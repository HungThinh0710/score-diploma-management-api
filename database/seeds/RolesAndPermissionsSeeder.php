<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
//use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        app(PermissionRegistrar::class)->setPermissionsTeamId(1);

        // create permissions
        //--- Organization
        Permission::create(['name' => 'view organization', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit organization', 'guard_name' => 'web']);
        Permission::create(['name' => 'active organization', 'guard_name' => 'web']);
        Permission::create(['name' => 'view user organization', 'guard_name' => 'web']);

        //--- Major
        Permission::create(['name' => 'create major', 'guard_name' => 'web']);
        Permission::create(['name' => 'view major', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit major', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete major', 'guard_name' => 'web']);

        //--- Subject
        Permission::create(['name' => 'create subject', 'guard_name' => 'web']);
        Permission::create(['name' => 'view subject', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit subject', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete subject', 'guard_name' => 'web']);

        //--- Class
        Permission::create(['name' => 'view class', 'guard_name' => 'web']);
        Permission::create(['name' => 'create class', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit class', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete class', 'guard_name' => 'web']);
        //--- Transcript
        Permission::create(['name' => 'view transcript', 'guard_name' => 'web']);
        Permission::create(['name' => 'submit transcript', 'guard_name' => 'web']);
        Permission::create(['name' => 'update transcript', 'guard_name' => 'web']);
        Permission::create(['name' => 'approve transcript', 'guard_name' => 'web']);
        Permission::create(['name' => 'history transcript', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete transcript', 'guard_name' => 'web']);
        //--- Manage Roles & Permission
        Permission::create(['name' => 'view permission', 'guard_name' => 'web']);
        Permission::create(['name' => 'view role', 'guard_name' => 'web']);
        Permission::create(['name' => 'create role', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit role', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete role', 'guard_name' => 'web']);
        Permission::create(['name' => 'manage permission role', 'guard_name' => 'web']);
        //--- API - Blockchain
        Permission::create(['name' => 'blockchain view transcript', 'guard_name' => 'web']);
        Permission::create(['name' => 'blockchain sync transcript', 'guard_name' => 'web']);

        // create roles and assign created permissions

        $roleAdmin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
            'org_id' => 1
        ]);

        $roleUser = Role::create([
            'name' => 'user',
            'guard_name' => 'web',
            'org_id' => 1
        ]);

        $roleAdmin->givePermissionTo(Permission::all());
        $roleUser->givePermissionTo('view class','view transcript', 'submit transcript', 'update transcript');

//        $admin = User::findOrFail(1);
//        $user = User::findOrFail(2);
//
//        $admin->assignRole($roleAdmin);
//        $user->assignRole($roleUser);

    }
}
