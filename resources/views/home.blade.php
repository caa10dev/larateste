@extends('adminlte::page')

@section('title', 'E-COND')

@section('content_header')
    {{-- <h1>Dashboard</h1> --}}
@stop

@section('content')
	@include('includes.alerts')
	
	<div class="row">
		@can('view_condominios')
			<div class="col-md-4">
				<div class="info-box {{ config('condominios.color') }}">
					<span class="info-box-icon"><i class="fa fa-fw fa-user"></i></span>

					<div class="info-box-content">
					  	<p><span class="info-box-text">Condominios</span></p>
					  	<p><a href="{{ route('condominios.index') }}">Listar Condominios</a></p>
					</div>
				</div>
			</div>
		@endcan

	</div>
@stop

