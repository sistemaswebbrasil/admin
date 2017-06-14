@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Usuários</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('usuario.index') }}"> Back</a>
            </div>
@stop

@section('content')



    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $usuario->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $usuario->email }}
            </div>
        </div>

    </div>

@endsection