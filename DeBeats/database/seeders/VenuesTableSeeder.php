<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $venues = [
            ['unit_number' => 'N28-105-01', 'venue_name' => 'Bilik Kuliah 1', 'venue_short' => 'BK1', 'type' => 'bilik kuliah', 'capacity' => 120,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-116-02', 'venue_name' => 'Bilik Kuliah 2', 'venue_short' => 'BK2', 'type' => 'bilik kuliah', 'capacity' => 120,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-112-02', 'venue_name' => 'Bilik Kuliah 3', 'venue_short' => 'BK3', 'type' => 'bilik kuliah', 'capacity' => 120,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-111-01', 'venue_name' => 'Bilik Kuliah 4', 'venue_short' => 'BK4', 'type' => 'bilik kuliah', 'capacity' => 120,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-106-01', 'venue_name' => 'Bilik Kuliah 5', 'venue_short' => 'BK5', 'type' => 'bilik kuliah', 'capacity' => 120,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-107-01', 'venue_name' => 'Bilik Kuliah 6', 'venue_short' => 'BK6', 'type' => 'bilik kuliah', 'capacity' => 120,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-108-01', 'venue_name' => 'Bilik Kuliah 7', 'venue_short' => 'BK7', 'type' => 'bilik kuliah', 'capacity' => 120,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-351-02', 'venue_name' => 'Active Learning Lab', 'venue_short' => 'ALL', 'type' => 'bilik kuliah', 'capacity' => 36,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-301-01', 'venue_name' => 'PMO', 'venue_short' => 'PMO', 'type' => 'bilik kuliah', 'capacity' => 36,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-301-01', 'venue_name' => 'Bilik Mesyuarat PMO (Dalam PMO)', 'venue_short' => 'BMPMO', 'type' => 'bilik kuliah', 'capacity' => 30,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-05', 'venue_name' => 'Bilik Tutorial 1', 'venue_short' => 'N28a-BT1', 'type' => 'bilik kuliah', 'capacity' => 24,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-04', 'venue_name' => 'Bilik Tutorial 2', 'venue_short' => 'N28a-BT2', 'type' => 'bilik kuliah', 'capacity' => 27,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-02', 'venue_name' => 'Bilik Tutorial 3', 'venue_short' => 'N28a-BT3', 'type' => 'bilik kuliah', 'capacity' => 40,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-01', 'venue_name' => 'Bilik Tutorial 4', 'venue_short' => 'N28a-BT4', 'type' => 'bilik kuliah', 'capacity' => 40,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-07', 'venue_name' => 'Bilik Tutorial 5', 'venue_short' => 'N28a-BT5', 'type' => 'bilik kuliah', 'capacity' => 40,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-20', 'venue_name' => 'Bilik Kuliah 1', 'venue_short' => 'N28a-BK1', 'type' => 'bilik kuliah', 'capacity' => 28,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-19', 'venue_name' => 'Bilik Kuliah 2', 'venue_short' => 'N28a-BK2', 'type' => 'bilik kuliah', 'capacity' => 36,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-16', 'venue_name' => 'Bilik Kuliah 5', 'venue_short' => 'N28a-BK5', 'type' => 'bilik kuliah', 'capacity' => 28,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28a-01-15', 'venue_name' => 'Bilik Kuliah 6', 'venue_short' => 'N28a-BK6', 'type' => 'bilik kuliah', 'capacity' => 36,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-502-01', 'venue_name' => 'Makmal Pengaturcaraan Komputer 1', 'venue_short' => 'MPK 1', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-505-01', 'venue_name' => 'Makmal Pengaturcaraan Komputer 2', 'venue_short' => 'MPK 2', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-506-01', 'venue_name' => 'Makmal Pengaturcaraan Komputer 3', 'venue_short' => 'MPK 3', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-512-01', 'venue_name' => 'Makmal Pengaturcaraan Komputer 4', 'venue_short' => 'MPK 4', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-516-01', 'venue_name' => 'Makmal Pengaturcaraan Komputer 5', 'venue_short' => 'MPK 5', 'type' => 'makmal', 'capacity' => 25,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-517-02', 'venue_name' => 'Makmal Pengaturcaraan Komputer 6', 'venue_short' => 'MPK 6', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-518-02', 'venue_name' => 'Makmal Pengaturcaraan Komputer 7', 'venue_short' => 'MPK 7', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-524-02', 'venue_name' => 'Makmal Pengaturcaraan Komputer 8', 'venue_short' => 'MPK 8', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-525-01', 'venue_name' => 'Makmal Pengaturcaraan Komputer 9', 'venue_short' => 'MPK 9', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-527-01', 'venue_name' => 'Makmal Pengaturcaraan Komputer 10', 'venue_short' => 'MPK 10', 'type' => 'makmal', 'capacity' => 60,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28A-02-33', 'venue_name' => 'Makmal Pengajaran 1', 'venue_short' => 'N28A-MP1', 'type' => 'makmal', 'capacity' => 48,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28A-02-34', 'venue_name' => 'Makmal Pengajaran 2', 'venue_short' => 'N28A-MP2', 'type' => 'makmal', 'capacity' => 48,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-223-02', 'venue_name' => 'Computer Graphic & Multimedia Teaching Lab', 'venue_short' => 'CGMTL', 'type' => 'makmal', 'capacity' => 40,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-422-01', 'venue_name' => 'CCNP Lab', 'venue_short' => 'CCNP', 'type' => 'makmal', 'capacity' => 36,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-330-01', 'venue_name' => 'Computer Security Lab', 'venue_short' => 'CSL', 'type' => 'makmal', 'capacity' => 30,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-423-01', 'venue_name' => 'Intelligence Data Analysis Lab', 'venue_short' => 'IDAL', 'type' => 'makmal', 'capacity' => 32,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-352-01', 'venue_name' => 'CCNA Teaching Lab', 'venue_short' => 'CCNA', 'type' => 'makmal', 'capacity' => 30,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-204-01', 'venue_name' => 'Computer Vision Lab', 'venue_short' => 'CVL', 'type' => 'makmal', 'capacity' => 30,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-322-02', 'venue_name' => 'Software Innovation Lab', 'venue_short' => 'SIL', 'type' => 'makmal', 'capacity' => 36,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-203-01', 'venue_name' => 'Computer Vision Teaching Lab', 'venue_short' => 'CVTL', 'type' => 'makmal', 'capacity' => 28,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-321-02', 'venue_name' => 'Makmal CASE', 'venue_short' => 'MCASE', 'type' => 'makmal', 'capacity' => 28,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-329-01', 'venue_name' => 'Information System Teaching Lab', 'venue_short' => 'ISTL', 'type' => 'makmal', 'capacity' => 26,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-202-01', 'venue_name' => 'Virtual Environment Teaching Lab', 'venue_short' => 'VETL', 'type' => 'makmal', 'capacity' => 25,'created_at' => now(),'updated_at' => now()],
            ['unit_number' => 'N28-350-03', 'venue_name' => 'Data Analytics Lab', 'venue_short' => 'DAL', 'type' => 'makmal', 'capacity' => 23,'created_at' => now(),'updated_at' => now()],
            

        ];
        DB::table('venues')->insert($venues);
    }
}