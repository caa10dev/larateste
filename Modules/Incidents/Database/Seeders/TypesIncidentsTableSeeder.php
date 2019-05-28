<?php

use Illuminate\Database\Seeder;
use Modules\Entities\TypesIncident;

class TypesIncidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tp1 = TypesIncident::create([
            'title'              => 'Ataque Brute Force'
        ]);
        $tp2 = TypesIncident::create([
            'title'              => 'Credencias Vazia'
        ]);
        $tp3 = TypesIncident::create([
            'title'              => 'Ataque de DDoS'
        ]);
        $tp4 = TypesIncident::create([
            'title'              => 'Atividades anormais de usuários'
        ]);
        $this->command->info('Populando Tipos de Incidentes');
    }
}
