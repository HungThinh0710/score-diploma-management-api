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
            'org_id'	=> 1,
            'subject_name' => 'Tiếng Anh chuyên ngành',
            'subject_code' => 'Tiếng Anh chuyên ngành_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Lập trình hướng đối tượng và Java cơ bản',
            'subject_code' => 'Lập trình hướng đối tượng và Java cơ bản_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tin học đại cương',
            'subject_code' => 'Tin học đại cương_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đại số',
            'subject_code' => 'Đại số_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tiếng Anh',
            'subject_code' => 'Tiếng Anh_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Nhập môn ngành và kỹ năng mềm',
            'subject_code' => 'Nhập môn ngành và kỹ năng mềm_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Cơ sở dữ liệu',
            'subject_code' => 'Cơ sở dữ liệu_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Công nghệ Web',
            'subject_code' => 'Công nghệ Web_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án cơ sở 1 - IT',
            'subject_code' => 'Đồ án cơ sở 1 - IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tiếng Anh chuyên ngành',
            'subject_code' => 'Tiếng Anh chuyên ngành_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Vật lý',
            'subject_code' => 'Vật lý_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Nguyên lý hệ điều hành',
            'subject_code' => 'Nguyên lý hệ điều hành_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Kiến trúc máy tính',
            'subject_code' => 'Kiến trúc máy tính_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Cấu trúc dữ liệu và giải thuật',
            'subject_code' => 'Cấu trúc dữ liệu và giải thuật_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Lập trình Java nâng cao',
            'subject_code' => 'Lập trình Java nâng cao_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tiếng Anh 2',
            'subject_code' => 'Tiếng Anh 2_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Phân tích và thiết kế hệ thống',
            'subject_code' => 'Phân tích và thiết kế hệ thống_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Toán rời rạc',
            'subject_code' => 'Toán rời rạc_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tiếng Anh chuyên ngành & thực hành',
            'subject_code' => 'Tiếng Anh chuyên ngành & thực hành_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Công nghệ web nâng cao',
            'subject_code' => 'Công nghệ web nâng cao_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tiếng Anh 3 ',
            'subject_code' => 'Tiếng Anh 3 _x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án cơ sở 2_IT',
            'subject_code' => 'Đồ án cơ sở 2_IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Chuyên đề 1',
            'subject_code' => 'Chuyên đề 1_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Hệ thống số',
            'subject_code' => 'Hệ thống số_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Mạng máy tính',
            'subject_code' => 'Mạng máy tính_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Chuyên đề 2',
            'subject_code' => 'Chuyên đề 2_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án cơ sở 3',
            'subject_code' => 'Đồ án cơ sở 3_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Công nghệ phần mềm',
            'subject_code' => 'Công nghệ phần mềm_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tiếng Anh chuyên ngành & thực hành',
            'subject_code' => 'Tiếng Anh chuyên ngành & thực hành_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Xác suất thống kê',
            'subject_code' => 'Xác suất thống kê_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Giải tích',
            'subject_code' => 'Giải tích_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Thực tập doanh nghiệp IT',
            'subject_code' => 'Thực tập doanh nghiệp IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Lập trình di động',
            'subject_code' => 'Lập trình di động_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Vi điều khiển',
            'subject_code' => 'Vi điều khiển_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Lập trình mạng',
            'subject_code' => 'Lập trình mạng_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Quản lý dự án',
            'subject_code' => 'Quản lý dự án_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Quản trị mạng',
            'subject_code' => 'Quản trị mạng_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Trí tuệ nhân tạo',
            'subject_code' => 'Trí tuệ nhân tạo_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Automat và Ngôn ngữ hình thức',
            'subject_code' => 'Automat và Ngôn ngữ hình thức_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Chuyên đề 3 (IT)',
            'subject_code' => 'Chuyên đề 3 (IT)_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ họa máy tính',
            'subject_code' => 'Đồ họa máy tính_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án cơ sở 4 IT',
            'subject_code' => 'Đồ án cơ sở 4 IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án cơ sở 5 IT',
            'subject_code' => 'Đồ án cơ sở 5 IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Kiểm thử phần mềm',
            'subject_code' => 'Kiểm thử phần mềm_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Kỹ thuật truyền số liệu',
            'subject_code' => 'Kỹ thuật truyền số liệu_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Trình biên dịch',
            'subject_code' => 'Trình biên dịch_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Xử lý ảnh',
            'subject_code' => 'Xử lý ảnh_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Xử lý tín hiệu số',
            'subject_code' => 'Xử lý tín hiệu số_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Bảo mật và An toàn hệ thống thông tin',
            'subject_code' => 'Bảo mật và An toàn hệ thống thông tin_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Chuyên đề 4 IT',
            'subject_code' => 'Chuyên đề 4 IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án cơ sở 5 IT',
            'subject_code' => 'Đồ án cơ sở 5 IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Thị giác máy tính',
            'subject_code' => 'Thị giác máy tính_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tương tác người - máy',
            'subject_code' => 'Tương tác người - máy_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Triết học Mác - Lênin',
            'subject_code' => 'Triết học Mác - Lênin_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Tư tưởng Hồ Chí Minh',
            'subject_code' => 'Tư tưởng Hồ Chí Minh_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Pháp luật đại cương',
            'subject_code' => 'Pháp luật đại cương_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Chuyên đề 5 (IT)',
            'subject_code' => 'Chuyên đề 5 (IT)_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án chuyên ngành 1 (IT)',
            'subject_code' => 'Đồ án chuyên ngành 1 (IT)_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Xử lý tín hiệu số',
            'subject_code' => 'Xử lý tín hiệu số_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Hệ cơ sở dữ liệu phân tán',
            'subject_code' => 'Hệ cơ sở dữ liệu phân tán_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Thương mại điện tử',
            'subject_code' => 'Thương mại điện tử_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Lịch sử Đảng Cộng sản Việt Nam',
            'subject_code' => 'Lịch sử Đảng Cộng sản Việt Nam_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Kinh tế chính trị Mác - Lênin',
            'subject_code' => 'Kinh tế chính trị Mác - Lênin_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Chuyên đề 6 IT',
            'subject_code' => 'Chuyên đề 6 IT_x',
            'credit'	=> 3
        ]);
        DB::table('subjects')->insert([
            'org_id'	=> 1,
            'subject_name' => 'Đồ án chuyên ngành 2 IT',
            'subject_code' => 'Đồ án chuyên ngành 2 IT_x',
            'credit'	=> 3
        ]);

    }
}
