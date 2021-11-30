<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::findOrFail(9);
//        $user = User::findOrFail(2);

        app(PermissionRegistrar::class)->setPermissionsTeamId(1);
        $roleAdmin = Role::findOrFail(1);
        // Assign Role
        $admin->assignRole($roleAdmin);
//        $user->assignRole($roleUser);
    }
}
