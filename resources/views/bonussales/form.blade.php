@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bunus Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('bonussales') }}">Bunus Sales</a></li>
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

                    <form action="#" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Bunus Sales</h4>
                                    <span class="float-right font-weight-bold" id="lblidbonus"></span>

                                </div>
                            </div>
                            <div class="card-body">

                                <meta name="csrf-token" content="{{ csrf_token() }}">

                                <input type="hidden" name="idbonus" id="idbonus">
                                <div class="row">


                                    <div class="col-md-3 required">
                                        <div class="form-group">
                                            <label for="tglbonus">Tgl Bonus</label>
                                            <input type="date" name="tglbonus" id="tglbonus"
                                                class="form-control" autofocus="" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-9 required">
                                        <div class="form-group">
                                            <label for="namasales">Nama Sales</label>
                                            <select name="idsales" id="idsales" class="form-control searchSales"></select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 required">
                                        <div class="form-group">
                                            <label for="namasales">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" rows="2" placeholder="Keterangan"></textarea>
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-12 required">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h5>Bonus Penjualan</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="totalpenjualan">Total Penjualan</label>
                                                            <input type="text" name="totalpenjualan" id="totalpenjualan"
                                                                class="form-control rupiah" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="totalbonuspenjualan">Bonus Penjualan</label>
                                                            <input type="text" name="totalbonuspenjualan" id="totalbonuspenjualan"
                                                                class="form-control rupiah" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="card card-default collapsed collapsed-card" data-card-widget="collapse">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Detail Bonus Penjualan</h3>

                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <table class="table" id="tablePenjualan">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 5%; text-align: center;" rowspan="2">No</th>
                                                                                    <th style="display: none;" rowspan="2">idpenjualan</th>
                                                                                    <th style="display: none;" rowspan="2">idpenjualandetail</th>
                                                                                    <th style="display: none;" rowspan="2">jenisbonuspenjualan</th>
                                                                                    <th style="display: none;" rowspan="2">persenbonuspenjualan</th>
                                                                                    <th style="display: none;" rowspan="2">jumlahbonuspenjualan</th>
                                                                                    <th style="display: none;" rowspan="2">iddetailsuratjalan</th>
                                                                                    <th style="width: 15%; text-align: center;" rowspan="2">Nomor Invoice</th>
                                                                                    <th style="width: 10%; text-align: center;" rowspan="2">Tgl Invoice</th>
                                                                                    <th style="text-align: left;" rowspan="2">Nama Barang</th>
                                                                                    <th style="width: 10%; text-align: right;" rowspan="2">Harga Jual Bersih</th>
                                                                                    <th style="width: 20%; text-align: center;" colspan="2">Komisi</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th style="width: 10%; text-align: center;">%</th>
                                                                                    <th style="width: 10%; text-align: right;">Jumlah</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbodyPenjualan">

                                                                            </tbody>

                                                                        </table>

                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="card-footer">
                                                                <i>*Sumber nya dari penjualan yang sudah ada surat jalan nya.</i>
                                                            </div>
                                                            </div>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-12 required">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h5>Bonus Penagihan</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="totalpenagihan">Total Penagihan</label>
                                                            <input type="text" name="totalpenagihan" id="totalpenagihan"
                                                                class="form-control rupiah" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="totalbonuspenagihan">Bonus Penagihan</label>
                                                            <input type="text" name="totalbonuspenagihan" id="totalbonuspenagihan"
                                                                class="form-control rupiah" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="card collapsed collapsed-card" data-card-widget="collapse">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Detail Bonus Penagihan</h3>

                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <table class="table" id="tablePenagihan">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 5%; text-align: center;" rowspan="2">No</th>
                                                                                    <th style="display: none;">IdPiutang</th>
                                                                                    <th style="display: none;">idpenjualan</th>
                                                                                    <th style="display: none;">IdPenjualanDetail</th>
                                                                                    <th style="display: none;">jenisbonustagihan</th>
                                                                                    <th style="display: none;">persenbonustagihan</th>
                                                                                    <th style="display: none;">jumlahbonustagihan</th>
                                                                                    <th style="width: 15%; text-align: center;" rowspan="2">Nomor Invoice</th>
                                                                                    <th style="width: 10%; text-align: center;" rowspan="2">Tgl Invoice</th>
                                                                                    <th style="text-align: center;" rowspan="2">Nama Barang</th>
                                                                                    <th style="width: 5%; text-align: center;" rowspan="2">QTY</th>
                                                                                    <th style="width: 10%; text-align: center;" rowspan="2">Sub Total Jual</th>
                                                                                    <th style="width: 20%; text-align: center;" colspan="2">Komisi</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th style="width: 10%; text-align: center;">%</th>
                                                                                    <th style="width: 10%; text-align: center;">Jumlah</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbodyPenagihan"></tbody>

                                                                        </table>

                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="card-footer">
                                                                <i>*Sumber nya dari pembayaran piutang yang belum lewat jatuh tempo.</i>
                                                            </div>
                                                            </div>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-12 required">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h5>Bonus Target</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="pencapaiantarget">Jumlah Penjualan</label>
                                                            <input type="text" name="pencapaiantarget" id="pencapaiantarget"
                                                                class="form-control rupiah" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="targetpenjualan">Jumlah Target</label>
                                                            <input type="text" name="targetpenjualan" id="targetpenjualan"
                                                                class="form-control rupiah" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="totalbonustarget">Bonus Target</label>
                                                            <input type="text" name="totalbonustarget" id="totalbonustarget"
                                                                class="form-control rupiah" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="card collapsed collapsed-card" data-card-widget="collapse">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Detail Bonus Target Barang</h3>

                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <table class="table" id="tableTarget">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 5%; text-align: center;" rowspan="2">No</th>
                                                                                    <th style="display: none;" rowspan="2">Idpenjualan</th>
                                                                                    <th style="display: none;" rowspan="2">IdPenjualanDetail</th>
                                                                                    <th style="display: none;" rowspan="2">idjenisbarang</th>
                                                                                    <th style="display: none;" rowspan="2">persenbonustarget</th>
                                                                                    <th style="width: 15%; text-align: center;" rowspan="2">Nomor Invoice</th>
                                                                                    <th style="width: 10%; text-align: center;" rowspan="2">Tgl Invoice</th>
                                                                                    <th style="text-align: left;" rowspan="2">Nama Barang</th>
                                                                                    <th style="width: 10%; text-align: center;" rowspan="2">Jenis</th>
                                                                                    <th style="width: 10%; text-align: right;" rowspan="2">Harga Jual Bersih</th>
                                                                                    <th style="width: 20%; text-align: center;" colspan="2">Komisi</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th style="width: 10%; text-align: center;">%</th>
                                                                                    <th style="width: 10%; text-align: right;">Jumlah</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbodyTarget">

                                                                            </tbody>

                                                                        </table>

                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <!-- /.card-body -->
                                                            <div class="card-footer">
                                                                <i>*Sumber nya dari pembayaran piutang yang belum lewat jatuh tempo.</i>
                                                            </div>
                                                            </div>
                                                    </div>


                                                    
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('bonussales') }}" class="btn btn-default float-right mr-1"><i
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
    var idbonus = "{{ $idbonus }}";

    $(document).ready(function() {
        if (idbonus != "") {
            $('.label-judul').html('Edit');
        } else {
            $('.label-judul').html('Tambah');
        }
        $("form").attr('autocomplete', 'off');
    });

    $(document).on('change', '#idsales', function() {
        var idsales = $(this).val();
        $('#tbodyPenjualan').empty();
        $('#tbodyPenagihan').empty();
        $('#tbodyTarget').empty();

        $.ajax({
            url: "{{ url('bonussales/getBonus') }}",
            type: 'GET',
            dataType: 'json',
            data: {'idsales': idsales},
        })
        .done(function(getBonusResult) {
            console.log(getBonusResult);
            hitungBonusPenjualan(getBonusResult['rsHitungBonusPenjualan']);
            hitungBonusPenagihan(getBonusResult['rsHitungBonusPenagihan']);
            hitungBonusTarget(getBonusResult['rsHitungBonusTarget'], getBonusResult['TargetPenjualanSales'], getBonusResult['PencapaianPenjualan']);
            
        })
        .fail(function() {
            console.log('error getBonus');
        });
    });

    function hitungBonusPenjualan(rsA) {
        
        if (rsA.length >0 ) {
                var totalpenjualan = 0;
                var totalbonuspenjualan = 0;
                var noA = 1;
                for (var i = 0; i < rsA.length; i++) {

                    var rowA = rsA[i];

                    var subtotalhargabersih =  (parseInt(rowA['hargadpp']) - parseInt(rowA['jumlahdiskon'])) * parseInt(rowA['jumlahjual']);
                    totalpenjualan += parseInt(subtotalhargabersih);
                    
                    if (rowA['jenisbonuspenjualan'] == 'Persen') {
                        var rumusKomisiA = rowA['persenbonuspenjualan'] + ' %';
                        if (rowA['persenbonuspenjualan'] == "0.00") {
                            var jumlahbonuspenjualan = 0;                            
                        }else{
                            var jumlahbonuspenjualan = (parseFloat(rowA['persenbonuspenjualan'])/100) * parseFloat(subtotalhargabersih);                            
                        }
                    }

                    if (rowA['jenisbonuspenjualan'] == 'Nominal') {
                        var rumusKomisiA = rowA['jumlahbonuspenjualan'] + '/Unit';
                        if (rowA['jumlahbonuspenjualan'] == "0") {
                            var jumlahbonuspenjualan = 0;                            
                        }else{
                            var jumlahbonuspenjualan = parseFloat(rowA['jumlahjual']) * parseFloat(rowA['jumlahbonuspenjualan']);
                        }
                    }

                    totalbonuspenjualan += jumlahbonuspenjualan;

                    var addTextA = `
                        <tr>
                            <td style="width: 5%; text-align: center;">` + noA + `</td>
                            <td style="display: none;">` + rowA['idpenjualan'] + `</td>
                            <td style="display: none;">` + rowA['id'] + `</td>
                            <td style="display: none;">` + rowA['jenisbonuspenjualan'] + `</td>
                            <td style="display: none;">` + rowA['persenbonuspenjualan'] + `</td>
                            <td style="display: none;">` + rowA['jumlahbonuspenjualan'] + `</td>
                            <td style="display: none;">` + rowA['iddetailsuratjalan'] + `</td>
                            <td style="width: 15%; text-align: center;">` + rowA['noinvoice'] + `</td>
                            <td style="width: 10%; text-align: center;">` + rowA['tglinvoice'] + `</td>
                            <td style="text-align: left;">` + rowA['namabarang'] + `</td>
                            <td style="width: 10%; text-align: right;">` + totitik(subtotalhargabersih) + `</td>
                            <td style="width: 10%; text-align: right;">` + rumusKomisiA + `</td>
                            <td style="width: 10%; text-align: right;">` + totitik(parseInt(jumlahbonuspenjualan)) + `</td>
                        </tr>
                    `;
                    $('#tbodyPenjualan').append(addTextA);
                    noA++;
                }
                $('#totalpenjualan').val(totitik(totalpenjualan));
                $('#totalbonuspenjualan').val( totitik(totalbonuspenjualan));
            }else{
                $('#totalpenjualan').val('0');
                $('#totalbonuspenjualan').val('0');
            }

    }


    function hitungBonusPenagihan(rsB) {
        
        if (rsB['detailPenagihan'].length >0 ) {
                var totalpenagihan = 0;
                var totalbonuspenagihan = 0;
                var noB = 1;
                for (var i = 0; i < rsB['detailPenagihan'].length; i++) {

                    var rowB = rsB['detailPenagihan'][i];

                    totalpenagihan += parseInt(rowB['subtotaljual']);

                    if (rowB['jenisbonustagihan'] == 'Persen') {
                        var rumusKomisi = rowB['persenbonustagihan'] + ' %';
                    }

                    if (rowB['jenisbonustagihan'] == 'Nominal') {
                        var rumusKomisi = rowB['jumlahbonustagihan'] + '/Unit';
                    }

                    totalbonuspenagihan += rowB['subtotalbonustagihan'];

                    var addTextB = `
                        <tr>
                            <td style="width: 5%; text-align: center;">` + noB + `</td>
                            <td style="display: none;">` + rowB['idpiutang'] + `</td>
                            <td style="display: none;">` + rowB['idpenjualan'] + `</td>
                            <td style="display: none;">` + rowB['idpenjualandetail'] + `</td>
                            <td style="display: none;">` + rowB['jenisbonustagihan'] + `</td>
                            <td style="display: none;">` + rowB['persenbonustagihan'] + `</td>
                            <td style="display: none;">` + rowB['jumlahbonustagihan'] + `</td>
                            <td style="width: 15%; text-align: center;">` + rowB['noinvoice'] + `</td>
                            <td style="width: 10%; text-align: center;">` + rowB['tglinvoice'] + `</td>
                            <td style="text-align: center;">` + rowB['namabarang'] + `</td>
                            <td style="text-align: center;">` + rowB['jumlahjual'] + `</td>
                            <td style="width: 10%; text-align: right;">` + totitik(rowB['subtotaljual']) + `</td>
                            <td style="width: 10%; text-align: right;">` + rumusKomisi + `</td>
                            <td style="width: 10%; text-align: right;">` + totitik(parseInt(rowB['subtotalbonustagihan'])) + `</td>
                        </tr>
                    `;
                    $('#tbodyPenagihan').append(addTextB);
                    noB++;
                }
                $('#totalpenagihan').val(totitik(rsB['totalPembayaran']));
                $('#totalbonuspenagihan').val( totitik(totalbonuspenagihan));
            }else{
                $('#totalpenagihan').val('0');
                $('#totalbonuspenagihan').val('0');
            }

    }


    function hitungBonusTarget(rsC, jumlahtarget, jumlahpencapaian) {
        
        if (rsC.length >0 ) {
                var totalpenjualan = 0;
                var totalbonustarget = 0;
                var noA = 1;
                for (var i = 0; i < rsC.length; i++) {

                    var rowC = rsC[i];

                    totalpenjualan += parseInt(rowC['subtotaljual']);

                    
                    var rumusKomisiC = rowC['persenbonustarget'] + ' %';

                    var subtotalhargabersih =  (parseInt(rowC['hargadpp']) - parseInt(rowC['jumlahdiskon'])) * parseInt(rowC['jumlahjual']);


                    //jika penjualan mencapai target
                    if (parseInt(jumlahpencapaian)>=parseInt(jumlahtarget) ) {
                        var jumlahbonustarget = (parseFloat(rowC['persenbonustarget'])/100) * parseFloat(subtotalhargabersih);                                                    
                    }else{
                        var jumlahbonustarget = 0;
                    }


                    totalbonustarget += jumlahbonustarget;

                    var addTextC = `
                        <tr>
                            <td style="width: 5%; text-align: center;">` + noA + `</td>
                            <td style="display: none;">` + rowC['idpenjualan'] + `</td>
                            <td style="display: none;">` + rowC['id'] + `</td>
                            <td style="display: none;">` + rowC['idjenisbarang'] + `</td>
                            <td style="display: none;">` + rowC['persenbonustarget'] + `</td>
                            <td style="width: 15%; text-align: center;">` + rowC['noinvoice'] + `</td>
                            <td style="width: 10%; text-align: center;">` + rowC['tglinvoice'] + `</td>
                            <td style="text-align: left;">` + rowC['namabarang'] + `</td>
                            <td style="text-align: center;">` + rowC['jenisbarang'] + `</td>
                            <td style="width: 10%; text-align: right;">` + totitik(subtotalhargabersih) + `</td>
                            <td style="width: 10%; text-align: center;">` + rumusKomisiC + `</td>
                            <td style="width: 10%; text-align: right;">` + totitik(parseInt(jumlahbonustarget)) + `</td>
                        </tr>
                    `;
                    $('#tbodyTarget').append(addTextC);
                    noA++;
                }
                $('#pencapaiantarget').val(totitik(jumlahpencapaian));
                $('#targetpenjualan').val( totitik(jumlahtarget));
                $('#totalbonustarget').val( totitik(totalbonustarget));
                
            }else{
                $('#pencapaiantarget').val('0');
                $('#targetpenjualan').val('0');
                $('#totalbonustarget').val('0');
            }

    }


    $('#form').submit(function (e) { 
        e.preventDefault();
        $('#btnSimpan').attr('disabled', true);

        var tglbonus = $('#tglbonus').val();
        var idsales = $('#idsales').val();
        var keterangan = $('#keterangan').val();
        var totalpenjualan = $('#totalpenjualan').val();
        var totalbonuspenjualan = $('#totalbonuspenjualan').val();
        var totalpenagihan = $('#totalpenagihan').val();
        var totalbonuspenagihan = $('#totalbonuspenagihan').val();
        var targetpenjualan = $('#targetpenjualan').val();
        var pencapaiantarget = $('#pencapaiantarget').val();
        var totalbonustarget = $('#totalbonustarget').val();


        if (tglbonus == '' ) {
            swal("Informasi", "Tanggal tidak boleh kosong", "info");
            $('#btnSimpan').attr('disabled', false);
            return false;
        }

        if (idsales == '' || idsales == null) {
            swal("Informasi", "Nama sales tidak boleh kosong", "info");
            $('#btnSimpan').attr('disabled', false);
            return false;
        }

        if (parseInt(totalbonuspenjualan) == 0 && parseInt(totalbonuspenagihan)==0 && parseInt(totalbonustarget)==0) {
            swal("Informasi", "Tidak ada detail bonus yang diterima!", "info");
            $('#btnSimpan').attr('disabled', false);
            return false;
        }

        var arrPenjualan = [];
        $("#tablePenjualan tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").each(function() {
                rowData.push($(this).text());
            });
            arrPenjualan.push(rowData);
        });

        tablePenjualan = [];
        for (var i = 0; i < arrPenjualan.length; i++) {
            tablePenjualan.push({
                'idpenjualan': arrPenjualan[i][1],
                'idpenjualandetail': arrPenjualan[i][2],
                'jenisbonuspenjualan': arrPenjualan[i][3],
                'persenbonuspenjualan': arrPenjualan[i][4],
                'jumlahbonuspenjualan': arrPenjualan[i][5],
                'iddetailsuratjalan': arrPenjualan[i][6],
                'subtotal': arrPenjualan[i][10],
                'totalbonus': arrPenjualan[i][12],
            });
        }


        var arrPenagihan = [];
        $("#tablePenagihan tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").each(function() {
                rowData.push($(this).text());
            });
            arrPenagihan.push(rowData);
        });

        tablePenagihan = [];
        for (var i = 0; i < arrPenagihan.length; i++) {
            tablePenagihan.push({
                'idpiutang': arrPenagihan[i][1],
                'idpenjualan': arrPenagihan[i][2],
                'idpenjualandetail': arrPenagihan[i][3],
                'jenisbonustagihan': arrPenagihan[i][4],
                'persenbonustagihan': arrPenagihan[i][5],
                'jumlahbonustagihan': arrPenagihan[i][6],
                'subtotal': arrPenagihan[i][11],
                'totalbonus': arrPenagihan[i][13],
            });
        }


        var arrTarget = [];
        $("#tableTarget tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").each(function() {
                rowData.push($(this).text());
            });
            arrTarget.push(rowData);
        });

        tableTarget = [];
        for (var i = 0; i < arrTarget.length; i++) {
            tableTarget.push({
                'idpenjualan': arrTarget[i][1],
                'idpenjualandetail': arrTarget[i][2],
                'idjenisbarang': arrTarget[i][3],
                'persenbonustarget': arrTarget[i][4],
                'subtotal': arrTarget[i][9],
                'totalbonus': arrTarget[i][11],
            });
        }

        var formData = {
            "tglbonus": tglbonus,
            "idsales": idsales,
            "keterangan": keterangan,
            "totalpenjualan": totalpenjualan,
            "totalbonuspenjualan": totalbonuspenjualan,
            "totalpenagihan": totalpenagihan,
            "totalbonuspenagihan": totalbonuspenagihan,
            "targetpenjualan": targetpenjualan,
            "pencapaiantarget": pencapaiantarget,
            "totalbonustarget": totalbonustarget,
            "tablePenjualan": tablePenjualan,
            "tablePenagihan": tablePenagihan,
            "tableTarget": tableTarget,
        }
        // console.log(formData);

        //jika kondisi piutang masih ada, maka simpan data
        $.ajax({
            type: 'POST',
            url: "{{ url('bonussales/simpanData') }}",
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
                        window.location.href = "{{ url('bonussales') }}";
                    });
            } else {
                $('#btnSimpan').attr('disabled', false);
                swal("Informasi", result.msg, "info");
            }
        })
        .fail(function() {
            $('#btnSimpan').attr('disabled', false);
            console.log("Gagal script simpanData1!");
            swal("Error", "Terjadi kesalahan script!!", "error");
        });

    });
</script>
@endsection