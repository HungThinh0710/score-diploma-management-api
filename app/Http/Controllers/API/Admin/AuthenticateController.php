<?php

namespace App\Http\Controllers\API\Admin;

use App\Admin;
use App\API;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{

    public function register(Request $request)
    {
        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $admin = Admin::create($request->all());

        return response()->json([
            'message' => 'Register successfully.',
            'success' => true,
            'admin_user' => $admin,
            'code' => 0,
        ], 201);
    }

    private function getCookieDetails($token)
    {
        return [
            'name' => '_admin_token',
            'value' => $token,
            'minutes' => 525948, // 525948
            'path' => null,
            'domain' => null,
            //  'secure' => true, // for production https
            'secure' => false, // for localhost
            'httponly' => true,
            'samesite' => true,
        ];
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::guard('admin')->attempt($credentials)){
            $token = Auth::guard('admin')->user()->createToken('appToken', ['admin']);
            $cookie = $this->getCookieDetails($token->accessToken);
            return response()->json([
                'success' => true,
                'message' => 'Login successfully.',
                'admin_user' => Auth::guard('admin'),
                'code' => 0,
                'access_token' => $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            ])->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);
        }
        return response()->json([
            'success' => false,
            'code'    => 2,
            'message' => 'Email or password are wrong! Please try again.'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::user()->token()->revoke();
        $cookie = Cookie::forget('_token');
        return response()->json([
            'message' => 'Logout user successfully'
        ])->withCookie($cookie);
    }
}
