@extends('adminlte::page')
@section('title', trans('geral.acessonegado')  )
@section('content')
<div class="alert alert-danger alert-dismissible">
	<h4><i class="icon fa fa-ban"></i>{{ trans('geral.acessonegado') }}</h4>
	@if(!empty (Config::get('ability')))
		{{  Config::get('ability') }}
	@else
		{{ $exception->getMessage() }}
	@endif
</div>

@stop
