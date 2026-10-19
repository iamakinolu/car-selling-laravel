<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Gate::define('manage-cars', fn (User $user) => $user->isAdmin());
        Vite::createAssetPathsUsing(fn (string $path, ?bool $secure) => '/'.ltrim($path, '/'));
    }
}
