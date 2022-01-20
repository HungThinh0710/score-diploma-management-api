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
            'org_name' => 'Vietnam-Korea University of Infomation and Communication Technology',
            'org_prefix' => 'vku.udn.vn',
            'org_code' => 'VKU',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@vku.udn.vn',
            'email_domain' => 'vku.udn.vn',
            'description' => 'Trường ĐH CNTT & TT Việt Hàn',
            'address' => 'Làng đại học Đà Nẵng'
        ]);

        DB::table('organizations')->insert([
            'setting_id' => 2,
            'org_name' => 'University of Science and Technology',
            'org_prefix' => 'dut.udn.vn',
            'org_code' => 'DUT',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@dut.udn.vn',
            'email_domain' => 'dut.udn.vn',
            'description' => 'Trường Đại học Bách Khoa',
            'address' => 'Làng đại học Đà Nẵng'
        ]);

        DB::table('organizations')->insert([
            'setting_id' => 3,
            'org_name' => 'University of Economics',
            'org_prefix' => 'due.udn.vn',
            'org_code' => 'DUE',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@due.udn.vn',
            'email_domain' => 'due.udn.vn',
            'description' => 'Trường Đại học Kinh Tế',
            'address' => 'Làng đại học Đà Nẵng'
        ]);

        DB::table('organizations')->insert([
            'setting_id' => 4,
            'org_name' => 'University of Foreign Language Studies',
            'org_prefix' => 'ufl.udn.vn',
            'org_code' => 'UFL',
            'is_active' => 1,
            'status' => 0,
            'email' => 'contact@ufl.udn.vn',
            'email_domain' => 'ufl.udn.vn',
            'description' => 'Trường Đại học Ngoại ngữ',
            'address' => 'Làng đại học Đà Nẵng'
        ]);


    }
}
