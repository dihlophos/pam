<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Organ;
use App\Models\Institution;
use App\Models\Subdivision;
use App\Models\Object;
use App\Policies\ObjectPolicy;
use App\Policies\OrganPolicy;
use App\Policies\InstitutionPolicy;
use App\Policies\SubdivisionPolicy;

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
        Institution::class => InstitutionPolicy::class,
        Subdivision::class => SubdivisionPolicy::class,
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
