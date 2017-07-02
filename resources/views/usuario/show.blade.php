@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('title', trans('usuario.mostrar',[ 'name' => $usuario->name ]))
@section('content_header')
<h1>{{ trans('usuario.mostrar',[ 'name' => $usuario->name ]) }}</h1>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('usuario.index') }}"> {{ trans('geral.voltar') }}</a>
            </div>
@stop

@section('content')



    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('usuario.id') }}:</strong>
                {{ $usuario->id }}
            </div>
        </div>    

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('usuario.name') }}:</strong>
                {{ $usuario->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('usuario.email') }}:</strong>
                {{ $usuario->email }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('usuario.avatar') }}:</strong>
                @if (!empty($usuario->avatar))
                    <img src={{ $usuario->avatar }} id='avatar' width="200px" > 
                @else
                    <img src='/usuarios/usuario.jpg' id='avatar' width="200px" > 
                @endif
            </div>
        </div> 

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('usuario.created_at') }}:</strong>
                {{ $usuario->created_at }}
            </div>
        </div>    

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('usuario.updated_at') }}:</strong>
                {{ $usuario->updated_at }}
            </div>
        </div>               

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ trans('usuario.language') }}:</strong>
                {{ $usuario->language }}
            </div>
        </div>                       

  
<div class="col-xs-12 col-sm-12 col-md-12">
    <table class="table table-bordered">
        <tr>
            <th>{{ trans('usuario.roles') }}</th>
            <th>{{ trans('funcao.description') }}</th>
        </tr>
    @foreach ($usuario->roles as $role)
    <tr>
        <td>{{ $role->display_name }}</td>
        <td>{{ $role->description }}</td>
    </tr>
    @endforeach
    </table>      
    </div>

                     



    </div>

@endsection