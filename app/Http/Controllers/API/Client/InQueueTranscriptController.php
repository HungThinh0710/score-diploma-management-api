<?php

namespace App\Http\Controllers\API\Client;

use App\ClassRoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\InQueueTranscript\ApproveQueueTranscriptRequest;
use App\Http\Requests\API\InQueueTranscript\GetQueueTranscriptRequest;
use App\InQueueTranscript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InQueueTranscriptController extends Controller
{
    private const NEW_TRANSCRIPT_TYPE = 1;
    private const UPDATE_TRANSCRIPT_TYPE = 2;
    private const DELETE_TRANSCRIPT_TYPE = 3;

    public function index(Request $request)
    {
//        $this->authorize('view', InqueueTranscript::class);
//        $myClasses = ClassRoom::where('org_id', $request->user()->org_id)->pluck('id')->toArray();
//        $i = InQueueTranscript::whereIn('class_id', $myClasses)->paginate($request->perpage);
//        return response()->json([
//            'message' => "Get in queue transcript successfully",
//            'transcripts' => $i
//        ], 200);
        $classArray = ClassRoom::where('org_id', $request->user()->org_id)->pluck('id')->toArray();
        $inQueueTranscript = InQueueTranscript::with('classroom')->whereIn('class_id', $classArray)->paginate($request->perpage);
        return response()->json([
            'message' => "Get in queue transcript successfully",
            'success' => true,
            'transcripts' => $inQueueTranscript
        ], 200);
    }

    public function approve(ApproveQueueTranscriptRequest $request)
    {
        $inQueueTranscript = InQueueTranscript::findOrFail($request->input('queue_id'));
        $this->authorize('approve', $inQueueTranscript);
        $transcriptController = new TranscriptController();

        $classRoom = ClassRoom::findOrFail($inQueueTranscript->class_id);
        $transcriptDecrypted = Crypt::decryptString($inQueueTranscript->transcript);

        $payload['class_id'] = $inQueueTranscript->class_id;
        $payload['student_code'] = $inQueueTranscript->student_code;
        $payload['student_name'] = $inQueueTranscript->student_name;
//        $payload['transcript'] = $inQueueTranscript->transcript;
        $payload['transcript'] = json_decode($transcriptDecrypted);

        return $transcriptController->directSubmit($payload, $classRoom);
    }
}
