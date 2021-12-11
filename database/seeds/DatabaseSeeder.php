<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrganizationSeeder::class);
        $this->call(UsersSeeder::class);
        // Pls run above command
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(MajorAndSubjectSeeder::class);
//        php artisan db:seed --class=RolesAndPermissionsSeeder

    }
}
