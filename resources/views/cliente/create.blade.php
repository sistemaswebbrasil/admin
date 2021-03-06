@extends('adminlte::page')
@section('title', trans('geral.novapermissao')  )
@section('content_header')
@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('geral.novapermissao') }}
        </h3>
    </div>
    {!! Form::open(array('route' => 'permission.store','method'=>'POST')) !!}
    @include('permission.partials.form')
</div>
{!! Form::close() !!}
@endsection
