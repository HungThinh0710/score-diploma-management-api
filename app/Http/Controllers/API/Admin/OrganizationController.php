<?php

namespace App\Http\Controllers\API\Admin;

use App\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Organization\CreateOrganizationRequest;
use App\Http\Traits\BlockchainExecutionTrait;
use App\OrganizationSettings;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Organization;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class OrganizationController extends Controller
{
    use BlockchainExecutionTrait;

    public function getOrganizations(Request $request)
    {
        $organizations = Organization::paginate($request->perpage);
        return response()->json([
            'success' => true,
            'code' => 0,
            'message' => 'Get organizations successfully.',
            'organizations' => $organizations
        ]);
    }

    public function deactivateOrganization(Request $request)
    {
        $organizationId = $request->input('org_id');
        Organization::findOrFail($organizationId)->update(['status' => $request->input('status')]);
        return response()->json([
            'success' => true,
            'code' => 0,
            'message' => 'Successfully.',
        ]);
    }

    public function createOrganization(CreateOrganizationRequest $request)
    {
        $orgCode = $request->input('org_code');
        $orgDomain = $request->input('domain');
        // Check exists step 1
        if (Organization::where('org_prefix', $orgDomain)->orWhere('org_code', $orgCode)->exists())
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Educational Organization is already exists.',
            ]);
        if(User::where('email', $request->input('admin_user'))->exists())
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Your email user is already exists',
            ]);

        // Check exists step 2
        // Send MSPID to Blockchain System (If it not exists in blockchain, return error)
        $payloadGetMSPIDS = $this->postAPI(API::GET_MSPIDS);

        if($payloadGetMSPIDS->success == true){
            $msPIdsRaw = $payloadGetMSPIDS->response;
            $msPIds =  []; // MsPIds with right format (ex: "udn-vn" => "udn.vn")
            for ($i = 0; $i < sizeof($msPIdsRaw); $i++){
                $msPIds[] = str_replace('-', '.', $msPIdsRaw[$i]);
                if($msPIds[$i] == $orgDomain){
                    return response()->json([
                        'success' => false,
                        'code' => 1,
                        'message' => $msPIds[$i].' is already exists in Blockchain System.',
                    ]);
                }
            }

        }



        // TODO: Create a Setting record
        $organizationSetting = OrganizationSettings::create([
            'is_direct_submit_transcript' => 1,
            'is_activate_email_domain'    => 0,
        ]);
        if(!$organizationSetting)
            return response()->json([
                'success' => false,
                'code' => 1,
                'message' => 'Error when creating organization setting.',
            ]);

        // Passed Step 2 = Setup transaction
        DB::beginTransaction();

        $newOrg = Organization::create([
            'org_name' => $request->input('org_name'),
            'setting_id' => $organizationSetting->id,
            'org_code' => $orgCode,
            'org_prefix' => $orgDomain,
            'is_active' => 1,
            'email_domain' => $request->input('domain'),
            'email' => $request->input('email').'@'.$request->input('domain'),
            'status' => 0,
            'description' => $request->input('description'),
            'address' => $request->input('address'),
        ]);

        $newOrgId = $newOrg->id;

        // TODO: Create a user

        $adminUser = User::create([
            'org_id' => $newOrgId,
            'is_owner' => 1,
            'full_name' => 'Admin',
            'email' => $request->input('admin_user'),
            'password' => Hash::make($request->input('admin_password')),
        ]);


        // TODO: Init, Assign Role & Permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        app(PermissionRegistrar::class)->setPermissionsTeamId($newOrgId);
        $roleAdmin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
            'org_id' => $newOrgId
        ]);
        $roleUser = Role::create([
            'name' => 'user',
            'guard_name' => 'web',
            'org_id' => $newOrgId
        ]);
        $roleAdmin->givePermissionTo(Permission::all());
        $roleUser->givePermissionTo('view class','view transcript', 'submit transcript', 'update transcript');

        $adminUser->assignRole($roleAdmin);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $dataEnroll = [
            "mspid" => $orgDomain,
            "orgCode" => $orgCode,
            "email" => $request->input('admin_user')
        ];
        $payloadEnrollUser = $this->postAPI(API::ENROLL_ADMIN, null, $dataEnroll);
        if($payloadEnrollUser->success == true){
            $credentials = $payloadEnrollUser->response;
            DB::commit();
            return response()->json([
                'success' => true,
                'code'    => 0,
                'message' => 'Create Educational Organization successfully.',
                'key'     => Crypt::encryptString(json_encode($credentials)),
            ]);
        }
        $organizationSetting->delete();
        return response()->json([
            'message'     => $payloadEnrollUser->errorMessage,
            'success'     => false,
            'user'        => null,
            'code'        => $payloadEnrollUser->code,
            'credentials' => false,
        ], 400);
    }
}
