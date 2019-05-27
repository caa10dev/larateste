@extends('adminlte::page')

@section('title', 'Criar Perfil')

@section('content')
	<div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Criar Perfil</h3>
        </div>
        <div class="box-body">
        	@include('includes.alerts')
		    <form action="{{ route('roles.store') }}" class="form-horizontal" method="post">
				@include('settings.role._form')
			</form>
		</div>
	</div>
@stop