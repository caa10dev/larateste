@extends('adminlte::page')

@section('title', 'Criar Permissão')

@section('content')
	<div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Criar Permissão</h3>
        </div>
        <div class="box-body">
        	@include('includes.alerts')
		    <form action="{{ route('permissions.store') }}" class="form-horizontal" method="post">
				@include('settings.permission._form')
			</form>
		</div>
	</div>
@stop