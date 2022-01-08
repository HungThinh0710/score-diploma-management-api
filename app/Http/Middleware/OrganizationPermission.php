<?php

namespace App\Http\Middleware;

use Closure;

class OrganizationPermission
{
    public function handle($request, Closure $next)
    {
        if (!empty(auth()->user())) {
            // Stop using session
//            if(session('org_id') == null){
//                abort(response()->json([
//                    'success' => false,
//                    'message' => 'Session has been expired, please login again!',
//                    'code'    => 98
//                ], 403));
//            }
            // Using org_id from a request instead of session

            $orgId = $request->user()->org_id;
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId($orgId);
        }

        return $next($request);
    }
}
