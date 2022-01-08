<?php

namespace App\Http\Middleware;

use App\IntegrationAPI;
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

            // Check integration before

            $orgId = $request->user()->org_id;
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId($orgId);
        }

//        if ($request->bearerToken()) {
//            if ($request->header('Authorization') != null) {
//                $providerAPIKey = str_replace('Bearer ', '', $request->header('Authorization'));
//                if (IntegrationAPI::where('api', $providerAPIKey)->exists()) {
//                    $integrateAPI = IntegrationAPI::where('api', $providerAPIKey)->first();
//                    if ($integrateAPI->is_activate === 1) {
//                        $request->merge(['integrate' => $integrateAPI]);
////                        $request->integrate = $integrateAPI;
//                        app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId($integrateAPI->org_id);
//                    }
//                }
//            }
//        }

        return $next($request);
    }
}
