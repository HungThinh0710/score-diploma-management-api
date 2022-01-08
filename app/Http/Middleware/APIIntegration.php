<?php

namespace App\Http\Middleware;

use App\IntegrationAPI;
use Closure;

class APIIntegration
{
    private function mergeIntegrationToRequest($next, $request, $integrateAPI)
    {
//        $request->integrate = $integrateAPI; // Use request merge instead.
        $request->merge(['integrate' => $integrateAPI]);
        return $next($request);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken()) {
            $providerAPIKey = str_replace('Bearer ', '', $request->header('Authorization'));
            if(IntegrationAPI::where('api', $providerAPIKey)->exists()){
                $integrateAPI = IntegrationAPI::where('api', $providerAPIKey)->first();
                return $integrateAPI->is_activate == 1 ? $this->mergeIntegrationToRequest($next, $request, $integrateAPI) : response()->json([
                    'message' => 'API Key is not activated.',
                    'success' => false,
                    'code' => 97
                ], 403);
            }
            abort(response()->json([
                'message' => 'unauthenticated.',
                'success' => false,
                'code' => 98
            ], 401));
        }
        abort(response()->json([
            'message' => 'API Key not found.',
            'success' => false,
            'code' => 99
        ], 401));
    }
}
