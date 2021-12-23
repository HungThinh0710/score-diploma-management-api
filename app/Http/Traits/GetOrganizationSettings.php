<?php

namespace App\Http\Traits;

use App\Organization;
use App\OrganizationSettings;

trait GetOrganizationSettings{
    public function getOrgSetting($orgId)
    {

        $orgSettings = Organization::with('setting')->find($orgId);
        if(!$orgSettings)
            abort(
                response()->json([
                    'success' => false,
                    'message' => 'Organization setting not found.'
                ], 400));

        return $orgSettings->setting;
    }
}
