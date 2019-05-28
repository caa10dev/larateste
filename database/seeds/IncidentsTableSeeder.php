<?php

use Illuminate\Database\Seeder;
use Modules\Entities\Incident;

class IncidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incident1 = Incident::create([
            'title'              => 'Tentativa de Invasão',
            'description'        => 'Lorem ipsum velit venenatis leo arcu quisque bibendum sit, ornare varius urna tristique accumsan a dictum, consectetur convallis sociosqu sagittis ligula ornare ut. gravida aenean morbi sagittis dapibus quis aliquam auctor aenean, imperdiet bibendum sollicitudin curabitur justo vulputate mi lorem',
            'criticality'        => 3,
            'type_id'            => 1,
        ]);
        $incident2 = Incident::create([
            'title'              => 'Atividade Fora do Padrão',
            'description'        => 'Lorem ipsum potenti dictum semper dictumst nulla lectus nostra pretium, tellus tortor ultrices ut vivamus potenti aliquam nunc. etiam bibendum fames',
            'criticality'        => 0,
            'type_id'            => 4,
        ]);
        $this->command->info('Populando  Incidentes');
    }
}
