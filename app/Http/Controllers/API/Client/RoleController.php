<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Role\CreateRoleRequest;
use App\Http\Requests\API\Role\DeleteRoleRequest;
use App\Http\Requests\API\Role\UpdateRoleRequest;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view',Role::class);
        $roles = Role::where('org_id', session('org_id'))->get();
        return response()->json([
            'success' => true,
            'message' => 'Get roles successfully.',
            'roles' => $roles
        ]);
    }

    public function create(CreateRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $newRoles = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'org_id' => session('org_id')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'create role successfully.',
            'roles' => $newRoles
        ]);
    }

    public function update(UpdateRoleRequest $request)
    {
        $role = Role::findOrFail($request->input('role_id'));

        if($role->name == $request->input('name'))
            return response()->json([
                'success' => false,
                'message' => 'New role name must different with old role.',
            ], 400);

        $this->authorize('update', $role);

        $role->update(['name' => $request->input('name')]);
        if($role->update(['name' => $request->input('name')]))
            return response()->json([
                'success' => true,
                'message' => 'Update role successfully.',
            ]);
        return response()->json([
            'success' => false,
            'message' => 'Update role failed.',
        ], 400);
    }

    public function delete(DeleteRoleRequest $request)
    {
        //Need import roles to db
        //TODO: WAITING
    }
}
