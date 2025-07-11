@extends('template/layout')

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3><sup style="font-size: 20px">Rp.</sup><span id="totalPembelian">0</span>
                                                </h3>

                                                <p>Pembelian Hari Ini</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-bag"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3><sup style="font-size: 20px">Rp.</sup><span id="totalPenjualan">0</span>
                                                </h3>

                                                <p>Penjualan Hari Ini</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3><sup style="font-size: 20px">Rp.</sup><span
                                                        id="totalUtang">0</span></h3>

                                                <p>Utang Hari Ini</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-card"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-6">
                                        <!-- small box -->
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3><sup style="font-size: 20px">Rp.</sup><span
                                                        id="totalpiutang">0</span></h3>

                                                <p>Piutang Hari Ini</p>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-pie-graph"></i>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header border-0">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="card-title">PEMBELIAN DAN PENJUALAN TAHUN {{ date('Y') }}</h3>
                                                </div>
                                            </div>
                                            <div class="card-body shadow">
                                                <div class="d-flex">
                                                    <p class="d-flex flex-column text-danger">
                                                        <span class="text-bold text-lg"><span id="totalSemuaPembelian">Rp.
                                                                0</span></span>
                                                        <span>Total Pembelian</span>
                                                    </p>

                                                    <p class="d-flex flex-column text-primary ml-5">
                                                        <span class="text-bold text-lg"><span id="totalSemuaPenjualan">Rp.
                                                                0</span></span>
                                                        <span>Total Penjualan</span>
                                                    </p>
                                                </div>
                                                <!-- /.d-flex -->

                                                <div class="position-relative mb-4">
                                                    <canvas id="grafik-penjualan" height="200"></canvas>
                                                </div>

                                                <div class="d-flex flex-row justify-content-end">
                                                    <span class="mr-2">
                                                        <i class="fas fa-square text-danger"></i> Pembelian
                                                        <i class="fas fa-square text-primary"></i> Penjualan
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('') }}assets/AdminLTE32/plugins/chart.js/Chart.min.js"></script>

    <script>
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }
        var mode = 'index'
        var intersect = true

        var $visitorsChart = $('#grafik-penjualan')



        $(document).ready(function() {

            $.ajax({
                    url: "{{ url('home/getInfoBox') }}",
                    type: 'GET',
                    dataType: 'json',
                })
                .done(function(response) {
                    console.log(response);
                    $('#totalPembelian').html(numberWithCommas(response.totalPembelian));
                    $('#totalPenjualan').html(numberWithCommas(response.totalPenjualan));
                    $('#totalUtang').html(numberWithCommas(response.totalUtang));
                    $('#totalPiutang').html(numberWithCommas(response.totalPiutang));
                })
                .fail(function() {
                    console.log('error getInfoBox');
                });


            $.ajax({
                    url: "{{ url('home/getInfoGrafikPenjualan') }}",
                    type: 'GET',
                    dataType: 'json',
                })
                .done(function(responGrafik) {
                    console.log(responGrafik);
                    $('#totalSemuaPembelian').html('Rp. ' + format_rupiah(responGrafik.totalSemuaPembelian));
                    $('#totalSemuaPenjualan').html('Rp. ' + format_rupiah(responGrafik.totalSemuaPenjualan));

                    var visitorsChart = new Chart($visitorsChart, {
                        data: {
                            labels: responGrafik.arrDeskripsi,
                            datasets: [{
                                type: 'line',
                                data: responGrafik.arrTotalPenjualan,
                                backgroundColor: 'transparent',
                                borderColor: '#007bff',
                                pointBorderColor: '#007bff',
                                pointBackgroundColor: '#007bff',
                                fill: false
                                // pointHoverBackgroundColor: '#007bff',
                                // pointHoverBorderColor    : '#007bff'
                            }, 
                            {
                                type: 'line',
                                data: responGrafik.arrTotalPembelian,
                                backgroundColor: 'tansparent',
                                borderColor: 'rgb(216, 2, 2)',
                                pointBorderColor: 'rgb(216, 2, 2)',
                                pointBackgroundColor: 'rgb(216, 2, 2)',
                                fill: false
                                // pointHoverBackgroundColor: 'rgb(216, 2, 2)',
                                // pointHoverBorderColor    : 'rgb(216, 2, 2)'
                            }
                        ]
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                mode: mode,
                                intersect: intersect
                            },
                            hover: {
                                mode: mode,
                                intersect: intersect
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    // display: false,
                                    gridLines: {
                                        display: true,
                                        lineWidth: '4px',
                                        color: 'rgba(0, 0, 0, .2)',
                                        zeroLineColor: 'transparent'
                                    },
                                    ticks: $.extend({
                                        beginAtZero: true,
                                        suggestedMax: 200
                                    }, ticksStyle)
                                }],
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: ticksStyle
                                }]
                            }
                        }
                    })

                })
                .fail(function() {
                    console.log('error');
                });
        

        });
    </script>
@endsection
