@extends('adminlte::page')
@section('title', trans('geral.graficos')  )
@section('content')




<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('geral.atendimentosabertos ') }}</span>
              <span class="info-box-number">{{ $atendimentostotal->total }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('geral.errosnaolidos ') }}</span>
              <span class="info-box-number">{{ $errostotal->total }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

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
                    {{ trans('geral.historico') }}
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
                    <canvas id="line_histerroatend">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">
                    {{ trans('geral.atendsol') }}
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
                    <canvas id="pie_atendimentos">
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

    window.randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
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

        var atendimentos = {
            type: 'pie',
            data: {
                datasets: [{
                    data: {!! $atendtotal !!},
                    backgroundColor: palette(['tol-rainbow','sequential-cbf'], {!! $atendtotal !!}.length ).map(function(hex) {
                        return '#' + hex;
                    }),
                    label: 'Dataset 1'
                }],
                labels: {!! $atendsolicitante !!}// ["Red","Orange","Yellow","Green","Blue"]
            },
            options: {
                responsive: true,
                     legend: {
                        display: false
                     },
            }
        };

        var histerroatend = {
            type: 'line',
            data: {
                labels: {!! $atendperiododata !!},
                datasets: [{
                    label: '{!! trans('geral.erros') !!}',
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: {!! $errosperiodototal !!},
                    fill: false,
                }, {
                    label: '{!! trans('geral.atendimentos') !!}',
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data:{!! $atendperiodototal !!},
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Chart.js Line Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true
                    }]
                }
            }
        };

        window.onload = function() {
            console.log({!! $errosapplido !!});
            console.log({!! $errosapp !!});


            var ctxapp = document.getElementById("bar_erroapp").getContext("2d");
            window.myBar = new Chart(ctxapp, errosapp);

            var ctxcli = document.getElementById("pie_errocli").getContext("2d");
            window.myPie = new Chart(ctxcli, errosclientes);

            var ctxcli = document.getElementById("pie_atendimentos").getContext("2d");
            window.myPie = new Chart(ctxcli, atendimentos);

            var ctxhist = document.getElementById("line_histerroatend").getContext("2d");
            window.myLine = new Chart(ctxhist, histerroatend);
        };
</script>
@stop
@endsection
