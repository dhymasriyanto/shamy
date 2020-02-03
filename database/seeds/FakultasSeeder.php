<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 5; $i++){

            // insert data ke table fakultas menggunakan Faker
            DB::table('fakultas')->insert([
                'nama' => $faker->name,
                'singkatan' => $faker->name
            ]);

        }
    }
}
