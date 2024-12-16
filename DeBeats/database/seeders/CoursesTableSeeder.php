<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['course_name' => 'Discrete Structure', 'course_code' => 'SECI1013', 'capacity' => '60',  'created_at' => now(), 'updated_at' => now()],
           // ['course_name' => 'Discrete Structure', 'course_code' => 'SECI1013', 'section' => '08', 'section_capacity' => 30, 'lecturer' => 'Ts. Dr. Goh Eg Su', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Programming Technique 1', 'course_code' => 'SECJ1013', 'capacity' => '50', 'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Programming Technique 1', 'course_code' => 'SECJ1013', 'section' => '08', 'section_capacity' => 25, 'lecturer' => 'Ts. Dr. Goh Eg Su', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Technology & Information System', 'course_code' => 'SECP1513', 'capacity' => '80',  'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Technology & Information System', 'course_code' => 'SECP1513', 'section' => '09', 'section_capacity' => 40, 'lecturer' => 'Dr. Pang Yee Yong', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Digital Logic', 'course_code' => 'SECR1013',  'capacity' => '55', 'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Digital Logic', 'course_code' => 'SECR1013', 'section' => '08', 'section_capacity' => 25, 'lecturer' => 'Dr. Farkhana Binti Muchtar', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Network Communications', 'course_code' => 'SECR1213', 'capacity' => '90',  'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Network Communications', 'course_code' => 'SECR1213', 'section' => '11', 'section_capacity' => 40, 'lecturer' => 'Dr. Raja Zahilah Binti Raja Mohd Radzi', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Database', 'course_code' => 'SECD2524',  'capacity' => '75', 'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Database', 'course_code' => 'SECD2524', 'section' => '10', 'section_capacity' => 35, 'lecturer' => 'Dr Layla Rasheed Abdallah Hassan', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Software Engineering', 'course_code' => 'SECJ2203',  'capacity' => '35',  'created_at' => now(), 'updated_at' => now()],
           // ['course_name' => 'Software Engineering', 'course_code' => 'SECJ2203', 'section' => '10', 'section_capacity' => 35, 'lecturer' => 'Ts. Dr. Johanna Binti Ahmad', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Data Structure & Algorithm', 'course_code' => 'SECJ2013', 'capacity' => '70', 'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Data Structure & Algorithm', 'course_code' => 'SECJ2013', 'section' => '11', 'section_capacity' => 35, 'lecturer' => 'Dr. Fazliaty Edora Binti Fadzli', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Human Computer Interaction', 'course_code' => 'SECV2113',  'capacity' => '85',  'created_at' => now(), 'updated_at' => now()],
           // ['course_name' => 'Human Computer Interaction', 'course_code' => 'SECV2113', 'section' => '10', 'section_capacity' => 30, 'lecturer' => 'Dr. Aida Binti Ali', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Artificial Intelligence', 'course_code' => 'SECJ3553',  'capacity' => '50',  'created_at' => now(), 'updated_at' => now()],
         //   ['course_name' => 'Artificial Intelligence', 'course_code' => 'SECJ3553', 'section' => '12', 'section_capacity' => 30, 'lecturer' => 'Dr. Ruhaidah Binti Samsudin', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Application Development', 'course_code' => 'SECV3104',  'capacity' => '80', 'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Application Development', 'course_code' => 'SECV3104', 'section' => '02', 'section_capacity' => 30, 'lecturer' => 'Dr. Jumail Bin Taliba', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Fundamental Of Image Processing', 'course_code' => 'SECV3213', 'capacity' => '20', 'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Fundamental Of Image Processing', 'course_code' => 'SECV3213', 'section' => '02', 'section_capacity' => 30, 'lecturer' => 'Dr. Md Sah Bin Hj. Salam', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Geometric Modelling', 'course_code' => 'SECV3113',  'capacity' => '40',  'created_at' => now(), 'updated_at' => now()],
          //  ['course_name' => 'Geometric Modelling', 'course_code' => 'SECV3113', 'section' => '02', 'section_capacity' => 30, 'lecturer' => 'Dr. Norhaida Binti Mohd Suaib', 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Mobile Application Programming', 'course_code' => 'SECJ3623',  'capacity' => '25',  'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Graphics & Multimedia Software Project II', 'course_code' => 'SECV4134',  'capacity' => '30',  'created_at' => now(), 'updated_at' => now()],
           

            
        ];

        DB::table('courses')->insert($courses);
    }
}