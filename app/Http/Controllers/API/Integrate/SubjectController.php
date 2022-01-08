<?php

namespace App\Http\Controllers\API\Integrate;

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
        $orgId = $request->integrate->org_id;
        $classId = $request->input('class_id');
        if($request->has('class_id')){
            $subjects = Subject::with('majors.classes')->whereHas('majors.classes', function ($q) use ($orgId, $classId){
                return $q->where('classes.id', $classId);
            })
                ->where('org_id', $orgId)
                ->paginate($request->input('perpage'));
        }
        else{
             $subjects = Subject::with('majors')->where('org_id', $orgId)->paginate($request->input('perpage'));
        }
        return response()->json([
            'success'  => true,
            'message'  => 'Get list subjects successfully.',
            'subjects' => $subjects,
        ]);
    }

    public function create(CreateSubjectRequest $request)
    {
        $request->merge(['org_id' => $request->integrate->org_id]);
        $subject = Subject::create($request->only('org_id', 'subject_name', 'subject_code', 'credit'));
        return response()->json([
            'success'  => true,
            'message'  => 'Create subject successfully.',
            'subject'  => $subject,
        ], 201);
    }

    public function update(UpdateSubjectRequest $request)
    {
        $subject = Subject::where('org_id', $request->integrate->org_id)->where('id', $request->input('subject_id'))->firstOrFail();
        $payload = array_filter($request->only('subject_name', 'subject_code', 'credit'), 'strlen');
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
        $subject = Subject::where('org_id', $request->integrate->org_id)->where('id', $request->input('subject_id'))->firstOrFail();
        $subject->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted subject successfully.',
        ]);
    }

}
