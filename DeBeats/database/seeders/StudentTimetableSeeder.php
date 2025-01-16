<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student_timetable = [
            [
                'course_code' => 'SECI1013',
                'course_name' => 'Discrete Structure',
                'day' => 'Tuesday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECI1013',
                'course_name' => 'Discrete Structure',
                'day' => 'Wednesday',
                'start_time' => '10:00',
                'end_time' => '11:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECJ1013',
                'course_name' => 'Programming Technique 1',
                'day' => 'Monday',
                'start_time' => '11:00',
                'end_time' => '13:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECP1513',
                'course_name' => 'Programming Technique 1',
                'day' => 'Wednesday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECP1513',
                'course_name' => 'Technology & Information System',
                'day' => 'Wednesday',
                'start_time' => '14:00',
                'end_time' => '17:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECR1013',
                'course_name' => 'Digital Logic',
                'day' => 'Monday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECR1013',
                'course_name' => 'Digital Logic',
                'day' => 'Tuesday',
                'start_time' => '11:00', 
                'end_time' => '13:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECR1213',
                'course_name' => 'Network Communications',
                'day' => 'Sunday',
                'start_time' => '11:00',
                'end_time' => '13:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECR1213',
                'course_name' => 'Network Communications',
                'day' => 'Thursday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECD2524',
                'course_name' => 'Database',
                'day' => 'Monday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECD2524',
                'course_name' => 'Database',
                'day' => 'Tuesday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECJ2203',
                'course_name' => 'Software Engineering',
                'day' => 'Tuesday',
                'start_time' => '10:00',
                'end_time' => '13:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECJ2013',
                'course_name' => 'Data Structure & Algorithm',
                'day' => 'Sunday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECJ2013',
                'course_name' => 'Data Structure & Algorithm',
                'day' => 'Wednesday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECV2113',
                'course_name' => 'Human Computer Interaction',
                'day' => 'Sunday',
                'start_time' => '14:00',
                'end_time' => '17:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECJ3553',
                'course_name' => 'Artificial Intelligence',
                'day' => 'Monday',
                'start_time' => '10:00',
                'end_time' => '13.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECV3104',
                'course_name' => 'Application Development',
                'day' => 'Sunday',
                'start_time' => '14:00',
                'end_time' => '16:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECV3104',
                'course_name' => 'Application Development',
                'day' => 'Monday',
                'start_time' => '8:00',
                'end_time' => '10:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECV3213',
                'course_name' => 'Fundamental Of Image Processing',
                'day' => 'Thursday',
                'start_time' => '8:00',
                'end_time' => '11:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECV3113',
                'course_name' => 'Geometric Modelling',
                'day' => 'Wednesday',
                'start_time' => '10:00',
                'end_time' => '13:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECJ3623',
                'course_name' => 'Mobile Application Programming',
                'day' => 'Monday',
                'start_time' => '14:00',
                'end_time' => '18:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_code' => 'SECV4134',
                'course_name' => 'Graphics & Multimedia Software Project II',
                'day' => 'Friday',
                'start_time' => '15:00',
                'end_time' => '17:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('student_timetable')->insert($student_timetable);
    }
}

