<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $master = Role::create([
        	'name'				=> 'master',
        	'label'				=> 'Administrador Master',
        ]);

        $master->permissions()->attach(Permission::all());

        $this->command->info('Master possui todas as permissões');

        $sindico = [
            'view_towers',
            'add_towers',
            'edit_towers',
            'delete_towers',

            'view_apartamentos',
            'add_apartamentos',
            'edit_apartamentos',
            'delete_apartamentos',

            'view_zonas',
            'add_zonas',
            'edit_zonas',
            'delete_zonas',

            'view_vagas',
            'add_vagas',
            'edit_vagas',
            'delete_vagas',

            'view_tp_vagas',
            'add_tp_vagas',
            'edit_tp_vagas',
            'delete_tp_vagas',

            'view_veiculos',
            'add_veiculos',
            'edit_veiculos',
            'delete_veiculos',

            'view_entradas',
            'add_entradas',
            'edit_entradas',
            'delete_entradas',

            'view_avisos',
            'add_avisos',
            'edit_avisos',
            'delete_avisos',

            'view_orcamentos',
            'add_orcamentos',
            'edit_orcamentos',
            'delete_orcamentos',

            'view_enderecos',
            'add_enderecos',
            'edit_enderecos',
            'delete_enderecos',

            'menu_torres',
            'menu_apartametnos',
            'menu_vagas',
            'menu_zonas',
            'menu_veiculos',
            'menu_areas',
            'menu_orcamentos',
            'menu_avisos',
            'menu_documentos',
            'menu_entradas',
            'menu_condominios',
        ];
        $permissions_sindico = Permission::whereIn('name', $sindico)->get();

        $perfil_sindico = Role::create([
        	'name'				=> 'Sindico',
        	'label'				=> 'Sindico',
        ]);

        $perfil_sindico->permissions()->attach($permissions_sindico);

        $this->command->info('Sindico possui as suas permissões');

        $zelador = [
            'view_towers',

            'view_apartamentos',

            'view_zonas',

            'view_vagas',

            'view_veiculos',

            'view_entradas',

            'view_avisos',
            'add_avisos',
            'edit_avisos',
            'delete_avisos',

            'view_orcamentos',
            'add_orcamentos',
            'edit_orcamentos',
            'delete_orcamentos',

            'view_enderecos',

            'menu_torres',
            'menu_apartametnos',
            'menu_zonas',
            'menu_veiculos',
            'menu_areas',
            'menu_orcamentos',
            'menu_avisos',
            'menu_documentos',
            'menu_entradas',
        ];
        $permissions_zelador = Permission::whereIn('name', $zelador)->get();

        $perfil_zelador = Role::create([
            'name'              => 'Zelador',
            'label'             => 'Zeladoria',
        ]);
        
        $perfil_zelador->permissions()->attach($permissions_zelador);

        $this->command->info('Zelador possui as suas permissões');

        $morador = [
            'view_towers',
            'add_towers',
            'edit_towers',
            'delete_towers',

            'view_apartamentos',
            'add_apartamentos',
            'edit_apartamentos',
            'delete_apartamentos',

            'view_zonas',
            'add_zonas',
            'edit_zonas',
            'delete_zonas',

            'view_vagas',
            'add_vagas',
            'edit_vagas',
            'delete_vagas',

            'view_tp_vagas',
            'add_tp_vagas',
            'edit_tp_vagas',
            'delete_tp_vagas',

            'view_veiculos',
            'add_veiculos',
            'edit_veiculos',
            'delete_veiculos',

            'view_entradas',
            'add_entradas',
            'edit_entradas',
            'delete_entradas',

            'view_avisos',
            'add_avisos',
            'edit_avisos',
            'delete_avisos',

            'view_orcamentos',
            'add_orcamentos',
            'edit_orcamentos',
            'delete_orcamentos',

            'view_enderecos',
            'add_enderecos',
            'edit_enderecos',
            'delete_enderecos',

            'menu_torres',
            'menu_apartametnos',
            'menu_vagas',
            'menu_zonas',
            'menu_veiculos',
            'menu_areas',
            'menu_orcamentos',
            'menu_avisos',
            'menu_documentos',
            'menu_entradas',
            'menu_condominios',
        ];
        
        $permissions_morador = Permission::whereIn('name', $morador)->get();

        $perfil_morador = Role::create([
        	'name'				=> 'Morador',
        	'label'				=> 'Morador',
        ]);
        
        $perfil_morador->permissions()->attach($permissions_morador);

        $this->command->info('Morador possui as suas permissões');
    }
}
