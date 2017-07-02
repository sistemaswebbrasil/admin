@extends('adminlte::master')

<div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
            @if (!empty($usuario->avatar))
            <img class="profile-user-img img-responsive img-circle" src={{ $usuario->avatar }} id='avatar' width="200px" > 
            @else
            <img class="profile-user-img img-responsive img-circle" src='/usuarios/usuario.jpg' id='avatar' width="200px" > 
            @endif
            <h3 class="profile-username text-center">{{ $usuario->name }}</h3>
            <p class="text-muted text-center">{{ $usuario->email }}</p>

        </div>

    </div>
</div>

<div class="col-md-9">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('geral.detalhes') }}</h3>
  </div>
  <div class="box-body">
      <strong><i class="fa fa-book margin-r-5"></i> {{ trans('usuario.language') }}</strong>
      <p class="text-muted">        
        {{ trans(  'usuario.'.$usuario->language ) }}
    </p>
    <hr>
    <strong><i class="fa fa-pencil margin-r-5"></i> {{ trans('usuario.roles') }}</strong>
    <p>
        @foreach ($usuario->roles as $role)
        <span class="label label-info"> {{ $role->display_name }}</span>
        @endforeach
    </p>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('usuario.created_at') }}</strong>
        <!-- <p>{{ $usuario->created_at }}</p> -->
        </p>
        <?php \Carbon\Carbon::setLocale('hr');?>
        {{ Lang::setLocale('pt-br') }}  
        {{ date('l j F Y H:i:s', strtotime($usuario->created_at)) }}  
        {{Date::now()->format('l j F Y H:i:s')}}
        </p>
    </div>
    <div class="col-md-6">
      <strong><i class="fa fa-file-text-o margin-r-5"></i> {{ trans('usuario.updated_at') }}</strong>
      </p>{{ date('l j F Y H:i:s', strtotime($usuario->updated_at)) }}  </p>
  </div>
</div>
</div>
</div>
</div>
