@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Aktifitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Riwayat Aktifitas</li>
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
                                <h3 class="card-title font-weight-bold"><i class="far fa-list-alt mr-1"></i>List Data
                                    Riwayat Aktifitas</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="">Tanggal Riwayat:</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <div class="col-md-5">
                                                    <input type="date" name="tglawal" id="tglawal" class="form-control"
                                                        value="{{ date('Y-01-01') }}">
                                                </div>
                                                <div class="col-md-2 text-center">
                                                    <label for="">S/D</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="date" name="tglakhir" id="tglakhir"
                                                        class="form-control" value="{{ date('Y-m-d') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Nama Pengguna</label>
                                        <select name="idpengguna" id="idpengguna"
                                            class="form-control searchPengguna"></select>
                                    </div>
                                </div>
                                <div class="col-md-3 pt-4">
                                    <button type="button" class="btn btn-success" id="btnCari"><i
                                            class="fa fa-search"></i> Cari</button>
                                    <button type="button" class="btn btn-primary" id="btnPrint"><i
                                            class="fa fa-print"></i> Print</button>
                                </div>

                                <div class="col-12 mt-3 mb-3">
                                    <hr>
                                </div>

                                <div class="col-12">
                                    <table class="table table-bordered" id="tableList">
                                        <thead class="">
                                            <tr>
                                                <th style="width: 5%; text-align: center;">No</th>
                                                <th style="width: 15%; text-align: center;">Tanggal</th>
                                                <th style="width: 35%; text-align: center;">Deskripsi</th>
                                                <th style="width: 15%; text-align: center;">Aktifitas</th>
                                                <th style="width: 15%; text-align: center;">Nama Table</th>
                                                <th style="width: 15%; text-align: center;">Nama Pengguna</th>
                                            </tr>
                                        </thead>
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
                url: "{{ route('home.listdatariwayataktifitas') }}",
                type: 'GET',
                data: function(d) {
                    d.tglawal = $('#tglawal').val();
                    d.tglakhir = $('#tglakhir').val();
                    d.idpengguna = $('#idpengguna').val();
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
                    data: 'inserted_date',
                    name: 'inserted_date',
                    className: 'dt-body-center',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi',
                    className: 'dt-body-left',
                    orderable: false,
                },
                {
                    data: 'namafunction',
                    name: 'namafunction',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namatabel',
                    name: 'namatabel',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namapengguna',
                    name: 'namapengguna',
                    className: 'dt-body-center',
                    orderable: true,
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



    $('#btnPrint').click(function() {
        var tglawal = $('#tglawal').val();
        var tglakhir = $('#tglakhir').val();
        var idpengguna = $('#idpengguna').val();

        if (tglawal === '' || tglakhir === '') {
            swal("Informasi", "Tanggal periode belum dipilih!", "info");
            return;
        }

        if (idpengguna === '' || idpengguna === null) {
            idpengguna = "-";            
        }



        window.open("{{ url('home/cetakriwayataktifitas') }}" + "/" + tglawal + "/" + tglakhir + "/" + idpengguna);
    });


</script>
@endsection