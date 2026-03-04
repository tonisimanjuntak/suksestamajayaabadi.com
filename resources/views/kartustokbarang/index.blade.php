@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kartu Stok Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kartu Stok Barang</li>
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
                                <h3 class="card-title font-weight-bold"><i class="far fa-list-alt mr-1"></i>Kartu Stok
                                    Barang</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="" class="col-12">Tanggal</label>
                                        <div class="col-12 from-group row">
                                            <div class="col-md-5">
                                                <input type="date" name="tglawal" id="tglawal" class="form-control"
                                                    value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="col-12">S/D</label>
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
                                        <label for="">Nama Barang</label>
                                        <select name="idbarang" id="idbarang"
                                            class="form-control searchBarang"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 row">
                                    <div class="col-12 mt-4">
                                        <button class="btn btn-sm btn-success" id="btnCetakExcel"><i
                                                class="fa fa-file-excel"></i> Cetak Excel</button>
                                        <button class="btn btn-sm btn-danger" id="btnCetakPdf"><i
                                                class="fa fa-file-pdf"></i> Cetak PDF</button>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <table class="table table-bordered" id="tableList">
                                        <thead class="">
                                            <tr>
                                                <th style="width: 10%; text-align: center;">Tanggal</th>
                                                <th style="width: 10%; text-align: center;">Kode Barang</th>
                                                <th style="text-align: left;">Nama Barang</th>
                                                <th style="width: 10%; text-align: center;">Awal</th>
                                                <th style="width: 10%; text-align: center;">In</th>
                                                <th style="width: 10%; text-align: center;">Out</th>
                                                <th style="width: 10%; text-align: center;">Akhir</th>
                                                <th style="width: 15%; text-align: center;">Keterangan</th>
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
@endsection

@section('scripts')

<script>
    var table;

    $(document).ready(function() {

        table = $('#tableList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('kartustokbarang.listdata') }}",
                type: 'GET',
                data: function(d) {
                    d.tglawal = $('#tglawal').val();
                    d.tglakhir = $('#tglakhir').val();
                    d.idbarang = $('#idbarang').val();
                }
            },
            pageLength: 50, // Jumlah data per halaman
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ], // Opsi jumlah data per halaman
            columns: [
                {
                    data: 'tglriwayat',
                    name: 'tglriwayat',
                    className: 'dt-body-center',
                    orderable: false,
                },
                {
                    data: 'kdbarang',
                    name: 'kdbarang',
                    orderable: false,
                },
                {
                    data: 'namabarang',
                    name: 'namabarang',
                    orderable: false,
                },
                {
                    data: 'stokawal',
                    name: 'stokawal',
                    className: 'dt-body-center',
                    orderable: false,
                },
                {
                    data: 'stokmasuk',
                    name: 'stokmasuk',
                    className: 'dt-body-center',
                    orderable: false,
                },
                {
                    data: 'stokkeluar',
                    name: 'stokkeluar',
                    className: 'dt-body-center',
                    orderable: false,
                },
                {
                    data: 'stokakhir',
                    name: 'stokakhir',
                    className: 'dt-body-center',
                    orderable: false,
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi',
                    orderable: false,
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
        $('#tglawal').on('change', function() {
            table.ajax.reload();
        });
        $('#tglakhir').on('change', function() {
            table.ajax.reload();
        });

    });


    $('#btnCetakExcel').click(function() {
            cetak('excel');
        });

        $('#btnCetakPdf').click(function() {
            cetak('pdf');
        });

        function cetak(jenis)
        {
            var idbarang = $('#idbarang').val();
            var tglawal = $('#tglawal').val();
            var tglakhir = $('#tglakhir').val();

            if (idbarang == null) {
                swal("Informasi", "Barang belum dipilih!", "info");
                return;
            }   

            if (tglawal === '' || tglakhir === '') {
                swal("Informasi", "Tanggal periode belum dipilih!", "info");
                return;
            }

            window.open("{{ url('kartustokbarang/cetak') }}" + "/" + jenis + "/" + idbarang + "/" + tglawal + "/" + tglakhir);             
        }
</script>

@endsection