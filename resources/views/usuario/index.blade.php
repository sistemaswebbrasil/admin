@extends('adminlte::page')

@section('title',  trans('usuario.listar') )

@section('content_header')
<!-- <h1>{{ trans('usuario.listar') }}</h1> -->

<!-- @role('admin') -->
<!-- <div class="pull-right">
    <a class="btn btn-success" href="{{ route('usuario.create') }}"> {{ trans('geral.novo') }}</a>
</div> -->
<!-- @endrole -->

@stop

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-ban"></i> {{ trans('geral.sucesso') }} </h4>
        <p>{{ $message }}</p>
</div>
@endif

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('usuario.listar') }}</h3>




<!-- <a class="btn btn-success pull-right" href="{{ route('usuario.create') }}"><i class="fa fa-plus"> {{ trans('geral.novo') }}</i></a> -->


  </div>

<div class="box-header">
    <a class="btn btn-success pull-right" href="{{ route('usuario.create') }}"><i class="fa fa-plus"> {{ trans('geral.novo') }}</i></a>
</div>

  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-striped">
        <tr>
            <th>{{ trans('usuario.id') }}</th>
            <th>{{ trans('usuario.name') }}</th>
            <th>{{ trans('usuario.email') }}</th>
            <th>{{ trans('geral.acao') }}</th>
        </tr>
    @foreach ($usuarios as $key => $usuario)
    <tr>
        <td>{{ $usuario->id }}</td>
        <td>{{ $usuario->name }}</td>
        <td>{{ $usuario->email }}</td>
        <td>
            <a data-toggle="modal" data-target="#modal-default" class="btn btn-info" href="#" title={{ trans('geral.mostrar') }}><i class="fa fa-eye"></i></a>

            <!-- <a data-toggle="modal" data-target="#modal-default" class="btn btn-info" href="{{ route('usuario.show',$usuario->id) }}" title={{ trans('geral.mostrar') }}><i class="fa fa-eye"></i></a> -->            

            
            <a class="btn btn-primary" href="{{ route('usuario.edit',$usuario->id) }}" title={{ trans('geral.editar') }}><i class="fa fa-edit"></i></a>
            {!! Form::open(['method' => 'DELETE','route' => ['usuario.destroy', $usuario->id],'style'=>'display:inline']) !!}
            
            <button class="btn btn-danger" title={{ trans('geral.excluir') }}><i class="fa fa-close"></i></button>
            {!! Form::close() !!}
            
        </td>
    </tr>
    @endforeach
    </table>
    {!! $usuarios->render() !!}
</div>
<!-- /.box-body -->
<!-- <div class="box-footer clearfix">
  <ul class="pagination pagination-sm no-margin pull-right">
    <li><a href="#">«</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">»</a></li>
</ul>
</div> -->
</div>

<div class="modal fade" id="modal-default" style="display: none;">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{{ trans('usuario.mostrar',[ 'name' => $usuario->name ]) }}</h4>
              </div>
              <div class="modal-body">                
                @include('usuario.show')
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

@endsection          






