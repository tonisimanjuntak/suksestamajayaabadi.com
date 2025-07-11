@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Posting Jurnal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Posting Jurnal</li>
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
                                    Posting Jurnal</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                    
                                            <form action="{{ url('postingjurnal/mulaiPosting') }}" method="POST" id="form"
                                                enctype="multipart/form-data">
                                                
                                                @csrf
                                            
                                                <div class="row">

                                                    <div class="col-12 mb-3">
                                                        <h5>POSTING JURNAL</h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Bulan</label>
                                                            <select name="bulan" id="bulan" class="form-control select2">                                                        
                                                                <option value="">Bulan posting...</option>
                                                                <option value="01">01 - Januari</option>
                                                                <option value="02">02 - Februari</option>
                                                                <option value="03">03 - Maret</option>
                                                                <option value="04">04 - April</option>
                                                                <option value="05">05 - Mei</option>
                                                                <option value="06">06 - Juni</option>
                                                                <option value="07">07 - Juli</option>
                                                                <option value="08">08 - Agustus</option>
                                                                <option value="09">09 - September</option>
                                                                <option value="10">10 - Oktober</option>
                                                                <option value="11">11 - November</option>
                                                                <option value="12">12 - Desember</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Tahun</label>
                                                            <select name="tahun" id="tahun" class="form-control select2">
                                                                @for ($i = 2020; $i < date('Y') + 5; $i++)
                                                                    @if ($i == date('Y'))
                                                                    <option value="{{ $i }}" selected="">{{ $i }}</option>                                                            
                                                                    @else
                                                                    <option value="{{ $i }}">{{ $i }}</option>                                                            
                                                                    @endif
                                                                @endfor
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary" style="margin-top: 30px;" id="btnMulaiPosting"><i class="fa fa-check-double"></i> Mulai Posting</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 mt-3">
                                    <table class="table table-bordered text-sm" id="tableList">
                                        <thead class="">
                                            <tr>
                                                <th style="width: 5%; text-align: center;">No</th>
                                                <th style="width: 10%; text-align: center;">Bulan</th>
                                                <th style="width: 10%; text-align: center;">Tahun</th>
                                                <th style="width: 15%; text-align: right;">Total Debet</th>
                                                <th style="width: 15%; text-align: right;">Total Kredit</th>
                                                <th style="text-align: center;">Di Posting Oleh</th>
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


        $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    bulan: {
                        validators: {
                            notEmpty: {
                                message: 'Bulan tidak boleh kosong'
                            }
                        }
                    },
                    tahun: {
                        validators: {
                            notEmpty: {
                                message: 'Tahun tidak boleh kosong'
                            }
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnMulaiPosting').attr("disabled", true);
            });


        table = $('#tableList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('postingjurnal.listdata') }}",
                type: 'GET',
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
                    data: 'bulan',
                    name: 'bulan',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'tahun',
                    name: 'tahun',
                    className: 'dt-body-center',
                    orderable: true,
                },
                {
                    data: 'jumlahdebet',
                    name: 'jumlahdebet',
                    className: 'dt-body-right',
                    orderable: false,
                },
                {
                    data: 'jumlahkredit',
                    name: 'jumlahkredit',
                    className: 'dt-body-right',
                    orderable: false,
                },
                {
                    data: 'namapengguna',
                    name: 'namapengguna',
                    className: 'dt-body-center',
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