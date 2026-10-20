@extends('template/layout')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekonsiliasi Stok</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Rekonsiliasi Stok</li>
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
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold"><i class="fas fa-balance-scale mr-1"></i>Rekonsiliasi Selisih Stok (Riwayat Stok vs Stok FIFO)</h3>
                                <span class="badge badge-warning p-2">Barang Selisih: <span id="spanCount">0</span></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label class="font-weight-bold">Filter Barang (Opsional):</label>
                                    <select id="selBarang" class="form-control searchBarang">
                                        <option value="">-- Semua Barang (yang selisih) --</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button id="btnHitung" class="btn btn-primary mr-2">
                                        <i class="fa fa-calculator mr-1"></i>Hitung Selisih
                                    </button>
                                    <button id="btnResetFilter" class="btn btn-secondary">
                                        <i class="fa fa-undo mr-1"></i>Reset
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tblSelisih" class="table table-sm table-bordered table-striped" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%; text-align: center;">No</th>
                                            <th style="width: 10%;">ID Barang</th>
                                            <th style="width: 12%;">Kode</th>
                                            <th>Nama Barang</th>
                                            <th style="width: 10%; text-align: right;">Stok Riwayat</th>
                                            <th style="width: 10%; text-align: right;">Stok FIFO</th>
                                            <th style="width: 10%; text-align: right;">Selisih</th>
                                            <th style="width: 12%; text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Klik tombol "Hitung Selisih" untuk menampilkan data.</td>
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

