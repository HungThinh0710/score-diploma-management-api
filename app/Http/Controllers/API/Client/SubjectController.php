<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Major\DeleteMajorRequest;
use App\Http\Requests\API\Subject\CreateSubjectRequest;
use App\Http\Requests\API\Subject\DeleteSubjectRequest;
use App\Http\Requests\API\Subject\UpdateSubjectRequest;
use App\Major;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', Subject::class);
        $orgId = $request->user()->org_id;
        $subject = Subject::with('major')->whereHas('major', function ($q) use ($orgId) {
            $q->where('org_id', $orgId);
        })->paginate($request->input('perpage'));
        return response()->json([
            'success'  => true,
            'message'  => 'Get list subjects successfully.',
            'subjects' => $subject,
        ]);
    }

    public function create(CreateSubjectRequest $request)
    {
        $major = Major::findOrFail($request->input('major_id'));
        $this->authorize('checkMajorWithId', $major);
        $this->authorize('create', Subject::class);
        $major = Subject::create($request->only('major_id','subject_name', 'subject_code','credit'));
        return response()->json([
            'success'  => true,
            'message'  => 'Create subject successfully.',
            'subject'  => $major,
        ], 201);
    }

    public function update(UpdateSubjectRequest $request)
    {
        $major = Major::find($request->input('major_id'));
        if($major)
            $this->authorize('checkMajorWithId', $major);
        $subject = Subject::findOrFail($request->input('subject_id'));
        $this->authorize('update', $subject);
        $payload = array_filter($request->only('major_id', 'subject_name', 'subject_code', 'credit'), 'strlen');
        $isUpdated = $subject->update($payload);
        if($isUpdated)
            return response()->json([
                'success' => true,
                'message' => 'Update subject successfully.',
                'subject' => Subject::find($request->input('subject_id'))
            ], 200);
        return response()->json([
            'success' => false,
            'message' => 'Update subject failed.',
        ], 200);
    }

    public function delete(DeleteSubjectRequest $request)
    {
        $subject = Subject::findOrFail($request->input('subject_id'));
        $this->authorize('delete', $subject);
        $subject->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted subject successfully.',
        ]);
    }

}
