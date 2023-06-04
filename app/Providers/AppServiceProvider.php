<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

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
        // Paginator::useBootstrapFive();
        // Paginator::useBootstrapFour();

        Gate::define('auth', function () {
            return auth()->user();
        });

        Gate::define('admin', function (User $user) {
            return $user->is_admin === 1;
        });

        Gate::define('produsen', function (User $user) {
            return $user->actor_id === 2 && $user->is_admin === 0;
        });

        Gate::define('farmer', function (User $user) {
            return $user->actor_id === 1 && $user->is_admin === 0;
        });
    }
}
