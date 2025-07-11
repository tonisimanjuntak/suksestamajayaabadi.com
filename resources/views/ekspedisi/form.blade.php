@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ekspedisi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('ekspedisi') }}">Ekspedisi</a></li>
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

                    <form action="{{ url('ekspedisi/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Ekspedisi</h4>
                                    <span class="float-right font-weight-bold" id="lblidekspedisi"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idekspedisi" id="idekspedisi">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5>Informasi Data Ekspedisi</h5>
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-8 required">
                                                        <div class="form-group">
                                                            <label for="namaekspedisi">Nama Ekspedisi</label>
                                                            <input type="text" name="namaekspedisi" id="namaekspedisi"
                                                                class="form-control" placeholder="Nama ekspedisi" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="notelpekspedisi">No Telp/HP</label>
                                                            <input type="text" name="notelpekspedisi" id="notelpekspedisi"
                                                                class="form-control notelp" placeholder="Nomor telepon">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="emailekspedisi">Email</label>
                                                            <input type="email" name="emailekspedisi" id="emailekspedisi"
                                                                class="form-control" placeholder="Email ekspedisi">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="kdakunutang">Nama akun utang</label>
                                                            <select name="kdakunutang" id="kdakunutang" class="form-control searchAkunUtangEkspedisi"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 required">
                                                        <div class="form-group">
                                                            <label for="namaekspedisi">Alamat Lengkap Ekspedisi</label>
                                                            <textarea name="alamatekspedisi" id="alamatekspedisi" rows="3" class="form-control"
                                                                placeholder="Alamat lengkap ekspedisi"></textarea>
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

                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5>Informasi Data Pemilik/ Data Manager</h5>
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
                                <a href="{{ url('ekspedisi') }}" class="btn btn-default float-right mr-1"><i
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
    var idekspedisi = "{{ $idekspedisi }}";

    $(document).ready(function() {

        if (idekspedisi != "") {
            $('#idekspedisi').val(idekspedisi);
            $('#lblidekspedisi').html("ID: " + idekspedisi);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();
            $.ajax({
                    url: "{{ url('ekspedisi/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idekspedisi': idekspedisi
                    },
                })
                .done(function(response) {
                    console.log(response);
                    $('#namaekspedisi').val(response['namaekspedisi']);
                    $('#notelpekspedisi').val(response['notelpekspedisi']);
                    $('#alamatekspedisi').val(response['alamatekspedisi']);
                    $('#emailekspedisi').val(response['emailekspedisi']);

                    addSelectOption('kdakunutang', response['kdakunutang'], response['namaakunutang']); 
                    $('#kdakunutang').val(response['kdakunutang']).trigger('change');


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
                    namaekspedisi: {
                        validators: {
                            notEmpty: {
                                message: 'Nama ekspedisi tidak boleh kosong'
                            }
                        }
                    },
                    notelpekspedisi: {
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
                    alamatekspedisi: {
                        validators: {
                            notEmpty: {
                                message: 'Alamat ekspedisi tidak boleh kosong'
                            }
                        }
                    },
                    kdakunutang: {
                        validators: {
                            notEmpty: {
                                message: 'Nama akun utang tidak boleh kosong'
                            }
                        }
                    },                    
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnSimpan').attr("disabled", true);
            });

        

        $("form").attr('autocomplete', 'off');

    });
</script>
@endsection