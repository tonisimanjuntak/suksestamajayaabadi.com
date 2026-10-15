@extends('template/layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header pb-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.6rem;">
                        <i class="fas fa-user-tie text-success mr-2"></i>Dashboard Sales
                    </h1>
                    <p class="text-muted mb-0 small">
                        Info penagihan & penjualan per <span class="font-weight-bold">{{ date('d F Y') }}</span>
                    </p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <button class="btn btn-outline-success btn-sm shadow-sm" id="btnRefreshSales" title="Muat Ulang">
                        <i class="fas fa-sync-alt mr-1"></i> Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            {{-- 3 CARD TOP SALES (BOBOT PERSEN SAJA, TANPA RUPIAH) --}}
            <div class="row">
                <!-- TOP SALES BULAN INI -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card card-outline card-success shadow-sm h-100">
                        <div class="card-header border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title font-weight-bold text-dark mb-0">
                                    <i class="fas fa-medal text-success mr-2"></i>Top Penjualan Sales Bulan Ini
                                </h5>
                                <span id="badgeBulanIni" class="badge badge-success py-1 px-2 font-weight-normal">-</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div id="listTopSalesBulanIni">
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-spinner fa-spin mr-1"></i>Memuat data...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOP SALES BULAN KEMARIN -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="card card-outline card-info shadow-sm h-100">
                        <div class="card-header border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title font-weight-bold text-dark mb-0">
                                    <i class="fas fa-history text-info mr-2"></i>Top Penjualan Sales Bulan Kemarin
                                </h5>
                                <span id="badgeBulanKemarin" class="badge badge-info py-1 px-2 font-weight-normal">-</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div id="listTopSalesBulanKemarin">
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-spinner fa-spin mr-1"></i>Memuat data...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOP SALES TAHUN INI -->
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card card-outline card-primary shadow-sm h-100">
                        <div class="card-header border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title font-weight-bold text-dark mb-0">
                                    <i class="fas fa-trophy text-warning mr-2"></i>Top Penjualan Sales Tahun Ini
                                </h5>
                                <span id="badgeTahunIni" class="badge badge-primary py-1 px-2 font-weight-normal">-</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div id="listTopSalesTahunIni">
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-spinner fa-spin mr-1"></i>Memuat data...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL PENAGIHAN TERBARU & TOP 5 KONSUMEN PIUTANG LEWAT JATUH TEMPO --}}
            <div class="row">
                <div class="col-lg-7 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <h5 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-clipboard-list text-warning mr-2"></i>Penagihan Terbaru
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover mb-0" id="tablePenagihanSales">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Tgl</th>
                                            <th>No Penagihan</th>
                                            <th>Sales</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td colspan="4" class="text-center text-muted py-3"><i class="fas fa-spinner fa-spin mr-1"></i>Memuat...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-3">
                    <div class="card card-outline card-danger shadow-sm h-100">
                        <div class="card-header border-bottom-0 pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title font-weight-bold text-dark mb-0">
                                    <i class="fas fa-exclamation-triangle text-danger mr-2"></i>Top 5 Konsumen Piutang Lewat Jatuh Tempo
                                </h5>
                                <span class="badge badge-danger py-1 px-2 font-weight-normal">Lewat Tempo</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div id="listTopKonsumenJatuhTempo">
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-spinner fa-spin mr-1"></i>Memuat data...
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
<script>
    function formatRupiah(angka) {
        if (!angka) return '0';
        return parseFloat(angka).toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
    }

    function renderTopSalesList(items, themeColor) {
        if (!items || items.length === 0) {
            return '<div class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x mb-2 d-block text-secondary"></i>Belum ada data penjualan</div>';
        }

        var rankBadges = {
            1: 'badge-warning text-dark font-weight-bold',
            2: 'badge-secondary font-weight-bold',
            3: 'badge-info font-weight-bold'
        };

        var html = '';
        $.each(items, function (i, row) {
            var badgeClass = rankBadges[row.ranking] || 'badge-light text-muted border';
            var barColor = themeColor || 'bg-success';

            html += '<div class="mb-3">' +
                '<div class="d-flex justify-content-between align-items-center mb-1">' +
                    '<div class="text-truncate pr-2">' +
                        '<span class="badge badge-pill ' + badgeClass + ' mr-2" style="min-width: 26px;">#' + row.ranking + '</span>' +
                        '<span class="font-weight-bold text-dark">' + row.namasales + '</span>' +
                    '</div>' +
                    '<div class="text-right flex-shrink-0">' +
                        '<span class="font-weight-bold text-' + themeColor.replace('bg-', '') + '" style="font-size: 0.95rem;">' + row.persen_label + '</span>' +
                    '</div>' +
                '</div>' +
                '<div class="progress" style="height: 6px; border-radius: 3px; background-color: #e9ecef;">' +
                    '<div class="progress-bar ' + barColor + '" role="progressbar" style="width: ' + row.persen + '%;" aria-valuenow="' + row.persen + '" aria-valuemin="0" aria-valuemax="100"></div>' +
                '</div>' +
            '</div>';
        });

        return html;
    }

    function renderTopOverdueList(items, themeColor) {
        if (!items || items.length === 0) {
            return '<div class="text-center text-muted py-4"><i class="fas fa-check-circle fa-2x mb-2 d-block text-success"></i>Tidak ada piutang lewat jatuh tempo</div>';
        }

        var rankBadges = {
            1: 'badge-danger font-weight-bold',
            2: 'badge-warning text-dark font-weight-bold',
            3: 'badge-secondary font-weight-bold'
        };

        var html = '';
        $.each(items, function (i, row) {
            var badgeClass = rankBadges[row.ranking] || 'badge-light text-muted border';
            var barColor = themeColor || 'bg-danger';

            html += '<div class="mb-3">' +
                '<div class="d-flex justify-content-between align-items-center mb-1">' +
                    '<div class="text-truncate pr-2">' +
                        '<span class="badge badge-pill ' + badgeClass + ' mr-2" style="min-width: 26px;">#' + row.ranking + '</span>' +
                        '<span class="font-weight-bold text-dark">' + row.namakonsumen + '</span>' +
                    '</div>' +
                    '<div class="text-right flex-shrink-0">' +
                        '<span class="font-weight-bold text-' + themeColor.replace('bg-', '') + '" style="font-size: 0.95rem;">' + row.persen_label + '</span>' +
                    '</div>' +
                '</div>' +
                '<div class="progress" style="height: 6px; border-radius: 3px; background-color: #e9ecef;">' +
                    '<div class="progress-bar ' + barColor + '" role="progressbar" style="width: ' + row.persen + '%;" aria-valuenow="' + row.persen + '" aria-valuemin="0" aria-valuemax="100"></div>' +
                '</div>' +
            '</div>';
        });

        return html;
    }

    function loadSalesData(callback) {
        $.get("{{ url('home/getSalesData') }}", function (res) {
            // Badges Periode
            if (res.periodeBulanIni) $('#badgeBulanIni').text(res.periodeBulanIni);
            if (res.periodeBulanKemarin) $('#badgeBulanKemarin').text(res.periodeBulanKemarin);
            if (res.periodeTahunIni) $('#badgeTahunIni').text(res.periodeTahunIni);

            // Render 3 Top Penjualan Sales (Bobot Persen Saja, Tanpa Rupiah)
            $('#listTopSalesBulanIni').html(renderTopSalesList(res.topSalesBulanIni, 'bg-success'));
            $('#listTopSalesBulanKemarin').html(renderTopSalesList(res.topSalesBulanKemarin, 'bg-info'));
            $('#listTopSalesTahunIni').html(renderTopSalesList(res.topSalesTahunIni, 'bg-primary'));

            // Render Top 5 Konsumen Piutang Lewat Jatuh Tempo (Bobot Persen Saja, Tanpa Rupiah)
            $('#listTopKonsumenJatuhTempo').html(renderTopOverdueList(res.topKonsumenJatuhTempo, 'bg-danger'));

            // Tabel Penagihan Terbaru (Limit 5, Tanpa Kolom Status)
            var rowsPenagihan = '';
            if (res.penagihanTerbaru && res.penagihanTerbaru.length > 0) {
                $.each(res.penagihanTerbaru, function (i, row) {
                    rowsPenagihan += '<tr>' +
                        '<td>' + row.tglpenagihan + '</td>' +
                        '<td>' + row.idpenagihan + '</td>' +
                        '<td>' + (row.namasales || '-') + '</td>' +
                        '<td class="text-right font-weight-bold">Rp ' + formatRupiah(row.totaltagihan) + '</td>' +
                        '</tr>';
                });
            } else {
                rowsPenagihan = '<tr><td colspan="4" class="text-center text-muted py-3">Tidak ada data penagihan</td></tr>';
            }
            $('#tablePenagihanSales tbody').html(rowsPenagihan);

            if (typeof callback === 'function') callback();
        }).fail(function () {
            $('#listTopSalesBulanIni').html('<div class="text-center text-danger py-3">Gagal memuat data</div>');
            $('#listTopSalesBulanKemarin').html('<div class="text-center text-danger py-3">Gagal memuat data</div>');
            $('#listTopSalesTahunIni').html('<div class="text-center text-danger py-3">Gagal memuat data</div>');
            $('#listTopKonsumenJatuhTempo').html('<div class="text-center text-danger py-3">Gagal memuat data</div>');
            $('#tablePenagihanSales tbody').html('<tr><td colspan="4" class="text-center text-danger py-3">Gagal memuat data</td></tr>');
            if (typeof callback === 'function') callback();
        });
    }

    $(document).ready(function () {
        loadSalesData();

        // Tombol Refresh
        $('#btnRefreshSales').on('click', function () {
            var $btn = $(this);
            $btn.find('i').addClass('fa-spin');
            loadSalesData(function () {
                $btn.find('i').removeClass('fa-spin');
            });
        });
    });
</script>
@endsection
