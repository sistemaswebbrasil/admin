@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Mostrar Item de Menu de Acesso</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('menuacesso.index') }}"> Back</a>
            </div>
@stop
@section('content')

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Título:</strong>
                {{ $menuacesso->text }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>URL:</strong>
                {{ $menuacesso->url }}
            </div>
        </div>

    </div>

@endsection