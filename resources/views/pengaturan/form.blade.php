@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('pengaturan') }}">Pengaturan</a></li>
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

                    <form action="{{ url('pengaturan/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Pengaturan</h4>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="ltambah" value="{{ $ltambah }}">
                                <div class="row">
                                    <div class="col-md-12 required">
                                        <div class="form-group">
                                            <label for="prefix">Prefix</label>
                                            <input type="text" name="prefix" id="prefix"
                                                class="form-control" placeholder="Prefix" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-12 required">
                                        <div class="form-group">
                                            <label for="values">Values</label>
                                            <textarea name="values" id="values" class="form-control" placeholder="values" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('pengaturan') }}" class="btn btn-default float-right mr-1"><i
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
    var prefix = "{{ $prefix }}";

    $(document).ready(function() {

        if (prefix != "") {
            $('#prefix').val(prefix);
            $('.label-judul').html('Edit');

            $.ajax({
                    url: "{{ url('pengaturan/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'prefix': prefix
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#prefix').attr('readonly', true);
                    $('#values').val(response['values']);
                    $('#deskripsi').val(response['deskripsi']);
                    $('#values').focus();
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
                    prefix: {
                        validators: {
                            notEmpty: {
                                message: 'prefix tidak boleh kosong'
                            },
                            stringLength: {
                                max: 50,
                                message: 'maksimal 50 karakter'
                            },
                            regexp: {
                                regexp: /^[A-Za-z0-9_-]+$/, // Hanya huruf besar dan kecil, tanpa spasi
                                message: 'Hanya karakter alphanumeric yang diperbolehkan (tanpa spasi)'
                            },
                        }
                    },
                    values: {
                        validators: {
                            notEmpty: {
                                message: 'nama kategori barang tidak boleh kosong'
                            },
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