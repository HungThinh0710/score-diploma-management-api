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
        $classId = $request->input('class_id');
        if($request->has('class_id')){
            $subjects = Subject::with('majors.classes')->whereHas('majors.classes', function ($q) use ($orgId, $classId){
//            $q->where('id', '17IT1');
                return $q->where('classes.id', $classId);

            })
                ->where('org_id', $orgId)
                ->paginate($request->input('perpage'));
        }
        else{
             $subjects = Subject::with('majors')->where('org_id', $orgId)->paginate($request->input('perpage'));
        }


//        dd($subjects);

        return response()->json([
            'success'  => true,
            'message'  => 'Get list subjects successfully.',
            'subjects' => $subjects,
        ]);
    }

    public function create(CreateSubjectRequest $request)
    {
        $this->authorize('create', Subject::class);
        $request->merge(['org_id' => $request->user()->org_id]);
        $subject = Subject::create($request->only('org_id', 'subject_name', 'subject_code', 'credit'));
        return response()->json([
            'success'  => true,
            'message'  => 'Create subject successfully.',
            'subject'  => $subject,
        ], 201);
    }

    public function update(UpdateSubjectRequest $request)
    {
//        $major = Major::find($request->input('major_id'));
//        if($major)
//            $this->authorize('checkMajorWithId', $major);
        $subject = Subject::findOrFail($request->input('subject_id'));
        $this->authorize('update', $subject);
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
        $subject = Subject::findOrFail($request->input('subject_id'));
        $this->authorize('delete', $subject);
        $subject->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted subject successfully.',
        ]);
    }

}
