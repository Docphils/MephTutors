<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Gate::define('Admin', function ($user) {
            // Check if the user has the role of an administrator
            return $user->isAdmin(); 
        });

        Gate::define('Tutor', function ($user) {
            // Check if the user has the role of a tutor
            return $user->isTutor(); 
        });
    }
}
