<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Traits\Authorizable;
use App\Models\Permission;
use App\Models\Role;
use App\Table\Table;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use Authorizable;

    /**
     * @var Role
     * @var Table
     */
    private $_role;
    private $_table;

    public function __construct(Table $table, Role $role)
    {
        $this->_role = $role;
        $this->_table = $table;
    }

    public function index()
    {
        $conditions = [];

        $table = $this->_table
            ->model(Role::class)
            ->columns([
                [
                    'label' => 'ID',
                    'column' => 'roles.id',
                    'alias' => 'id',
                    'name' => 'id',
                    'key' => true
                ],
                [
                    'label' => 'Perfil',
                    'column' => 'roles.name',
                    'alias' => 'name',
                    'name' => 'name',
                    'order' => true
                ],
                [
                    'label' => 'Descrição',
                    'column' => 'roles.label',
                    'alias' => 'label',
                    'name' => 'label',
                ],
                [
                    'label' => 'Criado em',
                    'column' => 'roles.created_at',
                    'alias' => 'created_at',
                    'name' => 'created_at'
                ],
            ])
            ->where([
                $conditions
            ])
            ->filters([
                [
                    'model_master' => 1,
                    'name' => 'roles.name',
                    'label' => 'name',
                    'operator' => 'LIKE'
                ]
            ])
            ->addEditAction('roles.edit', 'bg-teal')
            ->addDeleteAction('roles.destroy', 'bg-teal')
            ->paginate(10)
            ->search();

        return view('settings.role.index', compact('table'));
    }

    public function create()
    {
        $role = $this->_role;
        $permissions = Permission::all();
        return view('settings.role.create', compact('role', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if ( $role = Role::create($request->except('permissions')) ) {
            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            alert()->success($role->label . ' - O Perfil foi criado com sucesso!!!', '');
        } else {
            alert()->warning('O Perfil não foi criado.', '');
        }

        return response()->redirectToRoute('roles.index');
    }

    public function edit($id)
    {
        $role = $this->_role->find($id);
        $permissions = Permission::all('name', 'id');

        return view('settings.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        if($role = Role::findOrFail($id)) {
            // admin role has everything
            if($role->name === 'master') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('roles.index');
            }

            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            alert()->success($role->label . ' - as permissões foram atualizadas.', '');
        } else {
            alert()->warning('Perfil com id '. $id .' não foi encontrado.', '');
        }

        return redirect()->route('roles.index');
    }
}
