<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturer = [
            ['UTMID' => 'shukor', 'image_path' => 'images/shukor.jpg', 'name' => 'Dr. Mohamad Shukor bin Talib', 'course_code' => 'SECI1013', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'alif', 'image_path' => 'images/alif.jpg', 'name' => 'Dr. Alif Ridzuan bin Khairuddin', 'course_code' => 'SECJ1013', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'iqbal', 'image_path' => 'images/iqbal.jpg', 'name' => 'Ts. Dr. Muhammad Iqbal Tariq bin Idris', 'course_code' => 'SECP1513', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'foad', 'image_path' => 'images/foad.jpg', 'name' => 'Dr. Mohd Fo\'ad bin Rohani', 'course_code' => 'SECR1013', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'hazinah', 'image_path' => 'images/hazinah.jpg', 'name' => 'Ts. Ms. Hazinah binti Kutty Mammi', 'course_code' => 'SECR1213', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'izyan', 'image_path' => 'images/izyan.jpg', 'name' => 'Dr. Izyan Izzati binti Kamsani', 'course_code' => 'SECD2524', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'jamilah', 'image_path' => 'images/jamilah.jpg', 'name' => 'Dr. Jamilah binti Mahmood', 'course_code' => 'SECJ2203', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'pang', 'image_path' => 'images/pang.jpg', 'name' => 'Dr. Pang Yee Yong', 'course_code' => 'SECJ2013', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'zuraifah', 'image_path' => 'images/zuraifah.jpg', 'name' => 'Dr. Nur Zuraifah Syazrah binti Othman', 'course_code' => 'SECV2113', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'shafaatunnur', 'image_path' => 'images/shafaatunnur.jpg', 'name' => 'Dr. Shafaatunnur binti Hassan', 'course_code' => 'SECJ3553', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'shahida', 'image_path' => 'images/shahida.jpg', 'name' => 'Assoc. Prof. Dr. Shahida binti Sulaiman', 'course_code' => 'SECV3104', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'sah', 'image_path' => 'images/sah.jpg', 'name' => 'Dr. Md. Sah bin Hj. Salam', 'course_code' => 'SECV3213', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'norhaida', 'image_path' => 'images/norhaida.jpg', 'name' => 'Dr. Norhaida binti Mohd Suaib', 'course_code' => 'SECV3113', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'jumail', 'image_path' => 'images/jumail.jpg', 'name' => 'Dr. Jumail bin Taliba', 'course_code' => 'SECJ3623', 'created_at' => now(), 'updated_at' => now()],
            ['UTMID' => 'aida', 'image_path' => 'images/aida.jpg', 'name' => 'Dr. Aida binti Ali', 'course_code' => 'SECV4134', 'created_at' => now(), 'updated_at' => now()],
        ];
        

        DB::table('lecturer')->insert($lecturer);
    }
}
