@extends('adminlte::page')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-{!! config('incidents.bg-color') !!}-dark">
            <div class="box-header bg-{!! config('incidents.bg-color') !!} color-palette">
                <i class="fa fa-asterisk"></i>
                <h3 class="box-title">{!! config('incidents.name') !!} - Tipos</h3>
            </div>
			<div class="box-body">
				@include('includes.alerts')
				<table class="table table-striped table-bordered table-hover">
         		 	<thead>
					  <th width="8%">Código</th>
					  <th>Título</th>
					  <th></th>
					</thead>
					@foreach($tp_incidents as $type_incident)
						<tr>
							<td>{{$type_incident->id}}</td>
							<td>{{$type_incident->title}}</td>
							<td><a href="/incidents/types/{{$type_incident->id}}/edit" class="col-xs-6"><i class="fa fa-edit"></i></a></td>
						</tr>
					@endforeach
				</table>
				@if(sizeof($tp_incidents) > 0)
				<div>{{ $tp_incidents->appends(request()->input())->links() }}</div>
				<div>{{ $tp_incidents->total()}} <small>Resultado(s)</small></div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop
@include('incidents::_modalRemove')
