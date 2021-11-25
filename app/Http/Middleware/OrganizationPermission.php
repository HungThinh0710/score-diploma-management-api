<?php

namespace App\Http\Middleware;

use Closure;

class OrganizationPermission
{
    public function handle($request, Closure $next)
    {
        if(!empty(auth()->user())){
            // Session value set on login
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId(session('org_id'));
        }
        return $next($request);
    }
}
