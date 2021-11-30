<?php

namespace App\Http\Middleware;

use Closure;

class OrganizationPermission
{
    public function handle($request, Closure $next)
    {
        if(!empty(auth()->user())){
            if(session('org_id') == null){
                abort(response()->json([
                    'success' => false,
                    'message' => 'Session has been expired, please login again!'
                ], 403));
            }
            // Session value set on login
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId(session('org_id'));
        }
        return $next($request);
    }
}
