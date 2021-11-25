<?php

namespace App\Http\Controllers\API\Client;

use App\API;
use App\ClassRoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Transcript\SubmitNewTranscriptRequest;
use App\Http\Traits\BlockchainExecutionTrait;
use App\Http\Traits\GetOrganizationSettings;
use App\InQueueTranscript;
use App\Transcript;
use Illuminate\Http\JsonResponse;

class TranscriptController extends Controller
{
    use GetOrganizationSettings, BlockchainExecutionTrait;

    private function inQueueSubmit($payload): JsonResponse
    {
        try {
            InQueueTranscript::create([
                'class_id'     => $payload['class_id'],
                'student_code' => $payload['studentID'],
                'payload'      => json_encode($payload['transcript'])
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Submit transcript successfully.',
                'type'    => 'Waiting approve'
            ], 201);
        }
        catch (\Illuminate\Database\QueryException $ex){
            return response()->json([
                'success' => false,
                'message' => 'Submit transcript failed.',
                'error' => $ex->getMessage(),
            ], 400);
        }
    }

    private function prepareTranscriptPayload($payload, $classroom): array
    {
        return [
            'student' => [
                'studentID'     => $classroom['org']['org_code'].'_'.$classroom['class_name'],
                'studentName'   => $payload['studentName'],
                'uniCode'       => $classroom['org']['org_code'],
                'class'         => $classroom['class_name'],
                'transcript'    => $payload['transcript']
            ]
        ];
    }


    private function directSubmit($payload, $classroom): JsonResponse
    {
        $transcript = $this->prepareTranscriptPayload($payload, $classroom);
        $result = $this->postAPI(API::SUBMIT_NEW_TRANSCRIPT,null, $transcript, true);
        if(!$result->success){
            return response()->json([
                'success' => false,
                'message' => $result->message,
            ], 400);
        }
        return response()->json([
            'success' => true,
            'message' => $result->message,
        ]);
    }

    public function submit(SubmitNewTranscriptRequest $request): JsonResponse
    {
        $org = $this->getOrgSetting($request->user()->org_id);
        $class = ClassRoom::find($request->input('class_id'));
        $payload = $request->only('class_id', 'student_code', 'studentID', 'studentName', 'transcript');

        if($org->is_direct_submit_transcript){
            $this->authorize('submit', [Transcript::class, $class]);
            return $this->directSubmit($payload, $class);
        }

        $this->authorize('submit', [InQueueTranscript::class, $class]);
        return $this->inQueueSubmit($payload);
    }

}
