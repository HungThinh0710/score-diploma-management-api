<?php

namespace App\Http\Controllers\API\Integrate;

use App\ClassRoom;
use App\Organization;
use App\Major;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ClassRoom\CreateClassRequest;
use App\Http\Requests\API\ClassRoom\UpdateClassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassRoomController extends Controller
{
    public function showListClassRoom(Request $request)
    {
        $orgId = $request->integrate->org_id;
        $classRoom = ClassRoom::with(['major', 'transcripts'])->where('org_id', $orgId)->orderBy('class_name')->paginate($request->input('perpage'));
        return response()->json([
            'success' => true,
            'message' => 'Get class list successfully.',
            'classes' => $classRoom
        ]);
    }

    public function create(CreateClassRequest $request)
    {
        $major = Major::where('org_id', $request->integrate->org_id)->where('id', $request->input('major_id'))->firstOrFail();
        $request->merge(['org_id' => $request->integrate->org_id]);
        $payloads = $request->only("class_name", "major_id", "start_year", "code", "org_id");
        ClassRoom::create($payloads);
        return response()->json([
            'success' => true,
            'message' => 'Create class ' . $request->input('class_name') . ' successfully.',
            'class' => $payloads
        ], 201);
    }

    public function update(UpdateClassRequest $request)
    {
        $classId = $request->input('class_id');
        $payload = array_filter($request->only('class_name', 'start_year', 'code'), 'strlen');
        $classroom = ClassRoom::where('org_id', $request->integrate->org_id)->where('id', $classId)->firstOrFail();
        $isUpdated = $classroom->update($payload);
        if ($isUpdated)
            return response()->json([
                'success' => true,
                'message' => 'Update class successfully.',
                'class' => ClassRoom::findOrFail($classId)
            ], 200);
        return response()->json([
            'success' => false,
            'message' => 'Update class failed.',
        ], 400);
    }

    public function delete()
    {

    }
}
