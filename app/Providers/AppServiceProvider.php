<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Autoriser automatiquement les admins à tout faire
        Gate::before(function (User $user, string $ability) {
            if (strtolower($user->role) === 'admin') {
                return true;
            }
            return null; // sinon laisse la Policy gérer
        });
    }
}
