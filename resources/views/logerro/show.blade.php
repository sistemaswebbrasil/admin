@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('adminlte_js')
<script type="text/javascript">
"use strict";

    $(document).ready(function() {
        var token = $(this).data("token");


        $('#tabeladetanlhe').dataTable( {
            "processing": true,
            serverSide : true,
            "sSearch": "Pesquisar",
            "order": [[ 2, "asc" ]],
            "bDestroy": false,
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
            "pageLength": '5',

            ajax: {
                url: '/api/logerrodetalhe/'+ "{{ $id }}",
            },
            columns: [
                { data: 'ip' },
                { data: 'usuario' },
                { data: 'estacao' },
                { data: 'data' },
                { data: 'hora' },
                { data: 'sistema' },
                { data: 'lido' }
            ]
        } );



            } );
</script>
@yield('js')
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
