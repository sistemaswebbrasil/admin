@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Criar novo Usuário</h1>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('usuario.index') }}"> Back</a>
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

    {!! Form::open(array('route' => 'usuario.store','method'=>'POST')) !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Senha:</strong>
                {!! Form::password('password', null, array('placeholder' => 'Senha','class' => 
                'form-control')) !!}                
            </div>
        </div>  

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Funções:</strong>
                {!! Form::select('roles[]',$roles,null,['class' => 'form-control', 
                'multiple' => 'multiple']) !!}
            </div>
        </div>               

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
    {!! Form::close() !!}




@endsection
