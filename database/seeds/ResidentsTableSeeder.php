<?php

use Illuminate\Database\Seeder;
use Modules\Residents\Entities\Resident;
use Faker\Factory as Faker;

class residents_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create();
         foreach (range(1,10) as $index) {
         	DB::table('residents')->insert([
              'name' 	=> $faker->name,
              'born' 	=> $faker->date($format = 'Y-m-d', $max = 'now')
              'gen'		=> $faker->email,
              'apartment_id' => rand(1,22),
              'tower_id' => rand(1,3),
          	]);
         }
    }
}
