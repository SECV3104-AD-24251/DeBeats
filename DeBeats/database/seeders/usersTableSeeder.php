<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class usersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete(); // WARNING: Deletes all data from the table.

        DB::table('users')->insert([
            [
                'name' => 'Niza',
                'UTMID' => 'niza',
                'email' => 'niza@domain.com',
                'password' => Hash::make('staffpassword'),
                'role' => 'staff',
            ],
            [
                'name' => 'Jumail',
                'UTMID' => 'jumail',
                'email' => 'jumail@domain.com',
                'password' => Hash::make('lecturerpassword'),
                'role' => 'lecturer',
            ],
            [
                'name' => 'Lynette',
                'UTMID' => 'lynette',
                'email' => 'lynette@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Abbenisha Ann Michael Benedict',
                'UTMID' => 'A23CS0029',
                'email' => 'abbenisha@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Alice Lee Hui Mee',
                'UTMID' => 'A23CS0040',
                'email' => 'alice@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Ammar Qhawiem Bin Mohd Asrak',
                'UTMID' => 'A23CS0045',
                'email' => 'ammar@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Izzaty Balqis Binti Suhaimi',
                'UTMID' => 'A23CS0090',
                'email' => 'izzaty@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Ismail Bin Esa',
                'UTMID' => 'A23CS0086',
                'email' => 'ismail@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Nazmi Haikal Bin Khairul',
                'UTMID' => 'A23CS0145',
                'email' => 'nazmi@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Ainnur Alis Nabella Binti Ahmad Shukri',
                'UTMID' => 'B23CS0003',
                'email' => 'ainnur@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Che Arif Hakimi Bin Che Rudi',
                'UTMID' => 'B23CS0033',
                'email' => 'arif@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Nirumalar A/P Santharan',
                'UTMID' => 'B23CS0012',
                'email' => 'nirumalar@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Danish Hakimi Bin Azril Dahari',
                'UTMID' => 'A22EC0153',
                'email' => 'danish@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Elisha Binti Affandi',
                'UTMID' => 'A22EC0156',
                'email' => 'elisha@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Fakhirah Shakila Binti Khairul Ariffin',
                'UTMID' => 'A22EC0158',
                'email' => 'fakhirah@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Kong Yew Yeong',
                'UTMID' => 'A22EC0061',
                'email' => 'kong@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Nuraisya Salsabila Binti Mohd Fadzal',
                'UTMID' => 'A22EC0249',
                'email' => 'nuraisya@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Puventhiran A/L Ganeson',
                'UTMID' => 'A22EC0262',
                'email' => 'puventhiran@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Amar Syafiq Bin Zamri',
                'UTMID' => 'B22EC0002',
                'email' => 'amar@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Nur Dalili Faiqah Binti Mohd Ghazali',
                'UTMID' => 'B22EC0041',
                'email' => 'dalili@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Ulinnuha Binti Ab Aziz Al Safi',
                'UTMID' => 'B22EC0009',
                'email' => 'ulinnuha@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Amalia Syazana Binti Mohd Mazlimin',
                'UTMID' => 'A21EC0014',
                'email' => 'amalia@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Aliff Aizuddin Bin Abdul Aziz',
                'UTMID' => 'A21EC0012',
                'email' => 'aliff@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Huam Jun Xiang',
                'UTMID' => 'A21EC0031',
                'email' => 'huam@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Misya Syafiqah',
                'UTMID' => 'A21EC0099',
                'email' => 'misya@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Gan Heng Lai',
                'UTMID' => 'A21EC0176',
                'email' => 'henglai@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
            [
                'name' => 'Amirul Haziq Fahmi Bin Mat Zaid',
                'UTMID' => 'A21EC0016',
                'email' => 'amirul@domain.com',
                'password' => Hash::make('studentpassword'),
                'role' => 'student',
            ],
        ]);

        Log::info('UsersTableSeeder executed successfully.');
    }
}
