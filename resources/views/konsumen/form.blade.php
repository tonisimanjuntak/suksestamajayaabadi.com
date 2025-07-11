@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konsumen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('konsumen') }}">Konsumen</a></li>
                        <li class="breadcrumb-item label-judul active"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <form action="{{ url('konsumen/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Konsumen</h4>
                                    <span class="float-right font-weight-bold" id="lblidkonsumen"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idkonsumen" id="idkonsumen">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5>Informasi Data Konsumen</h5>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="namakonsumen">Nama Konsumen</label>
                                                            <input type="text" name="namakonsumen" id="namakonsumen"
                                                                class="form-control" placeholder="Nama konsumen" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="notelpkonsumen">No Telp/HP</label>
                                                            <input type="text" name="notelpkonsumen" id="notelpkonsumen"
                                                                class="form-control notelp" placeholder="Nomor telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="emailkonsumen">Email</label>
                                                            <input type="email" name="emailkonsumen" id="emailkonsumen"
                                                                class="form-control" placeholder="Email konsumen">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-8 required">
                                                        <div class="form-group">
                                                            <label for="idwilayah">Daerah Wilayah</label>
                                                            <select name="idwilayah" id="idwilayah" class="form-control"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="npwp">NPWP</label>
                                                            <input type="text" name="npwp" id="npwp" class="form-control npwp" placeholder="NPWP">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="limitkredit">Jumlah Limit Kredit</label>
                                                            <input type="text" name="limitkredit" id="limitkredit" class="form-control rupiah" value="{{ session('default_piutang_konsumen') }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="limitkredit">Akun Piutang</label>
                                                            <select name="kdakunpiutang" id="kdakunpiutang" class="form-control searchAkunPiutangKonsumen"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 required" style="display: none;" id="divStatusAktif">
                                                        <div class="form-group">
                                                            <label for="statusaktif">Status</label>
                                                            <select name="statusaktif" id="statusaktif" class="form-control select2">
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 required">
                                                        <div class="form-group">
                                                            <label for="namakonsumen">Alamat Lengkap Konsumen</label>
                                                            <textarea name="alamatkonsumen" id="alamatkonsumen" rows="3" class="form-control"
                                                                placeholder="Alamat lengkap konsumen"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5>Informasi Data Pemilik</h5>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nikpemilik">NIK Pemilik</label>
                                                            <input type="text" name="nikpemilik" id="nikpemilik"
                                                                class="form-control nik" placeholder="NIK pemilik">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="namapemilik">Nama Pemilik</label>
                                                            <input type="text" name="namapemilik" id="namapemilik"
                                                                class="form-control" placeholder="Nama pemilik">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="notelppemilik">No Telpon Pemilik</label>
                                                            <input type="text" name="notelppemilik" id="notelppemilik"
                                                                class="form-control notelp" placeholder="Nomor Telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nowapemilik">No WhatsAPP</label>
                                                            <input type="text" name="nowapemilik" id="nowapemilik"
                                                                class="form-control nowa" placeholder="Nomor Whatsapp">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('konsumen') }}" class="btn btn-default float-right mr-1"><i
                                        class="fa fa-chevron-left mr-1"></i>Kembali</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script>
    var idkonsumen = "{{ $idkonsumen }}";

    $(document).ready(function() {

        if (idkonsumen != "") {
            $('#idkonsumen').val(idkonsumen);
            $('#lblidkonsumen').html("ID: " + idkonsumen);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();
            $.ajax({
                    url: "{{ url('konsumen/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idkonsumen': idkonsumen
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#namakonsumen').val(response['namakonsumen']);
                    $('#notelpkonsumen').val(response['notelpkonsumen']);
                    $('#alamatkonsumen').val(response['alamatkonsumen']);
                    $('#emailkonsumen').val(response['emailkonsumen']);
                    $('#npwp').val(response['npwp']);
                    addSelectOption('kdakunpiutang', response['kdakunpiutang'], response['namaakunpiutang']);
                    $('#kdakunpiutang').val(response['kdakunpiutang']).trigger('change');
                    $('#limitkredit').val(totitik(response['limitkredit']));

                    addSelectOption('idwilayah', response['idwilayah'], response['namawilayah']);
                    $('#idwilayah').val(response['idwilayah']);
                    $('#statusaktif').val(response['statusaktif']).trigger('change');
                    $('#nikpemilik').val(response['nikpemilik']);
                    $('#namapemilik').val(response['namapemilik']);
                    $('#notelppemilik').val(response['notelppemilik']);
                    $('#nowapemilik').val(response['nowapemilik']);

                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            $('.label-judul').html('Tambah');

        }

        $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    namakonsumen: {
                        validators: {
                            notEmpty: {
                                message: 'Nama konsumen tidak boleh kosong'
                            }
                        }
                    },
                    notelpkonsumen: {
                        validators: {
                            notEmpty: {
                                message: 'Nomor Telepon tidak boleh kosong'
                            },
                            stringLength: {
                                max: 20,
                                message: 'Maksimal 20 karakter'
                            }
                        }
                    },
                    alamatkonsumen: {
                        validators: {
                            notEmpty: {
                                message: 'Alamat konsumen tidak boleh kosong'
                            }
                        }
                    },
                    idwilayah: {
                        validators: {
                            notEmpty: {
                                message: 'Daerah/ wilayah tidak boleh kosong'
                            }
                        }
                    },
                    npwp: {
                        validators: {
                            notEmpty: {
                                message: 'NPWP tidak boleh kosong'
                            }
                        }
                    },
                    limitkredit: {
                        validators: {
                            notEmpty: {
                                message: 'Jumlah limit kredit tidak boleh kosong'
                            }
                        }
                    },
                    kdakunpiutang: {
                        validators: {
                            notEmpty: {
                                message: 'Nama akun piutang tidak boleh kosong'
                            }
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnSimpan').attr("disabled", true);
            });

        $('#idwilayah').select2({
            placeholder: 'Pilih daerah/ wilayah ...',
            minimumInputLength: 0,
            ajax: {
                url: "{{ route('konsumen.searchWilayah') }}", // URL untuk pencarian
                dataType: 'json',
                delay: 250, // Delay saat mengetik (ms)
                data: function(params) {
                    return {
                        q: params.term, // Parameter pencarian
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results, // Format data untuk Select2
                    };
                },
                cache: true
            }
        });

        $("form").attr('autocomplete', 'off');

    });
</script>
@endsection