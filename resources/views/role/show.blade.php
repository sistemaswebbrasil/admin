@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Mostrar Função</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('role.index') }}"> Back</a>
            </div>
@stop

@section('content')



    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $role->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Apelido:</strong>
                {{ $role->display_name }}
            </div>
        </div>

    </div>

@endsection