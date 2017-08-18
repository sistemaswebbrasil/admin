@extends('adminlte::page')
@section('title', trans('geral.graficos')  )
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    {{ trans('geral.errosapp') }}
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" type="button">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button class="btn btn-box-tool" data-widget="remove" type="button">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="bar_erroapp">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">
                    {{ trans('geral.erroscli') }}
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" type="button">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button class="btn btn-box-tool" data-widget="remove" type="button">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="pie_errocli">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    {{ trans('geral.errosapp') }}
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" type="button">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button class="btn btn-box-tool" data-widget="remove" type="button">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="bar_erroapp">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">
                    {{ trans('geral.erroscli') }}
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" type="button">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button class="btn btn-box-tool" data-widget="remove" type="button">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <canvas id="pie_errocli">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js">
</script>
<script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js">
</script>
<script src="https://codepen.io/anon/pen/aWapBE.js">
</script>
<script>
    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };


        var color = Chart.helpers.color;

        var errosapp = {
            type: 'bar',
            data: {
                datasets: [{
                    label: '{!! trans('geral.erros') !!}',
                    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.red,
                    borderWidth: 1,
                    data: {!! $errosapp !!}
                }, {
                    label: '{!! trans('geral.erroslidos') !!}',
                    backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.blue,
                    borderWidth: 1,
                    data: {!! $errosapplido !!}
                }],
                labels: {!! $errosappsis !!}// ["Red","Orange","Yellow","Green","Blue"]
            },
            options: {
                responsive: true
            }
        };

        var errosclientes = {
            type: 'pie',
            data: {
                datasets: [{
                    data: {!! $logerros !!},
                    backgroundColor: palette(['tol-rainbow','sequential-cbf'], {!! $logerros !!}.length ).map(function(hex) {
                        return '#' + hex;
                    }),
                    label: 'Dataset 1'
                }],
                labels: {!! $clientes !!}// ["Red","Orange","Yellow","Green","Blue"]
            },
            options: {
                responsive: true
            }
        };

        window.onload = function() {
            console.log({!! $errosapplido !!});
            console.log({!! $errosapp !!});


            var ctxapp = document.getElementById("bar_erroapp").getContext("2d");
            window.myBar = new Chart(ctxapp, errosapp);

            var ctxcli = document.getElementById("pie_errocli").getContext("2d");
            window.myPie = new Chart(ctxcli, errosclientes);
        };
</script>
@stop
@endsection
