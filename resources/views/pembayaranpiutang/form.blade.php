@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembayaran Piutang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('pembayaranpiutang') }}">Pembayaran Piutang</a></li>
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

                    <form action="{{ url('pembayaranpiutang/simpanTambahPiutang') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Pembayaran Piutang </h4>
                                    <span class="float-right font-weight-bold" id="lblidpembayaranpiutang"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="idpembayaranpiutang" id="idpembayaranpiutang">

                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="tglpembayaran" class="col-md-3">Tgl Pembayaran</label>
                                            <div class="col-md-3">
                                                <input type="date" name="tglpembayaran" id="tglpembayaran"
                                                    class="form-control" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="idkonsumen" class="col-md-3">Konsumen</label>
                                            <div class="col-md-9">
                                                <select name="idkonsumen" id="idkonsumen"
                                                    class="form-control searchKonsumen">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="carabayar" class="col-md-3">Cara Bayar</label>
                                            <div class="col-md-9">
                                                <select name="carabayar" id="carabayar" class="form-control select2">
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
                                            <label for="nobilyetgiro" class="col-md-3 col-form-label">No Bilyet
                                                Giro</label>
                                            <div class="col-md-9">
                                                <input type="text" name="nobilyetgiro" id="nobilyetgiro"
                                                    class="form-control" placeholder="No Bilyet Giro">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="totaldibayar" class="col-md-3">Jumlah Dibayar</label>
                                            <div class="col-md-3">
                                                <input type="text" name="totaldibayar" id="totaldibayar"
                                                    class="form-control rupiah">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="keterangan" class="col-md-3">Keterangan</label>
                                            <div class="col-md-9">
                                                <textarea name="keterangan" id="keterangan" class="form-control"
                                                    rows="3" placeholder="Keterangan"></textarea>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3 mb-3">
                                        <div class="font-weight-bold text-lg display-block">DETAIL INVOICE</div>
                                        <small class="text-muted">NB:Diurutkan Berdasarkan Tanggal Jatuh
                                            Tempo</small>
                                    </div>

                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered table-striped" id="tblPiutang"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr class="text-center text-sm">
                                                        <th style="text-align:center;">Id Piutang</th>
                                                        <th style="text-align:center;">No Invoice</th>
                                                        <th>Tgl Piutang</th>
                                                        <th>Tgl Jatuh Tempo</th>
                                                        <th>Sisa Piutang</th>
                                                        <th style="width: 15%;">Jumlah Dibayar</th>
                                                        <th style="width: 5%;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="totalpembayaran"
                                                class="col-md-9 text-right col-form-label">Total
                                                Detail</label>
                                            <div class="col-md-3">
                                                <input type="text" name="totalpembayaran" id="totalpembayaran"
                                                    class="form-control rupiah" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="totaldiskon"
                                                class="col-md-9 text-right col-form-label">Potongan/
                                                Diskon</label>
                                            <div class="col-md-3">
                                                <input type="text" name="totaldiskon" id="totaldiskon"
                                                    class="form-control rupiah" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('pembayaranpiutang') }}" class="btn btn-default float-right mr-1"><i
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
    var idpembayaranpiutang = "{{ $idpembayaranpiutang }}";

    $(document).ready(function() {

        if (idpembayaranpiutang != "") {
            $('#idpembayaranpiutang').val(idpembayaranpiutang);
            $('#lblidpembayaranpiutang').html('ID: ' + idpembayaranpiutang);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('pembayaranpiutang/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpembayaranpiutang': idpembayaranpiutang
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPiutang = response['rsPiutang'];

                    $('#idpembayaranpiutang').val(rsPiutang['idpembayaranpiutang']);
                    $('#tglpembayaran').val(rsPiutang['tglpembayaran']);
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
                    tglpembayaran: {
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
                    totaldibayar: {
                        validators: {
                            notEmpty: {
                                message: 'jumlah dibayar tidak boleh kosong'
                            }
                        }
                    },
                    carabayar: {
                        validators: {
                            notEmpty: {
                                message: "cara bayar tidak boleh kosong"
                            },
                        }
                    },
                    idbank: {
                        validators: {
                            callback: {
                                message: "nama bank tidak boleh kosong",
                                callback: function(value, validator, idbank) {

                                    if ($('#carabayar').val() == "Transfer" || $('#carabayar').val() == "Giro") {
                                        if ($('#idbank').val() == '' || $('#idbank').val() == null) {
                                            return {
                                                valid: false,
                                                message: "nama bank tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                        }
                    },
                    nobilyetgiro: {
                        validators: {
                            callback: {
                                message: "Nomor bilyet giro tidak boleh kosong",
                                callback: function(value, validator, nobilyetgiro) {

                                    if ($('#carabayar').val() == "Giro") {
                                        if ($('#nobilyetgiro').val() == '' || $('#nobilyetgiro').val() == null) {
                                            return {
                                                valid: false,
                                                message: "Nomor bilyet giro tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
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
                e.preventDefault();
                $('#btnSimpan').attr("disabled", true);

                var idpembayaranpiutang = $("#idpembayaranpiutang").val();
                var tglpembayaran = $("#tglpembayaran").val();
                var idkonsumen = $("#idkonsumen").val();
                var carabayar = $("#carabayar").val();
                var idbank = $("#idbank").val();
                var nobilyetgiro = $("#nobilyetgiro").val();
                var totaldibayar = $("#totaldibayar").val();
                var keterangan = $("#keterangan").val();



                var detailPiutang = [];
                $('input[name="jumlahdibayar[]"]').each(function() {
                    detailPiutang.push({ idpiutang: $(this).data('idpiutang'), jumlahdibayar: hilangkanTitik($(this).val()) });
                });

                if (detailPiutang.length == 0) {
                    swal("Informasi", "Detail piutang yang dibayar belum ada!!", "info");
                    $('#btnSimpan').attr("disabled", false);
                    return;
                }

                idbank = '';
                nobilyetgiro = '';

                if (carabayar == 'Transfer') {
                    if (idbank == null) {
                        swal("Informasi", "Nama bank harus dipilih!", "info")
                            .then(function() {
                                $('#idbank').focus();
                                $('#btnSimpan').attr("disabled", false);

                            });
                        return;
                    }else{
                        idbank = $("#idbank").val();
                    }
                } 

                if (carabayar == 'Giro') {
                    if (idbank == null) {
                        swal("Informasi", "Nama bank harus dipilih!", "info")
                            .then(function() {
                                $('#idbank').focus();
                                $('#btnSimpan').attr("disabled", false);
                            });
                        return;
                    }else{
                        idbank = $("#idbank").val();
                    }

                    if (nobilyetgiro == '') {
                        swal("Informasi", "Nomor bilyet giro tidak boleh kosong!", "info")
                            .then(function() {
                                $('#nobilyetgiro').focus();
                                $('#btnSimpan').attr("disabled", false);
                            });
                        return;
                    }else{
                        nobilyetgiro = $("#nobilyetgiro").val();
                    }
                }
                
                var formData = {
                    "idpembayaranpiutang": idpembayaranpiutang,
                    "tglpembayaran": tglpembayaran,
                    "idkonsumen": idkonsumen,
                    "carabayar": carabayar,
                    "idbank": idbank,
                    "nobilyetgiro": nobilyetgiro,
                    "totaldibayar": totaldibayar,
                    "keterangan": keterangan,
                    "detailPiutang": detailPiutang
                };

                // console.log(formData);
                // return;

                $.ajax({
                        type: 'POST',
                        url: "{{ url('pembayaranpiutang/simpanData') }}",
                        data: JSON.stringify(formData),
                        dataType: 'json',
                        contentType: 'application/json; charset=utf-8',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        encode: true
                    })
                    .done(function(result) {
                        console.log(result);

                        if (result.success) {
                            swal("Berhasil", "Berhasil simpan data!", "success")
                                .then(function() {
                                    window.location.href = "{{ url('pembayaranpiutang') }}";
                                });
                        } else {
                            swal("Informasi", result.msg, "info");
                            $('#btnSimpan').attr("disabled", false);
                        }
                    })
                    .fail(function() {
                        // console.log("Gagal script simpanData!");
                        swal("Error", "Terjadi kesalahan script simpanData!!", "error");
                        $('#btnSimpan').attr("disabled", false);
                    });
            });


        getPiutangKonsumen();
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

    });

    $(document).on('change', '#idkonsumen', function() {
        var idkonsumen = $(this).val();
        if (idkonsumen != "" && idkonsumen != null) {
            getPiutangKonsumen(idkonsumen);
        }
    });

    $(document).on('change', '#totaldibayar', function() {
        hitungTotalPembayaran();        
    })


    function getPiutangKonsumen(idkonsumen = null) {
        $('#tblPiutang tbody').html('');
        
        if (idkonsumen == "" || idkonsumen == null) {
            $('#tblPiutang tbody').html(`<tr>
                                    <td colspan="7" class="text-center">Data piutang tidak ditemukan
                                    </td>
                                </tr>`);
            return false;
        }
        $.ajax({
                url: "{{ url('pembayaranpiutang/getPiutangKonsumen') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    'idkonsumen': idkonsumen
                },
            })
            .done(function(response) {
                var rsPiutang = response['rsPiutang'];
                if (rsPiutang.length != 0) {
                    for (var i = 0; i < rsPiutang.length; i++) {
                        console.log(rsPiutang[i]);
                        var totalpiutanginvoice = rsPiutang[i]['totaldebet'];
                        var totalpiutangsudahbayar = rsPiutang[i]['totalkredit'];

                        var sisapiutanginvoice = parseFloat(totalpiutanginvoice) - parseFloat(totalpiutangsudahbayar);

                        if (parseFloat(totalpiutangsudahbayar) > 0) {
                            var sisapiutangText = format_rupiah(sisapiutanginvoice) + " / " + format_rupiah(totalpiutanginvoice);
                        }else{
                            var sisapiutangText = format_rupiah(sisapiutanginvoice);
                        }

                        var addText = `<tr>
                                        <td style="text-align:center;">${rsPiutang[i]['idpiutang']}</td>
                                        <td style="text-align:center;">${rsPiutang[i]['noinvoice'] ?? "-"}</td>
                                        <td style="text-align:center;">${rsPiutang[i]['tglpiutang']}</td>
                                        <td style="text-align:center;">${rsPiutang[i]['tgljatuhtempo']}</td>
                                        <td style="text-align:right;">${sisapiutangText}</td>
                                        <td style=";"><input type="text" name="jumlahdibayar[]"
                                                id="jumlahdibayar${rsPiutang[i]['idpiutang']}" class="form-control jumlahdibayar" value="${format_rupiah(sisapiutanginvoice)}" data-idpiutang="${rsPiutang[i]['idpiutang']}"></td>
                                        <td style="width: 5%;"><button type="button"
                                                class="btn btn-danger btn-sm deleteRow"><i
                                                    class="fa fa-trash"></i></button></td>
                                    </tr>`;
                        $('#tblPiutang tbody').append(addText);

                        //add mask dan placeholer
                        $('#jumlahdibayar' + rsPiutang[i]['idpiutang']).mask('000.000.000.000.000', {
                            reverse: true
                        });
                        $('#jumlahdibayar' + rsPiutang[i]['idpiutang']).attr('placeholder', '000.000.000.000.000');
                        $('#jumlahdibayar' + rsPiutang[i]['idpiutang']).css('text-align', 'right');
                    }              
                    hitungTotalPembayaran();      
                }else{
                    var addText = `<tr>
                                    <td colspan="7" class="text-center">Data piutang tidak ditemukan
                                    </td>
                                </tr>`; 
                    $('#tblPiutang tbody').html(addText);

                }
            })
            .fail(function() {
                console.log('error getPiutangKonsumen');
            });
        
    }

    function hitungTotalPembayaran() {
        var total = 0;
        var totaldibayar =  ($('#totaldibayar').val() != '') ? parseFloat($('#totaldibayar').val().replace(/[^0-9]/g, '')) : 0;

        $('.jumlahdibayar').each(function() {
            total += parseFloat($(this).val().replace(/[^0-9]/g, ''));
        });
        
        $('#totalpembayaran').val(format_rupiah(total));
        $('#totaldiskon').val(format_rupiah( total - totaldibayar));
    }
</script>
@endsection