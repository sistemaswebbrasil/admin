@extends('adminlte::page')

@section('title',  trans('geral.listarerrosclientes') )

@section('content')
        @section('js')
<script type="text/javascript">
    $(document).ready(function() {
                var token = $(this).data("token");

                var tabela = $('#tabela').DataTable( {
                    pageResize: true,
                    "processing": true,
                    serverSide : true,
                    "sSearch": "Pesquisar",
                    "order": [[ 3, "desc" ]],

                    "language": {
                            "sEmptyTable": "{{ trans('geral.sEmptyTable') }}",
                            "sInfo": "{{ trans('geral.sInfo') }}",
                            "sInfoEmpty": "{{ trans('geral.sInfoEmpty') }}",
                            "sInfoFiltered": "{{ trans('geral.sInfoFiltered') }}",
                            "sInfoPostFix": "{{ trans('geral.sInfoPostFix') }}",
                            "sInfoThousands": "{{ trans('geral.sInfoThousands') }}",
                            "sLengthMenu": "{{ trans('geral.sLengthMenu') }}",
                            "sLoadingRecords": "{{ trans('geral.sLoadingRecords') }}",
                            "sProcessing": "{{ trans('geral.sProcessing') }}",
                            "sZeroRecords": "{{ trans('geral.sZeroRecords') }}",
                            "sSearch": "{{ trans('geral.sSearch') }}",
                            "oPaginate": {
                                "sNext": "{{ trans('geral.oPaginate.sNext') }}",
                                "sPrevious": "{{ trans('geral.oPaginate.sPrevious') }}",
                                "sFirst": "{{ trans('geral.oPaginate.sFirst') }}",
                                "sLast": "{{ trans('geral.oPaginate.sLast') }}",
                            },
                            "oAria": {
                                "sSortAscending": "{{ trans('geral.oAria.sSortAscending') }}",
                                "sSortDescending": "{{ trans('geral.oAria.sSortDescending') }}",
                            }

                    },
                    "pageLength": '1',
                    ajax: '{!! route("logerro.ajax" ) !!}',

                    columns: [
                        { data: 'cl_codigo', name: 'cl_codigo' },
                        { data: 'cl_nome', name: 'cl_nome' },
                        { data: 'total', name: 'total' },
                        { data: 'total_lidos', name: 'total_lidos' },

                        {
                            data: null,
                            "targets": -1,
                            className: "center",
                            "bSortable": false,
                            "bSearchable": false,

                            "render": function (data, type, full, meta) {
                                var mostrar = '<a data-target="#modal-default" data-toggle="modal" id="mostrar" data-id="'+data.cl_codigo+'" class="btn btn-info" href="#" title="{{ trans("geral.mostrardetalhes") }}"><i class="fa fa-eye"></i></a> ';
                                var excluir = '<a id="excluir" data-id="'+data.id+'" class="btn btn-danger" href="#" title="{!! trans("geral.excluir") !!}"><i class="fa fa-close"></i></a> ';
                                return mostrar+excluir;
                            }
                        }
                    ]
                } );

                var altura = document.documentElement.clientHeight - $("#tabela").offset().top - 55 ;
                // console.log(altura);
                $(document).on( 'init.dt', function ( e, settings ) {
                    $('#resize_wrapper').css('height', altura );
                });
                new $.fn.dataTable.PageResize( tabela );

                $('#modal-default').on("show.bs.modal", function (e) {
                    var cl_codigo = $(e.relatedTarget).data('id');


                        $('#tabeladetanlhe').DataTable({
                            deferRender: true,
                            responsive: true,
                            processing : true,
                             serverSide : true,
                            'bPaginate': true,
                            'bInfo': true,
                            "pageLength": '5',
                            ajax: '/api/logerrodetalhe/'+ cl_codigo ,

                            columns: [
                                { data: 'ip' },
                                { data: 'usuario' },
                                { data: 'estacao' },
                                { data: 'data' },
                                { data: 'hora' },
                                { data: 'sistema' },
                                { data: 'lido' }
                            ],
                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
                            },
                          });

                    // $.get('/logerro/' + cl_codigo, function( data ) {
                    // // console.log(data);
                    //   $(".modal-body").html(data);
                    // });
                } );


                $('#modal-default').on('hidden.bs.modal', function () {
                    $('#tabeladetanlhe').dataTable().fnDestroy();
                });

                $('#tabela tbody').on( 'click', 'a#excluir', function () {
                    var id = $(this).attr('data-id');
                    var row = $(this).closest('tr');

                     if ( confirm( "{{ trans('geral.desejaexcluir') }}" ) ) {
                         $.ajax({
                            // '{!! route("logerro.ajax" ) !!}',
                             url: '/logerro/'+ id,
                             data: {
                                "id": id,
                                "_method": 'DELETE',
                                "_token": "{{ csrf_token() }}"
                             },
                             type: 'POST',
                             success: function(result) {
                                // row.remove();
                                tabela.row( $(this).parents('tr') ).remove().draw(false);

                                   $(".alert-success").addClass('hidden');
                                   $(".alert-success").removeClass('hidden');
                                   $(".alert-success #msg").remove();
                                   $(".alert-success p").after('<p id="msg" >{{ trans("geral.excluido") }}</p>');
                             },
                             error: function(result) {
                                   $(".alert-danger").addClass('hidden');
                                   $(".alert-danger").removeClass('hidden');
                                   $(".alert-danger #msg").remove();
                                   $(".alert-danger ul").after('<ul id="msg"><li>{{ trans("geral.erroaoexcluir") }}</li></ul>');
                             }
                         });
                     }
                } );

                $('.alert .close').on('click', function(e) {
                    e.preventDefault();
                    $(".alert #msg").remove();

                    $(".alert").addClass('hidden');
                });


                    } );
