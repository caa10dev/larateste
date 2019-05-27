<?php

use Illuminate\Database\Seeder;
use Modules\Condominios\Entities\Condominio;

class CondominiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Condominio::create([
            'name'              => 'Condominiio alvorada'
        ]);
    }
}
