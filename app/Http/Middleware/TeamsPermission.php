<?php

namespace App\Http\Middleware;

use Closure;

class TeamsPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd("Hello from TeamsPermission");
        if(!empty(auth()->user())){
            // session value set on login
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId(session('org_id'));
        }
        // other custom ways to get team_id
        /*if(!empty(auth('api')->user())){
            // `getTeamIdFromToken()` example of custom method for getting the set team_id
            app(\Spatie\Permission\PermissionRegistrar::class)->setPermissionsTeamId(auth('api')->user()->getTeamIdFromToken());
        }*/

        return $next($request);
    }
}
