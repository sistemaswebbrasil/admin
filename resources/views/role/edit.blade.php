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
    {!! Form::model($role, ['method' => 'PATCH','route' => ['role.update', $role->id]]) !!}
    @include('role.partials.form')
</div>
{!! Form::close() !!}
@endsection
