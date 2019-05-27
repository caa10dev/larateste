@extends('adminlte::page')


@section('title', 'Editar Perfil')

@section('content')
	<div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Editar Perfil</h3>
        </div>
        <div class="box-body">
        	@include('includes.alerts')
		    <form action="{{ route('roles.update', $role->id) }}" class="form-horizontal" method="post">
		    	{{ method_field('PUT') }}
				@include('settings.role._form')
			</form>
		</div>
	</div>
@stop