{!! csrf_field() !!}

@if(isset($empresas))
<div class="form-group">
    <label class="col-sm-2 control-label" for="empresas">*Clinica:</label>
	<div class="col-sm-10">
		{!! Form::select('empresa_id', $empresas, $user->empresa_id, array('class' => 'form-control', 'id' => 'empresas', 'placeholder' => 'Selecione uma Clinica', 'required')) !!}
	</div>
</div>
@endif

@if(isset($funcionarios))
<div class="form-group">
    <label class="col-sm-2 control-label" for="funcionarios">*Funcionário:</label>
	<div class="col-sm-10">
		{!! Form::select('funcionario_id', $funcionarios, $user->funcionario_id, array('class' => 'form-control', 'id' => 'funcionarios', 'placeholder' => 'Selecione um Funcionário para vincular ao usuário criado')) !!}
	</div>
</div>
@endif

<div class="form-group">
    <label class="col-sm-2 control-label" for="name">*Nome:</label>
	<div class="col-sm-10">
		{!! Form::text('name', $user->name, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'name')) !!}
	</div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="email">*Email:</label>
	<div class="col-sm-10">
		{!! Form::text('email', $user->email, array('placeholder' => 'Email','class' => 'form-control', 'id' => 'email')) !!}
	</div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="password">*Senha:</label>
	<div class="col-sm-10">
		{!! Form::password('password', array('placeholder' => 'Senha','class' => 'form-control', 'id' => 'password')) !!}
	</div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="confirm-password">*Repetir Senha:</label>
	<div class="col-sm-10">
		{!! Form::password('confirm-password',  array('placeholder' => 'Confirm Password','class' => 'form-control', 'id' => 'confirm-password')) !!}
	</div>
</div>

@if(isset($roles))
<div class="form-group">
    <label class="col-sm-2 control-label" for="roles">*Perfil:</label>
	<div class="col-sm-10">
		{!! Form::select('roles[]', $roles, $user->roles, array('class' => 'form-control','multiple', 'id' => 'roles')) !!}
	</div>
</div>
@endif

@can(['add_users', 'edit_users'])
<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
        <input type="submit" value="Salvar" class="btn btn-primary">
    </div>
</div>
@endcan

