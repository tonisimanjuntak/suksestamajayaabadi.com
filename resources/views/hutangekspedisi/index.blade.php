@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buku Utang Ekspedisi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Buku Utang Ekspedisi</li>
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
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title font-weight-bold"><i class="far fa-list-alt mr-1"></i>List Data
                                    Buku Utang Ekspedisi</h3>
                                <a href="{{ url('hutangekspedisi/tambah') }}" class="btn btn-sm btn-primary"><i
                                        class="fa fa-plus-circle mr-1"></i> Tambah Pembayaran</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Tanggal Faktur</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <input type="date" name="tglawal" id="tglawal" class="form-control" value="{{ date('Y-01-01') }}">
                                                </div>
                                                <label for="" class="col-md-2 col-form-label text-center">S/D</label>
                                                <div class="col-md-5">
                                                    <input type="date" name="tglakhir" id="tglakhir" class="form-control" value="{{ date('Y-m-d') }}">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Supplier</label>
                                        </div>
                                        <div class="col-9">
                                            <select name="idekspedisi" id="idekspedisi" class="form-control searchEkspedisi"></select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-success" id="btnCari"><i class="fa fa-search"></i> Cari</button>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-12 mt-3">
                                    <table class="table table-bordered text-sm" id="tableList">
                                        <thead class="">
                                            <tr>
                                                <th style="width: 7%; text-align: center;">No</th>
                                                <th style="width: 10%; text-align: center;">Tanggal</th>
                                                <th style="width: 15%; text-align: center;">ID Utang</th>
                                                <th style="text-align: center;">Nama Ekspedisi</th>
                                                <th style="width: 15%; text-align: right;">Jumlah Utang</th>
                                                <th style="width: 15%; text-align: right;">Jumlah Dibayar</th>
                                                <th style="width: 10%; text-align: center;">Aksi</th>
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
                url: "{{ route('hutangekspedisi.listdata') }}",
                type: 'GET',
                data: function(d) {
                    d.tglawal = $('#tglawal').val();
                    d.tglakhir = $('#tglakhir').val();
                    d.idekspedisi = $('#idekspedisi').val();
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
                    data: 'tglhutang',
                    name: 'tglhutang',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'idhutangekspedisi',
                    name: 'idhutangekspedisi',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namaekspedisi',
                    name: 'namaekspedisi',
                    className: 'dt-body-left',
                    orderable: true,
                },
                {
                    data: 'kredit',
                    name: 'kredit',
                    className: 'dt-body-right',
                    orderable: false,
                },
                {
                    data: 'debet',
                    name: 'debet',
                    className: 'dt-body-right',
                    orderable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    className: 'dt-body-center',
                    orderable: false,
                    searchable: false
                }
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

        $(document).on('click', '#btnCari', function() {
            table.ajax.reload();
        })

    });

    $(document).on('click', '#btnHapus', function(e) {
        var link = $(this).attr("href");
        e.preventDefault();
        swal({
                title: "Hapus?",
                text: "Apakah anda yakin akan menghapus data ini!",
                icon: "warning",
                buttons: ["Batal", "Ya"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = link;
                }
            });

    });
</script>
@endsection