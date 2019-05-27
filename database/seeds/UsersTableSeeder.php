<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       $user1 = User::create([
            'name'              => 'Carlos Almeida',
            'email'             => 'admin@gmail.com',
            'condominio_id'     => 1,
            'tower_id'          => null,
            'password'          => bcrypt('123456'),
        ]);
        $user1->roles()->sync(1);

        /*$faker = Faker::create();
        for ($i=1 ; $i <= 3; $i++) {
            $user = User::create([
                'name'              => $faker->name($gender = null),
                'email'             => $faker->email,
                'condominio_id'     => NULL,
                'tower_id'     => $i,
                'password'          => bcrypt('123456'),
            ]);

            $user->roles()->sync(1);
        }
        */

    }
}
