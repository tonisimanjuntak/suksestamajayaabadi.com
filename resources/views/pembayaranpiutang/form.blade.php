@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buku Piutang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('piutang') }}">Buku Piutang</a></li>
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

                    <form action="{{ url('piutang/simpanTambahPiutang') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Buku Piutang </h4>
                                    <span class="float-right font-weight-bold" id="lblidpiutang"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="idpiutang" id="idpiutang">

                                <div class="form-group row">
                                    <label for="tglpiutang" class="col-md-3">Tgl Hutang</label>
                                    <div class="col-md-3">
                                        <input type="date" name="tglpiutang" id="tglpiutang"
                                            class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="idkonsumen" class="col-md-3">Konsumen</label>
                                    <div class="col-md-9">
                                        <select name="idkonsumen" id="idkonsumen" class="form-control searchKonsumen">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="idjenispiutang" class="col-md-3">Jenis Piutang</label>
                                    <div class="col-md-9">
                                        <select name="idjenispiutang" id="idjenispiutang" class="form-control searchJenisPiutang">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="totaldebet" class="col-md-3">Jumlah Piutang</label>
                                    <div class="col-md-3">
                                        <input type="text" name="totaldebet" id="totaldebet"
                                            class="form-control rupiah">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="keterangan" class="col-md-3">Keterangan</label>
                                    <div class="col-md-9">
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Keterangan"></textarea>

                                    </div>
                                </div>                                

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('piutang') }}" class="btn btn-default float-right mr-1"><i
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
    var idpiutang = "{{ $idpiutang }}";

    $(document).ready(function() {

        if (idpiutang != "") {
            $('#idpiutang').val(idpiutang);
            $('#lblidpiutang').html('ID: ' + idpiutang);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('piutang/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpiutang': idpiutang
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPiutang = response['rsPiutang'];

                    $('#idpiutang').val(rsPiutang['idpiutang']);
                    $('#tglpiutang').val(rsPiutang['tglpiutang']);
                    addSelectOption("idkonsumen", rsPiutang['idkonsumen'], rsPiutang['namakonsumen']);
                    $('#idkonsumen').val(rsPiutang['idkonsumen']);                    

                    addSelectOption("idjenispiutang", rsPiutang['idjenispiutang'], rsPiutang['namajenispiutang'] + ' (' + rsPiutang['jatuhtempo'] + ' hari)');
                    $('#idjenispiutang').val(rsPiutang['idjenispiutang']);                    


                    $('#totaldebet').val(format_rupiah(rsPiutang['totaldebet']));                    
                    $('#keterangan').val(rsPiutang['keterangan']);                    
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
                    tglpiutang: {
                        validators: {
                            notEmpty: {
                                message: 'tanggal tidak boleh kosong'
                            }
                        }
                    },
                    idkonsumen: {
                        validators: {
                            notEmpty: {
                                message: 'nama konsumen tidak boleh kosong'
                            }
                        }
                    },
                    idjenispiutang: {
                        validators: {
                            notEmpty: {
                                message: 'jenis piutang tidak boleh kosong'
                            }
                        }
                    },
                    totaldebet: {
                        validators: {
                            notEmpty: {
                                message: 'jumlah piutang tidak boleh kosong'
                            }
                        }
                    },
                    keterangan: {
                        validators: {
                            notEmpty: {
                                message: 'keterangan tidak boleh kosong'
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