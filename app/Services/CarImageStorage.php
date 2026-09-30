<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class CarImageStorage
{
    private const REMOTE_PREFIX = 'supabase:';

    public function store(UploadedFile $file, string $directory): string
    {
        $this->assertAvailable();

        if (!$this->configured()) {
            return $file->store($directory, 'public');
        }

        $mimeType = $file->getMimeType() ?: 'application/octet-stream';
        $path = trim($directory, '/').'/'.Str::uuid().'.'.($file->guessExtension() ?: 'jpg');
        $response = $this->request()
            ->withHeaders([
                'Content-Type' => $mimeType,
                'x-upsert' => 'false',
                'cache-control' => 'max-age=31536000',
            ])
            ->withBody(file_get_contents($file->getRealPath()), $mimeType)
            ->post($this->bucketUrl().'/'.$this->encodePath($path));

        $response->throw();

        return self::REMOTE_PREFIX.$path;
    }

    public function assertAvailable(): void
    {
        if (app()->environment('production') && !$this->configured()) {
            throw new RuntimeException('Supabase Storage is not configured. Set SUPABASE_URL and SUPABASE_SERVICE_ROLE_KEY.');
        }
    }

    public function delete(string $path): void
    {
        if (Str::startsWith($path, self::REMOTE_PREFIX)) {
            $objectPath = substr($path, strlen(self::REMOTE_PREFIX));
            $this->request()->delete($this->bucketUrl(), ['prefixes' => [$objectPath]])->throw();

            return;
        }

        Storage::disk('public')->delete($path);
    }

    public function url(string $path): string
    {
        if (Str::startsWith($path, self::REMOTE_PREFIX)) {
            $objectPath = substr($path, strlen(self::REMOTE_PREFIX));

            return $this->baseUrl().'/storage/v1/object/public/'.rawurlencode($this->bucket()).'/'.$this->encodePath($objectPath);
        }

        return asset('storage/'.$path);
    }

    private function configured(): bool
    {
        return filled(config('services.supabase_storage.url'))
            && filled(config('services.supabase_storage.service_role_key'));
    }

    private function request(): PendingRequest
    {
        $key = config('services.supabase_storage.service_role_key');

        return Http::acceptJson()
            ->withHeaders(['apikey' => $key])
            ->withToken($key)
            ->timeout(30);
    }

    private function bucketUrl(): string
    {
        return $this->baseUrl().'/storage/v1/object/'.rawurlencode($this->bucket());
    }

    private function baseUrl(): string
    {
        return rtrim((string) config('services.supabase_storage.url'), '/');
    }

    private function bucket(): string
    {
        return (string) config('services.supabase_storage.bucket', 'car-images');
    }

    private function encodePath(string $path): string
    {
        return implode('/', array_map('rawurlencode', explode('/', $path)));
    }
}
