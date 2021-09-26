<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define('hasPermission', function (User $user, $area = null, $module = null, $permission = null) {
            return ($area && $module && $permission) ? $user->hasPermission($area, $module, $permission) : false;
        });

        Gate::define('hasArea', function (User $user, $area = null) {
            return $area != null ?  $user->hasArea($area) : false;
        });

        Gate::define('hasModule', function (User $user, $module = null) {
            return $module != null ?  $user->hasModule($module) : false;
        });

    }
}
