@extends('adminlte::page')
@section('title', trans('geral.editarpermissao')  )
@section('content_header')

@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('geral.editarpermissao') }}</h3>
    </div>
    {!! Form::model($permission, ['method' => 'PATCH','route' => ['permission.update', $permission->id]]) !!}
    @include('permission.partials.form')
</div>
{!! Form::close() !!}
@endsection
