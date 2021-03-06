@extends('adminlte::page')

@section('title',  trans('geral.listarpermissao') )

@section('content')
        @section('js')
        <script type="text/javascript">

        function gerarPermissoes(){
            // $(".box-info").addClass('hidden');
            // $("#modal-gerar .box-info").removeClass('hidden');
             $.ajax({

                 url: '{!! route("permission.gerar.ajax" ) !!}',
                 data: {
                    "_token": "{{ csrf_token() }}"
                 },
                 type: 'GET',
                 success: function(result) {
                    $("#modal-gerar .box-success").removeClass('hidden');
                    $(".box-success p").after('<p id="msg" >'+result.status+'</p>');

                    $("#msg").remove();

                $("#modal-gerar .modal-body .box-info").after(
                    '<div id="msg" class="alert alert-success "><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon glyphicon glyphicon-ok"></i>{{ trans("geral.sucesso") }}</h4>'+result.status+'</div>'
                    );


                 // $(".box-success").addClass('hidden');
                       // $(".box-success").removeClass('hidden');
                       // $(".box-success #msg").remove();
                       // $(".box-success").css('display','none');
                       // $(".box-success p").after('<p id="msg" >'+result.status+'</p>');
                 },
                 error: function(result) {
                       // $(".alert-danger").addClass('hidden');
                       // $(".alert-danger").removeClass('hidden');
                       // $(".alert-danger #msg").remove();
                       // $(".alert-danger ul").after('<ul id="msg"><li>{{ trans("geral.errogerar") }}</li></ul>');

                 $("#msgerro").remove();


            // $("#modal-gerar .box-info").addClass('hidden');

                $("#modal-gerar .modal-body .box-info").after(
                    '<div id="msgerro" class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i>{{ trans("geral.erro") }}</h4>{{ trans("geral.erroinserir") }}</div>'
                    );

              }
          });
        }


                // $('.box .close').on('click', function(e) {
                //     e.preventDefault();
                //     $(".msgs #msg").remove();

                //     $(".alert").addClass('hidden');
                // });




            $(document).ready(function() {
                var token = $(this).data("token");

                var tabela = $('#tabela').DataTable( {
                    pageResize: true,
                    "processing": true,
                    serverSide : true,
                    "sSearch": "Pesquisar",

                    "language": {
                        // "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
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
                    // "deferLoading": 0, // here

                    ajax: '{!! route("permission.ajax" ) !!}',

                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'display_name', name: 'display_name' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'updated_at', name: 'updated_at' },
                        {
                            data: null,
                            "targets": -1,
                            className: "center",
                            "bSortable": false,
                            "bSearchable": false,

                            "render": function (data, type, full, meta) {
                                var mostrar = '<a data-target="#modal-default" data-toggle="modal" id="mostrar" data-id="'+data.id+'" class="btn btn-info" href="#modal-default" title="{{ trans("geral.mostrardetalhes") }}"><i class="fa fa-eye"></i></a> ';






                                var editar = '<a id="editar" class="btn btn-primary" href="permission/'+data.id+'/edit" title="{!! trans("geral.editar") !!}"><i class="fa fa-edit"></i></a> ';
                                var excluir = '<a id="excluir" data-id="'+data.id+'" class="btn btn-danger" href="#" title="{!! trans("geral.excluir") !!}"><i class="fa fa-close"></i></a> ';
                                return mostrar+editar+excluir;
                            }
                        }
                    ]
                } );

                var altura = document.documentElement.clientHeight - $("#tabela").offset().top - 55 ;
                console.log(altura);
                $(document).on( 'init.dt', function ( e, settings ) {
                    $('#resize_wrapper').css('height', altura );
                });
                new $.fn.dataTable.PageResize( tabela );

                $('#modal-default').on("show.bs.modal", function (e) {
                    var id = $(e.relatedTarget).data('id');
                    $.get('/permission/' + id, function( data ) {

                      $("#modal-default .modal-body").html(data);
                    });
                } );

                $('#modal-gerar').on("show.bs.modal", function (e) {
                    $("#modal-gerar .box-info").addClass('hidden');
                    $("#modal-gerar .box-info").removeClass('hidden');
                } );

                $('#tabela tbody').on( 'click', 'a#excluir', function () {
                    var id = $(this).attr('data-id');
                    var row = $(this).closest('tr');

                     if ( confirm( "{{ trans('geral.desejaexcluir') }}" ) ) {
                         $.ajax({

                             url: '/permission/'+ id,
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

                $('.box .close').on('click', function(e) {
                    e.preventDefault();
                    $(".msgs #msg").remove();

                    $(".alert").addClass('hidden');
                });

                    } );
        </script>
        @stop


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
            {{ trans('geral.listarpermissao') }}
        </h3>
    </div>
    <div class="box-header">
        <a class="btn btn-success pull-right" href="{{ route('permission.create') }}">
            <i class="fa fa-plus">
                {{ trans('geral.novo') }}
            </i>
        </a>

        <a class="btn btn-info pull-right" id='modal-gerars' data-toggle="modal"  href="#modal-gerar">
            <i class="fa fa-plus">
                {{ trans('geral.gerarpermissoespendentes') }}
            </i>
        </a>
    </div>


    <div class="box-body">
    <div id="resize_wrapper">
        <table cellspacing="0" class="pageResize table table-bordered table-striped " id="tabela" width="100%">
            <thead>
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
        <!-- <div id="resize_handle">Drag to resize</div> -->
    </div>
        <div class="modal fade modal-default " id="modal-default" role="dialog" tabindex="-1" style="display: none;">
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

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default pull-right" data-dismiss="modal" type="button">
                            {{ trans('geral.sair') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-gerar " id="modal-gerar" role="dialog" tabindex="-2" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">
                                ×
                            </span>
                        </button>
                        <h4 class="modal-title">
                            {{ trans('geral.gerarpermissoespendentes') }}
                        </h4>
                    </div>
                    <div class="modal-body">
                    <p></p>






              <div class="alert box box-info ">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-info"></i> {{ trans('geral.nota') }}</h3>


                </div>
                <div class="box-body">
                    <p>{{ trans('geral.gerarpermissoespendentesinfo') }}</p>

                </div>
              </div>

<!--                       <div class="alert box box-success hidden msgs">
                        <div class="box-header with-border">
                          <h3 class="box-title"><i class="fa fa-info"></i> {{ trans('geral.sucesso') }}</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool close"  ><i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                            <p></p>

                        </div>
                      </div> -->


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default pull-right" data-dismiss="modal" type="button">
                            {{ trans('geral.sair') }}
                        </button>

                        <button class="btn btn-info pull-right" href="#" onclick="gerarPermissoes();" type="button">
                            {{ trans('geral.confirmar') }}
                        </button>
                    </div>


                </div>
            </div>
        </div>
    </div>


















</div>
@endsection
