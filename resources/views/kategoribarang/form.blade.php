@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kategori Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('kategoribarang') }}">Kategori Barang</a></li>
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

                    <form action="{{ url('kategoribarang/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Kategori Barang</h4>
                                    <span class="float-right font-weight-bold" id="lblidkategori"></span>

                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idkategori" id="idkategori">
                                <div class="row">
                                    <div class="col-md-12 required">
                                        <div class="form-group">
                                            <label for="namakategori">Nama Kategori Barang</label>
                                            <input type="text" name="namakategori" id="namakategori"
                                                class="form-control" placeholder="Nama kategori barang">
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
                                <a href="{{ url('kategoribarang') }}" class="btn btn-default float-right mr-1"><i
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
    var idkategori = "{{ $idkategori }}";

    $(document).ready(function() {

        if (idkategori != "") {
            $('#idkategori').val(idkategori);
            $('#lblidkategori').html("ID: " + idkategori);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('kategoribarang/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idkategori': idkategori
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#namakategori').val(response['namakategori']);
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
                    namakategori: {
                        validators: {
                            notEmpty: {
                                message: 'nama kategori barang tidak boleh kosong'
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