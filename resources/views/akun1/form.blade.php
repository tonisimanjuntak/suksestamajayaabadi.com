@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Akun Lv. 1</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('akun1') }}">Akun Lv. 1</a></li>
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

                    <form action="{{ url('akun1/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Akun Lv. 1</h4>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="ltambah" id="ltambah" value="{{ $ltambah }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row required">
                                            <label for="kdakun" class="col-md-2 col-form-label">Kode Akun</label>
                                            <div class="col-md-2">
                                                <input type="text" name="kdakun" id="kdakun"
                                                    class="form-control" placeholder="X">
                                            </div>
                                        </div>

                                        <div class="form-group row required">
                                            <label for="namaakun" class="col-md-2 col-form-label">Nama Akun</label>
                                            <div class="col-md-10">
                                                <input type="text" name="namaakun" id="namaakun"
                                                    class="form-control" placeholder="Nama akun">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('akun1') }}" class="btn btn-default float-right mr-1"><i
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
    var kdakun = "{{ $kdakun }}";

    $(document).ready(function() {

        if (kdakun != "") {
            $('#kdakun').val(kdakun);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('akun1/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'kdakun': kdakun
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#namaakun').val(response['namaakun']);
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
                    kdakun: {
                        validators: {
                            notEmpty: {
                                message: 'kode akun tidak boleh kosong'
                            }
                        }
                    },
                    namaakun: {
                        validators: {
                            notEmpty: {
                                message: 'nama akun tidak boleh kosong'
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