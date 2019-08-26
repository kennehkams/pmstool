<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin',function($user){
            return $user->type === 'admin';
        });

        Gate::define('isOperation',function($user){
            return $user->type === 'operation';
        });

        Gate::define('isFinance',function($user){
            return $user->type === 'finance';
        });
        
        Gate::define('isHr',function($user){
            return $user->type === 'hr';
        });

        Gate::define('isPmanager',function($user){
            return $user->type === 'pmanager';
        });

        Gate::define('isTleader',function($user){
            return $user->type === 'tleader';
        });

        Gate::define('isAgent',function($user){
            return $user->type === 'agent';
        });

        Gate::define('isDriver',function($user){
            return $user->type === 'driver';
        });

        passport::routes();
    }
}
