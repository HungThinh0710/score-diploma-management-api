<?php

namespace App\Http\Traits;
use App\BlockchainToken;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Auth;
use stdClass;

trait BlockchainExecutionTrait{

    private function returnObject($success = false, $response = null) : stdClass
    {
        $return = new stdClass;
        $return->success = $success;
        $return->code = $response->code;
        $return->response = $response->data; // data return an array;
        if($response->success) {
            $return->message = $response->message;
            $return->errorMessage = $response->errorMessage;
        }
        else{
            $return->errorMessage = $response->errorMessage;
            $return->message = null;
        }
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
//            dd(json_decode($response->getBody()->getContents()));
            $responseJSON = (object) json_decode($response->getBody()->getContents(), true);
            return $this->returnObject($responseJSON->success, $responseJSON);
        }
        catch (ClientException $e){
            echo Psr7\Message::toString($e->getRequest());
            echo Psr7\Message::toString($e->getResponse());
        }
    }

}
