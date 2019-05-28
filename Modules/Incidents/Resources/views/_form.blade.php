<div class="row">
	<div class="clearfix"></div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label>Título</label>
			{{ Form::text('title', isset($data->title) ? $data->title : null, ['class'=>'form-control', 'required']) }}
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div class="form-group">
			<label>Tipo</label>
			{{ Form::select('type_id', $types_incidents, isset($data->type_id) ? $data->type_id : null ,['class'=>'form-control', 'required']) }}
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div class="form-group">
			<label>Criticidade</label>
			{{ Form::select('criticality', $criticality, isset($data->criticality) ? $data->criticality : null ,['class'=>'form-control', 'required']) }}
		</div>
	</div>
	<div class="col-xs-12">
		<div class="form-group">
			<label>Descrição</label>
			{{ Form::textarea('description', isset($data->description) ? $data->description : null, ['class'=>'form-control', 'required']) }}
		</div>
	</div>
</div>
