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
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
/**
 * @group Authenticating endpoints
 *
 * APIs for authentication user.
 */
class AuthenticateController extends Controller
{
    use BlockchainExecutionTrait;

    /**
     * Register.
     * Login to organization (Only admin of organization can execute this endpoint)
     * @group Authenticating endpoints
     * @bodyParam org_id numeric required
     * @bodyParam email String required
     * @bodyParam password String required
     * @bodyParam full_name String required
     *
     * @response 201 {
     *  "message": "Register successfully.",
     *  "success": true,
     *  "user": {
     *      "org_id": 1,
     *      "email": "khaothi17@hungthinh.edu.vn",
     *      "full_name": "To Khao Thi VKU",
     *      "updated_at": "2021-12-02 18:23:04",
     *      "created_at": "2021-12-02 18:23:04",
     *      "id": 17
     *  },
     *  "wallet": "eyJpdiI6Ik9ORFdhMnA1T0hJaUhQTnVGWGxMMmc9PSIsInZhbHVlIjoiMzQ"
     * }
     */
    public function register(RegisterRequest $request)
    {
        if (!Organization::find($request->input('org_id')))
            return response()->json([
                'message' => 'Organization is not found.',
                'success' => false,
                'code' => 1,
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
                'code' => $responseBody->code,
//                'wallet' => $responseBody->response,
                'wallet' => Crypt::encryptString(json_encode($responseBody->response)),
            ], 201);
        }
//        $this->postAPI(API::REVOKE_USER, null, $payload);
        DB::rollBack();
        return response()->json([
            'message'     => $responseBody->errorMessage,
            'success'     => false,
            'user'        => null,
            'code' => $responseBody->code,
            'credentials' => false,
        ], 400);
    }
    private function getCookieDetails($token)
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => 525948,
            'path' => null,
            'domain' => null,
            //  'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => true,
            'samesite' => true,
        ];
    }

    /**
     * Login.
     * Login to organization
     *
     * @unauthenticated
     * @group Authenticating endpoints
     * @bodyParam email String required
     * @bodyParam password String required
     * @bodyParam wallet String required
     *
     * <h4 class="fancy-heading-panel"><b>Success Code</b></h4>
     * <p><b><code>0</code></b>  <small>Login success.</small>
     * <h4 class="fancy-heading-panel"><b>Error Code</b></h4>
     * <p><b><code>1</code></b>  <small>Wallet credentials is not valid.</small>
     * <p><b><code>2</code></b>  <small> Username or password are wrong.</small>
     *
     * @response 200 {
     *  "access_token": "access_token_here",
     *  "expires_at": "2022-12-02 23:01:04",
     *  "message": "Login successfully.",
     *  "success": true,
     *  "user": {
     *      "id": 17,
     *      "org_id": 1,
     *      "is_owner": 0,
     *      "email": "khaothi17@hungthinh.edu.vn",
     *      "full_name": "To Khao Thi VKU",
     *      …,
     *  },
     *  "created_at": "2021-12-02 18:23:04",
     *  "email": "khaothi17@hungthinh.edu.vn"
     * }
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials))
            return response()->json([
                'success' => false,
                'code'    => 2,
                'message' => 'Email or password are wrong! Please try again.'
            ], 401);

        $wallet = Crypt::decryptString($request->input('wallet'));
        $payload = [
            'user' => [
                'email' => $request->input('email'),
                'organization' => Auth::user()->org->org_prefix //right method [available in next release]
            ],
            'wallet' => json_decode($wallet)
        ];

        $responseLogin = $this->postAPI(API::LOGIN, null, $payload, false);
        if($responseLogin->success == true){
            $token = Auth::user()->createToken('appToken');
            $cookie = $this->getCookieDetails($token->accessToken);
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
                'code' => $responseLogin->code,
                'access_token' => $token->accessToken,
                'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
            ])->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);
        }

        Auth::user()->token()->revoke(); // instead Auth::logout
        return response()->json([
            'success' => false,
            'message' => $responseLogin['errorMessage'],
            'code' => $responseLogin->code,
        ], 400);
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
