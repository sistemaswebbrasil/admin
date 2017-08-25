@extends('adminlte::page')
@section('title', trans('geral.editarcliente')  )
@section('content_header')

@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('geral.editarcliente') }}</h3>
    </div>
    {!! Form::model($cliente, ['method' => 'PATCH','route' => ['cliente.update', $cliente->cl_codigo]]) !!}
    @include('cliente.partials.form')
</div>
{!! Form::close() !!}
@endsection
