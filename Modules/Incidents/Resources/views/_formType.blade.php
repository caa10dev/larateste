<div class="row">
	<div class="clearfix"></div>
	<div class="col-xs-12 col-md-6">
		<div class="form-group">
			<label>Título</label>
			{{ Form::text('title', isset($data->title) ? $data->title : null, ['class'=>'form-control', 'required']) }}
		</div>
	</div>
</div>
