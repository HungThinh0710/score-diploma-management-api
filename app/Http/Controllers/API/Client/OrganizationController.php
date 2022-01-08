<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Organization\UpdateOrganizationRequest;
use App\Http\Requests\API\Organization\ViewOrganizationRequest;
use App\Http\Traits\GetOrganizationSettings;
use App\Organization;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;

class OrganizationController extends Controller
{
    use GetOrganizationSettings;

    public function index(Request $request)
    {
        $org = Organization::findOrFail($request->user()->org_id);
        $this->authorize('view', $org);
        return response()->json([
            'success' => true,
            'organization' => $org,
        ]);
    }

    public function update(UpdateOrganizationRequest $request)
    {
        $org = Organization::findOrFail($request->input('org_id'));
        $this->authorize('update', $org);
        $payload = array_filter($request->only('org_name', 'email', 'email_domain', 'description', 'address'), 'strlen');
        $org->update($payload);
        // TODO edit org here
        return response()->json([
            'success' => true,
            'message' => 'Update organization successfully.',
            'organization' => $org,
        ]);
    }

    public function users(Request $request)
    {
        $this->authorize('users', Organization::class);
        $users = User::with('roles')->where('org_id', $request->user()->org_id)->paginate($request->input('perpage'));
        return response()->json([
            'success' => true,
            'message' => 'Get users in organization successfully.',
            'users' => $users,
        ]);
    }

    public function updateUser(Request $request)
    {
        $this->authorize('users', Organization::class); // FIXME: Must change permission
        $users = User::where('org_id', $request->user()->org_id)->where('id', $request->input('user_id'))->firstOrFail();
//        $payload = array_filter($request->only('email', 'full_name'), 'strlen');
        $payload = array_filter($request->only('full_name'), 'strlen');
        $users->update($payload);
        if($request->has('role_id')){
            $role = Role::where('org_id', $request->user()->org_id)->where('id', $request->input('role_id'))->first();
            $users->assignRole($role);
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        }
        return response()->json([
            'success' => true,
            'message' => 'Update user successfully.',
            'users' => $users,
        ]);
    }



    public function getSetting(Request $request)
    {
//        $this->authorize('view');

        $orgId = $request->user()->org_id;
        $setting = $this->getOrgSetting($orgId);
        return response()->json([
            'success' => true,
            'message' => 'Get organization setting successfully.',
            'setting' => $setting,
        ]);
    }

    public function changeSetting(Request $request)
    {
        $payload = array_filter($request->only('is_direct_submit_transcript', 'is_activate_email_domain'), 'strlen');
        $orgId = $request->user()->org_id;
        $orgSetting = $this->getOrgSetting($orgId);
        //        $this->authorize('update', $orgSetting); // TODO: NOT YET Permission
        $orgSetting->update($payload);
        return response()->json([
            'success' => true,
            'message' => 'Update organization setting successfully.',
            'setting' => $orgSetting,
        ]);
    }
}