</script>
@endsection


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
<div class="alert alert-danger alert-dismissible hidden">
    <button aria-hidden="true" class="close" type="button">
        ×
    </button>
    <!-- data-dismiss="alert" -->
    <h4>
        <i class="icon fa fa-ban">
        </i>
        {{ trans('geral.falha') }}
    </h4>
    <ul>
        @foreach ($errors->all() as $error)
        <li>
            {{ $error }}
        </li>
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
            {{ trans('geral.listarerrosclientes') }}
        </h3>
    </div>
    <div class="box-header">
        <a class="btn btn-info pull-right" href="{{ route('logerro.grafico') }}">
            <i class="fa fa-plus">
                {{ trans('geral.graficos') }}
            </i>
        </a>
    </div>
    <div class="box-body">
        <div id="resize_wrapper">
            <table cellspacing="0" class="pageResize table table-bordered table-striped table-responsive" id="tabela" width="100%">
                <thead>
                    <tr>
                        <th>
                            {{ trans('geral.cl_codigo') }}
                        </th>
                        <th>
                            {{ trans('geral.cl_nome') }}
                        </th>
                        <th>
                            {{ trans('geral.total') }}
                        </th>
                        <th>
                            {{ trans('geral.total_lidos') }}
                        </th>
                        <th style="min-width:130px">
                            {{ trans('geral.acao') }}
                        </th>
                    </tr>
                </thead>
            </table>
            <!-- <div id="resize_handle">Drag to resize</div> -->
        </div>
        <div class="modal fade modal-default " id="modal-default" style="display: none;width: '80%' ">
            <div class="modal-dialog modal-lg" style="width: '80%'; ">
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
                        <div class="box">
                            <div class="box-body">
                                <div id="resize_wrapper">
                                    <table cellspacing="0" class="table table-bordered table-striped table-responsive" id="tabeladetanlhe" width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    {{ trans('geral.ip') }}
                                                </th>
                                                <th>
                                                    {{ trans('geral.usuario') }}
                                                </th>
                                                <th>
                                                    {{ trans('geral.estacao') }}
                                                </th>
                                                <th>
                                                    {{ trans('geral.data') }}
                                                </th>
                                                <th>
                                                    {{ trans('geral.hora') }}
                                                </th>
                                                <th>
                                                    {{ trans('geral.sistema') }}
                                                </th>
                                                <th>
                                                    {{ trans('geral.lido') }}
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default pull-right" data-dismiss="modal" type="button">
                                {{ trans('geral.sair') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</div>
