<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Organ;
use App\Models\Institution;
use App\Models\Subdivision;
use App\Models\Object;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Organ::class => OrganPolicy::class,
        Institution::class => Institution::class,
        Subdivision::class => Subdivision::class,
        Object::class => ObjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-lists', function ($user) {
            return $user->isAdmin();
        });
    }
}
