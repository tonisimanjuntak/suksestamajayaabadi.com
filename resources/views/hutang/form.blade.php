@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buku Utang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('hutang') }}">Buku Utang</a></li>
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

                    <form action="{{ url('hutang/simpanTambahPiutang') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Buku Utang </h4>
                                    <span class="float-right font-weight-bold" id="lblidhutang"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="idhutang" id="idhutang">

                                <div class="form-group row">
                                    <label for="tglhutang" class="col-md-3">Tgl Hutang</label>
                                    <div class="col-md-3">
                                        <input type="date" name="tglhutang" id="tglhutang"
                                            class="form-control" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="idsupplier" class="col-md-3">Supplier</label>
                                    <div class="col-md-9">
                                        <select name="idsupplier" id="idsupplier" class="form-control searchSupplier">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="totalkredit" class="col-md-3">Jumlah Hutang</label>
                                    <div class="col-md-3">
                                        <input type="text" name="totalkredit" id="totalkredit"
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
                                <a href="{{ url('hutang') }}" class="btn btn-default float-right mr-1"><i
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
    var idhutang = "{{ $idhutang }}";

    $(document).ready(function() {

        if (idhutang != "") {
            $('#idhutang').val(idhutang);
            $('#lblidhutang').html('ID: ' + idhutang);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('hutang/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idhutang': idhutang
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsHutang = response['rsHutang'];

                    $('#idhutang').val(rsHutang['idhutang']);
                    $('#tglhutang').val(rsHutang['tglhutang']);
                    addSelectOption("idsupplier", rsHutang['idsupplier'], rsHutang['namasupplier']);
                    $('#idsupplier').val(rsHutang['idsupplier']);                    
                    $('#totalkredit').val(format_rupiah(rsHutang['totalkredit']));                    
                    $('#keterangan').val(rsHutang['keterangan']);                    
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
                    tglhutang: {
                        validators: {
                            notEmpty: {
                                message: 'nama barang tidak boleh kosong'
                            }
                        }
                    },
                    idsupplier: {
                        validators: {
                            notEmpty: {
                                message: 'nama supplier tidak boleh kosong'
                            }
                        }
                    },
                    totalkredit: {
                        validators: {
                            notEmpty: {
                                message: 'jumlah utang tidak boleh kosong'
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