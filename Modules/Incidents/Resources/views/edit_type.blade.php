@extends('adminlte::page')
@section('content')
	<div class="box box-{!! config('incidents.bg-color') !!}-dark">
            <div class="box-header bg-{!! config('incidents.bg-color') !!} color-palette">
                <i class="fa fa-asterisk"></i>
                <h3 class="box-title">{!! config('incidents.name') !!} - Editar Tipo</h3>
            </div>
            
            <div class="box-body">
                @include('includes.alerts')
                {!! Form::open(['route' => ['tp_incidents.update'], 'class' => 'form']) !!}
                    {{ Form::hidden('id',$data->id)}}
                    @include('incidents::_formType')
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                {!! Form::close() !!}
		    </div>
		</div>
	</div>		
@stop

