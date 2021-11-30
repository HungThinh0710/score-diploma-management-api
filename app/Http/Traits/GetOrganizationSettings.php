<?php

namespace App\Http\Traits;

use App\OrganizationSettings;

trait GetOrganizationSettings{
    public function getOrgSetting($orgId)
    {
        $org = OrganizationSettings::find($orgId);
        if(!$org)
            abort(
                response()->json([
                'success' => false,
                'message' => 'Organization setting not found.'
            ], 400));
        return $org;
    }
}
