@extends('adminlte::page')

@section('title', trans('geral.acessonegado')  )





@section('content')
<div class="alert alert-danger alert-dismissible">
	<h4><i class="icon fa fa-ban"></i>{{ trans('geral.acessonegado') }}</h4>
	{{ $exception->getMessage() }}
</div>
@stop
