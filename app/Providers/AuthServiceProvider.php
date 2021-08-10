<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('USER_VIEW_ADMIN', function($user){
            return $user->canDo('USER_VIEW_ADMIN');
        });
        Gate::define('VIEW_ADMIN', function($user){
            return $user->canDo('VIEW_ADMIN');
        });

        Gate::define('USER_EDIT_ADMIN', function($user){
            return $user->canDo('USER_EDIT_ADMIN');
        });
    }
}
