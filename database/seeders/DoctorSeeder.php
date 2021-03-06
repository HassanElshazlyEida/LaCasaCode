<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            Doctor::create([
                "name" => $faker->name,
                "address" => $faker->address,
                "phone"=> $faker->phoneNumber,
            ]);
        }
    }



}
