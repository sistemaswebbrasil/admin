@extends('adminlte::master')

@section('title', 'Página não encontrada'  )

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>


        <div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i>Página não encontrada , verifique o endereço digitado !</h4>
            {{ $exception->getMessage() }}
        </div>
        </div>
    </div>
@stop
