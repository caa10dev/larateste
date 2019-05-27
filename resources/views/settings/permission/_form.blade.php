{!! csrf_field() !!}

<div class="form-group">
    <label class="col-sm-2 control-label" for="name">*Nome:</label>
	<div class="col-sm-10">
		{!! Form::text('name', $permission->name, array('placeholder' => 'Name','class' => 'form-control', 'id' => 'name')) !!}
	</div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label" for="label">*Descrição:</label>
	<div class="col-sm-10">
		{!! Form::text('label', $permission->email, array('placeholder' => 'Descrição','class' => 'form-control', 'id' => 'label')) !!}
	</div>
</div>

@if (Auth::user()->can('add_permissions') || Auth::user()->can('edit_permissions'))
<div class="form-group">
    <div class="col-sm-12">
        <input type="submit" value="Salvar" class="btn btn-primary">
    </div>
</div>
@endif

