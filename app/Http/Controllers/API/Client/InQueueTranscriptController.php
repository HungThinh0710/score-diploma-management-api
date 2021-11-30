<?php

namespace App\Http\Controllers\API\Client;

use App\ClassRoom;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\InQueueTranscript\ApproveQueueTranscriptRequest;
use App\Http\Requests\API\InQueueTranscript\GetQueueTranscriptRequest;
use App\InQueueTranscript;
use Illuminate\Http\Request;

class InQueueTranscriptController extends Controller
{
    private const NEW_TRANSCRIPT_TYPE = 1;
    private const UPDATE_TRANSCRIPT_TYPE = 2;
    private const DELETE_TRANSCRIPT_TYPE = 3;

    public function index(Request $request)
    {
        $this->authorize('view', InqueueTranscript::class);
        $myClasses = ClassRoom::where('org_id', $request->user()->org_id)->pluck('id')->toArray();
        return InQueueTranscript::whereIn('class_id', $myClasses)->get();
    }

    public function approve(ApproveQueueTranscriptRequest $request)
    {
        $inQueueTranscript = InQueueTranscript::findOrFail($request->input('queue_id'));
        $this->authorize('approve', $inQueueTranscript);
        $transcriptController = new TranscriptController();

        $classRoom = ClassRoom::findOrFail($inQueueTranscript->class_id);

        $payload['class_id'] = $inQueueTranscript->class_id;
        $payload['student_code'] = $inQueueTranscript->student_code;
        $payload['student_name'] = $inQueueTranscript->student_name;
        $payload['transcript'] = $inQueueTranscript->transcript;

        return $transcriptController->directSubmit($payload, $classRoom);
    }
}
