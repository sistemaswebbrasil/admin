@extends('adminlte::page')
@section('title', trans('geral.editarfuncao')  )
@section('content_header')
<!-- <h1>{{ trans('usuario.criar') }}</h1> -->

@stop
@section('content')



<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('geral.novafuncao') }}</h3>
    </div>
    {!! Form::model($permission, ['method' => 'PATCH','route' => ['permission.update', $permission->id]]) !!}
    @include('permission.partials.form')
</div>
{!! Form::close() !!}
@endsection
