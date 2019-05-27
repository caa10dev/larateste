@extends('adminlte::page')


@section('title', 'Editar Permissão')

@section('content')
	<div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Editar Permissão</h3>
        </div>
        <div class="box-body">
        	@include('includes.alerts')
		    <form action="{{ route('permissions.update', $permission->id) }}" class="form-horizontal" method="post">
		    	{{ method_field('PUT') }}
				@include('settings.permission._form')
			</form>
		</div>
	</div>
@stop