<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'label'
    ];
    
    public function roles()
    {
    	return $this->belongsToMany(\App\Models\Role::class);
    }

    public static function defaultPermissions()
	{
	    return [
	        'view_users' => 'Visualizar Usuários',
	        'add_users' => 'Adicionar Usuário',
	        'edit_users' => 'Editar Usuário',
	        'delete_users' => 'Deletar Usuário',

	        'view_roles' => 'Visualizar Perfil',
	        'add_roles' => 'Adicionar Perfil',
	        'edit_roles' => 'Editar Perfil',
	        'delete_roles' => 'Deletar Perfil',

	        'view_condominios' => 'Visualizar Condominio',
	        'add_condominios' => 'Adicionar Condominio',
	        'edit_condominios' => 'Editar Condominio',
	        'delete_condominios' => 'Deletar Condominio',

	        'view_financeiro_contas_categorias' => 'Visualizar Financeiro Categorias de Contas',
	        'add_financeiro_contas_categorias' => 'Adicionar Financeiro Categorias de Contas',
	        'edit_financeiro_contas_categorias' => 'Editar Financeiro Categorias de Contas',
	        'delete_financeiro_contas_categorias' => 'Deletar Financeiro Categorias de Contas',

	        'view_financeiro_contas' => 'Visualizar Financeiro Contas (Metodos de Pagamentos)',
	        'add_financeiro_contas' => 'Adicionar Financeiro Contas (Metodos de Pagamentos)',
	        'edit_financeiro_contas' => 'Editar Financeiro Contas (Metodos de Pagamentos)',
	        'delete_financeiro_contas' => 'Deletar Financeiro Contas (Metodos de Pagamentos)',

	        'view_financeiro_contas_pagar' => 'Visualizar Financeiro Contas a Pagar',
	        'add_financeiro_contas_pagar' => 'Adicionar Financeiro Contas a Pagar',
	        'edit_financeiro_contas_pagar' => 'Editar Financeiro Contas a Pagar',
	        'delete_financeiro_contas_pagar' => 'Deletar Financeiro Contas a Pagar',

	        'view_financeiro_contas_receber' => 'Visualizar Financeiro Contas a Receber',
	        'add_financeiro_contas_receber' => 'Adicionar Financeiro Contas a Receber',
	        'edit_financeiro_contas_receber' => 'Editar Financeiro Contas a Receber',
	        'delete_financeiro_contas_receber' => 'Deletar Financeiro Contas a Receber',

	        'view_financeiro_fluxo_de_caixa' => 'Visualizar Financeiro Fluxo de Caixa',
	        'view_financeiro_extrato' => 'Visualizar Financeiro Extrato',
	        'view_financeiro_grafico_de_contas' => 'Visualizar Financeiro Gráfico de Contas',

	        'view_orcamentos' => 'Visualizar Orçamentos',
	        'add_orcamentos' => 'Adicionar Orçamentos',
	        'edit_orcamentos' => 'Editar Orçamentos',
	        'delete_orcamentos' => 'Deletar Orçamentos',

	        'view_vagas' => 'Visualizar Vagas',
	        'add_vagas' => 'Adicionar Vagas',
	        'edit_vagas' => 'Editar Vagas',
	        'delete_vagas' => 'Deletar Vagas',

	        'view_rateio' => 'Visualizar Rateio',
	        'add_rateio' => 'Adicionar Rateio',
	        'edit_rateio' => 'Editar Rateio',
	        'delete_rateio' => 'Deletar Rateio',

	        'view_avisos' => 'Visualizar Avisos',
	        'add_avisos' => 'Adicionar Avisos',
	        'edit_avisos' => 'Editar Avisos',
	        'delete_avisos' => 'Deletar Avisos',

	        'view_entradas' => 'Visualizar Entradas',
	        'alterar_entradas' => 'Aleterar Entradas',

	        'view_enderecos' => 'Visualizar Enderecos',
	        'alterar_enderecos' => 'Alterar Enderecos',

	        'view_zonas' => 'Visualizar Zonas',
	        'chenge_zonas' => 'Alterar Zonas',

	        'view_torres' => 'Visualizar Torres',
	        'chenge_torres' => 'Alterar Torres',

	        'view_apartamentos' => 'Visualizar Apartamentos',
	        'alterar_apartamentos' => 'Alterar Apartamentos',

	        'view_veiculos' => 'Visualizar Veiculos',
	        'add_veiculos' => 'Adicionar Veiculos',
	        'edit_veiculos' => 'Editar Veiculos',
	        'delete_veiculos' => 'Deletar Veiculos',

	        'view_estoque_movimentacao' => 'Visualizar Estoque Movimentação',
	        'add_estoque_movimentacao' => 'Adicionar Estoque Movimentação',
	        'edit_estoque_movimentacao' => 'Editar Estoque Movimentação',
	        'delete_estoque_movimentacao' => 'Deletar Estoque Movimentação',

	        'view_moradores' => 'Visualizar Moradores',
	        'add_moradores' => 'Adicionar Moradores',
	        'edit_moradores' => 'Editar Moradores',
	        'delete_moradores' => 'Deletar Moradores',

	        'view_funcionarios' => 'Visualizar Funcionários',
	        'alterar_funcionarios' => 'Alterar Funcionários',

	        'view_Fornecedores' => 'Visualizar Fornecedores',
	        'add_Fornecedores' => 'Adicionar Fornecedores',
	        'edit_Fornecedores' => 'Editar Fornecedores',
	        'delete_Fornecedores' => 'Deletar Fornecedores',

	        'view_agenda' => 'Visualizar Agenda',
	        'add_agenda' => 'Adicionar Agenda',
	        'edit_agenda' => 'Editar Agenda',
	        'delete_agenda' => 'Deletar Agenda',
	        'view_minha_reserva' => 'Visualizar Minha Reserva',

	        'menu_moradores' => 'Visualizar Menu Moradores',
	        'menu_agenda' => 'Visualizar Menu Agenda',
	        'menu_produtos' => 'Visualizar Menu Orçamentos',
	        'menu_financeiro' => 'Visualizar Menu Financeiro',
	        'menu_condominios' => 'Visualizar Condominio',
	        'menu_estoque' => 'Visualizar Menu Estoque',
	        'menu_vagas' => 'Visualizar Menu Vagas',

	    ];
	}

	public function syncPermissions($permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionTo($permissions);
    }
}
