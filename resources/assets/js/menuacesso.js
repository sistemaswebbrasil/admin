$(document).ready(function() {
    alert('OI!!!!');
    var token = $(this).data("token");
    var table = $('#tabela').DataTable({
        "processing": true,
        "serverSide": true,
        ajax: '{!! route("menuacesso.ajax" ) !!}',
        columns: [{
            data: 'id',
            name: 'id'
        }, {
            data: 'text',
            name: 'text'
        }, {
            data: 'url',
            name: 'url'
        }, {
            data: 'created_at',
            name: 'created_at'
        }, {
            data: 'updated_at',
            name: 'updated_at'
        }, {
            data: null,
            "targets": -1,
            className: "center",
            "bSortable": false,
            "render": function(data, type, full, meta) {
                var mostrar = '<a data-target="#modal-default" data-toggle="modal" id="mostrar" data-id="' + data.id + '" class="btn btn-info" href="#" title="{{ trans("geral.mostrardetalhes") }}"><i class="fa fa-eye"></i></a> ';
                var editar = '<a id="editar" class="btn btn-primary" href="menuacesso/' + data.id + '/edit" title="{!! trans("geral.editar") !!}"><i class="fa fa-edit"></i></a> ';
                var excluir = '<a id="excluir" data-id="' + data.id + '" class="btn btn-danger" href="#" title="{!! trans("geral.excluir") !!}"><i class="fa fa-close"></i></a> ';
                return mostrar + editar + excluir;
            }
        }]
    });
    $('#modal-default').on("show.bs.modal", function(e) {
        var id = $(e.relatedTarget).data('id');
        $.get('/menuacesso/' + id, function(data) {
            console.log(data);
            $(".modal-body").html(data);
        });
    });
    // $('#tabela tbody').on( 'click', 'tr', function () {
    $('#tabela tbody').on('click', 'a#excluir', function() {
        var id = $(this).attr('data-id');
        var row = $(this).closest('tr');
        if (confirm("{{ trans('geral.desejaexcluir') }}")) {
            $.ajax({
                url: '/menuacesso/' + id,
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": "{{ csrf_token() }}"
                },
                type: 'POST',
                success: function(result) {
                    console.log(row);
                    row.remove();
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
    });
    $('.alert .close').on('click', function(e) {
        // alert('Fecha');
        // $(this).parent().addClass('hidden');
        e.preventDefault();
        $(".alert #msg").remove();
        $(".alert").addClass('hidden');
    });
});