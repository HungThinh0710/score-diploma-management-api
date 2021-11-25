<?php

namespace App\Http\Traits;
use App\BlockchainToken;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Auth;
use stdClass;

trait BlockchainExecutionTrait{

    private function returnObject($success = false, $message = 'Unknown error') : stdClass
    {
        $return = new stdClass;
        $return->success = $success;
        $return->message = $message;
        return $return;
    }

    private function isJWTValid($token)
    {

    }

    public function getAPI($endpoint, $headers, $params)
    {

    }

    public function postAPI($endpoint, $headers, $payload, $authentication = false)
    {
        try {
            $client = new \GuzzleHttp\Client();
            if($authentication === true){
                $blockchainToken = BlockchainToken::where('user_id', Auth::user()->id)->first();
                if($blockchainToken === null){
                    Auth::user()->token()->revoke();
                    return $this->returnObject(false, 'Blockchain token is not found, please sign in again.');
                }
                $headers['Authorization'] = 'Bearer '.$blockchainToken->token;
            }

            $headers['secret'] = env('SECRET_API_KEY');
            $response = $client->request('POST', $endpoint, [
                'headers' => $headers,
                'json' =>  $payload
            ]);
            return json_decode($response->getBody(), true);
        }
        catch (ClientException $e){
            echo Psr7\Message::toString($e->getRequest());
            echo Psr7\Message::toString($e->getResponse());
        }
    }

}
