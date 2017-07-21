@extends('adminlte::page')
@section('title', trans('usuario.criar')  )
@section('content_header')
<!-- <h1>{{ trans('usuario.criar') }}</h1> -->

@stop
@section('content')



<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">{{ trans('usuario.criar') }}</h3>
	</div>
	{!! Form::open(array('route' => 'usuario.store','method'=>'POST','files' => true ,'role' => 'form')) !!}
	@include('usuario.partials.form')
</div>
{!! Form::close() !!}
@endsection
