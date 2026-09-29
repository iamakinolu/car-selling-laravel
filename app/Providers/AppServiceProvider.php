<?php
namespace App\Providers;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Vite::createAssetPathsUsing(fn (string $path, ?bool $secure) => '/'.ltrim($path, '/'));
    }
}
