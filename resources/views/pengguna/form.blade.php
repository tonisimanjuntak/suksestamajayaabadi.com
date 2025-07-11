@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('pengguna') }}">Pengguna</a></li>
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

                    <form action="{{ url('pengguna/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Pengguna</h4>
                                    <span class="float-right font-weight-bold" id="lblidpengguna"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idpengguna" id="idpengguna">
                                <div class="row">
                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="namapengguna">Nama Pengguna</label>
                                            <input type="text" name="namapengguna" id="namapengguna"
                                                class="form-control" placeholder="Nama Pengguna" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="jeniskelamin">Jenis Kelamin</label>
                                            <select name="jeniskelamin" id="jeniskelamin" class="form-control select2">
                                                <option value="">Pilih jenis kelamin...</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="notelppengguna">No Telp/HP</label>
                                            <input type="text" name="notelppengguna" id="notelppengguna"
                                                class="form-control notelp">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailpengguna">Email</label>
                                            <input type="email" name="emailpengguna" id="emailpengguna"
                                                class="form-control" placeholder="email pengguna">
                                        </div>
                                    </div>
                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="idotorisasi">Otorisasi</label>
                                            <select name="idotorisasi" id="idotorisasi" class="form-control select2">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="**********">
                                        </div>
                                    </div>
                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="password">Ulangi Password</label>
                                            <input type="password" name="password2" id="password2" class="form-control"
                                                placeholder="**********">
                                        </div>
                                    </div>
                                    <div class="col-md-6 required" style="display: none;" id="divStatusAktif">
                                        <div class="form-group">
                                            <label for="statusaktif">Status</label>
                                            <select name="statusaktif" id="statusaktif" class="form-control select2">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="fotopengguna" class="col-md-12">Foto Pengguna <small
                                                    class="text-danger"> (Maksimal 200Kb)</small></label>
                                            <div class="col-md-12">
                                                <img src="{{ url('images/profil1.png') }}" alt=""
                                                    class="" style="width: 150px;" id="imgProfil">
                                                <input type="file" name="fotopengguna" id="fotopengguna"
                                                    class="btn btn-sm">
                                                <input type="hidden" name="fotopengguna_lama" id="fotopengguna_lama"
                                                    class="btn btn-sm">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="" id="lblNamaFile"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('pengguna') }}" class="btn btn-default float-right mr-1"><i
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
    var idpengguna = "{{ $idpengguna }}";

    $(document).ready(function() {

        if (idpengguna != "") {
            $('#idpengguna').val(idpengguna);
            $('.label-judul').html('Edit');
            $('#password').attr('placeholder', 'Kosongkan jika tidak ubah pasword');
            $('#password2').attr('placeholder', 'Kosongkan jika tidak ubah pasword');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('pengguna/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpengguna': idpengguna
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#lblidpengguna').html("ID: " + idpengguna);


                    $('#namapengguna').val(response['namapengguna']);
                    $('#namapengguna').attr('readonly', true);
                    $('#notelppengguna').val(response['notelppengguna']);
                    $('#jeniskelamin').val(response['jeniskelamin']).trigger('change');
                    $('#emailpengguna').val(response['emailpengguna']);
                    $('#username').val(response['username']);
                    $('#statusaktif').val(response['statusaktif']).trigger('change');

                    addSelectOption('idotorisasi', response['idotorisasi'], response['namaotorisasi']);
                    $('#idotorisasi').val(response['idotorisasi']).trigger('change');
                    $('#fotopengguna_lama').val(response['fotopengguna']);
                    console.log("src", "{{ url('uploads/pengguna') }}" + "/" + response['fotopengguna']);
                    $('#imgProfil').attr("src", "{{ url('uploads/pengguna') }}" + "/" + response['fotopengguna']);
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
                    namapengguna: {
                        validators: {
                            notEmpty: {
                                message: 'Nama Pengguna tidak boleh kosong'
                            }
                        }
                    },
                    notelppengguna: {
                        validators: {
                            notEmpty: {
                                message: 'Nomor Telepon tidak boleh kosong'
                            }
                        }
                    },
                    jeniskelamin: {
                        validators: {
                            notEmpty: {
                                message: 'Jenis Kelamin tidak boleh kosong'
                            }
                        }
                    },
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Username tidak boleh kosong'
                            },
                            stringLength: {
                                min: 4,
                                max: 25,
                                message: 'minimal 4 sampai dengan 25 karakter'
                            },
                        }
                    },
                    idotorisasi: {
                        validators: {
                            notEmpty: {
                                message: 'nama otorisasi tidak boleh kosong'
                            },
                        }
                    },
                    password: {
                        validators: {
                            stringLength: {
                                min: 5,
                                max: 25,
                                message: 'minimal 5 sampai dengan 25 karakter'
                            },
                            callback: {
                                message: "Password tidak boleh kosong",
                                callback: function(value, validator, password) {

                                    if (idpengguna == "" && $('#password').val() == '') {
                                        return {
                                            valid: false,
                                            message: "Password tidak boleh kosong"
                                        }
                                    }
                                    return true
                                }
                            }
                        }
                    },
                    password2: {
                        validators: {
                            stringLength: {
                                min: 5,
                                max: 25,
                                message: 'minimal 5 sampai dengan 25 karakter'
                            },
                            callback: {
                                message: "Ulangi Password tidak boleh kosong",
                                callback: function(value, validator, password2) {

                                    if (idpengguna == "") {
                                        if ($('#password').val() != $('#password2').val()) {
                                            return {
                                                valid: false,
                                                message: "Ulangi Password tidak sama"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnSimpan').attr("disabled", true);
            });


        $('#idotorisasi').select2({
            placeholder: 'Pilih nama otorisasi...',
            minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
            ajax: {
                url: "{{ route('pengguna.searchOtorisasi') }}", // URL untuk pencarian
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

    });
</script>
@endsection