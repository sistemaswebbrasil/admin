@extends('adminlte::master')

    <div class="row">


<div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">{{ trans('usuario.avatar') }}</h4>
            </div>
            <div class="box-body">                
                @if (!empty($usuario->avatar))
                    <img src={{ $usuario->avatar }} id='avatar' width="200px" > 
                @else
                    <img src='/usuarios/usuario.jpg' id='avatar' width="200px" > 
                @endif
            </div>
          </div>
  </div>

<div class="col-md-9">
          <div class="box box-primary">





        
            <div class="form-group">
                <strong>{{ trans('usuario.id') }}:</strong>
                {{ $usuario->id }}
            </div>
        

        
            <div class="form-group">
                <strong>{{ trans('usuario.name') }}:</strong>
                {{ $usuario->name }}
            </div>
        

        
            <div class="form-group">
                <strong>{{ trans('usuario.email') }}:</strong>
                {{ $usuario->email }}
            </div>
        

        

        

        
            <div class="form-group">
                <strong>{{ trans('usuario.created_at') }}:</strong>
                {{ $usuario->created_at }}
            </div>
        

        
            <div class="form-group">
                <strong>{{ trans('usuario.updated_at') }}:</strong>
                {{ $usuario->updated_at }}
            </div>
        

        
            <div class="form-group">
                <strong>{{ trans('usuario.language') }}:</strong>
                {{ $usuario->language }}
            </div>
        

  

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
