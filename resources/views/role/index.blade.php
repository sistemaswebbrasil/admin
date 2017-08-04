@extends('adminlte::page')

@section('title',  trans('geral.listarfuncao') )

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
            {{ trans('geral.listarfuncao') }}
        </h3>
    </div>
    <div class="box-header">
        <a class="btn btn-success pull-right" href="{{ route('role.create') }}">
            <i class="fa fa-plus">
                {{ trans('geral.novo') }}
            </i>
        </a>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>
                    {{ trans('geral.id') }}
                </th>
                <th>
                    {{ trans('geral.name') }}
                </th>
                <th>
                    {{ trans('geral.display_name') }}
                </th>
                <th>
                    {{ trans('geral.description') }}
                </th>
                <th>
                    {{ trans('geral.created_at') }}
                </th>
                <th>
                    {{ trans('geral.updated_at') }}
                </th>
                <th>
                    {{ trans('geral.acao') }}
                </th>
            </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>
                    {{ $role->id }}
                </td>
                <td>
                    {{ $role->name }}
                </td>
                <td>
                    {{ $role->display_name }}
                </td>
                <td>
                    {{ $role->description }}
                </td>
                <td>
                    @if (!empty($role->created_at))
                    {{ $role->created_at->formatLocalized('%d %B %Y') }}
                    @endif
                </td>
                <td>
                    @if (!empty($role->updated_at))
                    {{ $role->updated_at->diffForHumans()  }}
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" data-target="#modal-default" data-toggle="modal" href="#" title="{{ trans('geral.mostrardetalhes') }}" data-id="{{ $role->id }}" >
                        <i class="fa fa-eye">
                        </i>
                    </a>
                    <a "="" class="btn btn-primary" href="{{ route('role.edit',$role->id) }}" title="{{ trans('geral.editar') }}">
                        <i class="fa fa-edit">
                        </i>
                    </a>
                    {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role->id],'style'=>'display:inline']) !!}
                    <button class="btn btn-danger" title="{{ trans('geral.excluir') }}">
                        <i class="fa fa-close">
                        </i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    {!! $roles->render() !!}
</div>
<div class="modal fade modal-default" id="modal-default" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title">
                    {{ trans('geral.mostrardetalhes',[ 'name' => $role->name ]) }}
                </h4>
            </div>
            <div class="modal-body">
                <!-- @include('role.show',['role','$role->id']) -->

                    <form data-toggle="validator" action="/item-ajax/14" method="put">
                        <div class="form-group">
                            <label class="control-label" for="title">Title:</label>
                            <input type="text" name="title" class="form-control" data-error="Please enter title." required />
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="title">Description:</label>
                            <textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
                        </div>
                    </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-right" data-dismiss="modal" type="button">
                    {{ trans('geral.sair') }}
                </button>
            </div>
        </div>
    </div>
</div>

@section('js')
<script type="text/javascript">
$(function() {
    $('#modal-default').on("show.bs.modal", function (e) {
        var id = $(e.relatedTarget).data('id');
        $.get('/role/' + id, function( data ) {
        console.log(data);
          $(".modal-body").html(data);
        });
    });
});
</script>
@stop



@endsection
