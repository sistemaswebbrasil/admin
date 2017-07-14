@extends('adminlte::page')
@section('title', trans('usuario.editar',[ 'id' => $usuario->id ])) 

@section('content')
@if (count($errors) > 0)
<div class="box box-solid box-danger">
	<div class="box-header">
		<h3 class="box-title">
			{{ trans('geral.errovalidacao') }}
		</h3>
	</div>
	<div class="box-body">

		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
</div>
@endif

<div class="box box-primary">
	<div class="box-header with-border">		
		<h3 class="box-title">{{trans('usuario.editar',[ 'id' => $usuario->id ])}}</h3>		
	</div>
	{!! Form::model($usuario, ['method' => 'PATCH', 'route' =>  ['usuario.update', $usuario->id], 'files' => true]) !!}    
	 @include('usuario.partials.form')
	 @section('scripts')
</div>
{!! Form::close() !!}
@endsection