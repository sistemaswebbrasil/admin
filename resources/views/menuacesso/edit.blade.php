@extends('adminlte::page')

@section('title', 'Editar Item de Menu de Acesso')

@section('content_header')
<h1>Editar Item de Menu de Acesso</h1>

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('menuacesso.index') }}"> Voltar</a>
            </div>
@stop

@section('content')



    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Atenção!</strong>Foram encontrados os seguintes dados incorretos:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($menuacesso, ['method' => 'PATCH','route' => ['menuacesso.update', $menuacesso->id]]) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Título:</strong>
                {!! Form::text('text', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
            </div>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>URL:</strong>
                {!! Form::text('url', null, array('placeholder' => 'Apelido','class' => 'form-control')) !!}
            </div>
        </div> 
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>

    </div>
    {!! Form::close() !!}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


