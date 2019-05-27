@extends('adminlte::page')

@section('title', 'Listagem de Permissão')

@section('content')
    <div class="box box-solid">
        <div class="box-header bg-teal">
            <h3 class="box-title">Permissão</h3>
        </div>
        <div class="box-body">
            @include('includes.alerts')

            <form action="{{url()->current()}}" method="GET" class="form-inline">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Pesquisa</legend>
                        <div class="row">
                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Nome do Permissão" value="{{\Request::get('search')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-3">
                                <button type="submit" class="btn bg-teal">Pesquisar</button>
                                <button class="btn bg-teal btn-flat" type="button" id="search-btn-clear"><i class="fa fa-eraser"> Limpar Filtro</i></button>
                            </div>
                        </div>
                    </fieldset>
                </form>

                @can('add_permission')
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <span class="input-group-btn">
                            <a href="{{ route('permissions.create') }}" class="btn bg-teal btn-flat"> <i class="glyphicon glyphicon-plus-sign"></i> Criar Permissão</a>
                        </span>
                    </div>
                </div>
                <br>
                @endcan
                @include('table.table')
            </div>
        </div>
    </div>
@stop
