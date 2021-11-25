<?php

namespace App\Providers;

use App\ClassRoom;
use App\InQueueTranscript;
use App\Organization;
use App\Permission;
use App\Policies\ClassRoomPolicy;
use App\Policies\InQueueTranscriptPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\TranscriptPolicy;
use App\Role;
use App\Transcript;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Organization::class => OrganizationPolicy::class,
        ClassRoom::class => ClassRoomPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class,
        Transcript::class => TranscriptPolicy::class,
        InQueueTranscript::class => InQueueTranscriptPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Schema::defaultStringLength(191);

        // Implicitly grant "Admin" role all permission checks using can()
        // Do not use this, this make Policies will not working!!
//        Gate::before(function ($user, $ability) {
//            if ($user->hasRole('admin')) {
//                return true;
//            }
//        });
    }
}
