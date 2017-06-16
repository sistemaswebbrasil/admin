@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Criar novo Item de Menu de Acesso</h1>
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

    {!! Form::open(array('route' => 'menuacesso.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Texto do Menu:</strong>
                {!! Form::text('text', null, array('placeholder' => 'Texto do Menu','class' => 'form-control')) !!}
            </div>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>URL:</strong>
                {!! Form::text('url', null, array('placeholder' => 'URL','class' => 'form-control')) !!}
            </div>
        </div> 

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Menu Pai:</strong>
                {!! Form::select('menus[]',$menus,null,['class' => 'form-control','placeholder' => 'Selecionar']) !!}                
            </div>
        </div>             

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
