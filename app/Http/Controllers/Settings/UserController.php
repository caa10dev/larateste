<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Traits\Authorizable;
use App\Table\Table;
use Modules\Empresas\Entities\Empresa;
use Modules\Funcionarios\Entities\Funcionario;

class UserController extends Controller
{
	use Authorizable;

	/**
     * @var User
     */
	private $user;

	/**
     * @var Table
     */
    private $table;

    public function __construct(Table $table, User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->table = $table;
    }

    public function index()
	{
	    $result = $this->user->with('roles')->paginate();
	    $conditions = [];
	    $userRoleMaster = \Auth()->user()->hasAnyRoles('master');
	    $empresa_id = \Auth()->user()->condominio_id;

	    if(!$userRoleMaster && $empresa_id != 1){
	    	$conditions = [
    			'column' => 'users.empresa_id',
    			'value' => $empresa_id
	    	];
	    }

	    $table = $this->table
            ->model(User::class)
            ->columns([
                [
                    'label' => 'ID',
                    'column' => 'users.id',
                    'alias' => 'id',
                    'name' => 'id',
                    'key' => true
                ],
                [
                    'label' => 'Nome',
                    'column' => 'users.name',
                    'alias' => 'name',
                    'name' => 'name',
                    'order' => true
                ],
                [
                    'label' => 'Email',
                    'column' => 'users.email',
                    'alias' => 'email',
                    'name' => 'email',
                    'order' => true
                ],
                [
                	'label' => 'Perfil',
                	'with' => 'roles',
                	'with_pivot' => 1,
                	'column_with' => 'name',
                	'column' => 'roles.name',
                	'name' => 'roles',             	
                	'alias' => 'roles'
                ],
                [
                    'label' => 'Criado em',
                    'column' => 'users.created_at',
                    'alias' => 'created_at',
                    'name' => 'created_at'
                ],
            ])
            ->with([
            	[
        			'table' => 'roles',
        			'filter' => (!$userRoleMaster ? ['roles.name', '!=', 'master'] : ''),
        			'columns' => ['roles.name']
            	],
            ])
            ->where([
            	$conditions
            ])
            ->filters([
                [
                    'model_master' => 1,
                    'name' => 'users.name',
                    'label' => 'name',
                    'operator' => 'LIKE'
                ]
            ])
            ->addEditAction('users.edit', 'bg-teal')
            ->addDeleteAction('users.destroy', 'bg-teal')
            ->paginate(10)
            ->search();

	    return view('settings.user.index', compact('result', 'table'));
	}

	public function create()
	{
		$user = new User;
	    $roles = Role::pluck('name', 'id');
	    $empresas = Empresa::where([['tp', '<>', 1]])->pluck('name', 'id');
	    $funcionarios = Funcionario::pluck('nome', 'id');
	    return view('settings.user.create', compact('roles', 'user', 'empresas', 'funcionarios'));
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	    	'funcionario_id' => 'sometimes|nullable|exists:funcionarios,id',
	    	'empresa_id' => 'required|nullable|exists:empresas,id',
	        'name' => 'bail|required|min:2',
	        'email' => 'required|email|unique:users,email',
	        'password' => 'required|min:6|same:confirm-password',
	        'roles' => 'required|min:1'
	    ]);

	    // hash password
	    $request->merge(['password' => bcrypt($request->get('password'))]);

	    // Create the user
	    if ( $user = User::create($request->except('roles')) ) {
	        $user->roles()->sync($request->input('roles'));
	        alert()->success('Usuário criado com sucesso.', '');
	    } else {
	        alert()->warning('Não foi possivel criar o usuário.!!!', '');
	    }

	    return response()->redirectToRoute('users.index');
	}

	public function edit($id)
	{
	    $user = User::find($id);
	    $roles = Role::pluck('name', 'id');
	    $permissions = Permission::all('name', 'id');
	    $empresas = Empresa::where([['tp', '<>', 1]])->pluck('name', 'id');
	    $funcionarios = Funcionario::pluck('nome', 'id');

	    return view('settings.user.edit', compact('user', 'roles', 'permissions', 'empresas', 'funcionarios'));
	}


	public function minhaConta()
	{
	    $user = User::find(auth()->user()->id);

	    return view('settings.user.minha_conta', compact('user'));
	}

	public function update(Request $request, $id)
	{
	    $this->validate($request, [
	    	'funcionario_id' => 'sometimes|nullable|exists:funcionarios,id',
	        'empresa_id' => 'required|nullable|exists:empresas,id',
	        'name' => 'bail|required|min:2',
	        'email' => 'required|email|unique:users,email,' . $id,
	        'password' => 'sometimes|nullable|min:6|same:confirm-password',
	        'roles' => 'required|min:1'
	    ]);

	    // Get the user
	    $user = User::findOrFail($id);

	    // Update user
	    $user->fill($request->except('password'));

	    // check for password change
	    if($request->get('password')) {
	        $user->password = bcrypt($request->get('password'));
	    }

	    if ( $user->save() ) {
	        $user->roles()->sync($request->input('roles'));
	        alert()->success('Usuário foi atualizado', '');
	    } else {
	        alert()->waring('Não foi possivel atualizar o usuário.!!!', '');
	    }

	    return response()->redirectToRoute('users.index');
	}

	public function updateMinhaConta(Request $request)
	{
	    $this->validate($request, [
	        'name' => 'bail|required|min:2',
	        'email' => 'required|email|unique:users,email,' . auth()->user()->id,
	        'password' => 'sometimes|nullable|min:6|same:confirm-password',
	    ]);

	    // Get the user
	    $user = User::findOrFail(auth()->user()->id);

	    // Update user
	    $user->fill($request->except('roles', 'password'));

	    // check for password change
	    if($request->get('password')) {
	        $user->password = bcrypt($request->get('password'));
	    }

	    if ( $user->save() ) {
	        alert()->success('Usuário foi atualizado', '');
	    } else {
	        alert()->success('Não foi possivel atualizar o usuário.!!!', '');
	    }

	    return response()->redirectToRoute('users.minha_conta');
	}

	public function destroy($id)
	{
	    if ( \Auth()->user()->id == $id ) {
	        alert()->success('Deletar o usuário logado não é permitido :( !!!', '');
	        return redirect()->back();
	    }
	    
	    if (User::findOrFail($id)->delete() ) {
            alert()->success('Usuário deletado com sucesso', '');
        } else {
            alert()->success('Usuário não foi deletado!!!', '');
        }
        return response()->redirectToRoute('users.index')->with($message);

	}

	private function syncPermissions(Request $request, $user)
	{
	    // Get the submitted roles
	    $roles = $request->get('roles', []);
	    $permissions = $request->get('permissions', []);

	    // Get the roles
	    $roles = Role::find($roles);

	    // check for current role changes
	    if( ! $user->hasAllRoles( $roles ) ) {
	        // reset all direct permissions for user
	        $user->permissions()->sync([]);
	    } else {
	        // handle permissions
	        $user->syncPermissions($permissions);
	    }

	    $user->syncRoles($roles);
	    return $user;
	}
}
