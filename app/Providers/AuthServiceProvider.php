<?php

namespace App\Providers;

use App\ClassRoom;
use App\InQueueTranscript;
use App\Organization;
use App\Permission;
use App\Role;
use App\Transcript;
use App\Major;
use App\Subject;
use App\Policies\ClassRoomPolicy;
use App\Policies\InQueueTranscriptPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use App\Policies\TranscriptPolicy;
use App\Policies\MajorPolicy;
use App\Policies\SubjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Organization::class      => OrganizationPolicy::class,
        ClassRoom::class         => ClassRoomPolicy::class,
        Permission::class        => PermissionPolicy::class,
        Role::class              => RolePolicy::class,
        Transcript::class        => TranscriptPolicy::class,
        InQueueTranscript::class => InQueueTranscriptPolicy::class,
        Major::class             => MajorPolicy::class,
        Subject::class           => SubjectPolicy::class,
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

        Passport::tokensCan([
            'user' => 'Access user API',
            'admin' => 'Access admin API',
        ]);

        Passport::setDefaultScope([
            'user',
        ]);


        // Implicitly grant "Admin" role all permission checks using can()
        // Do not use this, this make Policies will not working!!
//        Gate::before(function ($user, $ability) {
//            if ($user->hasRole('admin')) {
//                return true;
//            }
//        });
    }
}
