@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('supplier') }}">Supplier</a></li>
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

                    <form action="{{ url('supplier/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Supplier</h4>
                                    <span class="float-right font-weight-bold" id="lblidsupplier"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idsupplier" id="idsupplier">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-12 required">
                                                        <div class="form-group">
                                                            <label for="namasupplier">Nama Supplier</label>
                                                            <input type="text" name="namasupplier" id="namasupplier"
                                                                class="form-control" placeholder="Nama supplier" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="npwp">NPWP</label>
                                                            <input type="text" name="npwp" id="npwp"
                                                                class="form-control npwp">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 required">
                                                        <div class="form-group">
                                                            <label for="kdakunutang">Nama Akun Utang</label>
                                                            <select name="kdakunutang" id="kdakunutang" class="form-control searchAkunUtangSupplier"></select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 required">
                                                        <div class="form-group">
                                                            <label for="namasupplier">Alamat Lengkap Supplier</label>
                                                            <textarea name="alamatsupplier" id="alamatsupplier" rows="3" class="form-control"
                                                                placeholder="Alamat lengkap supplier"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 required" style="display: none;" id="divStatusAktif">
                                                        <div class="form-group">
                                                            <label for="statusaktif">Status</label>
                                                            <select name="statusaktif" id="statusaktif" class="form-control select2">
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-5 mb-3">
                                                        <h5>Kontak Person</h5>
                                                    </div>

                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="kontakperson">Nama</label>
                                                            <input type="text" name="kontakperson" id="kontakperson"
                                                                class="form-control" placeholder="Nama kontak person">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 required">
                                                        <div class="form-group">
                                                            <label for="notelp">No Telp/ WhatsApp</label>
                                                            <input type="text" name="notelp" id="notelp"
                                                                class="form-control notelp">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control" placeholder="Email">
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
                                <a href="{{ url('supplier') }}" class="btn btn-default float-right mr-1"><i
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
    var idsupplier = "{{ $idsupplier }}";

    $(document).ready(function() {

        if (idsupplier != "") {
            $('#idsupplier').val(idsupplier);
            $('#lblidsupplier').html("ID: " + idsupplier);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();
            $.ajax({
                    url: "{{ url('supplier/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idsupplier': idsupplier
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#namasupplier').val(response['namasupplier']);
                    $('#npwp').val(response['npwp']);
                    $('#alamatsupplier').val(response['alamatsupplier']);
                    $('#kontakperson').val(response['kontakperson']);
                    $('#notelp').val(response['notelp']);
                    $('#email').val(response['email']);
                    $('#statusaktif').val(response['statusaktif']).trigger('change');

                    addSelectOption('kdakunutang', response['kdakunutang'], response['namaakunutang']);                    
                    $('#kdakunutang').val(response['kdakunutang']).trigger('change');

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
                    namasupplier: {
                        validators: {
                            notEmpty: {
                                message: 'Nama supplier tidak boleh kosong'
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
                    alamatsupplier: {
                        validators: {
                            notEmpty: {
                                message: 'Alamat supplier tidak boleh kosong'
                            }
                        }
                    },
                    kontakperson: {
                        validators: {
                            notEmpty: {
                                message: 'Nama kontak person tidak boleh kosong'
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
                    notelp: {
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
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnSimpan').attr("disabled", true);
            });



        $("form").attr('autocomplete', 'off');

    });
</script>
@endsection