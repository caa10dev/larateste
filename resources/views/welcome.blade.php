@extends('adminlte::page')
@section('title', 'Teste Prático')

@section('content_header')
    {{-- <h1>Laravel</h1> --}}
@stop
@section('content')

@include('includes.alerts')
<div class="row">
			<div class="col-md-4">
				<div class="info-box bg-green">
					<span class="info-box-icon"><i class="fa fa-fw fa-user"></i></span>

					<div class="info-box-content">
					  	<p><span class="info-box-text">Home</span></p>
					  	<p><a href="{{ route('incidents.index') }}">Página inicial 3</a></p>
					</div>
				</div>
			</div>

	</div>
  @stop