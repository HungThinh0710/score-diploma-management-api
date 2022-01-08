<?php

namespace App\Http\Controllers\API\Integrate;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Organization\UpdateOrganizationRequest;
use App\Http\Requests\API\Organization\ViewOrganizationRequest;
use App\Http\Traits\GetOrganizationSettings;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;

class OrganizationController extends Controller
{
    use GetOrganizationSettings;

    public function index(ViewOrganizationRequest $request)
    {
        $org = Organization::where('id', $request->integrate->org_id)->firstOrFail();
        return response()->json([
            'success' => true,
            'organization' => $org,
        ]);
    }

    public function update(UpdateOrganizationRequest $request)
    {
        $org = Organization::where('id', $request->integrate->org_id)->firstOrFail();
        $payload = array_filter($request->only('org_name', 'email', 'email_domain', 'description', 'address'), 'strlen');
        $org->update($payload);
        return response()->json([
            'success' => true,
            'message' => 'Update organization successfully.',
            'organization' => $org,
        ]);
    }

    public function users(Request $request)
    {
        $users = User::with('roles')->where('org_id', $request->integrate->org_id)->paginate($request->input('perpage')); // Use $request->org->user instead
        return response()->json([
            'success' => true,
            'message' => 'Get users in organization successfully.',
            'users' => $users,
        ]);
    }

    public function getSetting(Request $request)
    {
        $orgId = $request->integrate->org_id;
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
        $orgId = $request->integrate->org_id;
        $orgSetting = $this->getOrgSetting($orgId);
        $orgSetting->update($payload);
        return response()->json([
            'success' => true,
            'message' => 'Update organization setting successfully.',
            'setting' => $orgSetting,
        ]);
    }
}
