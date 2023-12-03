<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        for($i = 0; $i< 10;$i++){
            Contact::insert([
                "name" => $faker->name,
                "phone" => $faker->phoneNumber()
            ]);
        }
    }
}
