<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Center;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
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
            Center::create([
                "name" => $faker->name,
                "address" => $faker->address,
                "contacts"=> $faker->phoneNumber,
                "user_id"=> User::all()->random()->id,
            ]);
        }
    }
}
