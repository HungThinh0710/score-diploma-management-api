<?php

namespace App\Http\Middleware;

use Closure;

class AddDefaultPerpageMiddleware
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
        if(!$request->has('perpage'))
            $request->merge(['perpage' => 10]);
        return $next($request);
    }
}
