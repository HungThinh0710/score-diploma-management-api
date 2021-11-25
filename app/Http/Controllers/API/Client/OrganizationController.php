<?php

namespace App\Http\Controllers\API\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Organization\UpdateOrganizationRequest;
use App\Http\Requests\API\Organization\ViewOrganizationRequest;
use App\Organization;

class OrganizationController extends Controller
{
    public function index(ViewOrganizationRequest $request)
    {
        $org = Organization::findOrFail($request->input('org_id'));
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
        $payload = array_filter($request->only('org_name','email','email_domain','description','address'), 'strlen');
        $org->update($payload);
        // TODO edit org here
        return response()->json([
            'success' => true,
            'message' => 'Update organization successfully.',
            'organization' => $org,
        ]);
    }
}
