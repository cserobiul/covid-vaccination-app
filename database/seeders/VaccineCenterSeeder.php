<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VaccineCenter::insert([
            ['name' => 'Dhaka Medical College Hospital, Dhaka',           'address' => 'Secretariat Rd,Dhaka',      'capacity' => 250],
            ['name' => 'Ad-Din Medical College Hospital Mogbazar, Dhaka', 'address' => 'Mogbazar, Dhaka',           'capacity' => 70],
            ['name' => 'Dhanmondi General And Kidney Hospital Limited',   'address' => 'City Tower, Dhaka-1205',    'capacity' => 80],
            ['name' => 'Anwar Khan Modern Medical College Hospital',      'address' => 'house-17 Rd 8, Dhaka 1207', 'capacity' => 50],
            ['name' => 'Holy Family Red Cresent Medical College Hospital','address' => 'Eskatan Garden, Dhaka',     'capacity' => 50],
            ['name' => 'IBN SINA Medical College Hospital',               'address' => 'Prosika More,Mirpur 2',     'capacity' => 40],
            ['name' => 'National Heart Foundation Hospital',              'address' => 'Mirpur 2,Dhaka-1216',       'capacity' => 120],
            ['name' => 'Islami Bank Hospital Mirpur',                     'address' => 'Mirpur -11, Dhaka',         'capacity' => 50],
            ['name' => 'Popular Diagnostic Hospital',                     'address' => 'Mirpur 10, Dhaka-1216',     'capacity' => 50],
            ['name' => 'Alok Health Care Hospital',                       'address' => 'Mirpur-6, Dhaka',           'capacity' => 50],
        ]);

    }
}
