@extends('adminlte::page')
@section('title',  trans('geral.listarmenuacesso') )
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


<div class="alert alert-danger alert-dismissible hidden" >
    <button type="button" class="close"  aria-hidden="true">×</button>
    <!-- data-dismiss="alert" -->
    <h4><i class="icon fa fa-ban"></i> {{ trans('geral.falha') }} </h4>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
</div>

<div class="alert alert-success alert-dismissible hidden">
    <button aria-hidden="true" class="close" type="button">
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





<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('geral.listarmenuacesso') }}
        </h3>
    </div>
    <div class="box-header">
        <a class="btn btn-success pull-right" href="{{ route('menuacesso.create') }}">
            <i class="fa fa-plus">
                {{ trans('geral.novo') }}
            </i>
        </a>
    </div>
    <div class="box-body">
        <table cellspacing="0" class="table table-bordered table-striped" id="tabela"  width="100%">
            <thead>
                <tr>
                    <th>
                        {{ trans('geral.id') }}
                    </th>
                    <th>
                        {{ trans('geral.titulo') }}
                    </th>
                    <th>
                        {{ trans('geral.url') }}
                    </th>
                    <th>
                        {{ trans('geral.created_at') }}
                    </th>
                    <th>
                        {{ trans('geral.updated_at') }}
                    </th>
                    <th style="min-width:130px">
                        {{ trans('geral.acao') }}
                    </th>
                </tr>
            </thead>
        </table>
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
                            {{ trans('geral.mostrardetalhes') }}
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form action="/item-ajax/14" data-toggle="validator" method="put">
                            <div class="form-group">
                                <label class="control-label" for="title">
                                    Title:
                                </label>
                                <input class="form-control" data-error="Please enter title." name="title" required="" type="text"/>
                                <div class="help-block with-errors">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="title">
                                    Description:
                                </label>
                                <textarea class="form-control" data-error="Please enter description." name="description" required="">
                                </textarea>
                                <div class="help-block with-errors">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success crud-submit-edit" type="submit">
                                    Submit
                                </button>
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
            $(document).ready(function() {
                var token = $(this).data("token");

                var table = $('#tabela').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    ajax: '{!! route("menuacesso.ajax" ) !!}',
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'text', name: 'text' },
                        { data: 'url', name: 'url' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'updated_at', name: 'updated_at' },

                        {
                            data: null,
                            "targets": -1,
                            className: "center",
                            "bSortable": false,


                            "render": function (data, type, full, meta) {
                                var mostrar = '<a data-target="#modal-default" data-toggle="modal" id="mostrar" data-id="'+data.id+'" class="btn btn-info" href="#" title="{{ trans("geral.mostrardetalhes") }}"><i class="fa fa-eye"></i></a> ';
                                var editar = '<a id="editar" class="btn btn-primary" href="menuacesso/'+data.id+'/edit" title="{!! trans("geral.editar") !!}"><i class="fa fa-edit"></i></a> ';
                                var excluir = '<a id="excluir" data-id="'+data.id+'" class="btn btn-danger" href="#" title="{!! trans("geral.excluir") !!}"><i class="fa fa-close"></i></a> ';
                                return mostrar+editar+excluir;
                            }
                        }

                    ]
                } );

                $('#modal-default').on("show.bs.modal", function (e) {
                    var id = $(e.relatedTarget).data('id');
                    $.get('/menuacesso/' + id, function( data ) {
                    console.log(data);
                      $(".modal-body").html(data);
                    });
                } );

                $('#tabela').on( 'click', '#excluir', function () {
                    var id = $(this).attr('data-id');
                     if ( confirm( "{{ trans('geral.desejaexcluir') }}" ) ) {
                         $.ajax({
                             url: '/menuacesso/'+ id,
                             data: {
                                "id": id,
                                "_method": 'DELETE',
                                "_token": "{{ csrf_token() }}"
                             },
                             type: 'POST',
                             success: function(result) {
                                   $(".alert-danger").addClass('hidden');
                                   $(".alert-danger").removeClass('hidden');
                                   $(".alert-danger #msgerro").remove();
                                   $(".alert-danger ul").after('<ul id="msgerro"><li>{{ trans("geral.erroaoexcluir") }}</li></ul>');

                             },
                             error: function(result) {
                                   $(".alert-success").removeClass('hidden');

                                   $(".alert-success #msgsucesso").remove();
                                   $(".alert-success ul").after('<ul id="msgsucesso"><li>{{ trans("geral.excluido") }}</li></ul>');
                             }
                         });
                     }

                } );

                $('.alert .close').on('click', function(e) {
                    // alert('Fecha');
                    // $(this).parent().addClass('hidden');
                    e.preventDefault();

                    $(".alert-danger").addClass('hidden');
                });

                // Delete a record
                // $('#tabela').on('click', 'a#mostrar', function (e) {
                // $('#tabela').on('click', 'a#excluirs', function (e) {
                //     // e.preventDefault();

                //     var id = $(e.relatedTarget).data('id');
                //     alert(id);

                //     if ( confirm( "{{ trans('geral.desejaexcluir') }}" ) ) {
                //         $.ajax({
                //             url: '/menuacesso/' + id,
                //             type: 'DELETE',
                //             success: function(result) {
                //                 // Do something with the result
                //                 alert('ok');
                //             },
                //             error: function(result) {
                //                 // alert(result);
                //                 console.log(result);
                //             }
                //         });
                //     }

                // } );










                    } );
        </script>
        @stop
    </div>
</div>
@endsection
