@extends('adminlte::page')

@section('title', 'Minha Conta')

@section('content')
	<div class="box box-solid box-primary">
        <div class="box-header">
            <h3 class="box-title">Minha Conta</h3>
        </div>
        <div class="box-body">
        	@include('includes.alerts')
		    <form action="{{ route('users.update.minha_conta') }}" class="form-horizontal" method="post">
		    	{{ method_field('PUT') }}
				@include('settings.user._form')
			</form>
		</div>
	</div>
@stop