@extends('adminlte::page')

@section('title',  trans('geral.listarerrosclientes') )

@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        @section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
        $( document ).tooltip();
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

                                return mostrar;
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


                        var table =$('#tabeladetanlhe').DataTable({
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
                                { data: 'sistema' },

            { data: 'erro', render: function (data, type, row) {

// erros = explode(chr(13),{erro});
var erros = data.split(String.fromCharCode(13));

if (erros[6]){
    erros = erros[6].replace('   Descricao do Erro: ','');




return '<a href="#" title="'+data+'">'+cutString(erros)+'</a>';





    // return cutString(erros);//erros;
}else{
    return 'Erro';
}





            } },



// { data: 'erro' },

                            ],
                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
                            },
                          });



    $('#tabeladetanlhe tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );






                    // $.get('/logerro/' + cl_codigo, function( data ) {
                    // // console.log(data);
                    //   $(".modal-body").html(data);
                    // });
                } );


                $('#modal-default').on('hidden.bs.modal', function () {
                    $('#tabeladetanlhe').dataTable().fnDestroy();
                });



                $('.alert .close').on('click', function(e) {
                    e.preventDefault();
                    $(".alert #msg").remove();

                    $(".alert").addClass('hidden');
                });


                    } );



/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Erro:</td>'+
            '<td>d.erro</td>'+
        '</tr>'+
    '</table>';
}


        function cutString(text){
            var wordsToCut = 8;
            var wordsArray = text.split(" ");
            if(wordsArray.length>wordsToCut){
                var strShort = "";
                for(i = 0; i < wordsToCut; i++){
                    strShort += wordsArray[i] + " ";
                }
                return strShort+"...";
            }else{
                return text;
            }
         };


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

    </div>
    <div class="box-body">
        <div id="resize_wrapper">
            <table cellspacing="0" class="display" id="tabela" width="100%">
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
                        <th >
                            {{ trans('geral.acao') }}
                        </th>
                    </tr>
                </thead>
            </table>
            <!-- <div id="resize_handle">Drag to resize</div> -->
        </div>
        <div class="modal fade modal-default " id="modal-default" style="display: none;' ">
            <div class="modal-dialog modal-lg" style="width: 960; ">
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
                                                    {{ trans('geral.sistema') }}
                                                </th>                                                <th>
                                                    {{ trans('geral.sistema') }}
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
