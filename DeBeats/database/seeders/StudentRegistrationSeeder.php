<?php


namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StudentRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            // 1st year
            [
                'UTMID' => 'A23CS0029',
                'name' => 'Abbenisha Ann Michael Benedict',
                'courses' => [
                    ['course_code' => 'SECR1013'],
                    ['course_code' => 'SECP1513'],
                    ['course_code' => 'SECI1013'],
                    ['course_code' => 'SECJ1013']
                ]
            ],
            [
                'UTMID' => 'A23CS0040',
                'name' => 'Alice Lee Hui Mee',
                'courses' => [
                    ['course_code' => 'SECR1013'],
                    ['course_code' => 'SECP1513'],
                    ['course_code' => 'SECI1013'],
                    ['course_code' => 'SECJ1013']
                ]
            ],
            [
                'UTMID' => 'A23CS0045',
                'name' => 'Ammar Qhawiem Bin Mohd Asrak',
                'courses' => [
                    ['course_code' => 'SECR1013'],
                    ['course_code' => 'SECP1513'],
                    ['course_code' => 'SECI1013'],
                    ['course_code' => 'SECJ1013']
                ]
            ],
            [
                'UTMID' => 'A23CS0090',
                'name' => 'Izzaty Balqis Binti Suhaimi',
                'courses' => [
                    ['course_code' => 'SECR1013'],
                    ['course_code' => 'SECP1513'],
                    ['course_code' => 'SECI1013'],
                    ['course_code' => 'SECJ1013']
                ]
            ],
            [
                'UTMID' => 'A23CS0086',
                'name' => 'Ismail Bin Esa',
                'courses' => [
                    ['course_code' => 'SECR1013'],
                    ['course_code' => 'SECP1513'],
                    ['course_code' => 'SECI1013'],
                    ['course_code' => 'SECJ1013']
                ]
            ],
            [
                'UTMID' => 'A23CS0145',
                'name' => 'Nazmi Haikal Bin Khairul',
                'courses' => [
                    ['course_code' => 'SECR1013'],
                    ['course_code' => 'SECP1513'],
                    ['course_code' => 'SECI1013'],
                    ['course_code' => 'SECJ1013']
                ]
            ],
            // DE
            [
                'UTMID' => 'B23CS0003',
                'name' => 'Ainnur Alis Nabella Binti Ahmad Shukri',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2203'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113']
                ]
            ],
            [
                'UTMID' => 'B23CS0033',
                'name' => 'Che Arif Hakimi Bin Che Rudi',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2203'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113']
                ]
            ],
            [
                'UTMID' => 'B23CS0012',
                'name' => 'Nirumalar A/P Santharan',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2203'],
                    ['course_code' => 'SECR1213']
                ]
            ],
            // 2nd year
            [
                'UTMID' => 'A22EC0153',
                'name' => 'Danish Hakimi Bin Azril Dahari',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2013'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113']
                    ]
            ],
            [
                'UTMID' => 'A22EC0156',
                'name' => 'Elisha Binti Affandi',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2013'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113']                
                ]
            ],
            [
                'UTMID' => 'A22EC0158',
                'name' => 'Fakhirah Shakila Binti Khairul Ariffin',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2013'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113']                  
                ]
            ],
            [
                'UTMID' => 'A22EC0061',
                'name' => 'Kong Yew Yeong',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2013'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113']              
                ]
            ],
            [
                'UTMID' => 'A22EC0249',
                'name' => 'Nuraisya Salsabila Binti Mohd Fadzal',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2013'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113'],
                    ['course_code' => 'SECD2613']
                ]
            ],
            [
                'UTMID' => 'A22EC0262',
                'name' => 'Puventhiran A/L Ganeson',
                'courses' => [
                    ['course_code' => 'SECD2524'],
                    ['course_code' => 'SECJ2013'],
                    ['course_code' => 'SECR1213'],
                    ['course_code' => 'SECV2113']                  
                ]
            ],
            // DE
            [
                'UTMID' => 'B22EC0002',
                'name' => 'Amar Syafiq Bin Zamri',
                'courses' => [
                    ['course_code' => 'SECR1013'],
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3104'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECV3113']                
                ]
            ],
            [
                'UTMID' => 'B22EC0041',
                'name' => 'Nur Dalili Faiqah Binti Mohd Ghazali',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3104'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECV3113']                
                ]
            ],
            [
                'UTMID' => 'B22EC0009',
                'name' => 'Ulinnuha Binti Ab Aziz Al Safi',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3104'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECV3113']                
                ]
            ],
            // 3rd year
            [
                'UTMID' => 'A21EC0014',
                'name' => 'Amalia Syazana Binti Mohd Mazlimin',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECJ3623'],
                    ['course_code' => 'SECV3113']                  
                ]
            ],
            [
                'UTMID' => 'A21EC0012',
                'name' => 'Aliff Aizuddin Bin Abdul Aziz',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECJ3623']                  
                ]
            ],
            [
                'UTMID' => 'A21EC0031',
                'name' => 'Huam Jun Xiang',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECV3113']                    
                ]
            ],
            [
                'UTMID' => 'A21EC0099',
                'name' => 'Misya Syafiqah',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECV3113']                    
                ]
            ],
            [
                'UTMID' => 'A21EC0176',
                'name' => 'Gan Heng Lai',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECV3113']                  
                ]
            ],
            [
                'UTMID' => 'A21EC0016',
                'name' => 'Amirul Haziq Fahmi Bin Mat Zaid',
                'courses' => [
                    ['course_code' => 'SECJ3553'],
                    ['course_code' => 'SECV3213'],
                    ['course_code' => 'SECJ3623']                  
                ]
            ],
        ];


        // Loop through each student
        foreach ($students as $student) {
            foreach ($student['courses'] as $course_details) {
               
                $course = DB::table('courses')->where('course_code', $course_details['course_code'])->first();


                if ($course) {
                    // Insert data into student_registration table
                    DB::table('student_registrations')->insert([
                        'UTMID' => $student['UTMID'],
                        'course_code' => $course->course_code,
                    ]);
                }
            }
        }
    }
}