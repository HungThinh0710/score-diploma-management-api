<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('organization_settings')->insert([
            'is_activate_email_domain' => 0,
            'is_direct_submit_transcript' => 1,
        ]);

        DB::table('organization_settings')->insert([
            'is_activate_email_domain' => 0,
            'is_direct_submit_transcript' => 1,
        ]);

        DB::table('organization_settings')->insert([
            'is_activate_email_domain' => 0,
            'is_direct_submit_transcript' => 1,
        ]);

        DB::table('organization_settings')->insert([
            'is_activate_email_domain' => 0,
            'is_direct_submit_transcript' => 1,
        ]);

        DB::table('organizations')->insert([
            'setting_id' => 1,
            'org_name' => 'Viet Han University',
            'org_prefix' => 'it.vku.udn.vn',
            'org_code' => 'VKU',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@vku.udn.vn',
            'email_domain' => 'vku.udn.vn',
            'description' => 'Việt Hàn',
            'address' => 'Khu đô thị Đà Nẵng'
        ]);

        DB::table('organizations')->insert([
            'setting_id' => 2,
            'org_name' => 'Bach Khoa University',
            'org_prefix' => 'bka.udn.vn',
            'org_code' => 'BKA',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@bka.udn.vn',
            'email_domain' => 'bka.udn.vn',
            'description' => 'Bách Khoa',
            'address' => 'Khu đô thị Đà Nẵng'
        ]);

        DB::table('organizations')->insert([
            'setting_id' => 3,
            'org_name' => 'Kinh Tees University',
            'org_prefix' => 'due.udn.vn',
            'org_code' => 'DUE',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@due.udn.vn',
            'email_domain' => 'due.udn.vn',
            'description' => 'Kinh Tế',
            'address' => 'Khu đô thị Đà Nẵng'
        ]);

        DB::table('organizations')->insert([
            'setting_id' => 4,
            'org_name' => 'Ngoại Ngữ University',
            'org_prefix' => 'ufl.udn.vn',
            'org_code' => 'UFL',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@ufl.udn.vn',
            'email_domain' => 'ufl.udn.vn',
            'description' => 'Ngoại ngữ',
            'address' => 'Khu đô thị Đà Nẵng'
        ]);


    }
}
