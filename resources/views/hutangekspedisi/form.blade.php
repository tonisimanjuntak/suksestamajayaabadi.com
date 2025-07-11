@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Buku Utang Ekspedisi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('hutangekspedisi') }}">Buku Utang Ekspedisi</a></li>
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

                    <form action="{{ url('hutangekspedisi/simpanPembayaran') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Pembayaran </h4>
                                    <span class="float-right font-weight-bold" id="lblidhutangekspedisi"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="idhutangekspedisi" id="idhutangekspedisi">

                                <div class="form-group row">
                                    <label for="tglhutang" class="col-md-3">Tgl Pembayaran</label>
                                    <div class="col-md-3">
                                        <input type="date" name="tglhutang" id="tglhutang"
                                            class="form-control" value="{{ date('Y-m-d') }}" autofocus="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="idekspedisi" class="col-md-3">Nama Ekspedisi</label>
                                    <div class="col-md-9">
                                        <select name="idekspedisi" id="idekspedisi" class="form-control searchEkspedisi">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="carabayar" class="col-md-3">Cara Pembayaran</label>
                                    <div class="col-md-9">
                                        <select name="carabayar" id="carabayar" class="form-control select2">
                                            <option value="">Pilih cara bayar...</option>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Giro">Giro</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" style="display: none;" id="divBank">
                                    <label for="idbank" class="col-md-3 col-form-label">Nama Bank</label>
                                    <div class="col-md-9">
                                        <select name="idbank" id="idbank" class="form-control searchBank">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" id="divGiro" style="display: none;">
                                    <label for="nobilyetgiro" class="col-md-3 col-form-label">No Bilyet Giro</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nobilyetgiro" id="nobilyetgiro"
                                            class="form-control" placeholder="No Bilyet Giro">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="hargadpp" class="col-md-3">Jumlah DPP</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="hargadpp" id="hargadpp"
                                                    class="form-control rupiah">
                                            </div>
                                            <div class="col-md-12 mt-3"></div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="jumlahppn">Jumlah PPN ({{ session('ekspedisi_persen_ppn') }}%)</label>
                                                    <input type="hidden" name="persenppn" id="persenppn" value="{{ session('ekspedisi_persen_ppn') }}">
                                                    <input type="text" name="jumlahppn" id="jumlahppn" class="form-control rupiah" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="debet">Jumlah Pembayaran</label>
                                                    <input type="text" name="debet" id="debet" class="form-control rupiah" readonly="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="jumlahpph23">Jumlah PPH 23 ({{ session('ekspedisi_persen_pph23') }})</label>
                                                <input type="hidden" name="persenpph23" id="persenpph23" value="{{ session('ekspedisi_persen_pph23') }}">
                                                <input type="text" name="jumlahpph23" id="jumlahpph23"
                                                    class="form-control rupiah" readonly="">
                                            </div>
                                        </div>
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
                                <a href="{{ url('hutangekspedisi') }}" class="btn btn-default float-right mr-1"><i
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
    var idhutangekspedisi = "{{ $idhutangekspedisi }}";

    $(document).ready(function() {

        if (idhutangekspedisi != "") {
            $('#idhutangekspedisi').val(idhutangekspedisi);
            $('#lblidhutangekspedisi').html('ID: ' + idhutangekspedisi);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('hutangekspedisi/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idhutangekspedisi': idhutangekspedisi
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsHutang = response['rsHutang'];

                    $('#idhutangekspedisi').val(rsHutang['idhutangekspedisi']);
                    $('#tglhutang').val(rsHutang['tglhutang']);
                    addSelectOption("idekspedisi", rsHutang['idekspedisi'], rsHutang['namaekspedisi']);
                    $('#idekspedisi').val(rsHutang['idekspedisi']).trigger('change');                    
                    $('#carabayar').val(rsHutang['carabayar']).trigger('change');                    

                    if (rsHutang['idbank'] != null && rsHutang['idbank'] != "") {
                        addSelectOption("idbank", rsHutang['idbank'], rsHutang['namabank']);
                        $('#idbank').val(rsHutang['idbank']).trigger('change');                    
                    }

                    if (rsHutang['nobilyetgiro'] != null && rsHutang['nobilyetgiro'] != "") {
                        $('#nobilyetgiro').val(rsHutang['nobilyetgiro']);                    
                    }
                    

                    $('#hargadpp').val(format_rupiah(rsHutang['hargadpp']));                    
                    $('#jumlahppn').val(format_rupiah(rsHutang['jumlahppn']));             
                    $('#jumlahpph23').val(format_rupiah(rsHutang['jumlahpph23']));                    
                    $('#debet').val(format_rupiah(rsHutang['debet']));                    
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
                                message: 'tanggal pembayaran tidak boleh kosong'
                            }
                        }
                    },
                    idekspedisi: {
                        validators: {
                            notEmpty: {
                                message: 'nama ekspedisi tidak boleh kosong'
                            }
                        }
                    },
                    carabayar: {
                        validators: {
                            notEmpty: {
                                message: 'cara bayar tidak boleh kosong'
                            }
                        }
                    },
                    idbank: {
                        validators: {
                            callback: {
                                message: 'Nama bank tidak boleh kosong',
                                callback: function(value, validator, $field) {
                                    var carabayar = validator.getFieldElements('carabayar').val();

                                    if (carabayar === 'Transfer' || carabayar === 'Giro') {
                                        if (value=="" || value==null) {
                                            return false; 
                                        }else{
                                            return true;
                                        }
                                        return value !== ''; // Return true jika idbank tidak kosong
                                    }
                                    return true;
                                }
                            }
                        }
                    },
                    nobilyetgiro: {
                        validators: {
                            callback: {
                                message: 'nomor bilyet giro tidak boleh kosong',
                                callback: function(value, validator, $field) {
                                    var carabayar = validator.getFieldElements('carabayar').val();
                                    
                                    if (carabayar === 'Giro') {
                                        if (value=="" || value==null) {
                                            return false; 
                                        }else{
                                            return true;
                                        }
                                    }
                                    return true;
                                }
                            }
                        }
                    },
                    debet: {
                        validators: {
                            notEmpty: {
                                message: 'jumlah pembayaran tidak boleh kosong'
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

    $(document).on('change', '#carabayar', function() {
        var carabayar = $(this).val();
        $('#divBank').hide();
        $('#divGiro').hide();

        if (carabayar == 'Transfer') {
            $('#divBank').show();
        }
        if (carabayar == 'Giro') {
            $('#divBank').show();
            $('#divGiro').show();
        }
    })

    $(document).on('change', '#hargadpp', function(){
        var hargadpp = untitik($('#hargadpp').val());
        var persenppn = parseFloat($('#persenppn').val());
        var jumlahppn = parseInt((persenppn / 100) * (parseInt(hargadpp)));
        var jumlahpembayaran = parseInt(hargadpp) + jumlahppn;
        
        var persenpph23 = parseFloat($('#persenpph23').val());
        var jumlahpph23 = parseInt((persenpph23 / 100) * (parseInt(hargadpp)));
        
        $('#jumlahppn').val(format_rupiah(jumlahppn));
        $('#debet').val(format_rupiah(jumlahpembayaran));
        $('#jumlahpph23').val(format_rupiah(jumlahpph23));
        
    })
</script>
@endsection