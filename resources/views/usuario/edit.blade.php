@extends('adminlte::page')

@section('title', trans('usuario.editar',[ 'id' => $usuario->id ])) 

<!-- trans('string1', [ 'user' => 'Ainsley', 'other' => 'Hayden' ]); -->


@section('content_header')
<h1>{{trans('usuario.editar',[ 'id' => $usuario->id ])}}</h1>
<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('usuario.index') }}"> {{ trans('geral.voltar') }}</a>
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
{!! Form::model($usuario, ['method' => 'PATCH', 'route' =>  ['usuario.update', $usuario->id], 'files' => true]) !!}    



@include('usuario.partials.form')


{!! Form::close() !!}

@endsection