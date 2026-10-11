@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Stok FIFO</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan Stok FIFO</li>
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
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title font-weight-bold"><i class="fas fa-layer-group mr-1"></i>Laporan Stok FIFO</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="" class="col-12 font-weight-bold">Range Tanggal Masuk</label>
                                        <div class="col-12 form-group row">
                                            <div class="col-md-5">
                                                <input type="date" name="tglawal" id="tglawal" class="form-control"
                                                    value="{{ date('Y-m-01') }}">
                                            </div>
                                            <div class="col-md-2 text-center pt-2">
                                                <span>s/d</span>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="date" name="tglakhir" id="tglakhir" class="form-control"
                                                    value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="idbarang" class="font-weight-bold">Nama Barang</label>
                                        <select name="idbarang" id="idbarang" class="form-control searchBarang">
                                            <option value="">-- Semua Barang --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="d-none d-md-block">&nbsp;</label>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-sm" id="btnFilter">
                                                <i class="fa fa-filter mr-1"></i> Filter
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-sm" id="btnReset">
                                                <i class="fa fa-undo mr-1"></i> Reset
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm" id="btnCetakExcel">
                                                <i class="fa fa-file-excel mr-1"></i> Excel
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" id="btnCetakPdf">
                                                <i class="fa fa-file-pdf mr-1"></i> PDF
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="tableList" style="width: 100%;">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 4%; text-align: center;">No</th>
                                                    <th style="width: 7%; text-align: center;">ID FIFO</th>
                                                    <th style="width: 7%; text-align: center;">Tgl Masuk</th>
                                                    <th style="width: 10%; text-align: center;">No Transaksi</th>
                                                    <th style="width: 8%; text-align: center;">Jenis</th>
                                                    <th style="text-align: left;">Nama Barang</th>
                                                    <th style="width: 5%; text-align: center;">Satuan</th>
                                                    <th style="width: 6%; text-align: right;">Masuk</th>
                                                    <th style="width: 6%; text-align: right;">Terpakai</th>
                                                    <th style="width: 6%; text-align: right;">Sisa</th>
                                                    <th style="width: 8%; text-align: right;">Nilai HPP</th>
                                                    <th style="width: 9%; text-align: right;">Total Sisa</th>
                                                    <th style="width: 12%; text-align: left;">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
    </div>
</div>
@endsection

@section('scripts')
<script>
    var table;

    $(document).ready(function() {

        table = $('#tableList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('lapstokfifo.listdata') }}",
                type: 'GET',
                data: function(d) {
                    d.tglawal = $('#tglawal').val();
                    d.tglakhir = $('#tglakhir').val();
                    d.idbarang = $('#idbarang').val();
                }
            },
            pageLength: 25,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            columns: [
                {
                    data: 'no',
                    name: 'no',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'idstokfifo',
                    name: 'sf.idstokfifo',
                    className: 'text-center',
                },
                {
                    data: 'tglmasuk',
                    name: 'sf.tglmasuk',
                    className: 'text-center',
                },
                {
                    data: 'idtransaksi',
                    name: 'sf.idtransaksi',
                    className: 'text-center',
                },
                {
                    data: 'jenistransaksi',
                    name: 'sf.jenistransaksi',
                    className: 'text-center',
                },
                {
                    data: 'namabarang',
                    name: 'b.namabarang',
                },
                {
                    data: 'namasatuan',
                    name: 's.namasatuan',
                    className: 'text-center',
                },
                {
                    data: 'jumlahmasuk',
                    name: 'sf.jumlahmasuk',
                    className: 'text-right',
                },
                {
                    data: 'jumlahterpakai',
                    name: 'jumlahterpakai',
                    className: 'text-right',
                },
                {
                    data: 'jumlahsisa',
                    name: 'sf.jumlahsisa',
                    className: 'text-right',
                },
                {
                    data: 'nilaihpp',
                    name: 'sf.nilaihpp',
                    className: 'text-right',
                },
                {
                    data: 'totalsisa',
                    name: 'totalsisa',
                    className: 'text-right',
                },
                {
                    data: 'keterangan',
                    name: 'sf.keterangan',
                },
            ],
            language: {
                info: "Menampilkan _START_ s/d _END_ dari _TOTAL_ entri",
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                emptyTable: "Tidak ada data yang tersedia",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                loadingRecords: "Memuat...",
                processing: "Sedang memproses...",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });

        $('#idbarang').on('change', function() {
            table.ajax.reload();
        });

        $('#tglawal, #tglakhir').on('change', function() {
            table.ajax.reload();
        });

        $('#btnFilter').click(function() {
            table.ajax.reload();
        });

        $('#btnReset').click(function() {
            $('#tglawal').val("{{ date('Y-m-01') }}");
            $('#tglakhir').val("{{ date('Y-m-d') }}");
            $('#idbarang').val(null).trigger('change');
            table.ajax.reload();
        });

        $('#btnCetakExcel').click(function() {
            cetak('excel');
        });

        $('#btnCetakPdf').click(function() {
            cetak('pdf');
        });
    });

    function cetak(jenis) {
        var tglawal = $('#tglawal').val() || '';
        var tglakhir = $('#tglakhir').val() || '';
        var idbarang = $('#idbarang').val() || '';

        var url = "{{ url('lapstokfifo/cetak') }}/" + jenis + "?tglawal=" + encodeURIComponent(tglawal) + "&tglakhir=" + encodeURIComponent(tglakhir) + "&idbarang=" + encodeURIComponent(idbarang);
        window.open(url, '_blank');
    }
</script>
@endsection
