<?php

namespace App\Http\Controllers\API\Client;

use App\API;
use App\BlockchainToken;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Authenticate\LoginRequest;
use App\Http\Requests\API\Authenticate\RegisterRequest;
use App\Http\Traits\BlockchainExecutionTrait;
use App\Organization;
use App\User;
//use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    use BlockchainExecutionTrait;

    public function register(RegisterRequest $request)
    {
        if (!Organization::find($request->input('org_id')))
            return response()->json([
                'message' => 'Organization is not found.',
                'success' => false
            ], 400);

        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);

        $user = new User($request->all());
        $payload = ['email' => $request->input('email')];
        $responseBody = $this->postAPI(API::REGISTER, null, $payload, false);

        DB::beginTransaction();
        if ((bool)$responseBody->success == true && $user->save() == true) {
            DB::commit();
            return response()->json([
                'message' => 'Register successfully.',
                'success' => true,
                'user' => $user,
                'wallet' => $responseBody->response
            ], 201);
        }
//        $this->postAPI(API::REVOKE_USER, null, $payload);
        DB::rollBack();
        return response()->json([
            'message'     => $responseBody->errorMessage,
            'success'     => false,
            'user'        => null,
            'credentials' => false,
        ], 400);

    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials))
            return response()->json([
                'success' => false,
                'message' => 'Email or password are wrong! Please try again.'
            ], 401);

        // Fixed payload (Will replace by user's upload in next release
        $wallet = $request->input('wallet');
        $payload = [
            'user' => [
                'email' => $request->input('email'),
                'organization' => Auth::user()->org->org_prefix //right method [available in next release]
            ],
            'wallet' => $wallet
        ];

        $responseLogin = $this->postAPI(API::LOGIN, null, $payload, false);
        if($responseLogin->success == true){
            $token = Auth::user()->createToken('appToken');
//            $cookie = $this->getCookieDetails($token->accessToken);
            session(['org_id' => Auth::user()->org_id]);

            $blockchainCredentials = [
                'user_id' => Auth::user()->id,
                'token' => $responseLogin->response['credentials']['token'],
                'expires_at' => Carbon::createFromTimestamp($responseLogin->response['credentials']['expires_at'])->toDateTimeString(),
            ];

            BlockchainToken::updateOrCreate(
                ['user_id' => Auth::user()->id],
                $blockchainCredentials
            );

            return response()->json([
                'success' => true,
                'message' => 'Login successfully.',
                'user' => Auth::user(),
                'access_token' => $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            ]);
        }
        Auth::logout();
        return response()->json([
            'success' => false,
            'message' => $responseLogin['errorMessage']
        ], 400);
    }

}
