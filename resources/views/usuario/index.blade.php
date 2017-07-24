@extends('adminlte::page')

@section('title',  trans('usuario.listar') )

@section('content_header')
@stop

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible">
    <button aria-hidden="true" class="close" data-dismiss="alert" type="button">
        ×
    </button>
    <h4>
        <i class="icon fa fa-ban">
        </i>
        {{ trans('geral.sucesso') }}
    </h4>
    <p>
        {{ $message }}
    </p>
</div>
@endif
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('usuario.listar') }}
        </h3>
    </div>
    <div class="box-header">
        <a class="btn btn-success pull-right" href="{{ route('usuario.create') }}">
            <i class="fa fa-plus">
                {{ trans('geral.novo') }}
            </i>
        </a>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>
                    {{ trans('usuario.id') }}
                </th>
                <th>
                    {{ trans('usuario.name') }}
                </th>
                <th>
                    {{ trans('usuario.email') }}
                </th>
                <th>
                    {{ trans('usuario.created_at') }}
                </th>
                <th>
                    {{ trans('usuario.updated_at') }}
                </th>
                <th>
                    {{ trans('geral.acao') }}
                </th>
            </tr>
            @foreach ($usuarios as $key => $usuario)
            <tr>
                <td>
                    {{ $usuario->id }}
                </td>
                <td>
                    {{ $usuario->name }}
                </td>
                <td>
                    {{ $usuario->email }}
                </td>
                <td>
                    {{ $usuario->created_at->formatLocalized('%d %B %Y') }}
                </td>
                <td>
                    {{ $usuario->updated_at->diffForHumans()  }}
                </td>
                <td>
                    <a class="btn btn-info" data-target="#modal-default" data-toggle="modal" href="#" title="{{" trans('geral.mostrar')="" }}="">
                        <i class="fa fa-eye">
                        </i>
                    </a>
                    <a class="btn btn-primary" href="{{ route('usuario.edit',$usuario->id) }}" title="{{" trans('geral.editar')="" }}="">
                        <i class="fa fa-edit">
                        </i>
                    </a>
                    {!! Form::open(['method' => 'DELETE','route' => ['usuario.destroy', $usuario->id],'style'=>'display:inline']) !!}
                    <button class="btn btn-danger" title="{{" trans('geral.excluir')="" }}="">
                        <i class="fa fa-close">
                        </i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    {!! $usuarios->render() !!}
</div>
<div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title">
                    {{ trans('usuario.mostrar',[ 'name' => $usuario->name ]) }}
                </h4>
            </div>
            <div class="modal-body">
                @include('usuario.show')
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-right" data-dismiss="modal" type="button">
                    {{ trans('geral.sair') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
