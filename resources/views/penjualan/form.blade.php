@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('penjualan') }}">Penjualan</a></li>
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

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                        class="label-judul"></span> Data Invoice Penjualan</h4>
                                <span class="float-right font-weight-bold" id="lblidprimary"></span>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idpenjualan" id="idpenjualan">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-3 required">
                                                    <div class="form-group">
                                                        <label for="noinvoice">No Invoice (Otomatis)</label>
                                                        <input type="text" name="noinvoice" id="noinvoice"
                                                            class="form-control" placeholder="Otomatis">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 required">
                                                    <div class="form-group">
                                                        <label for="tglinvoice">Tanggal Invoice</label>
                                                        <input type="date" name="tglinvoice" id="tglinvoice"
                                                            class="form-control" value="{{ date('Y-m-d') }}" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 required">
                                                    <div class="form-group">
                                                        <label for="idkonsumen">Nama Konsumen</label>
                                                        <select name="idkonsumen" id="idkonsumen" class="form-control searchKonsumen"></select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 required">
                                                    <div class="form-group">
                                                        <label for="idsales">Nama Sales</label>
                                                        <select name="idsales" id="idsales" class="form-control select2">
                                                            <option value="">Pilih nama sales...</option>
                                                            @foreach ($rsSales as $row)
                                                                <option value="{{ $row->idsales }}">{{ $row->namasales.' (NPWP: '.$row->npwp.')' }}</option>    
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 required">
                                                    <div class="form-group">
                                                        <label for="carabayar">Cara Bayar</label>
                                                        <select name="carabayar" id="carabayar" class="form-control select2">
                                                            <option value="">Pilih cara bayar...</option>
                                                            <option value="Tunai">Tunai</option>
                                                            <option value="Transfer">Transfer</option>
                                                            <option value="Giro">Giro</option>
                                                            <option value="Piutang">Piutang</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-5 required" id="divBank" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="idbank">Nama Bank</label>
                                                        <select name="idbank" id="idbank" class="form-control searchBank">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-5 required" id="divGiro" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="nobilyetgiro">No Bilyet Giro</label>
                                                        <input type="text" name="nobilyetgiro" id="nobilyetgiro"
                                                            class="form-control" placeholder="No Bilyet Giro">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 required" id="divJenisPiutang" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="idjenispiutang">Jenis Piutang</label>
                                                        <select name="idjenispiutang" id="idjenispiutang" class="form-control searchJenisPiutang">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                                                            placeholder="Keterangan Penjualan"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class="text-muted">Detail Invoice</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-md btn-success float-right" data-toggle="modal" data-target="#modalTambahBarang" id="btnTambahDetail"><i class="fa fa-plus-circle mr-1"></i> Tambah Detail</button>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="table-responsive">
                                                        <table id="tableDetail" class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%; text-align: center;">No</th>
                                                                    <th style="">idbarang</th>
                                                                    <th style="">jenisdiskon</th>
                                                                    <th style="">diskonpersen1</th>
                                                                    <th style="">diskonpersen2</th>
                                                                    <th style="">diskonpersen3</th>
                                                                    <th style="">jumlahdiskon</th>
                                                                    <th style="">Nama Barang</th>
                                                                    <th style="width: 5%; text-align: center;">Qty</th>
                                                                    <th style="width: 10%; text-align: right;">Harga Satuan</th>
                                                                    <th style="width: 10%; text-align: right;">DPP</th>
                                                                    <th style="width: 10%; text-align: right;">PPN</th>
                                                                    <th style="width: 10%; text-align: right;">Discount</th>
                                                                    <th style="width: 10%; text-align: right;">Sub Total</th>
                                                                    <th style="width: 15%; text-align: center;">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-6">
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="row">

                                        <input type="hidden" name="biayapengiriman" id="biayapengiriman"
                                        class="form-control col-md-6 rupiah" value="0">

                                        <label for="totaldpp" class="col-md-6 col-form-label">Jumlah DPP</label>
                                        <input type="text" name="totaldpp" id="totaldpp" class="form-control col-md-6 rupiah" value="0" readonly>

                                        <label for="totalppn" class="col-md-6 col-form-label">PPN ({{ session()->get('ppn_penjualan') }}%)</label>
                                        <input type="text" name="totalppn" id="totalppn"
                                            class="form-control col-md-6 rupiah" value="0" readonly>

                                        <label for="totaldiskon" class="col-md-6 col-form-label">Jumlah Diskon</label>
                                        <input type="text" name="totaldiskon" id="totaldiskon" class="form-control col-md-6 rupiah" value="0" readonly>

                                        <input type="hidden" name="ppnpersen" id="ppnpersen" value="{{ session()->get('ppn_penjualan') }}" readonly>
                                        

                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                        <label for="totalinvoice" class="col-md-6 col-form-label">Total Invoice</label>
                                        <input type="text" name="totalinvoice" id="totalinvoice"
                                            class="form-control col-md-6 rupiah" value="0" readonly>

                                        
                                    </div>

                                </div>


                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('penjualan') }}" class="btn btn-default float-right mr-1"><i
                                    class="fa fa-chevron-left mr-1"></i>Kembali</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection



