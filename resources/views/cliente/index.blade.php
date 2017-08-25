@extends('adminlte::page')

@section('title',  trans('geral.listarcliente') )

@section('content')
        @section('js')
        <script type="text/javascript">


function cpfCnpj(v){

    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")

    if (v.length <= 14) { //CPF 102.251.347-80

        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")

        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

    } else { //CNPJ

        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")

        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")

        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")

        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
    }
    return v
}


function telefone(v){
    v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
    if (v.length == 9) {
        v=v.replace(/(\d{1})(\d)/,"$1 $2") //Coloca parênteses em volta dos dois primeiros dígitos
    }else
    if (v.length == 11) {
        v=v.replace(/(\d{3})(\d)/,"$1 $2") //Coloca parênteses em volta dos dois primeiros dígitos
    }
    if (v.length > 9) {
        v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    }
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}




            $(document).ready(function() {
                var token = $(this).data("token");

                var tabela = $('#tabela').DataTable( {
                    pageResize: true,
                    "processing": true,
                    serverSide : true,
                    "sSearch": "Pesquisar",
                    "order": [[ 0, "asc" ]],

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

                    ajax: '{!! route("cliente.ajax" ) !!}',


// $clientes = Cliente::select(['cl_codigo', 'cl_nome', 'cl_conjuge', 'cl_cpf', 'cl_cidade', 'cl_fone', 'st_codigo']);

                    columns: [
                        { data: 'cl_nome', name: 'cl_nome' },
                        { data: 'cl_codigo', name: 'cl_codigo',className: "dt-right" },
                        {
                            data: 'cl_cpf',
                            name: 'cl_cpf',
                            render: function ( data, type, row ) {
                                return cpfCnpj(data);
                            }
                            ,className: "dt-right"
                        },
                        { data: 'cl_cidade', name: 'cl_cidade' },
                        {
                            data: 'cl_fone',
                            name: 'cl_fone',
                            render: function ( data, type, row ) {
                                return telefone(data) ;//telefone(data);
                            }
                            ,className: "dt-right"

                        },
                        { data: 'st_nome', name: 'st_nome' },
                        {
                            data: null,
                            "targets": -1,
                            className: "center",
                            "bSortable": false,
                            "bSearchable": false,

                            "render": function (data, type, full, meta) {
                                var mostrar = '<a data-target="#modal-default" data-toggle="modal" id="mostrar" data-id="'+data.cl_codigo+'" class="btn btn-info" href="#modal-default" title="{{ trans("geral.mostrardetalhes") }}"><i class="fa fa-eye"></i></a> ';

                                var editar = '<a id="editar" class="btn btn-primary" href="cliente/'+data.cl_codigo+'/edit" title="{!! trans("geral.editar") !!}"><i class="fa fa-edit"></i></a> ';
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
                    $.get('/cliente/' + id, function( data ) {

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

                             url: '/cliente/'+ id,
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
            {{ trans('geral.listarcliente') }}
        </h3>
    </div>
    <div class="box-header">
        <a class="btn btn-success pull-right" href="{{ route('permission.create') }}">
            <i class="fa fa-plus">
                {{ trans('geral.novo') }}
            </i>
        </a>
    </div>




    <div class="box-body">
    <div id="resize_wrapper">
        <table cellspacing="0" class="pageResize table table-bordered table-striped " id="tabela" width="100%">
            <thead>
                <tr>
                    <th>
                        {{ trans('geral.name') }}
                    </th>
                    <th>
                        {{ trans('geral.codigo') }}
                    </th>
                    <th>
                        {{ trans('geral.cpf') }}
                    </th>
                    <th>
                        {{ trans('geral.cidade') }}
                    </th>
                    <th>
                        {{ trans('geral.telefone') }}
                    </th>
                    <th>
                        {{ trans('geral.st') }}
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
    </div>
</div>
@endsection
