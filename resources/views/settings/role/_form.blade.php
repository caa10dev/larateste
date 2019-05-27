{!! csrf_field() !!}

<div class="form-group">
    <label class="col-sm-2 control-label" for="name">*Nome:</label>
	<div class="col-sm-10">
		{!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'name')) !!}
	</div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="label">*Descrição:</label>
	<div class="col-sm-10">
		{!! Form::text('label', $role->email, array('placeholder' => 'Descrição','class' => 'form-control', 'id' => 'label')) !!}
	</div>
</div>

@if($role->name === 'Master')
    @include('shared._permissions', [
                  'title' => 'Permissões',
                  'options' => ['disabled'] ])
@else
    @include('shared._permissions', [
                  'title' => 'Permissões',
                  'model' => $role ])
@endif

@if (Auth::user()->can('add_roles') || Auth::user()->can('edit_roles'))
<div class="form-group">
    <div class="col-sm-12">
        <input type="submit" value="Salvar" class="btn btn-primary">
    </div>
</div>
@endif

