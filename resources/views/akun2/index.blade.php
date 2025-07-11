@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Akun Lv. 2</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Akun Lv. 2</li>
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
                                    Akun Lv. 2</h3>
                                <a href="{{ url('akun2/tambah') }}" class="btn btn-sm btn-primary"><i
                                        class="fa fa-plus-circle mr-1"></i> Tambah Data</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3" style="display: none;">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label>Filter Status:</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statusFilter" id="semua" value="Semua" checked>
                                                <label class="form-check-label" for="semua">Semua</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statusFilter" id="aktif" value="Aktif">
                                                <label class="form-check-label" for="aktif">Aktif</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="statusFilter" id="tidakAktif" value="Tidak Aktif">
                                                <label class="form-check-label" for="tidakAktif">Tidak Aktif</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <table class="table table-bordered" id="tableList">
                                        <thead class="">
                                            <tr>
                                                <th style="width: 5%; text-align: center;">No</th>
                                                <th style="width: 15%; text-align: center;">Kode Akun</th>
                                                <th style="text-align: left;">Nama Akun</th>
                                                <th style="width: 10%; text-align: center;">Aksi</th>
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
                url: "{{ route('akun2.listdata') }}",
                type: 'GET',
                data: function(d) {
                    d.statusFilter = $('input[name="statusFilter"]:checked').val();
                }
            },
            pageLength: 50,
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            columns: [{
                    data: 'no',
                    name: 'no',
                    orderable: false,
                    className: 'dt-body-center',
                    searchable: false
                },
                {
                    data: 'kdakun',
                    name: 'kdakun',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'namaakun',
                    name: 'namaakun',
                    orderable: true,
                },
                {
                    data: 'action',
                    name: 'action',
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

        $('input[name="statusFilter"]').on('change', function() {
            table.ajax.reload();
        });

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