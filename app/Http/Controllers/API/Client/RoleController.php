<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Role\CreateRoleRequest;
use App\Http\Requests\API\Role\DeleteRoleRequest;
use App\Http\Requests\API\Role\SyncAllPermissionForRoleRequest;
use App\Http\Requests\API\Role\UpdatePermissionForRoleRequest;
use App\Http\Requests\API\Role\UpdateRoleRequest;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view', Role::class);
        $roles = Role::with('permissions')->where('org_id', $request->user()->org_id)->paginate($request->perpage);
        $permissions = Permission::all();
        return response()->json([
            'success' => true,
            'message' => 'Get roles successfully.',
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function create(CreateRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $newRoles = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web',
            'org_id' => $request->user()->org_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'create role successfully.',
            'roles' => $newRoles
        ]);
    }

    public function update(UpdateRoleRequest $request)
    {
//        $role = Role::findOrFail($request->input('role_id'));
        $role = Role::where('org_id', $request->user()->org_id)->where('id', $request->input('role_id'))->first();

        if ($role->name == $request->input('name'))
            return response()->json([
                'success' => false,
                'message' => 'New role name must different with old role.',
            ], 400);

        $this->authorize('update', $role);

        $role->update(['name' => $request->input('name')]);
        if ($role->update(['name' => $request->input('name')]))
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
        $role = Role::where('org_id', $request->user()->org_id)->where('id', $request->input('role_id'))->first();
        $this->authorize('delete', $role);
        $role->revokePermissionTo(Permission::all());
        $role->delete();
        return response()->json([
            'success' => true,
            'code'    => 0,
            'message' => 'Deleted role successfully.',
        ]);
    }

    public function updatePermissionForRole(UpdatePermissionForRoleRequest $request)
    {
        $role = Role::where('org_id', $request->user()->org_id)->where('id', $request->input('role_id'))->first();
        $this->authorize('managePermissionRole', $role);
        $permissions = $request->input('permissions');
        $permissionsDBArray = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissionsDBArray);
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        return response()->json([
            'success' => true,
            'code'    => 0,
            'message' => 'Synced permission successfully.',
        ]);
    }

    public function syncAllPermissionForRole(SyncAllPermissionForRoleRequest $request)
    {
        $role = Role::where('org_id', $request->user()->org_id)->where('id', $request->input('role_id'))->first();
        $this->authorize('managePermissionRole', $role);
        $role->givePermissionTo(Permission::all());
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        return response()->json([
            'success' => true,
            'code'    => 0,
            'message' => 'Give all permission to selected role successfully.',
        ]);
    }

}
