@extends('adminlte::page')
@section('title', trans('usuario.perfil',[ 'name' => $usuario->name ])) 

@section('content')
@if (count($errors) > 0)
<!-- <div class="box box-solid box-danger">
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
</div> -->

<!-- <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> {{ trans('geral.errovalidacao') }} </h4>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div> -->

	
@endif

<div class="box box-primary">
	<div class="box-header with-border">
		
		<h3 class="box-title">{{ trans('usuario.perfil',[ 'name' => $usuario->name ]) }}</h3>			
		
	</div>
	{!! Form::model($usuario, ['method' => 'PATCH', 'route' =>  ['usuario.update', $usuario->id], 'files' => true ] ) !!}
	@include('usuario.partials.form')
</div>
{!! Form::close() !!}
@endsection

