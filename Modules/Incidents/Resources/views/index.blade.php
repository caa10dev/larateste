@extends('adminlte::page')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-{!! config('incidents.bg-color') !!}-dark">
            <div class="box-header bg-{!! config('incidents.bg-color') !!} color-palette">
                <i class="fa fa-asterisk"></i>
                <h3 class="box-title">{!! config('incidents.name') !!}</h3>
            </div>
			<div class="box-body">
				@include('includes.alerts')
				<table class="table table-striped table-bordered table-hover">
         		 	<thead>
					  <th width="8%">Código</th>
					  <th>Título</th>
					  <th>Descrição</th>
					  <th width="22%">Tipo</th>
					  <th width="22%">Criticidade</th>
					  <th width="11%">Status</th>
					  <th width="11%"></th>
					</thead>
					@foreach($incidents as $incident)
						<tr id="ind-{{$incident->id}}">
							<td>{{$incident->id}}</td>
							<td>{{$incident->title}}</td>
							<td>{{$incident->description}}</td>
							<td>{{$types_incidents[$incident->type_id]}}</td>
							<td>{{$criticality[$incident->criticality]}}</td>
							<td>
								@if($incident->status==0)
									<span class="badge bg-red"><i class="fa fa-bolt"></i></span>
								@else
									<span class="badge bg-green"><i class="fa fa-check"></i></span>
								@endif
							</td>
							<td>
								<a href="{{$incident->id}}/edit" class="col-xs-6"><i class="fa fa-edit"></i></a>
								<i class="fa fa-remove remove-data" data-item="{{$incident->id}}"></i>
							</td>
						</tr>
					@endforeach
				</table>
				<div>{{ $incidents->appends(request()->input())->links() }}</div>
				<div>{{ $incidents->total()}} <small>Resultado(s)</small></div>
			</div>
		</div>
	</div>
</div>
@stop
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirmForm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Deseja excluir o item <b class="indice"> ?</b> ?</h4>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btn-confirm" data-token="{{ csrf_token() }}">Deletar o Item</button>
        <button type="button" class="btn btn-primary" id="btn-cancel">Cancelar</button>
      </div>
    </div>
  </div>
</div>

@section('js')
<script>
	$('.remove-data').click(function(){
		var id_item = $(this).attr('data-item');
		$('#confirmForm').modal('show');
		$('.indice').text(id_item);
		$("#btn-cancel").on("click", function(){
			$("#confirmForm").modal('hide');
		});
		$("#btn-confirm").on("click", function(){
			var token = $(this).data('token');
			$.ajax({
	        url: '{{ route("incidents.destroy") }}',
	        type: 'POST',
	        dataType: 'json',
			data:{
				"id": id_item,
                "_method": 'DELETE',
                "_token": token,
			}
		    }).done(function(data) {
				if(data.delete == 1){
					$('#ind-'+id_item).remove();
					swa(data.msg,'succcess');
				}
				if(data.delete == 0){
					swa(data.msg,'warning');
				}
		    });
			$("#confirmForm").modal('hide');
		});
	});
</script>
@stop