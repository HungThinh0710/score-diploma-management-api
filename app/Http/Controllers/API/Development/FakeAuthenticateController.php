<?php

namespace App\Http\Controllers\API\Development;

use App\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Authenticate\LoginRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FakeAuthenticateController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials))
            return response()->json([
                'success' => false,
                'message' => 'Email or password are wrong! Please try again.'
            ], 401);

        // Fixed payload (Will replace by user's upload in next release
        $token = Auth::user()->createToken('appToken');
        // Set org_id to session
        session(['org_id' => Auth::user()->org_id]);
        return response()->json([
            'success' => true,
            'message' => 'Login successfully.',
            'user' => Auth::user(),
            'access_token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
        ]);
    }
}
