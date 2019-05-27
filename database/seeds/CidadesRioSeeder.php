<?php

use Illuminate\Database\Seeder;
use JansenFelipe\CidadesGratis\Cidades;
use App\Models\Cidade;

class CidadesRioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $reflector = new ReflectionClass(Cidades::class);
        $content = file_get_contents(dirname($reflector->getFileName()).'/../build/cidades.json');

        $detalhes = json_decode($content, true);

        foreach($detalhes as $detalhe){
            $params = array();
            if($detalhe['uf'] == 'RJ') {
                $this->command->info("Inserindo Cidades de " . $detalhe['uf']);

                foreach($detalhe['cidades'] as $cidade)   
                        $params[] = ['nome' => $cidade['nome'], 'uf' => $detalhe['uf'], 'codigo_ibge' => $cidade['codigo']];

            }
            Cidade::insert($params);
        }
        */
    }
}
