<?php

namespace App\Http\Controllers\API\Integrate;

use App\API;
use App\ClassRoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\InQueueTranscript\GetTranscriptByStudentCodeRequest;
use App\Http\Requests\API\InQueueTranscript\GetTranscriptByTrxIDRequest;
use App\Http\Requests\API\Transcript\SubmitNewTranscriptRequest;
use App\Http\Requests\API\Transcript\UpdateTranscriptRequest;
use App\Http\Traits\BlockchainExecutionTrait;
use App\Http\Traits\GetOrganizationSettings;
use App\InQueueTranscript;
use App\Transcript;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class TranscriptController extends Controller
{
    use GetOrganizationSettings, BlockchainExecutionTrait;

    private const NEW_TRANSCRIPT_TYPE = 1;
    private const UPDATE_TRANSCRIPT_TYPE = 2;
    private const DELETE_TRANSCRIPT_TYPE = 3;

    private function isTranscriptExists($studentID) : bool
    {
        return Transcript::where('student_code', $studentID)->exists() || InqueueTranscript::where('student_code', $studentID)->exists();
    }

    private function inQueueSubmit($payload, $type): JsonResponse
    {
        try {
            $transcriptEncrypted = Crypt::encryptString(json_encode($payload['transcript']));
            InQueueTranscript::create([
                'class_id'        => $payload['class_id'],
                'student_code'    => $payload['student_code'],
                'student_name'    => $payload['student_name'],
                'type'            => $type,
//                'transcript'      => json_encode($payload['transcript'])
                'transcript'      => json_encode($transcriptEncrypted)
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Submit transcript successfully (Waiting approve).',
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

    private function prepareTranscriptPayload($payload, ClassRoom $classroom): array
    {
        return [
            'student' => [
                'studentID'     => $classroom['org']['org_code'].'_'.$payload['student_code'],
                'studentName'   => $payload['student_name'],
                'uniCode'       => $classroom['org']['org_code'],
                'class'         => $classroom['class_name'],
                'transcript'    => $payload['transcript']
            ]
        ];
    }

    public function directSubmit($payload, $classroom, $request): JsonResponse
    {
        $transcript = $this->prepareTranscriptPayload($payload, $classroom);
        DB::beginTransaction();
        $result = $this->postAPI(API::SUBMIT_NEW_TRANSCRIPT,null, $transcript, true, $request);

        // Import to Database
        $transcriptModel = new Transcript;
        $transcriptModel->class_id     = $classroom->id;
        $transcriptModel->student_code = $payload['student_code'];
        $transcriptModel->student_name = $payload['student_name'];
        $transcriptModel->trxID = '0';
        $transcriptModel->save();

        if($result->success){
            $transcriptModel->trxID = $result->response['trxID'];
            $transcriptModel->save();
            InqueueTranscript::where('student_code', $payload['student_code'])->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => $result->message,
                'code'    => $result->code,
                'data'    => $result->response,
            ], 201);
        }

        DB::rollBack();
        return response()->json([
            'success' => false,
            'data'    => null,
            'message' => $result->errorMessage,
            'code'    => $result->code,
        ], 400);
    }

    public function submit(SubmitNewTranscriptRequest $request): JsonResponse
    {
        $isTranscriptExisted = $this->isTranscriptExists($request->input('student_code'));
        if($isTranscriptExisted)
            return response()->json([
                'success' => false,
                'data'    => null,
                'message' => 'StudentID: '.$request->input('student_code').' is already exist in transcripts.',
                'code'    => 2,
            ], 422);

        $orgSettings = $this->getOrgSetting($request->integrate->org_id);
        $class = ClassRoom::where('org_id', $request->integrate->org_id)->where('id', $request->input('class_id'))->firstOrFail();
        $payload = $request->only('class_id', 'student_code', 'student_name', 'transcript');
        if($orgSettings->is_direct_submit_transcript){
            return $this->directSubmit($payload, $class, $request);
        }

        return $this->inQueueSubmit($payload, self::NEW_TRANSCRIPT_TYPE);
    }

    public function submitRaw(SubmitNewTranscriptRequest $request): JsonResponse
    {
        $isTranscriptExisted = $this->isTranscriptExists($request->input('student_code'));
        if($isTranscriptExisted)
            return response()->json([
                'success' => false,
                'data'    => null,
                'message' => 'StudentID: '.$request->input('student_code').' is already exist in transcripts.',
                'code'    => 2,
            ], 422);

        $orgSettings = $this->getOrgSetting($request->integrate->org_id);
        $class = ClassRoom::where('org_id', $request->integrate->org_id)->where('id', $request->input('class_id'))->firstOrFail();
        $payload = $request->only('class_id', 'student_code', 'student_name', 'transcript');
        if($orgSettings->is_direct_submit_transcript){
            return $this->directSubmit($payload, $class);
        }

        return $this->inQueueSubmit($payload, self::NEW_TRANSCRIPT_TYPE);
    }

    public function getByStudentCode(GetTranscriptByStudentCodeRequest $request)
    {
        $transcript = Transcript::where('student_code', $request->only('student_code'))->first(); // FIXME: AUTHEN

        $trxID = ['trxID' => $transcript->trxID];
        $result = $this->postAPI(API::GET_DETAIL_TRANSCRIPT, null, $trxID, true, $request);
        if($result->success){
            $transcript = $result->response;
            return response()->json([
                'success'       => true,
                'message'       => 'Get transcript from Blockchain API successfully.',
                'code'          => 0,
                'transcript'    => $transcript,
            ]);
        }
        return response()->json([
            'success'       => false,
            'message'       => 'Get transcript from Blockchain API failed.',
            'code'          => 0,
            'transcript'    => null,
        ]);
    }

    public function getByTrxId(GetTranscriptByTrxIDRequest $request)
    {
        $transcript = Transcript::where('trxID', $request->only('trxID'))->first(); // FIXME: AUTHEN

        $trxID = ['trxID' => $transcript->trxID];
        $result = $this->postAPI(API::GET_DETAIL_TRANSCRIPT, null, $trxID, true, $request);
        if($result->success){
            $transcriptBlockchain = $result->response;
            return response()->json([
                'success'       => true,
                'message'       => 'Get transcript from Blockchain API successfully.',
                'code'          => 0,
                'data'    => $transcriptBlockchain,
                'student_in_db' => $transcript
            ]);
        }
        return response()->json([
            'success'       => false,
            'message'       => 'Get transcript from Blockchain API failed.',
            'code'          => 0,
            'transcript'    => null,
        ]);
    }

    public function index(Request $request)
    {
        $orgId = $request->integrate->org_id;
        return Transcript::with('classRoom')->whereHas('classRoom', function ($q) use ($orgId) {
            $q->where('org_id', $orgId);
        })->paginate($request->input('perpage'));
    }

    public function history(GetTranscriptByStudentCodeRequest $request)
    {
        $studentID = ['studentID' => $request->user()->org->org_code.'_'.$request->input('student_code')];
        //FIXME: ERROR FIND STUDENT_CODE IN CLASS
        $result = $this->postAPI(API::GET_HISTORY_TRANSCRIPT, null, $studentID, true, $request);
        if($result->success){
            return response()->json([
                'success'       => true,
                'message'       => 'Get transcript history from Blockchain API successfully.',
                'code'          => 0,
                'history'    => $result->response
            ]);
        }
        return response()->json([
            'success'       => false,
            'message'       => $result->errorMessage,
            'code'          => $result->code,
            'history'    => null,
        ]);
    }

    public function update(UpdateTranscriptRequest $request)
    {
        $classroom = ClassRoom::with(['org'])->find($request->input('class_id'));

        $data = $request->only('class_id', 'student_code', 'student_name', 'transcript');
        $payload = $this->prepareTranscriptPayload($data, $classroom);

        $result = $this->postAPI(API::UPDATE_TRANSCRIPT, null, $payload, true, $request);

        if($result->success){
            Transcript::where('student_code', $data['student_code'])->update([
                'class_id'     => $classroom->id,
                'student_code' => $data['student_code'],
                'student_name' => $data['student_name'],
                'trxID'        => $result->response['trxID'],
            ]);
            return response()->json([
                'success'       => true,
                'message'       => 'Update transcript successfully.',
                'code'         => $result->code,
                'trxID'    => $result->response
            ]);
        }

        return response()->json([
            'success'       => false,
            'message'       => $result->errorMessage,
            'code'          => $result->code,
            'trxID'    => null,
        ]);
    }
}
