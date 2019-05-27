@extends('adminlte::page')

@section('title', 'Criar Usuário')

@section('content')
	<div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Criar Usuário</h3>
        </div>
        <div class="box-body">
        	@include('includes.alerts')
		    <form action="{{ route('users.store') }}" class="form-horizontal" method="post">
				@include('settings.user._form')
			</form>
		</div>
	</div>
@stop