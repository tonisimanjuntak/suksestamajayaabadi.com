@extends('template/layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-tools mr-2 text-secondary"></i>Pemeliharaan System</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pemeliharaan System</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <!-- Overview Statistik Database -->
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-history"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted font-weight-bold">Riwayat Aktifitas (Aktif)</span>
                            <span class="info-box-number text-lg" id="statAktifCount">
                                {{ number_format($statistik['aktif_count'], 0, ',', '.') }} <small>baris</small>
                            </span>
                            <span class="text-xs text-muted">
                                Rentang: <span id="statAktifMin">{{ $statistik['aktif_min_date'] }}</span> s/d <span id="statAktifMax">{{ $statistik['aktif_max_date'] }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-archive"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted font-weight-bold">Riwayat Aktifitas (Arsip)</span>
                            <span class="info-box-number text-lg" id="statArchiveCount">
                                {{ number_format($statistik['archive_count'], 0, ',', '.') }} <small>baris</small>
                            </span>
                            <span class="text-xs text-muted">
                                Rentang: <span id="statArchiveMin">{{ $statistik['archive_min_date'] }}</span> s/d <span id="statArchiveMax">{{ $statistik['archive_max_date'] }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-12">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-warning elevation-1 text-white"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-muted font-weight-bold">Sesi Pengguna Aktif</span>
                            <span class="info-box-number text-lg">
                                <span id="statSesiTotal">{{ number_format($statistik['total_sesi'] ?? 0, 0, ',', '.') }}</span> <small>sesi</small>
                            </span>
                            <span class="text-xs text-muted">
                                Pengguna lain aktif: <strong id="statSesiLain" class="text-primary">{{ number_format($statistik['sesi_lain'] ?? 0, 0, ',', '.') }}</strong> sesi
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modul 1: Arsip Riwayat Aktifitas -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-archive mr-2 text-primary"></i>1. Arsip Riwayat Aktifitas
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-primary">Database Maintenance</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-light border mb-4">
                                <h6 class="font-weight-bold text-dark mb-1"><i class="fas fa-info-circle mr-1 text-info"></i>Petunjuk Operasi:</h6>
                                <p class="mb-1 text-sm text-muted">
                                    Fitur ini memindahkan data riwayat aktifitas ke tabel arsip (<code>riwayataktifitas_archive</code>) berdasarkan batas periode yang dipilih (misal: data sebelum 1 bulan, 2 bulan, 3 bulan, 6 bulan, atau 12 bulan yang lalu).
                                </p>
                                <ul class="mb-0 text-sm text-muted pl-3">
                                    <li>Sistem secara otomatis mengecek data yang sudah pernah diarsipkan agar tidak terjadi duplikasi ID.</li>
                                    <li>Hanya data riwayat yang belum pernah diarsipkan yang akan dimasukkan ke tabel arsip.</li>
                                    <li>Data yang telah aman di arsip akan dibersihkan dari tabel utama (<code>riwayataktifitas</code>) untuk menjaga performa dan meringankan database.</li>
                                    <li>Data aktif terbaru (dalam kurun waktu periode yang dipilih) akan tetap tersimpan di tabel utama.</li>
                                </ul>
                            </div>

                            <!-- Form Filter Periode -->
                            <div class="row align-items-end mb-3">
                                <div class="col-md-5 col-sm-7 mb-2">
                                    <label for="filterPeriode" class="font-weight-bold text-sm">Periode Arsip Riwayat Aktifitas:</label>
                                    <select id="filterPeriode" class="form-control form-control-sm">
                                        @foreach ($periodeList as $val => $label)
                                            <option value="{{ $val }}" {{ $val == $periodeAktif ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted d-block mt-1">
                                        <i class="fas fa-clock mr-1 text-secondary"></i>Batas arsip: data sebelum <strong id="spanCutoffDate" class="text-dark">-</strong>
                                    </small>
                                </div>
                                <div class="col-md-7 col-sm-5 mb-2 d-flex">
                                    <button type="button" id="btnCekStatus" class="btn btn-sm btn-outline-info mr-2">
                                        <i class="fas fa-search mr-1"></i>Cek Ringkasan Periode
                                    </button>
                                    <button type="button" id="btnArchive" class="btn btn-sm btn-warning font-weight-bold">
                                        <i class="fas fa-file-archive mr-1"></i>Archive Riwayat Aktifitas
                                    </button>
                                </div>
                            </div>

                            <!-- Box Detail Periode Terpilih -->
                            <div id="boxStatusPeriode" class="card bg-light border p-3 mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="font-weight-bold mb-0">
                                        <i class="fas fa-chart-pie mr-1 text-secondary"></i>
                                        Ringkasan Periode: <span id="labelPeriode" class="text-primary">-</span>
                                    </h6>
                                    <span id="badgeStatusSiap" class="badge badge-secondary p-1">Menunggu Pengecekan</span>
                                </div>
                                <div class="row text-center mt-2">
                                    <div class="col-md-3 col-sm-6 col-12 mb-2">
                                        <div class="border rounded bg-white p-2 h-100">
                                            <span class="text-xs text-muted d-block">Data Riwayat Akan Diarsip</span>
                                            <span id="valTotalRiwayat" class="font-weight-bold text-md text-info">0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-2">
                                        <div class="border rounded bg-white p-2 h-100">
                                            <span class="text-xs text-muted d-block">Sudah Pernah Diarsipkan</span>
                                            <span id="valSudahDiarsipkan" class="font-weight-bold text-md text-success">0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-2">
                                        <div class="border rounded bg-white p-2 h-100">
                                            <span class="text-xs text-muted d-block">Belum Diarsipkan (Akan Dimasukkan)</span>
                                            <span id="valBelumDiarsipkan" class="font-weight-bold text-md text-warning">0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 mb-2">
                                        <div class="border rounded bg-white p-2 h-100">
                                            <span class="text-xs text-muted d-block">Tetap Disimpan di Tabel Aktif</span>
                                            <span id="valSisaAktif" class="font-weight-bold text-md text-primary">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modul 2: Manajemen Sesi & Logout Seluruh Pengguna -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-warning shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-user-lock mr-2 text-warning"></i>2. Force Logout Seluruh Pengguna
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-warning">Session Management</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-light border mb-4">
                                <h6 class="font-weight-bold text-dark mb-1"><i class="fas fa-info-circle mr-1 text-warning"></i>Petunjuk Operasi:</h6>
                                <p class="mb-1 text-sm text-muted">
                                    Fitur ini digunakan untuk mengeluarkan (<em>force logout</em>) seluruh pengguna yang sedang aktif menggunakan sistem (Kasir, Sales, Bagian Gudang, Admin, Akunting, dll).
                                </p>
                                <ul class="mb-0 text-sm text-muted pl-3">
                                    <li>Sesi aktif Anda sebagai <strong>Developer</strong> akan tetap dipertahankan (tidak ikut ter-logout).</li>
                                    <li>Seluruh sesi pengguna lain akan dihapus dari sistem, sehingga ketika mereka melakukan navigasi atau aksi berikutnya, sistem akan mengarahkan mereka untuk login ulang.</li>
                                    <li>Sangat disarankan dieksekusi setelah pembaruan sistem (seperti pembaruan tampilan login, penerapan verifikasi Google reCAPTCHA, atau penyesuaian hak akses menu) agar seluruh pengguna segera memuat konfigurasi terbaru.</li>
                                </ul>
                            </div>

                            <div class="card bg-light border p-3 mb-0">
                                <div class="row align-items-center">
                                    <div class="col-md-8 col-12 mb-md-0 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <span class="btn btn-warning btn-lg disabled" style="cursor: default; opacity: 1;">
                                                    <i class="fas fa-users-slash fa-2x"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <h6 class="font-weight-bold mb-1 text-dark">Keluarkan Seluruh Pengguna Lain</h6>
                                                <p class="text-sm text-muted mb-0">
                                                    Saat ini terdapat <strong class="text-primary font-weight-bold" id="textSesiLainCount">{{ number_format($statistik['sesi_lain'] ?? 0, 0, ',', '.') }}</strong> sesi pengguna lain yang sedang aktif di database.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 text-md-right text-left">
                                        <button type="button" class="btn btn-warning btn-lg font-weight-bold shadow-sm" id="btnForceLogout">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout Semua Pengguna
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modul 3: Mode Pemeliharaan Sistem (Maintenance Mode) -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline {{ $maintenanceInfo['is_active'] ? 'card-danger' : 'card-info' }} shadow-sm" id="cardMaintenance">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-tools mr-2 text-danger"></i>3. Mode Pemeliharaan Sistem (Maintenance Mode)
                            </h3>
                            <div class="card-tools">
                                <span id="badgeMaintenanceStatus" class="badge {{ $maintenanceInfo['is_active'] ? 'badge-danger' : 'badge-success' }}">
                                    {{ $maintenanceInfo['is_active'] ? 'Sedang Maintenance' : 'Sistem Normal / Aktif' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-light border mb-4">
                                <h6 class="font-weight-bold text-dark mb-1"><i class="fas fa-info-circle mr-1 text-info"></i>Petunjuk Operasi:</h6>
                                <p class="mb-1 text-sm text-muted">
                                    Ketika mode maintenance diaktifkan, seluruh pengguna sistem yang sudah login (kecuali Developer) akan dialihkan ke halaman pemeliharaan sistem dengan informasi estimasi waktu selesai.
                                </p>
                                <ul class="mb-0 text-sm text-muted pl-3">
                                    <li>Pengguna Developer (<code>idpengguna: 9999999999</code>) tetap memiliki akses penuh ke seluruh menu untuk melakukan perbaikan.</li>
                                    <li>Pilih estimasi durasi pemeliharaan, sistem otomatis menghitung tanggal & waktu selesai.</li>
                                    <li>Klik tombol <strong>Mulai Maintenance</strong> untuk mengunci akses pengguna.</li>
                                    <li>Setelah proses perbaikan selesai, klik tombol <strong>Maintenance Selesai</strong> untuk membuka kembali akses aplikasi secara normal.</li>
                                </ul>
                            </div>

                            <div class="card bg-light border p-3 mb-0">
                                <div class="row align-items-center">
                                    <div class="col-md-7 col-12 mb-md-0 mb-3">
                                        <div class="form-group mb-2">
                                            <label for="selectDurasiMaintenance" class="font-weight-bold text-sm">
                                                Estimasi Lama Waktu Maintenance:
                                            </label>
                                            <select id="selectDurasiMaintenance" class="form-control" {{ $maintenanceInfo['is_active'] ? 'disabled' : '' }}>
                                                <option value="30">30 Menit</option>
                                                <option value="60" selected>60 Menit</option>
                                                <option value="90">90 Menit</option>
                                                <option value="120">120 Menit</option>
                                                <option value="240">240 Menit</option>
                                                <option value="360">360 Menit</option>
                                                <option value="720">720 Menit</option>
                                                <option value="1440">1440 Menit</option>
                                            </select>
                                        </div>
                                        <div id="infoMaintenanceActive" class="{{ $maintenanceInfo['is_active'] ? '' : 'd-none' }}">
                                            <div class="alert alert-danger mb-0 py-2 px-3 text-sm">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Sistem saat ini sedang dalam status pemeliharaan. Estimasi selesai: 
                                                <strong id="textEstimatedFinished">{{ $maintenanceInfo['estimated_finished'] }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12 text-md-right text-left">
                                        <div id="wrapperBtnMulai" class="{{ $maintenanceInfo['is_active'] ? 'd-none' : '' }}">
                                            <button type="button" class="btn btn-danger btn-lg font-weight-bold shadow-sm" id="btnMulaiMaintenance">
                                                <i class="fas fa-play mr-2"></i>Mulai Maintenance
                                            </button>
                                        </div>
                                        <div id="wrapperBtnSelesai" class="{{ $maintenanceInfo['is_active'] ? '' : 'd-none' }}">
                                            <button type="button" class="btn btn-success btn-lg font-weight-bold shadow-sm" id="btnSelesaiMaintenance">
                                                <i class="fas fa-check-circle mr-2"></i>Maintenance Selesai
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholder untuk Pemeliharaan System Mendatang -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-secondary collapsed-card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title text-muted">
                                <i class="fas fa-cubes mr-2"></i>Modul Pemeliharaan Lainnya
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-muted text-sm">
                            Fitur-fitur pemeliharaan sistem tambahan (seperti pembersihan cache, optimasi database, atau rekonsiliasi modul lainnya) akan dikelompokkan di dalam halaman ini.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {

    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }

    function getNamaBulan(bulan) {
        var namaBulan = [
            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        return namaBulan[parseInt(bulan, 10)] || bulan;
    }

    function updateStatistikGlobal(stat) {
        if (!stat) return;
        $('#statAktifCount').html(formatNumber(stat.aktif_count) + ' <small>baris</small>');
        $('#statArchiveCount').html(formatNumber(stat.archive_count) + ' <small>baris</small>');
        $('#statAktifMin').text(stat.aktif_min_date);
        $('#statAktifMax').text(stat.aktif_max_date);
        $('#statArchiveMin').text(stat.archive_min_date);
        $('#statArchiveMax').text(stat.archive_max_date);
        if (stat.total_sesi !== undefined) {
            $('#statSesiTotal').text(formatNumber(stat.total_sesi));
        }
        if (stat.sesi_lain !== undefined) {
            $('#statSesiLain').text(formatNumber(stat.sesi_lain));
            $('#textSesiLainCount').text(formatNumber(stat.sesi_lain));
        }
    }

    function loadStatusPeriode(callback) {
        var periode = $('#filterPeriode').val();

        $('#badgeStatusSiap').removeClass('badge-success badge-warning badge-secondary badge-danger')
            .addClass('badge-secondary').html('<i class="fas fa-spinner fa-spin mr-1"></i>Memeriksa data...');

        $.ajax({
            url: "{{ route('pemeliharaansystem.cekStatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                periode: periode
            },
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    var d = res.data;
                    $('#labelPeriode').text(d.periode_label);
                    $('#spanCutoffDate').text(d.cutoff_formatted);
                    $('#valTotalRiwayat').text(formatNumber(d.total_riwayat));
                    $('#valSudahDiarsipkan').text(formatNumber(d.sudah_diarsipkan));
                    $('#valBelumDiarsipkan').text(formatNumber(d.belum_diarsipkan));
                    $('#valSisaAktif').text(formatNumber(d.sisa_aktif_tersimpan));

                    if (d.total_riwayat === 0) {
                        $('#badgeStatusSiap').removeClass('badge-secondary badge-warning badge-success badge-danger')
                            .addClass('badge-secondary').text('Tidak Ada Data Diarsip');
                    } else if (d.belum_diarsipkan > 0) {
                        $('#badgeStatusSiap').removeClass('badge-secondary badge-warning badge-success badge-danger')
                            .addClass('badge-warning').text(formatNumber(d.belum_diarsipkan) + ' Data Siap Diarsip');
                    } else {
                        $('#badgeStatusSiap').removeClass('badge-secondary badge-warning badge-success badge-danger')
                            .addClass('badge-success').text(formatNumber(d.sudah_diarsipkan) + ' Data Siap Dibersihkan');
                    }

                    if (res.statistik) {
                        updateStatistikGlobal(res.statistik);
                    }

                    if (typeof callback === 'function') {
                        callback(d);
                    }
                }
            },
            error: function(xhr) {
                $('#badgeStatusSiap').removeClass('badge-secondary')
                    .addClass('badge-danger').text('Gagal Mengecek Data');
                console.error("Gagal mengecek status periode:", xhr.responseText);
            }
        });
    }

    // Auto-load status saat pertama buka dan saat filter berganti
    loadStatusPeriode();
    $('#filterPeriode').on('change', function() {
        loadStatusPeriode();
    });

    $('#btnCekStatus').on('click', function() {
        loadStatusPeriode(function(d) {
            swal({
                title: "Ringkasan " + d.periode_label,
                text: "Batas tanggal: sebelum " + d.cutoff_formatted + "\n" +
                    "• Data riwayat yang akan diarsip: " + formatNumber(d.total_riwayat) + " baris\n" +
                    "• Data belum diarsipkan: " + formatNumber(d.belum_diarsipkan) + " baris\n" +
                    "• Data tetap disimpan di tabel aktif: " + formatNumber(d.sisa_aktif_tersimpan) + " baris",
                icon: "info",
                button: "OK"
            });
        });
    });

    // Tombol Archive Riwayat Aktifitas
    $('#btnArchive').on('click', function(e) {
        e.preventDefault();

        var periode = $('#filterPeriode').val();

        // Cek dulu data di frontend sebelum konfirmasi
        loadStatusPeriode(function(dataPeriode) {
            if (dataPeriode.total_riwayat === 0) {
                swal({
                    title: "Tidak Ada Data",
                    text: "Tidak ada data riwayat aktifitas pada periode " + dataPeriode.periode_label + " (sebelum " + dataPeriode.cutoff_formatted + ") yang perlu diarsipkan.",
                    icon: "info",
                    button: "OK"
                });
                return;
            }

            var confirmMsg = "Apakah Anda yakin ingin memindahkan riwayat aktifitas periode " + dataPeriode.periode_label + " ke arsip?\n\n" +
                "• Batas tanggal arsip: sebelum " + dataPeriode.cutoff_formatted + "\n" +
                "• Total data riwayat yang akan diproses: " + formatNumber(dataPeriode.total_riwayat) + " baris\n" +
                "• Data baru akan disalin ke arsip: " + formatNumber(dataPeriode.belum_diarsipkan) + " baris\n" +
                "• Data yang telah berada di arsip akan dibersihkan dari tabel riwayat aktifitas\n" +
                "• Data yang tetap tersimpan di tabel aktif: " + formatNumber(dataPeriode.sisa_aktif_tersimpan) + " baris";

            swal({
                title: "Konfirmasi Arsip",
                text: confirmMsg,
                icon: "warning",
                buttons: ["Batal", "Ya, Lanjutkan"],
                dangerMode: true,
            }).then((willProceed) => {
                if (willProceed) {
                    var $btn = $('#btnArchive');
                    var origHtml = $btn.html();
                    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Memproses Arsip...');

                    $.ajax({
                        url: "{{ route('pemeliharaansystem.archiveRiwayatAktifitas') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            periode: periode
                        },
                        dataType: "json",
                        success: function(res) {
                            $btn.prop('disabled', false).html(origHtml);

                            if (res.status === 'success') {
                                swal({
                                    title: "Berhasil!",
                                    text: res.message,
                                    icon: "success",
                                    button: "OK"
                                });

                                if (res.statistik) {
                                    updateStatistikGlobal(res.statistik);
                                }
                                if (res.status_periode) {
                                    var d = res.status_periode;
                                    $('#labelPeriode').text(d.periode_label);
                                    $('#spanCutoffDate').text(d.cutoff_formatted);
                                    $('#valTotalRiwayat').text(formatNumber(d.total_riwayat));
                                    $('#valSudahDiarsipkan').text(formatNumber(d.sudah_diarsipkan));
                                    $('#valBelumDiarsipkan').text(formatNumber(d.belum_diarsipkan));
                                    $('#valSisaAktif').text(formatNumber(d.sisa_aktif_tersimpan));
                                    $('#badgeStatusSiap').removeClass('badge-secondary badge-warning badge-danger')
                                        .addClass('badge-success').text('Selesai Dipindahkan');
                                } else {
                                    loadStatusPeriode();
                                }
                            } else if (res.status === 'warning') {
                                swal({
                                    title: "Perhatian",
                                    text: res.message,
                                    icon: "warning",
                                    button: "OK"
                                });
                            } else {
                                swal({
                                    title: "Gagal!",
                                    text: res.message || "Terjadi kesalahan saat memproses arsip.",
                                    icon: "error",
                                    button: "OK"
                                });
                            }
                        },
                        error: function(xhr) {
                            $btn.prop('disabled', false).html(origHtml);
                            var errDetail = "Terjadi kesalahan pada server.";
                            try {
                                var parsed = JSON.parse(xhr.responseText);
                                if (parsed && parsed.message) {
                                    errDetail = parsed.message;
                                }
                            } catch(e) {}
                            swal({
                                title: "Error Server",
                                text: errDetail,
                                icon: "error",
                                button: "OK"
                            });
                        }
                    });
                }
            });
        });
    });

    // Tombol Force Logout Semua Pengguna
    $('#btnForceLogout').on('click', function(e) {
        e.preventDefault();

        swal({
            title: "Konfirmasi Logout Semua Pengguna",
            text: "Apakah Anda yakin ingin mengeluarkan (force logout) seluruh pengguna lain dari sistem?\n\n" +
                "• Sesi Anda sebagai developer TETAP AKTIF.\n" +
                "• Seluruh sesi pengguna lain akan dihapus dari sistem.\n" +
                "• Seluruh pengguna lain wajib memasukkan username, password, dan verifikasi reCAPTCHA baru untuk masuk kembali.",
            icon: "warning",
            buttons: ["Batal", "Ya, Keluarkan Semua!"],
            dangerMode: true,
        }).then((willProceed) => {
            if (willProceed) {
                var $btn = $('#btnForceLogout');
                var origHtml = $btn.html();
                $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Memproses Logout...');

                $.ajax({
                    url: "{{ route('pemeliharaansystem.logoutSemuaPengguna') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(res) {
                        $btn.prop('disabled', false).html(origHtml);

                        if (res.status === 'success') {
                            swal({
                                title: "Berhasil!",
                                text: res.message,
                                icon: "success",
                                button: "OK"
                            });

                            if (res.statistik) {
                                updateStatistikGlobal(res.statistik);
                            }
                        } else {
                            swal({
                                title: "Gagal!",
                                text: res.message || "Terjadi kesalahan saat memproses logout pengguna.",
                                icon: "error",
                                button: "OK"
                            });
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html(origHtml);
                        var errDetail = "Terjadi kesalahan pada server.";
                        try {
                            var parsed = JSON.parse(xhr.responseText);
                            if (parsed && parsed.message) {
                                errDetail = parsed.message;
                            }
                        } catch(e) {}
                        swal({
                            title: "Error Server",
                            text: errDetail,
                            icon: "error",
                            button: "OK"
                        });
                    }
                });
            }
        });
    });

    // Tombol Mulai Maintenance
    $('#btnMulaiMaintenance').on('click', function(e) {
        e.preventDefault();

        var durasi = $('#selectDurasiMaintenance').val();
        var durasiText = $('#selectDurasiMaintenance option:selected').text();

        swal({
            title: "Konfirmasi Maintenance",
            text: "Apakah akan mulai maintenance?\n\nDurasi estimasi: " + durasiText + ".\nSeluruh pengguna yang sedang login akan diarahkan ke halaman maintenance.",
            icon: "warning",
            buttons: ["Batal", "Ya, Mulai Maintenance!"],
            dangerMode: true,
        }).then((willProceed) => {
            if (willProceed) {
                var $btn = $('#btnMulaiMaintenance');
                var origHtml = $btn.html();
                $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...');

                $.ajax({
                    url: "{{ route('pemeliharaansystem.mulaiMaintenance') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        durasi: durasi
                    },
                    dataType: "json",
                    success: function(res) {
                        $btn.prop('disabled', false).html(origHtml);

                        if (res.status === 'success') {
                            swal({
                                title: "Berhasil!",
                                text: res.message,
                                icon: "success",
                                button: "OK"
                            });

                            // Update tampilan ke status maintenance aktif
                            $('#cardMaintenance').removeClass('card-info').addClass('card-danger');
                            $('#badgeMaintenanceStatus').removeClass('badge-success').addClass('badge-danger').text('Sedang Maintenance');
                            $('#selectDurasiMaintenance').prop('disabled', true);
                            $('#textEstimatedFinished').text(res.estimated_finished);
                            $('#infoMaintenanceActive').removeClass('d-none');
                            $('#wrapperBtnMulai').addClass('d-none');
                            $('#wrapperBtnSelesai').removeClass('d-none');
                        } else {
                            swal({
                                title: "Gagal!",
                                text: res.message || "Terjadi kesalahan saat mengaktifkan maintenance.",
                                icon: "error",
                                button: "OK"
                            });
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html(origHtml);
                        var errDetail = "Terjadi kesalahan pada server.";
                        try {
                            var parsed = JSON.parse(xhr.responseText);
                            if (parsed && parsed.message) {
                                errDetail = parsed.message;
                            }
                        } catch(e) {}
                        swal({
                            title: "Error Server",
                            text: errDetail,
                            icon: "error",
                            button: "OK"
                        });
                    }
                });
            }
        });
    });

    // Tombol Maintenance Selesai
    $('#btnSelesaiMaintenance').on('click', function(e) {
        e.preventDefault();

        swal({
            title: "Konfirmasi Selesai",
            text: "Apakah maintenance sudah selesai?\n\nSistem akan kembali normal dan seluruh pengguna dapat mengakses modul aplikasi.",
            icon: "warning",
            buttons: ["Batal", "Ya, Selesai!"],
            dangerMode: false,
        }).then((willProceed) => {
            if (willProceed) {
                var $btn = $('#btnSelesaiMaintenance');
                var origHtml = $btn.html();
                $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Memproses...');

                $.ajax({
                    url: "{{ route('pemeliharaansystem.selesaiMaintenance') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(res) {
                        $btn.prop('disabled', false).html(origHtml);

                        if (res.status === 'success') {
                            swal({
                                title: "Berhasil!",
                                text: res.message,
                                icon: "success",
                                button: "OK"
                            });

                            // Update tampilan ke status normal
                            $('#cardMaintenance').removeClass('card-danger').addClass('card-info');
                            $('#badgeMaintenanceStatus').removeClass('badge-danger').addClass('badge-success').text('Sistem Normal / Aktif');
                            $('#selectDurasiMaintenance').prop('disabled', false);
                            $('#infoMaintenanceActive').addClass('d-none');
                            $('#wrapperBtnSelesai').addClass('d-none');
                            $('#wrapperBtnMulai').removeClass('d-none');
                        } else {
                            swal({
                                title: "Gagal!",
                                text: res.message || "Terjadi kesalahan saat menonaktifkan maintenance.",
                                icon: "error",
                                button: "OK"
                            });
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html(origHtml);
                        var errDetail = "Terjadi kesalahan pada server.";
                        try {
                            var parsed = JSON.parse(xhr.responseText);
                            if (parsed && parsed.message) {
                                errDetail = parsed.message;
                            }
                        } catch(e) {}
                        swal({
                            title: "Error Server",
                            text: errDetail,
                            icon: "error",
                            button: "OK"
                        });
                    }
                });
            }
        });
    });

});
</script>
@endsection
