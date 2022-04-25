<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsCentersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('doctor_center')->insert([
                "doctor_id"=>Doctor::all()->random()->id,
                "center_id"=>Center::all()->random()->id,
            ]);
        }
    }
}
