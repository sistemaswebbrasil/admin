@extends('adminlte::page')
@section('title', trans('geral.menuacesso')  )
@section('content_header')

@stop
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ trans('geral.novafuncao') }}</h3>
    </div>
    {!! Form::model($menuacesso, ['method' => 'PATCH','route' => ['menuacesso.update', $menuacesso->id]]) !!}
    @include('menuacesso.partials.form')
</div>
{!! Form::close() !!}
@endsection
