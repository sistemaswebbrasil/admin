@extends('adminlte::page')

@section('title',  trans('usuario.listar') )

@section('content_header')
<h1>{{ trans('usuario.listar') }}</h1>

<!-- @role('admin') -->
<div class="pull-right">
    <a class="btn btn-success" href="{{ route('usuario.create') }}"> {{ trans('geral.novo') }}</a>
</div>
<!-- @endrole -->

@stop

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>{{ trans('usuario.id') }}</th>
            <th>{{ trans('usuario.name') }}</th>
            <th>{{ trans('usuario.email') }}</th>
            <th width="280px">{{ trans('geral.acao') }}</th>
        </tr>
    @foreach ($usuarios as $key => $usuario)
    <tr>
        <td>{{ $usuario->id }}</td>
        <td>{{ $usuario->name }}</td>
        <td>{{ $usuario->email }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('usuario.show',$usuario->id) }}">{{ trans('geral.mostrar') }}</a>
            
            <a class="btn btn-primary" href="{{ route('usuario.edit',$usuario->id) }}">{{ trans('geral.editar') }}</a>
            {!! Form::open(['method' => 'DELETE','route' => ['usuario.destroy', $usuario->id],'style'=>'display:inline']) !!}
            {!! Form::submit( trans('geral.excluir') , ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            
        </td>
    </tr>
    @endforeach
    </table>

    {!! $usuarios->render() !!}

@endsection