@section('scripts')


@include('penjualan/modalTambahBarang')

<script type="text/javascript">
    var idpenjualan = "<?php echo $idpenjualan; ?>";
    var noinvoice = "<?php echo $noinvoice; ?>";
    var ppnpersen = parseInt("<?php echo $ppnpersen; ?>");

    var lInit = true;

    $(document).ready(function() {

        $('#tableDetail thead tr :nth-child(2)').hide();
        $('#tableDetail thead tr :nth-child(3)').hide();
        $('#tableDetail thead tr :nth-child(4)').hide();
        $('#tableDetail thead tr :nth-child(5)').hide();
        $('#tableDetail thead tr :nth-child(6)').hide();
        $('#tableDetail thead tr :nth-child(7)').hide();

        $('#tableDetail tbody tr :nth-child(2)').hide();
        $('#tableDetail tbody tr :nth-child(3)').hide();
        $('#tableDetail tbody tr :nth-child(4)').hide();
        $('#tableDetail tbody tr :nth-child(5)').hide();
        $('#tableDetail tbody tr :nth-child(6)').hide();
        $('#tableDetail tbody tr :nth-child(7)').hide();

        $('.select2').select2();

        if (idpenjualan != "") {
            $('#idpenjualan').val(idpenjualan);
            $('.label-judul').html('Edit');
            $('#lblidprimary').html("ID: " + idpenjualan);

            $.ajax({
                    url: "{{ url('penjualan/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpenjualan': idpenjualan
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPenjualan = response.rsPenjualan;
                    addSelectOption('idkonsumen', rsPenjualan['idkonsumen'], rsPenjualan['namakonsumen'])
                    $('#idkonsumen').val(rsPenjualan['idkonsumen']).trigger('change');
                    $('#noinvoice').val(rsPenjualan['noinvoice']);
                    $('#tglinvoice').val(rsPenjualan['tglinvoice']);
                    $('#keterangan').val(rsPenjualan['keterangan']);
                    $('#ppnpersen').val(rsPenjualan['ppnpersen']);
                    $('#carabayar').val(rsPenjualan['carabayar']).trigger('change');
                    $('#nobilyetgiro').val(rsPenjualan['nobilyetgiro']);

                    setTimeout(function() {
                        $('#idsales').val(rsPenjualan['idsales']).trigger('change');
                    }, 500); // Tambahkan delay agar Select2 siap
                    


                    if (rsPenjualan['idbank'] != '') {
                        addSelectOption('idbank', rsPenjualan['idbank'], rsPenjualan['namabank'])
                        $('#idbank').val(rsPenjualan['idbank']);
                    }

                    addSelectOption('idjenispiutang', rsPenjualan['idjenispiutang'], rsPenjualan['namajenispiutang'])
                    $('#idjenispiutang').val(rsPenjualan['idjenispiutang']).trigger('change');


                    var rsDetail = response.rsDetail;
                    // console.log(rsDetail.length);
                    if (rsDetail.length > 0) {
                        for (var i = 0; i < rsDetail.length; i++) {
                            // console.log(rsDetail[i]);
                            addTableRow(rsDetail[i]['idbarang'], rsDetail[i]['namabarang'], rsDetail[i]['jumlahjual'], rsDetail[i]['hargasatuan'], rsDetail[i]['hargadpp'], rsDetail[i]['jumlahppn'], rsDetail[i]['subtotaljual'],
                                rsDetail[i]['jenisdiskon'], rsDetail[i]['jumlahdiskon'], rsDetail[i]['diskonpersen1'], rsDetail[i]['diskonpersen2'], rsDetail[i]['diskonpersen3'], 0, 0);
                        }
                    }
                    lInit = false;
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            lInit = false;
            $('#carabayar').val('Piutang').trigger('change');


            $('#noinvoice').val(noinvoice);
            $('.label-judul').html('Tambah');

        }

        $('#biayapengiriman').on('change', function() {
            hitungTotalInvoice();
        });

        $("form").attr('autocomplete', 'off');
    });



    $("#tableDetail").on("click", ".deleteRow", function() {
        $(this).closest("tr").remove();
        hitungTotalInvoice();
    });

    $('#simpan').click(function() {
        $('#simpan').attr('disabled', true);

        var idpenjualan = $("#idpenjualan").val();
        var noinvoice = $("#noinvoice").val();
        var tglinvoice = $("#tglinvoice").val();
        var tglditerima = $("#tglditerima").val();
        var carabayar = $("#carabayar").val();
        var idbank = $("#idbank").val();
        var nobilyetgiro = $("#nobilyetgiro").val();
        var idkonsumen = $("#idkonsumen").val();
        var idjenispiutang = $("#idjenispiutang").val();
        var keterangan = $("#keterangan").val();
        var idsales = $("#idsales").val();

        var totaldpp = $("#totaldpp").val();
        var ppnpersen = $("#ppnpersen").val();
        var totalppn = $("#totalppn").val();
        var totaldiskon = $("#totaldiskon").val();
        var biayapengiriman = $("#biayapengiriman").val();
        var totalinvoice = $("#totalinvoice").val();

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });


        if (carabayar == 'Transfer' || carabayar == 'Giro') {
            if (idbank == null) {
                swal("Informasi", "Nama bank harus dipilih!", "info")
                    .then(function() {
                        $('#simpan').attr('disabled', false);
                        $('#idbank').focus();
                    });
                return;
            }
        } else {
            idbank = '';
        }

        if (carabayar == 'Giro') {
            if (nobilyetgiro == null || nobilyetgiro == '') {
                swal("Informasi", "Nomor bilyet giro harus diisi!", "info")
                    .then(function() {
                        $('#simpan').attr('disabled', false);
                        $('#nobilyetgiro').focus();
                    });
                return;
            }
        } else {
            nobilyetgiro = '';
        }

        if (carabayar == 'Piutang') {
            if (idjenispiutang == null) {
                swal("Informasi", "Jenis piutang harus dipilih!", "info")
                    .then(function() {
                        $('#simpan').attr('disabled', false);
                        $('#idjenispiutang').focus();
                    });
                return;
            }
        } else {
            idjenispiutang = '';
        }

        if (idkonsumen == '' || idkonsumen == null) {
            swal("Informasi", "Nama konsumen tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idkonsumen').focus();
                });
            return;
        }

        if (idsales == '' || idsales == null) {
            swal("Informasi", "Nama sales tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idsales').focus();
                });
            return;
        }

        if (noinvoice == '') {
            swal("Informasi", "Nomor invoice tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#noinvoice').focus();
                });
            return;
        }

        if (tglinvoice == '') {
            swal("Informasi", "Tanggal invoice tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#tglinvoice').focus();
                });
            return;
        }

        if ($("#tableDetail tbody tr").length == 0) {
            swal("Informasi", "Detail penjualan belum ada!!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        isidatatable = [];
        for (var i = 0; i < tableData.length; i++) {
            isidatatable.push({
                'idbarang': tableData[i][1],
                'jenisdiskon': tableData[i][2],
                'diskonpersen1': tableData[i][3],
                'diskonpersen2': tableData[i][4],
                'diskonpersen3': tableData[i][5],
                'jumlahdiskon': tableData[i][6],
                'namabarang': tableData[i][7],
                'jumlahjual': tableData[i][8],
                'hargasatuan': tableData[i][9],
                'hargadpp': tableData[i][10],
                'jumlahppn': tableData[i][11],
                'subtotaljual': tableData[i][13],
            });
        }

        var formData = {
            "idpenjualan": idpenjualan,
            "noinvoice": noinvoice,
            "tglinvoice": tglinvoice,
            "carabayar": carabayar,
            "idbank": idbank,
            "nobilyetgiro": nobilyetgiro,
            "idjenispiutang": idjenispiutang,
            "idkonsumen": idkonsumen,
            "keterangan": keterangan,
            "idsales": idsales,
            "totaldpp": totaldpp,
            "ppnpersen": ppnpersen,
            "totalppn": totalppn,
            "totaldiskon": totaldiskon,
            "biayapengiriman": biayapengiriman,
            "totalinvoice": totalinvoice,
            "isidatatable": isidatatable
        };

        // console.log(formData);
        // return;

        //jika kondisi piutang masih ada, maka simpan data
        $.ajax({
            type: 'POST',
            url: "{{ url('penjualan/simpanData') }}",
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
            // $('#simpan').attr('disabled', false);
            // return;

            if (result.success) {
                swal("Berhasil", "Berhasil simpan data!", "success")
                    .then(function() {
                        window.location.href = "{{ url('penjualan') }}";
                    });
            } else {
                $('#simpan').attr('disabled', false);
                swal("Informasi", result.msg, "info");
            }
        })
        .fail(function() {
            $('#simpan').attr('disabled', false);
            console.log("Gagal script simpanData!");
        });
        
    })


    $(document).on('change', '#carabayar', function() {
        var carabayar = $(this).val();
        $('#divBank').hide();
        $('#divGiro').hide();
        $('#divJenisPiutang').hide();

        if (carabayar == 'Transfer') {
            $('#divBank').show();
        }

        if (carabayar == 'Giro') {
            $('#divBank').show();
            $('#divGiro').show();
        }

        if (carabayar == 'Piutang') {
            $('#divJenisPiutang').show();

        }
    });


    $(document).on('change', '#idkonsumen', function() {
        var idkonsumen = $(this).val();
        if (idkonsumen != "" && lInit != true) {
            $.ajax({
                url: "{{ url('sales/getSalesByKonsumen') }}",
                type: 'GET',
                dataType: 'json',
                data: {'idkonsumen': idkonsumen},
            })
            .done(function(response) {
                console.log(response);
                $('#idsales').val(response).trigger('change');
            })
            .fail(function() {
                console.log('error');
            });            
        }else{
            $('#idsales').val('').trigger('change');
        }
    });

    function hitungTotalInvoice()
    {
        var ppnpersen = parseInt($('#ppnpersen').val());

        var arrTable = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            arrTable.push(rowData);
        });

        var totalDPP = 0;
        var totalPPN = 0;
        var totalDiskon = 0;
        var totalinvoice = 0;;

        for (var i = 0; i < arrTable.length; i++) {
            totalDPP += parseInt(untitik(arrTable[i][8])) * parseInt(untitik(arrTable[i][10]));
            totalPPN += parseInt(untitik(arrTable[i][8])) * parseInt(untitik(arrTable[i][11]));
            totalDiskon += parseInt(untitik(arrTable[i][8])) * parseInt(untitik(arrTable[i][6]));
            totalinvoice += parseInt(untitik(arrTable[i][13]));
        }


        $('#totaldpp').val(totitik(totalDPP));
        $('#totalppn').val(totitik(totalPPN));
        $('#totaldiskon').val(totitik(totalDiskon));
        $('#totalinvoice').val(totitik(totalinvoice));
    }

    
</script>




@endsection