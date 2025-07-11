@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Wilayah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('wilayah') }}">Wilayah</a></li>
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

                    <form action="{{ url('wilayah/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Wilayah</h4>
                                    <span class="float-right font-weight-bold" id="lblidwilayah"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idwilayah" id="idwilayah">
                                <div class="row">
                                    <div class="col-md-12 required">
                                        <div class="form-group">
                                            <label for="namawilayah">Nama Wilayah</label>
                                            <input type="text" name="namawilayah" id="namawilayah"
                                                class="form-control" placeholder="Nama wilayah barang">
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
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('wilayah') }}" class="btn btn-default float-right mr-1"><i
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
    var idwilayah = "{{ $idwilayah }}";

    $(document).ready(function() {

        if (idwilayah != "") {
            $('#idwilayah').val(idwilayah);
            $('#lblidwilayah').html("ID: " + idwilayah);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('wilayah/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idwilayah': idwilayah
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#namawilayah').val(response['namawilayah']);
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
                    namawilayah: {
                        validators: {
                            notEmpty: {
                                message: 'nama wilayah barang tidak boleh kosong'
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