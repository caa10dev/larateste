<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Permission;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if( !App::runningInConsole() ){
            $permissions = Permission::with('roles')->get();
            foreach ($permissions as $key => $permission) {
                Gate::define($permission->name, function($user) use ($permission){
                    return $user->hasPermission($permission);
                });
            }

            Gate::before(function(User $user, $ability)
            {
                if( $user->hasAnyRoles('master') )
                    return true;
            });
        }
    }
}
