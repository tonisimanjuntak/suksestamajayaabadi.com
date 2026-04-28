@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Satuan Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('satuan') }}">Satuan Barang</a></li>
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

                    <form action="{{ url('satuan/simpanData') }}" method="POST" id="form" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Satuan Barang</h4>
                                    <span class="float-right font-weight-bold" id="lblidsatuan"></span>

                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idsatuan" id="idsatuan">
                                <div class="row">
                                    <div class="col-md-12 required">
                                        <div class="form-group row">
                                            <label for="namasatuan" class="col-md-3 col-form-label">Nama Satuan
                                                Barang</label>
                                            <div class="col-md-3">
                                                <input type="text" name="namasatuan" id="namasatuan"
                                                    class="form-control" placeholder="Nama satuan barang" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 required" style="display: none;" id="divStatusAktif">
                                        <div class="form-group row">
                                            <label for="statusaktif" class="col-md-3 col-form-label">Status</label>
                                            <div class="col-md-9">
                                                <select name="statusaktif" id="statusaktif"
                                                    class="form-control select2">
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('satuan') }}" class="btn btn-default float-right mr-1"><i
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
    var idsatuan = "{{ $idsatuan }}";

    $(document).ready(function() {

        if (idsatuan != "") {
            $('#idsatuan').val(idsatuan);
            $('#lblidsatuan').html("ID: " + idsatuan);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('satuan/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idsatuan': idsatuan
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#namasatuan').val(response['namasatuan']);
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
                    namasatuan: {
                        validators: {
                            stringLength: {
                                min: 1, // Minimal 5 karakter
                                max: 25, // Maksimal 10 karakter
                                message: 'Nama satuan barang harus 1-25 karakter'
                            },
                            notEmpty: {
                                message: 'nama satuan barang tidak boleh kosong'
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