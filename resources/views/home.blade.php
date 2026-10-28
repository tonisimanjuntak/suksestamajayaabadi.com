@extends('template/layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header pb-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.6rem;">
                        <i class="fas fa-chart-line text-primary mr-2"></i>Dashboard Operasional
                    </h1>
                    <p class="text-muted mb-0 small">
                        Ringkasan performa bisnis & pergerakan transaksi per <span class="font-weight-bold">{{ date('d F Y') }}</span>
                    </p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <button class="btn btn-outline-primary btn-sm shadow-sm" id="btnRefreshDashboard" title="Muat Ulang Data">
                        <i class="fas fa-sync-alt mr-1"></i> Refresh Data
                    </button>
                    <a href="{{ url('penjualan/tambah') }}" class="btn btn-success btn-sm shadow-sm ml-1">
                        <i class="fas fa-plus mr-1"></i> Penjualan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">

            <!-- ROW 1: KPI CARDS -->
            <div class="row">
                <!-- Penjualan Hari Ini -->
                <div class="col-xl-3 col-md-6 col-12 mb-3">
                    <div class="small-box bg-gradient-success shadow-sm mb-0 h-100">
                        <div class="inner">
                            <span class="text-uppercase small font-weight-bold text-white-50">Penjualan Hari Ini</span>
                            <h3 class="font-weight-bold mt-1 mb-1">
                                <sup style="font-size: 16px">Rp</sup><span id="kpiPenjualan">0</span>
                            </h3>
                            <p class="mb-0 small text-white-50">
                                <span id="kpiPenjualanCount" class="badge badge-light text-success font-weight-bold">0</span> transaksi tercatat
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cash-register"></i>
                        </div>
                        <a href="{{ url('penjualan') }}" class="small-box-footer">
                            Lihat Penjualan <i class="fas fa-arrow-circle-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Pembelian Hari Ini -->
                <div class="col-xl-3 col-md-6 col-12 mb-3">
                    <div class="small-box bg-gradient-info shadow-sm mb-0 h-100">
                        <div class="inner">
                            <span class="text-uppercase small font-weight-bold text-white-50">Pembelian Hari Ini</span>
                            <h3 class="font-weight-bold mt-1 mb-1">
                                <sup style="font-size: 16px">Rp</sup><span id="kpiPembelian">0</span>
                            </h3>
                            <p class="mb-0 small text-white-50">
                                <span id="kpiPembelianCount" class="badge badge-light text-info font-weight-bold">0</span> faktur masuk
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                        <a href="{{ url('pembelian') }}" class="small-box-footer">
                            Lihat Pembelian <i class="fas fa-arrow-circle-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Piutang Dagang -->
                <div class="col-xl-3 col-md-6 col-12 mb-3">
                    <div class="small-box bg-gradient-warning shadow-sm mb-0 h-100 text-white">
                        <div class="inner">
                            <span class="text-uppercase small font-weight-bold text-white-50">Sisa Piutang Dagang</span>
                            <h3 class="font-weight-bold mt-1 mb-1 text-white">
                                <sup style="font-size: 16px">Rp</sup><span id="kpiPiutang">0</span>
                            </h3>
                            <p class="mb-0 small text-white-50">
                                <span id="kpiPiutangCount" class="badge badge-light text-warning font-weight-bold">0</span> invoice belum lunas
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <a href="{{ url('piutang') }}" class="small-box-footer text-white">
                            Kelola Piutang <i class="fas fa-arrow-circle-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Hutang Dagang -->
                <div class="col-xl-3 col-md-6 col-12 mb-3">
                    <div class="small-box bg-gradient-danger shadow-sm mb-0 h-100">
                        <div class="inner">
                            <span class="text-uppercase small font-weight-bold text-white-50">Sisa Hutang Supplier</span>
                            <h3 class="font-weight-bold mt-1 mb-1">
                                <sup style="font-size: 16px">Rp</sup><span id="kpiHutang">0</span>
                            </h3>
                            <p class="mb-0 small text-white-50">
                                <span id="kpiHutangCount" class="badge badge-light text-danger font-weight-bold">0</span> tagihan belum lunas
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <a href="{{ url('hutang') }}" class="small-box-footer">
                            Kelola Hutang <i class="fas fa-arrow-circle-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ROW 2: CHARTS -->
            <div class="row">
                <!-- Grafik Penjualan & Pembelian Tahunan -->
                <div class="col-lg-8 mb-4">
                    <div class="card card-outline card-primary shadow-sm h-100">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title font-weight-bold text-dark">
                                    <i class="fas fa-chart-area text-primary mr-1"></i> Tren Penjualan & Pembelian {{ date('Y') }}
                                </h3>
                            </div>
                            <div class="card-tools">
                                <span class="badge badge-primary px-2 py-1 mr-2"><i class="fas fa-circle text-primary mr-1"></i>Penjualan</span>
                                <span class="badge badge-danger px-2 py-1"><i class="fas fa-circle text-danger mr-1"></i>Pembelian</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <!-- Metrik Cepat -->
                            <div class="row border-bottom pb-2 mb-3 text-center">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <span class="description-text text-muted text-uppercase small">Total Penjualan {{ date('Y') }}</span>
                                        <h5 class="description-header text-primary font-weight-bold mt-1" id="totalSemuaPenjualan">Rp 0</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <span class="description-text text-muted text-uppercase small">Total Pembelian {{ date('Y') }}</span>
                                        <h5 class="description-header text-danger font-weight-bold mt-1" id="totalSemuaPembelian">Rp 0</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <span class="description-text text-muted text-uppercase small">Selisih Penjualan - Pembelian</span>
                                        <h5 class="description-header text-success font-weight-bold mt-1" id="totalSelisihTahunan">Rp 0</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative" style="height: 290px;">
                                <canvas id="grafik-penjualan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Distribusi Cara Bayar -->
                <div class="col-lg-4 mb-4">
                    <div class="card card-outline card-info shadow-sm h-100">
                        <div class="card-header border-0">
                            <h3 class="card-title font-weight-bold text-dark">
                                <i class="fas fa-wallet text-info mr-1"></i> Metode Pembayaran {{ date('F Y') }}
                            </h3>
                        </div>
                        <div class="card-body pt-0 d-flex flex-column justify-content-between">
                            <div class="position-relative my-auto" style="height: 220px;">
                                <canvas id="grafik-cara-bayar"></canvas>
                            </div>
                            <div class="mt-3 pt-2 border-top" id="legendCaraBayarContainer">
                                <div class="text-center text-muted small">Memuat distribusi pembayaran...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 3: OPERATIONAL MONITORING WIDGETS -->
            <div class="row">
                <!-- Peringatan Stok Kritis -->
                <div class="col-lg-4 mb-4">
                    <div class="card card-outline card-danger shadow-sm h-100">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold text-dark">
                                <i class="fas fa-exclamation-triangle text-danger mr-1"></i> Stok Mendekati Minimum
                            </h3>
                            <a href="{{ url('lappersediaan') }}" class="btn btn-tool text-primary" title="Lihat Laporan Persediaan">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-valign-middle mb-0">
                                    <thead class="bg-light text-muted small">
                                        <tr>
                                            <th>Barang</th>
                                            <th class="text-center">Sisa</th>
                                            <th class="text-center">Min</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyStokKritis">
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted small">
                                                <i class="fas fa-spinner fa-spin mr-1"></i> Memeriksa data stok...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-white border-top-0 py-2">
                            <a href="{{ url('lappersediaan') }}" class="text-uppercase small font-weight-bold text-danger">
                                Pantau Semua Stok <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Piutang Jatuh Tempo / Prioritas Tagih -->
                <div class="col-lg-4 mb-4">
                    <div class="card card-outline card-warning shadow-sm h-100">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold text-dark">
                                <i class="fas fa-clock text-warning mr-1"></i> Piutang Jatuh Tempo
                            </h3>
                            <a href="{{ url('piutang') }}" class="btn btn-tool text-primary" title="Kelola Piutang">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-valign-middle mb-0">
                                    <thead class="bg-light text-muted small">
                                        <tr>
                                            <th>Konsumen</th>
                                            <th class="text-right">Sisa (Rp)</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyPiutangTempo">
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted small">
                                                <i class="fas fa-spinner fa-spin mr-1"></i> Memeriksa data piutang...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-white border-top-0 py-2">
                            <a href="{{ url('piutang') }}" class="text-uppercase small font-weight-bold text-warning">
                                Buka Daftar Piutang <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Top Konsumen Tahun Ini -->
                <div class="col-lg-4 mb-4">
                    <div class="card card-outline card-success shadow-sm h-100">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold text-dark">
                                <i class="fas fa-crown text-warning mr-1"></i> Top Konsumen {{ date('Y') }}
                            </h3>
                            <a href="{{ url('konsumen') }}" class="btn btn-tool text-primary" title="Master Konsumen">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-valign-middle mb-0">
                                    <thead class="bg-light text-muted small">
                                        <tr>
                                            <th>Nama Konsumen</th>
                                            <th class="text-center">Trx</th>
                                            <th class="text-right">Total Belanja</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyTopKonsumen">
                                        <tr>
                                            <td colspan="3" class="text-center py-4 text-muted small">
                                                <i class="fas fa-spinner fa-spin mr-1"></i> Memuat pelanggan terbaik...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-center bg-white border-top-0 py-2">
                            <a href="{{ url('lappenjualan') }}" class="text-uppercase small font-weight-bold text-success">
                                Analisis Penjualan Lengkap <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 4: RIWAYAT AKTIVITAS LIVE STREAM -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card card-outline card-secondary shadow-sm">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center">
                            <h3 class="card-title font-weight-bold text-dark">
                                <i class="fas fa-history text-secondary mr-1"></i> Log Aktivitas Pengguna Terkini
                                <span class="badge badge-success ml-2 font-weight-normal"><i class="fas fa-circle text-xs mr-1"></i>Live</span>
                            </h3>
                            <div class="card-tools">
                                <a href="{{ url('home/lihatRiwayatAktifitas') }}" class="btn btn-sm btn-outline-secondary">
                                    Lihat Seluruh Log <i class="fas fa-angle-double-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0">
                                    <thead class="bg-light text-muted small">
                                        <tr>
                                            <th style="width: 15%;">Waktu</th>
                                            <th style="width: 20%;">Pengguna</th>
                                            <th style="width: 15%;">Aksi</th>
                                            <th style="width: 20%;">Modul / Tabel</th>
                                            <th style="width: 30%;">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyRiwayatAktifitas">
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted small">
                                                <i class="fas fa-spinner fa-spin mr-1"></i> Memuat log aktivitas...
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
    var tglLoadRiwayat = getFormattedDateTime();
    var chartTren = null;
    var chartCaraBayar = null;

    $(document).ready(function() {
        // Load semua data dashboard
        initDashboard();

        // Tombol refresh
        $('#btnRefreshDashboard').on('click', function() {
            var $btn = $(this);
            $btn.find('i').addClass('fa-spin');
            initDashboard(function() {
                $btn.find('i').removeClass('fa-spin');
            });
        });

        // Polling riwayat aktivitas setiap 15 detik secara background (global: false agar tidak flicker loader)
        setInterval(function() {
            loadRiwayatAktifitasPoll();
        }, 15000);

        // Update teks "menit yang lalu" setiap menit
        setInterval(updateSince, 60000);
    });

    function initDashboard(callback) {
        var completed = 0;
        var totalReq = 4;

        function checkComplete() {
            completed++;
            if (completed >= totalReq && typeof callback === 'function') {
                callback();
            }
        }

        loadInfoBox(checkComplete);
        loadGrafik(checkComplete);
        loadWidgets(checkComplete);
        loadRiwayatAktifitasAwal(checkComplete);
    }

    // 1. KPI Info Box
    function loadInfoBox(cb) {
        $.ajax({
            url: "{{ url('home/getInfoBox') }}",
            type: 'GET',
            dataType: 'json',
            global: false
        })
        .done(function(res) {
            $('#kpiPembelian').text(numberWithCommas(res.totalPembelian || 0));
            $('#kpiPenjualan').text(numberWithCommas(res.totalPenjualan || 0));
            $('#kpiPiutang').text(numberWithCommas(res.totalPiutang || 0));
            $('#kpiHutang').text(numberWithCommas(res.totalUtang || 0));

            if (res.detail) {
                $('#kpiPenjualanCount').text(res.detail.penjualan_hari_ini_count || 0);
                $('#kpiPembelianCount').text(res.detail.pembelian_hari_ini_count || 0);
                $('#kpiPiutangCount').text(res.detail.piutang_faktur_count || 0);
                $('#kpiHutangCount').text(res.detail.hutang_faktur_count || 0);
            }
        })
        .fail(function() {
            console.error('Gagal memuat getInfoBox');
        })
        .always(function() {
            if (typeof cb === 'function') cb();
        });
    }

    // 2. Grafik Tren & Komposisi Pembayaran
    function loadGrafik(cb) {
        $.ajax({
            url: "{{ url('home/getInfoGrafikPenjualan') }}",
            type: 'GET',
            dataType: 'json',
            global: false
        })
        .done(function(res) {
            var totalJual = parseFloat(res.totalSemuaPenjualan) || 0;
            var totalBeli = parseFloat(res.totalSemuaPembelian) || 0;
            var selisih = totalJual - totalBeli;

            $('#totalSemuaPenjualan').text('Rp ' + format_rupiah(totalJual));
            $('#totalSemuaPembelian').text('Rp ' + format_rupiah(totalBeli));
            
            var $selisihEl = $('#totalSelisihTahunan');
            $selisihEl.text('Rp ' + format_rupiah(selisih));
            if (selisih < 0) {
                $selisihEl.removeClass('text-success').addClass('text-danger');
            } else {
                $selisihEl.removeClass('text-danger').addClass('text-success');
            }

            renderChartTren(res.arrDeskripsi, res.arrTotalPenjualan, res.arrTotalPembelian);
            renderChartCaraBayar(res.caraBayarLabels, res.caraBayarData, res.caraBayarTotal);
        })
        .fail(function() {
            console.error('Gagal memuat grafik');
        })
        .always(function() {
            if (typeof cb === 'function') cb();
        });
    }

    function renderChartTren(labels, dataPenjualan, dataPembelian) {
        var ctx = document.getElementById('grafik-penjualan').getContext('2d');
        if (chartTren) {
            chartTren.destroy();
        }

        chartTren = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Penjualan',
                        data: dataPenjualan,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.08)',
                        pointBackgroundColor: '#007bff',
                        pointBorderColor: '#ffffff',
                        pointHoverRadius: 6,
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.25
                    },
                    {
                        label: 'Pembelian',
                        data: dataPembelian,
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.05)',
                        pointBackgroundColor: '#dc3545',
                        pointBorderColor: '#ffffff',
                        pointHoverRadius: 6,
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.25
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, chartData) {
                            var datasetLabel = chartData.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp ' + format_rupiah(tooltipItem.yLabel);
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontColor: '#6c757d',
                            fontStyle: 'bold'
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: 'rgba(0, 0, 0, 0.06)',
                            zeroLineColor: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#6c757d',
                            callback: function(value) {
                                if (value >= 1000000000) return (value / 1000000000).toFixed(1) + ' M';
                                if (value >= 1000000) return (value / 1000000).toFixed(0) + ' Jt';
                                if (value >= 1000) return (value / 1000).toFixed(0) + ' Rb';
                                return value;
                            }
                        }
                    }]
                }
            }
        });
    }

    function renderChartCaraBayar(labels, dataCounts, dataTotals) {
        var ctx = document.getElementById('grafik-cara-bayar').getContext('2d');
        if (chartCaraBayar) {
            chartCaraBayar.destroy();
        }

        var colors = ['#28a745', '#ffc107', '#17a2b8', '#6f42c1', '#fd7e14'];
        var bgColors = [];
        for (var i = 0; i < labels.length; i++) {
            bgColors.push(colors[i % colors.length]);
        }

        if (labels.length === 0) {
            $('#legendCaraBayarContainer').html('<div class="text-center text-muted small py-3">Belum ada transaksi bulan ini</div>');
            return;
        }

        chartCaraBayar = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataCounts,
                    backgroundColor: bgColors,
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutoutPercentage: 65,
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chartData) {
                            var idx = tooltipItem.index;
                            var label = chartData.labels[idx] || '';
                            var count = chartData.datasets[0].data[idx] || 0;
                            var nominal = dataTotals && dataTotals[idx] ? ' (Rp ' + format_rupiah(dataTotals[idx]) + ')' : '';
                            return label + ': ' + count + ' transaksi' + nominal;
                        }
                    }
                }
            }
        });

        // Legend list
        var legendHtml = '<div class="row text-center">';
        var totalAllTrx = dataCounts.reduce(function(a, b) { return a + b; }, 0);
        for (var j = 0; j < labels.length; j++) {
            var pct = totalAllTrx > 0 ? Math.round((dataCounts[j] / totalAllTrx) * 100) : 0;
            legendHtml += `
                <div class="col-6 mb-2 text-left">
                    <span style="display:inline-block;width:10px;height:10px;background-color:${bgColors[j]};border-radius:2px;" class="mr-1"></span>
                    <strong class="small text-dark">${labels[j]}</strong>: 
                    <span class="small text-muted">${dataCounts[j]} (${pct}%)</span>
                </div>
            `;
        }
        legendHtml += '</div>';
        $('#legendCaraBayarContainer').html(legendHtml);
    }

    // 3. Operational Widgets (Stok Kritis, Piutang Jatuh Tempo, Top Konsumen)
    function loadWidgets(cb) {
        $.ajax({
            url: "{{ url('home/getWidgetData') }}",
            type: 'GET',
            dataType: 'json',
            global: false
        })
        .done(function(res) {
            // Widget Stok Kritis
            var htmlStok = '';
            if (res.stokKritis && res.stokKritis.length > 0) {
                res.stokKritis.forEach(function(item) {
                    var sisa = parseFloat(item.totalstok !== undefined ? item.totalstok : item.stok) || 0;
                    var min = parseFloat(item.minstok !== undefined ? item.minstok : item.stokminimum) || 0;
                    var satuanBarang = item.satuan || item.namasatuan || '';
                    var badgeClass = sisa <= 0 ? 'badge-danger' : 'badge-warning';
                    htmlStok += `
                        <tr>
                            <td>
                                <div class="font-weight-bold text-dark text-truncate" style="max-width: 170px;" title="${item.namabarang}">
                                    ${item.namabarang}
                                </div>
                                <small class="text-muted">${item.kdbarang || '-'}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge ${badgeClass} font-weight-bold px-2 py-1">${format_rupiah(sisa)} ${satuanBarang}</span>
                            </td>
                            <td class="text-center text-muted small font-weight-bold">
                                ${format_rupiah(min)}
                            </td>
                        </tr>
                    `;
                });
            } else {
                htmlStok = '<tr><td colspan="3" class="text-center py-4 text-success small"><i class="fas fa-check-circle mr-1"></i> Semua stok dalam batas aman</td></tr>';
            }
            $('#tbodyStokKritis').html(htmlStok);

            // Widget Piutang Jatuh Tempo
            var htmlPiutang = '';
            if (res.piutangJatuhTempo && res.piutangJatuhTempo.length > 0) {
                res.piutangJatuhTempo.forEach(function(item) {
                    var sisaPiutang = parseFloat(item.sisa_piutang) || 0;
                    var lewatHari = parseInt(item.lewat_hari !== undefined ? item.lewat_hari : 0);
                    var statusTempo = item.status_tempo;
                    if (!statusTempo) {
                        if (lewatHari > 0) statusTempo = 'Overdue';
                        else if (lewatHari === 0) statusTempo = 'Hari Ini';
                        else statusTempo = 'Mendatang';
                    }

                    var ketTempo = item.keterangan_tempo;
                    if (!ketTempo) {
                        if (lewatHari > 0) ketTempo = 'Lewat ' + lewatHari + ' hari';
                        else if (lewatHari === 0) ketTempo = 'Jatuh tempo hari ini';
                        else ketTempo = 'Sisa ' + Math.abs(lewatHari) + ' hari';
                    }

                    var statusBadge = '';
                    if (statusTempo === 'Overdue') {
                        statusBadge = `<span class="badge badge-danger font-weight-bold" title="${ketTempo}">${ketTempo}</span>`;
                    } else if (statusTempo === 'Hari Ini') {
                        statusBadge = `<span class="badge badge-warning font-weight-bold">Hari Ini</span>`;
                    } else {
                        statusBadge = `<span class="badge badge-info font-weight-bold">${ketTempo}</span>`;
                    }
                    htmlPiutang += `
                        <tr>
                            <td>
                                <div class="font-weight-bold text-dark text-truncate" style="max-width: 150px;" title="${item.namakonsumen}">
                                    ${item.namakonsumen}
                                </div>
                                <small class="text-muted">Ref: ${item.noinvoice || item.idpiutang || '-'}</small>
                            </td>
                            <td class="text-right font-weight-bold text-danger">
                                ${format_rupiah(sisaPiutang)}
                            </td>
                            <td class="text-center">
                                ${statusBadge}
                            </td>
                        </tr>
                    `;
                });
            } else {
                htmlPiutang = '<tr><td colspan="3" class="text-center py-4 text-success small"><i class="fas fa-check-circle mr-1"></i> Tidak ada piutang jatuh tempo mendesak</td></tr>';
            }
            $('#tbodyPiutangTempo').html(htmlPiutang);

            // Widget Top Konsumen
            var htmlTop = '';
            if (res.topKonsumen && res.topKonsumen.length > 0) {
                res.topKonsumen.forEach(function(item, idx) {
                    var totalBelanja = parseFloat(item.total_omset !== undefined ? item.total_omset : item.total_nominal) || 0;
                    var totalTrx = item.total_transaksi !== undefined ? item.total_transaksi : (item.jml_transaksi !== undefined ? item.jml_transaksi : 0);
                    var rankIcon = '';
                    if (idx === 0) rankIcon = '<i class="fas fa-medal text-warning mr-1"></i>';
                    else if (idx === 1) rankIcon = '<i class="fas fa-medal text-secondary mr-1"></i>';
                    else if (idx === 2) rankIcon = '<i class="fas fa-medal text-danger mr-1"></i>';
                    else rankIcon = `<span class="badge badge-light border mr-1">${idx + 1}</span>`;

                    htmlTop += `
                        <tr>
                            <td>
                                <div class="font-weight-bold text-dark text-truncate" style="max-width: 160px;" title="${item.namakonsumen}">
                                    ${rankIcon}${item.namakonsumen}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light font-weight-bold">${totalTrx}x</span>
                            </td>
                            <td class="text-right font-weight-bold text-success">
                                Rp ${format_rupiah(totalBelanja)}
                            </td>
                        </tr>
                    `;
                });
            } else {
                htmlTop = '<tr><td colspan="3" class="text-center py-4 text-muted small">Belum ada transaksi penjualan</td></tr>';
            }
            $('#tbodyTopKonsumen').html(htmlTop);
        })
        .fail(function() {
            console.error('Gagal memuat getWidgetData');
        })
        .always(function() {
            if (typeof cb === 'function') cb();
        });
    }

    // 4. Riwayat Aktivitas
    function loadRiwayatAktifitasAwal(cb) {
        $.ajax({
            url: "{{ url('home/loadRiwayatAktifitas') }}",
            type: 'GET',
            dataType: 'json',
            global: false
        })
        .done(function(response) {
            $('#tbodyRiwayatAktifitas').empty();
            if (response && response.length > 0) {
                addRowRiwayatAktifitas(response);
            } else {
                $('#tbodyRiwayatAktifitas').html('<tr><td colspan="5" class="text-center py-3 text-muted small">Belum ada riwayat aktivitas</td></tr>');
            }
        })
        .fail(function() {
            console.error('Gagal memuat riwayat aktivitas awal');
        })
        .always(function() {
            if (typeof cb === 'function') cb();
        });
    }

    function loadRiwayatAktifitasPoll() {
        $.ajax({
            url: "{{ url('home/loadRiwayatAktifitas') }}",
            type: 'GET',
            dataType: 'json',
            data: { 'tglLoadRiwayat': tglLoadRiwayat },
            global: false
        })
        .done(function(response) {
            if (response && response.length > 0) {
                addRowRiwayatAktifitas(response);
            }
        })
        .fail(function() {
            console.error('Gagal polling riwayat aktivitas');
        });
    }

    function formatDeskripsiLive(deskripsi) {
        if (!deskripsi) return '-';
        try {
            var parsed = typeof deskripsi === 'string' ? JSON.parse(deskripsi) : deskripsi;
            if (typeof parsed === 'object' && parsed !== null) {
                var pairs = [];
                for (var key in parsed) {
                    if (Object.prototype.hasOwnProperty.call(parsed, key)) {
                        var label = key.replace(/_/g, ' ');
                        var val = parsed[key];
                        if (typeof val === 'object' && val !== null) {
                            val = JSON.stringify(val);
                        }
                        pairs.push(label + ': ' + (val === null ? '-' : val));
                    }
                }
                return pairs.length > 0 ? pairs.join(', ') : '-';
            }
        } catch (e) {
            // bukan json
        }
        return deskripsi;
    }

    function addRowRiwayatAktifitas(arrRiwayat) {
        if (!arrRiwayat || arrRiwayat.length === 0) return;

        for (var i = arrRiwayat.length - 1; i >= 0; i--) {
            var item = arrRiwayat[i];
            var actionBadge = getActionBadge(item.namafunction);
            var deskripsiTeks = formatDeskripsiLive(item.deskripsi);

            var rowHtml = `
                <tr>
                    <td class="small text-muted align-middle">
                        <i class="far fa-clock mr-1 text-primary"></i>
                        <span class="since-span font-weight-bold" data-time="${item.inserted_date}">${formatWaktuLalu(item.inserted_date)}</span>
                    </td>
                    <td class="font-weight-bold text-dark align-middle">
                        <i class="far fa-user-circle mr-1 text-secondary"></i>${item.namapengguna || 'Sistem'}
                    </td>
                    <td class="align-middle">
                        ${actionBadge}
                    </td>
                    <td class="small text-muted align-middle">
                        <code>${item.namatabel || '-'}</code>
                    </td>
                    <td class="small text-dark align-middle text-truncate" style="max-width: 250px;" title="${deskripsiTeks.replace(/"/g, '&quot;')}">
                        ${deskripsiTeks}
                    </td>
                </tr>
            `;

            var rowCount = $('#tbodyRiwayatAktifitas tr').length;
            if (rowCount >= 10) {
                $('#tbodyRiwayatAktifitas tr:last').remove();
            }

            $('#tbodyRiwayatAktifitas').prepend(rowHtml);
            tglLoadRiwayat = item.inserted_date;
        }
    }

    function getActionBadge(namaFn) {
        var fn = (namaFn || '').toLowerCase();
        if (fn.includes('tambah') || fn.includes('simpan') || fn.includes('create') || fn.includes('insert')) {
            return `<span class="badge badge-success px-2"><i class="fas fa-plus-circle mr-1"></i>${namaFn}</span>`;
        } else if (fn.includes('ubah') || fn.includes('edit') || fn.includes('update')) {
            return `<span class="badge badge-info px-2"><i class="fas fa-edit mr-1"></i>${namaFn}</span>`;
        } else if (fn.includes('hapus') || fn.includes('delete') || fn.includes('batal')) {
            return `<span class="badge badge-danger px-2"><i class="fas fa-trash-alt mr-1"></i>${namaFn}</span>`;
        } else {
            return `<span class="badge badge-secondary px-2">${namaFn || 'Aksi'}</span>`;
        }
    }

    function getFormattedDateTime() {
        var now = new Date();
        function pad(v) { return v < 10 ? '0' + v : v; }
        return now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate()) + ' ' +
               pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());
    }

    function formatWaktuLalu(dateStr) {
        var now = new Date();
        var date = new Date(dateStr);
        var diffSec = Math.floor((now - date) / 1000);

        if (isNaN(diffSec) || diffSec < 0) return 'Baru saja';
        if (diffSec < 60) return 'Baru saja';
        var diffMin = Math.floor(diffSec / 60);
        if (diffMin < 60) return diffMin + ' mnt lalu';
        var diffHour = Math.floor(diffMin / 60);
        if (diffHour < 24) return diffHour + ' jam lalu';
        var diffDay = Math.floor(diffHour / 24);
        if (diffDay < 30) return diffDay + ' hr lalu';
        return dateStr.substring(0, 10);
    }

    function updateSince() {
        document.querySelectorAll('.since-span').forEach(function(span) {
            var insertedDate = span.getAttribute('data-time');
            if (insertedDate) {
                span.textContent = formatWaktuLalu(insertedDate);
            }
        });
    }
</script>
@endsection