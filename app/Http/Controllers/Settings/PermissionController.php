<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Traits\Authorizable;
use App\Table\Table;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use Authorizable;

    /**
     * @var User
     * @var Table
     */
    private $_permission;
    private $_table;

    public function __construct(Table $table, Permission $permission)
    {
        $this->middleware('auth');
        $this->_permission = $permission;
        $this->_table = $table;
    }

    public function index()
    {
        $conditions = [];

        $table = $this->_table
            ->model(Permission::class)
            ->columns([
                [
                    'label' => 'ID',
                    'column' => 'permissions.id',
                    'alias' => 'id',
                    'name' => 'id',
                    'key' => true
                ],
                [
                    'label' => 'Perfil',
                    'column' => 'permissions.name',
                    'alias' => 'name',
                    'name' => 'name',
                    'order' => true
                ],
                [
                    'label' => 'Descrição',
                    'column' => 'permissions.label',
                    'alias' => 'label',
                    'name' => 'label',
                ],
                [
                    'label' => 'Criado em',
                    'column' => 'permissions.created_at',
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
                    'name' => 'permissions.name',
                    'label' => 'name',
                    'operator' => 'LIKE'
                ]
            ])
            ->addEditAction('permissions.edit', 'bg-teal')
            ->addDeleteAction('permissions.destroy', 'bg-teal')
            ->paginate(50)
            ->search();

        return view('settings.permission.index', compact('table'));
    }

    public function create()
    {
        $permission = $this->_permission;
        return view('settings.permission.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:permissions']);

        if ( $permission = Permission::create($request->all()) ) {
            alert()->success('Permissão foi criado com sucesso!!!', '');
        } else {
            alert()->warning('Permissão não foi criado.', '');
        }

        return response()->redirectToRoute('permissions.index');
    }

    public function edit($id)
    {
        $permission = $this->_permission->find($id);

        return view('settings.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        if($permission = $this->_permission->findOrFail($id)) {
            $permission->fill($request->all());
            if ( $permission->save() ) {
            	alert()->success($permission->label . ' - foram atualizadas.', '');
        	} else {
        		alert()->warning($permission->label . ' - não foram atualizadas.', '');
        	}
        } else {
            alert()->warning('Permissão com id '. $id .' não foi encontrado.', '');
        }

        return redirect()->route('permissions.index');
    }
}
