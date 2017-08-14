@extends('adminlte::page')
@section('title', trans('geral.novafuncao')  )
@section('content_header')
@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('geral.novafuncao') }}
        </h3>
    </div>
    {!! Form::open(array('route' => 'role.store','method'=>'POST')) !!}
    @include('role.partials.form')
</div>
{!! Form::close() !!}
@endsection
