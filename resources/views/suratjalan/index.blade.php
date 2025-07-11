@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Surat Jalan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Surat Jalan</li>
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
                                    Surat Jalan</h3>
                                <a href="{{ url('suratjalan/tambah') }}" class="btn btn-sm btn-primary"><i
                                        class="fa fa-plus-circle mr-1"></i> Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Tanggal Surat Jalan</label>
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
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="">Nama Konsumen</label>
                                        </div>
                                        <div class="col-9">
                                            <select name="idkonsumen" id="idkonsumen" class="form-control searchKonsumen"></select>
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
                                                <th style="width: 5%; text-align: center;">No</th>
                                                <th style="text-align: center;">Tanggal<br>Id</th>
                                                <th style="text-align: center;">Nama Ekspedisi</th>
                                                <th style="text-align: center;">Identitas Ekspedisi</th>
                                                <th style="text-align: center;">Nama Konsumen</th>
                                                <th style="text-align: center;">No Invoice</th>
                                                <th style="width: 10%; text-align: right;">Biaya Pengiriman</th>
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
                url: "{{ route('suratjalan.listdata') }}",
                type: 'GET',
                data: function(d) {
                    d.tglawal = $('#tglawal').val();
                    d.tglakhir = $('#tglakhir').val();
                    d.idkonsumen = $('#idkonsumen').val();
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
                    data: 'tglsuratjalan',
                    name: 'tglsuratjalan',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namaekspedisi',
                    name: 'namaekspedisi',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'identitasekspedisi',
                    name: 'identitasekspedisi',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namakonsumen',
                    name: 'namakonsumen',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'daftarnoinvoice',
                    name: 'daftarnoinvoice',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'biayapengiriman',
                    name: 'biayapengiriman',
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