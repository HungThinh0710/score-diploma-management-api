<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorAndSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Majors
        DB::table('majors')->insert([
            'org_id'      => 1,
            'major_name'  => 'Information Technology',
            'major_code'  => 'IT',
        ]);
        DB::table('majors')->insert([
            'org_id'      => 1,
            'major_name'  => 'Business Administrator',
            'major_code'  => 'BA',
        ]);
        DB::table('majors')->insert([
            'org_id'      => 1,
            'major_name'  => 'Computer Science',
            'major_code'  => 'CE',
        ]);

        DB::table('majors')->insert([
            'org_id'      => 1,
            'major_name'  => 'Artificial Intelligence',
            'major_code'  => 'AI',
        ]);

        // Subjects
        DB::table('subjects')->insert([
            'org_id'      => 1,
            'subject_name' => 'Lập trình hướng đối tượng và Java Cơ Bản',
            'subject_code' => 'JAVA_17_2',
            'credit'       => 4
        ]);
        DB::table('subjects')->insert([
            'org_id'      => 1,
            'subject_name' => 'Đại số',
            'subject_code' => 'DAISO_17_2',
            'credit'       => 3
        ]);

        DB::table('subjects')->insert([
            'org_id'      => 1,
            'subject_name' => 'Toán cao cấp',
            'subject_code' => 'SUPER_MATH2',
            'credit'       => 3
        ]);

    }
}