<!-- Modal Identifikasi -->
<div class="modal fade" id="modalIdentifikasi" tabindex="-1" role="dialog" aria-labelledby="modalIdentifikasiLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalIdentifikasiLabel"><i class="fa fa-search mr-1"></i> Identifikasi Transaksi Hilang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalIdentifikasiBody">
                <!-- Konten dinamis -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(function(){

    // Reset filter
    $('#btnResetFilter').on('click', function(){
        $('#selBarang').val(null).trigger('change');
    });

    // Tombol Hitung Selisih
    $('#btnHitung').on('click', function(){
        var btn = $(this);
        var idbarang = $('#selBarang').val();
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i>Menghitung...');

        $.ajax({
            url: '{{ route("rekonsiliasiStok.hitungSelisih") }}',
            type: 'POST',
            data: { 
                idbarang: idbarang,
                _token: '{{ csrf_token() }}' 
            },
            success: function(res){
                var tbody = $('#tblSelisih tbody').empty();
                if(res.status === 'success' && res.data.length > 0){
                    $.each(res.data, function(i, row){
                        var selisihClass = row.selisih > 0 ? 'text-danger font-weight-bold' : 'text-primary font-weight-bold';
                        tbody.append(
                            '<tr>' +
                                '<td>' + (i+1) + '</td>' +
                                '<td>' + row.idbarang + '</td>' +
                                '<td>' + row.kdbarang + '</td>' +
                                '<td>' + row.namabarang + '</td>' +
                                '<td class="text-right">' + row.stok_riwayat + '</td>' +
                                '<td class="text-right">' + row.stok_fifo + '</td>' +
                                '<td class="text-right ' + selisihClass + '">' + row.selisih + '</td>' +
                                '<td class="text-center"><button class="btn btn-xs btn-info btn-ident" data-id="' + row.idbarang + '" data-nama="' + row.namabarang + '"><i class="fa fa-search mr-1"></i>Identifikasi</button></td>' +
                            '</tr>'
                        );
                    });
                    $('#spanCount').text(res.data.length);
                } else {
                    tbody.append('<tr><td colspan="8" class="text-center text-success">Tidak ada selisih stok.</td></tr>');
                    $('#spanCount').text('0');
                }
            },
            error: function(){
                swal('Error', 'Gagal menghitung selisih stok.', 'error');
            },
            complete: function(){
                btn.prop('disabled', false).html('<i class="fa fa-calculator mr-1"></i>Hitung Selisih');
            }
        });
    });

    // Identifikasi transaksi hilang
    $('#tblSelisih').on('click', '.btn-ident', function(){
        var idbarang = $(this).data('id');
        var namabarang = $(this).data('nama');

        $('#modalIdentifikasiLabel').html('<i class="fa fa-search mr-1"></i> Identifikasi Transaksi Hilang: <strong>' + namabarang + ' (' + idbarang + ')</strong>');
        $('#modalIdentifikasiBody').html('<div class="text-center py-4"><i class="fa fa-spinner fa-spin fa-2x"></i><p class="mt-2">Mengidentifikasi transaksi...</p></div>');
        $('#modalIdentifikasi').modal('show');

        $.ajax({
            url: '{{ route("rekonsiliasiStok.identifikasiTransaksi") }}',
            type: 'POST',
            data: { idbarang: idbarang, _token: '{{ csrf_token() }}' },
            success: function(res){
                if(res.status !== 'success') {
                    $('#modalIdentifikasiBody').html('<div class="alert alert-danger">Gagal mengambil data identifikasi.</div>');
                    return;
                }

                var html = '';

                // Masuk yang belum ada FIFO
                html += '<div class="card mb-3"><div class="card-header bg-light py-2"><h6 class="mb-0 text-primary font-weight-bold"><i class="fa fa-arrow-down mr-1"></i>Transaksi Masuk (Riwayat) Belum Memiliki Layer FIFO <span class="badge badge-primary float-right">' + res.masuk_riwayat.length + ' transaksi</span></h6></div><div class="card-body p-0">';
                if(res.masuk_riwayat.length > 0){
                    html += '<div class="table-responsive"><table class="table table-sm table-bordered mb-0"><thead class="thead-light"><tr><th>ID Riwayat</th><th>ID Transaksi</th><th>Jenis</th><th>Tgl Transaksi</th><th class="text-right">Jumlah</th><th class="text-center">Aksi</th></tr></thead><tbody>';
                    $.each(res.masuk_riwayat, function(i, it){
                        html += '<tr><td>' + it.idriwayat + '</td><td>' + it.idtransaksi + '</td><td>' + it.jenistransaksi + '</td><td>' + it.tgltransaksi + '</td><td class="text-right">' + it.jumlah + '</td>';
                        html += '<td class="text-center"><button class="btn btn-xs btn-success btn-insert-fifo" data-idbarang="' + idbarang + '" data-idtransaksi="' + it.idtransaksi + '" data-jenis="' + it.jenistransaksi + '" data-tgl="' + it.tgltransaksi + '" data-jumlah="' + it.jumlah + '"><i class="fa fa-plus mr-1"></i>Insert Layer FIFO</button></td></tr>';
                    });
                    html += '</tbody></table></div>';
                } else {
                    html += '<p class="text-muted p-2 mb-0">Tidak ada selisih di sisi transaksi masuk.</p>';
                }
                html += '</div></div>';

                // Keluar yang belum ada FIFO detail
                html += '<div class="card mb-3"><div class="card-header bg-light py-2"><h6 class="mb-0 text-warning font-weight-bold"><i class="fa fa-arrow-up mr-1"></i>Transaksi Keluar (Riwayat) Belum Mengurangi FIFO <span class="badge badge-warning float-right">' + res.keluar_riwayat.length + ' transaksi</span></h6></div><div class="card-body p-0">';
                if(res.keluar_riwayat.length > 0){
                    html += '<div class="table-responsive"><table class="table table-sm table-bordered mb-0"><thead class="thead-light"><tr><th>ID Riwayat</th><th>ID Transaksi</th><th>Jenis</th><th>Tgl Transaksi</th><th class="text-right">Jumlah</th><th class="text-center">Aksi</th></tr></thead><tbody>';
                    $.each(res.keluar_riwayat, function(i, it){
                        html += '<tr><td>' + it.idriwayat + '</td><td>' + it.idtransaksi + '</td><td>' + it.jenistransaksi + '</td><td>' + it.tgltransaksi + '</td><td class="text-right">' + it.jumlah + '</td>';
                        html += '<td class="text-center"><button class="btn btn-xs btn-warning btn-keluar-fifo" data-idbarang="' + idbarang + '" data-idtransaksi="' + it.idtransaksi + '" data-jenis="' + it.jenistransaksi + '" data-jumlah="' + it.jumlah + '"><i class="fa fa-minus mr-1"></i>Proses Keluar FIFO</button></td></tr>';
                    });
                    html += '</tbody></table></div>';
                } else {
                    html += '<p class="text-muted p-2 mb-0">Tidak ada selisih di sisi transaksi keluar.</p>';
                }
                html += '</div></div>';

                // Orphan FIFO
                html += '<div class="card mb-3"><div class="card-header bg-light py-2"><h6 class="mb-0 text-danger font-weight-bold"><i class="fa fa-trash mr-1"></i>Layer FIFO Tanpa Riwayat Transaksi (Orphan) <span class="badge badge-danger float-right">' + res.orphan_fifo.length + ' layer</span></h6></div><div class="card-body p-0">';
                if(res.orphan_fifo.length > 0){
                    html += '<div class="table-responsive"><table class="table table-sm table-bordered mb-0"><thead class="thead-light"><tr><th>ID FIFO</th><th>ID Transaksi</th><th>Jenis</th><th>Tgl Masuk</th><th class="text-right">Masuk</th><th class="text-right">Sisa</th><th class="text-center">Aksi</th></tr></thead><tbody>';
                    $.each(res.orphan_fifo, function(i, it){
                        html += '<tr><td>' + it.idstokfifo + '</td><td>' + it.idtransaksi + '</td><td>' + it.jenistransaksi + '</td><td>' + it.tglmasuk + '</td><td class="text-right">' + it.jumlahmasuk + '</td><td class="text-right">' + it.jumlahsisa + '</td>';
                        html += '<td class="text-center"><button class="btn btn-xs btn-danger btn-hapus-fifo" data-idstokfifo="' + it.idstokfifo + '"><i class="fa fa-trash mr-1"></i>Hapus Layer</button></td></tr>';
                    });
                    html += '</tbody></table></div>';
                } else {
                    html += '<p class="text-muted p-2 mb-0">Tidak ada layer FIFO orphan.</p>';
                }
                html += '</div></div>';

                $('#modalIdentifikasiBody').html(html);
                bindActionButtons(idbarang);
            },
            error: function(){
                $('#modalIdentifikasiBody').html('<div class="alert alert-danger">Terjadi kesalahan pada server saat mengambil identifikasi.</div>');
            }
        });
    });

    function bindActionButtons(idbarang){
        // Insert layer FIFO
        $(document).off('click', '.btn-insert-fifo').on('click', '.btn-insert-fifo', function(){
            var btn = $(this);
            var data = {
                _token: '{{ csrf_token() }}',
                idbarang: btn.data('idbarang'),
                idtransaksi: btn.data('idtransaksi'),
                jenistransaksi: btn.data('jenis'),
                tgl: btn.data('tgl'),
                jumlah: btn.data('jumlah')
            };
            btn.prop('disabled', true);
            $.post('{{ route("rekonsiliasiStok.insertLayerFifo") }}', data, function(res){
                if(res.status === 'success'){
                    btn.closest('tr').addClass('table-success');
                    btn.html('<i class="fa fa-check"></i> Berhasil Ditambahkan');
                    swal('Berhasil', res.message, 'success');
                    $('#btnHitung').trigger('click');
                } else {
                    btn.prop('disabled', false);
                    swal('Gagal', res.message, 'error');
                }
            }).fail(function(xhr){
                btn.prop('disabled', false);
                swal('Gagal', xhr.responseJSON ? xhr.responseJSON.message : 'Error', 'error');
            });
        });

        // Proses keluar FIFO
        $(document).off('click', '.btn-keluar-fifo').on('click', '.btn-keluar-fifo', function(){
            var btn = $(this);
            var data = {
                _token: '{{ csrf_token() }}',
                idbarang: btn.data('idbarang'),
                idtransaksi: btn.data('idtransaksi'),
                jenistransaksi: btn.data('jenis'),
                jumlah: btn.data('jumlah')
            };
            btn.prop('disabled', true);
            $.post('{{ route("rekonsiliasiStok.keluarLayerFifo") }}', data, function(res){
                if(res.status === 'success'){
                    btn.closest('tr').addClass('table-warning');
                    btn.html('<i class="fa fa-check"></i> Berhasil Dikeluarkan');
                    swal('Berhasil', res.message, 'success');
                    $('#btnHitung').trigger('click');
                } else {
                    btn.prop('disabled', false);
                    swal('Gagal', res.message, 'error');
                }
            }).fail(function(xhr){
                btn.prop('disabled', false);
                swal('Gagal', xhr.responseJSON ? xhr.responseJSON.message : 'Error', 'error');
            });
        });

        // Hapus layer orphan
        $(document).off('click', '.btn-hapus-fifo').on('click', '.btn-hapus-fifo', function(){
            var btn = $(this);
            var idstokfifo = btn.data('idstokfifo');

            swal({
                title: "Yakin Hapus?",
                text: "Layer FIFO " + idstokfifo + " akan dihapus permanen!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: false
            }, function(isConfirm){
                if (isConfirm) {
                    btn.prop('disabled', true);
                    $.post('{{ route("rekonsiliasiStok.hapusLayerFifo") }}', {
                        idstokfifo: idstokfifo,
                        _token: '{{ csrf_token() }}'
                    }, function(res){
                        if(res.status === 'success'){
                            btn.closest('tr').addClass('table-danger');
                            btn.html('<i class="fa fa-check"></i> Terhapus');
                            swal('Berhasil', res.message, 'success');
                            $('#btnHitung').trigger('click');
                        } else {
                            btn.prop('disabled', false);
                            swal('Gagal', res.message, 'error');
                        }
                    }).fail(function(xhr){
                        btn.prop('disabled', false);
                        swal('Gagal', xhr.responseJSON ? xhr.responseJSON.message : 'Error', 'error');
                    });
                }
            });
        });
    }

});
</script>
@endsection
