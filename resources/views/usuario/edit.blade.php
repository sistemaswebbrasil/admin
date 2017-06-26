@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1>Editar novo usuário</h1>
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

    <!-- {!! Form::model($usuario, ['method' => 'PATCH','route' => ['usuario.update', $usuario->id]]) !!} -->

    {!! Form::model($usuario, ['method' => 'PATCH', 'route' =>  ['usuario.update', $usuario->id], 'files' => true]) !!}    




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
                <strong>Funções:</strong>
                {!! Form::select('roles[]',$roles,null,['class' => 'form-control', 
                'multiple' => 'multiple']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {!! Form::text('avatar', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
            </div>
        </div>   

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">                
                <img src={{ $usuario->avatar }} > 
            </div>
        </div>        

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Foto2</strong>
                    {!! Form::label('avatar', 'Image')!!}
                    {!! Form::file('avatar', ['class' => 'form-control border-input']) !!}


            </div>
        </div> 
        

      





        

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>

    </div>
    {!! Form::close() !!}

@endsection