


@extends('adminlte::page')
@section('title', trans('geral.novoitemmenu')  )
@section('content_header')
@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('geral.novoitemmenu') }}
        </h3>
    </div>
    {!! Form::open(array('route' => 'menuacesso.store','method'=>'POST')) !!}
    @include('menuacesso.partials.form')
</div>
{!! Form::close() !!}
@endsection
