@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Persediaan Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan Persediaan Barang</li>
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
                                <h3 class="card-title font-weight-bold"><i class="far fa-list-alt mr-1"></i>Laporan
                                    Persediaan Barang</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-2"></div>
                                        <label for="" class="col-md-2">Kategori</label>
                                        <div class="col-md-3">
                                            <select name="idkategori" id="idkategori" class="form-control searchKategori"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <button class="btn btn-sm btn-success" id="btnCetakExcel"><i class="fa fa-file-excel"></i> Cetak Excel</button>
                                            <button class="btn btn-sm btn-danger" id="btnCetakPdf"><i class="fa fa-file-pdf"></i> Cetak PDF</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <table class="table table-bordered" id="tableList">
                                        <thead class="">
                                            <tr>
                                                <th style="width: 5%; text-align: center;">No</th>
                                                <th style="width: 15%; text-align: center;">ID Barang</th>
                                                <th style="text-align: left;">Nama Barang</th>
                                                <th style="text-align: left;">Kategori</th>
                                                <th style="width: 15%; text-align: center;">Harga Beli</th>
                                                <th style="width: 15%; text-align: center;">Harga Jual</th>
                                                <th style="width: 10%; text-align: center;">Stok</th>
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
                url: "{{ route('lappersediaan.listdata') }}",
                type: 'GET',
                data: function(d) {
                    d.idkategori = $('#idkategori').val();
                }
            },
            pageLength: 50, // Jumlah data per halaman
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ], // Opsi jumlah data per halaman
            columns: [{
                    data: 'no',
                    name: 'no',
                    className: 'dt-body-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'idbarang',
                    name: 'idbarang',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namabarang',
                    name: 'namabarang',
                    orderable: true,
                },
                {
                    data: 'namakategori',
                    name: 'namakategori',
                    orderable: true,
                },
                {
                    data: 'hargabeli',
                    name: 'hargabeli',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'hargajualdiskon',
                    name: 'hargajualdiskon',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'stok',
                    name: 'stok',
                    className: 'dt-body-center',
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

        $('#idkategori').on('change', function() {
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
            var idkategori = $('#idkategori').val();

            if (idkategori == null) {
                idkategori = "-";
            }            
            window.open("{{ url('lappersediaan/cetak') }}" + "/" + jenis + "/" + idkategori);                
        }
</script>

@endsection