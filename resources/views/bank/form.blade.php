@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bank</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('bank') }}">Bank</a></li>
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

                    <form action="{{ url('bank/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Bank</h4>
                                    <span class="float-right font-weight-bold" id="lblidbank"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idbank" id="idbank">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-6 required">
                                                        <div class="form-group">
                                                            <label for="namabank">Nama Bank</label>
                                                            <input type="text" name="namabank" id="namabank"
                                                                class="form-control" placeholder="Nama bank" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 required">
                                                        <div class="form-group">
                                                            <label for="cabang">Cabang</label>
                                                            <input type="text" name="cabang" id="cabang"
                                                                class="form-control" placeholder="Cabang">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 required">
                                                        <div class="form-group">
                                                            <label for="norekening">No Rekening</label>
                                                            <input type="text" name="norekening" id="norekening"
                                                                class="form-control" placeholder="No rekening">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 required">
                                                        <div class="form-group">
                                                            <label for="atasnama">Atas Nama</label>
                                                            <input type="text" name="atasnama" id="atasnama"
                                                                class="form-control" placeholder="No rekening">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 required">
                                                        <div class="form-group">
                                                            <label for="kdakun">Jenis Akun Kas</label>
                                                            <select name="kdakun" id="kdakun" class="form-control searchAkunKas"></select>
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

                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('bank') }}" class="btn btn-default float-right mr-1"><i
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
    var idbank = "{{ $idbank }}";

    $(document).ready(function() {

        if (idbank != "") {
            $('#idbank').val(idbank);
            $('#lblidbank').html("ID: " + idbank);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();
            $.ajax({
                    url: "{{ url('bank/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idbank': idbank
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#namabank').val(response['namabank']);
                    $('#cabang').val(response['cabang']);
                    $('#norekening').val(response['norekening']);
                    addSelectOption('kdakun', response['kdakun'], response['namaakun'])
                    $('#kdakun').val(response['kdakun']);
                    $('#atasnama').val(response['atasnama']);
                    $('#statusaktif').val(response['statusaktif']).trigger('change');


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
                    namabank: {
                        validators: {
                            notEmpty: {
                                message: 'Nama bank tidak boleh kosong'
                            }
                        }
                    },
                    cabang: {
                        validators: {
                            notEmpty: {
                                message: 'Cabang bank tidak boleh kosong'
                            }
                        }
                    },
                    norekening: {
                        validators: {
                            notEmpty: {
                                message: 'Nomor rekening tidak boleh kosong'
                            }
                        }
                    },
                    atasnama: {
                        validators: {
                            notEmpty: {
                                message: 'Atas nama tidak boleh kosong'
                            }
                        }
                    },
                    kdakun: {
                        validators: {
                            notEmpty: {
                                message: 'Nama akun kas tidak boleh kosong'
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