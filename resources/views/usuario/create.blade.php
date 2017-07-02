@extends('adminlte::page')
@section('title', trans('usuario.criar')  )
@section('content_header')
<!-- <h1>{{ trans('usuario.criar') }}</h1> -->

@stop
@section('content')

<!-- @if (count($errors) > 0) -->
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h4><i class="icon fa fa-ban"></i> {{ trans('geral.errovalidacao') }}</h4>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
</div>
<!-- @endif -->





<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">{{ trans('usuario.criar') }}</h3>
	</div>
	{!! Form::open(array('route' => 'usuario.store','method'=>'POST','files' => true ,'role' => 'form')) !!}
	@include('usuario.partials.form')
</div>
{!! Form::close() !!}
@endsection