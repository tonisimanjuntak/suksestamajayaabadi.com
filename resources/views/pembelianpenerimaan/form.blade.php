@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penerimaan PO</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('pembelianpenerimaan') }}">Penerimaan PO</a></li>
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
                                        class="label-judul"></span> Data Faktur Penerimaan PO</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                
                                                <div class="col-md-7 required">
                                                    <div class="form-group">
                                                        <label for="idsupplier">Nama Supplier</label>
                                                        <select name="idsupplier" id="idsupplier" class="form-control searchSupplier"></select>
                                                    </div>
                                                </div> 
                                                
                                                <div class="col-md-5 required">
                                                    <div class="form-group">
                                                        <label for="idpembelian">No Purchase Order</label>
                                                        <select name="idpembelian" id="idpembelian" class="form-control"></select>
                                                    </div>
                                                </div> 

                                                <div class="col-md-4 required">
                                                    <div class="form-group">
                                                        <label for="nofaktur">No Faktur</label>
                                                        <input type="text" name="nofaktur" id="nofaktur"
                                                            class="form-control" placeholder="Nomor faktur">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 required">
                                                    <div class="form-group">
                                                        <label for="tglfaktur">Tanggal Faktur</label>
                                                        <input type="date" name="tglfaktur" id="tglfaktur"
                                                            class="form-control" value="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 required">
                                                    <div class="form-group">
                                                        <label for="tglditerima">Tanggal Diterima</label>
                                                        <input type="date" name="tglditerima" id="tglditerima"
                                                            class="form-control" value="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                                                         

                                                <div class="col-md-4 required">
                                                    <div class="form-group">
                                                        <label for="carabayar">Cara Bayar Faktur</label>
                                                        <select name="carabayar" id="carabayar" class="form-control select2">
                                                            <option value="">Pilih cara bayar...</option>
                                                            <option value="Tunai">Tunai</option>
                                                            <option value="Transfer">Transfer</option>
                                                            <option value="Giro" selected="">Giro</option>
                                                            <option value="Hutang" selected="">Hutang</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 required" id="divBank" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="idbank">Nama Bank</label>
                                                        <select name="idbank" id="idbank" class="form-control searchBank">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 required divGiro" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="nobilyetgiro">No Bilyet Giro</label>
                                                        <input type="text" name="nobilyetgiro" id="nobilyetgiro"
                                                            class="form-control" placeholder="No Bilyet Giro">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 required divGiro" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="tglbilyetgiro">Tgl Bilyet Giro</label>
                                                        <input type="date" name="tglbilyetgiro" id="tglbilyetgiro"
                                                            class="form-control" value="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 required">
                                                    <div class="form-group">
                                                        <label for="idekspedisi">Nama Ekspedisi</label>
                                                        <select name="idekspedisi" id="idekspedisi" class="form-control searchEkspedisi">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                                                            placeholder="Keterangan Pembelian"></textarea>
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
                                                    <h3 class="text-muted">Detail Faktur Penerimaan</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-md btn-success float-right" id="btnTambahDetail" disabled><i class="fa fa-plus-circle mr-1"></i> Tambah Detail</button>
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
                                                                    <th style="width: 5%; text-align: center;">Qty PO</th>
                                                                    <th style="width: 5%; text-align: center;">Qty Masuk</th>
                                                                    <th style="width: 10%; text-align: right;">Harga Satuan</th>
                                                                    <th style="width: 10%; text-align: right;">DPP</th>
                                                                    <th style="width: 10%; text-align: right;">PPN</th>
                                                                    <th style="width: 10%; text-align: right;">Discount</th>
                                                                    <th style="width: 10%; text-align: right;">Sub Total</th>
                                                                    <th style="">iddetail</th>
                                                                    <th style="width: 10%; text-align: center;">Aksi</th>
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
                                        <label for="totaldpp" class="col-md-6 col-form-label">Jumlah DPP</label>
                                        <input type="text" name="totaldpp" id="totaldpp"
                                        class="form-control col-md-6 rupiah" value="0" readonly>
                                        
                                        <input type="hidden" name="ppnpersen" id="ppnpersen" value="{{ session()->get('ppn_pembelian') }}" readonly>
                                        <label for="totalppn" class="col-md-6 col-form-label">PPN (%)</label>
                                        <input type="text" name="totalppn" id="totalppn"
                                            class="form-control col-md-6 rupiah" value="0" readonly>

                                        <label for="totaldiskon" class="col-md-6 col-form-label">Jumlah Diskon</label>
                                        <input type="text" name="totaldiskon" id="totaldiskon" class="form-control col-md-6 rupiah" value="0" readonly>

                                        <label for="totalpotongan" class="col-md-6 col-form-label">Jumlah Potongan</label>
                                        <input type="text" name="totalpotongan" id="totalpotongan" class="form-control col-md-6 rupiah" value="0">

                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                        <label for="totalfaktur" class="col-md-6 col-form-label">Total Faktur</label>
                                        <input type="text" name="totalfaktur" id="totalfaktur"
                                            class="form-control col-md-6 rupiah" value="0" readonly>
                                        
                                        <label for="biayapengiriman" class="col-md-6 col-form-label">Biaya Pengiriman</label>
                                        <input type="text" name="biayapengiriman" id="biayapengiriman"
                                            class="form-control col-md-6 rupiah" value="0">

                                        
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('pembelianpenerimaan') }}" class="btn btn-default float-right mr-1"><i
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


@include('pembelianpenerimaan/modalTambahBarang')

<script type="text/javascript">
    var idpembelian = "<?php echo $idpembelian; ?>";

    $(document).ready(function() {

        $('#tableDetail thead tr :nth-child(2)').hide();
        $('#tableDetail thead tr :nth-child(3)').hide();
        $('#tableDetail thead tr :nth-child(4)').hide();
        $('#tableDetail thead tr :nth-child(5)').hide();
        $('#tableDetail thead tr :nth-child(6)').hide();
        $('#tableDetail thead tr :nth-child(7)').hide();
        $('#tableDetail thead tr :nth-child(16)').hide(); //iddetail

        $('#tableDetail tbody tr :nth-child(2)').hide();
        $('#tableDetail tbody tr :nth-child(3)').hide();
        $('#tableDetail tbody tr :nth-child(4)').hide();
        $('#tableDetail tbody tr :nth-child(5)').hide();
        $('#tableDetail tbody tr :nth-child(6)').hide();
        $('#tableDetail tbody tr :nth-child(16)').hide();

        $('.select2').select2();

        if (idpembelian != "") {
            $('#idpembelian').val(idpembelian);
            $('.label-judul').html('Edit');
            $.ajax({
                    url: "{{ url('pembelianpenerimaan/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpembelian': idpembelian
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPembelian = response.rsPembelian;
                    addSelectOption('idsupplier', rsPembelian['idsupplier'], rsPembelian['namasupplier'])
                    $('#idsupplier').val(rsPembelian['idsupplier']).trigger('change');

                    $('#nofaktur').val(rsPembelian['nofaktur']);
                    $('#tglfaktur').val(rsPembelian['tglfaktur']);
                    $('#tglditerima').val(rsPembelian['tglditerima']);
                    $('#keterangan').val(rsPembelian['keterangan']);
                    $('#ppnpersen').val(rsPembelian['ppnpersen']);
                    $('#carabayar').val(rsPembelian['carabayar']).trigger('change');                    
                    $('#nobilyetgiro').val(rsPembelian['nobilyetgiro']);

                    if (rsPembelian['idbank'] != '') {
                        addSelectOption('idbank', rsPembelian['idbank'], rsPembelian['namabank'] + ' Rek: '+rsPembelian['norekening'] + ' Atas Nama: '+rsPembelian['atasnama']);
                        $('#idbank').val(rsPembelian['idbank']);
                    }


                    var rsDetail = response.rsDetail;
                    // console.log(rsDetail.length);
                    if (rsDetail.length > 0) {
                        for (var i = 0; i < rsDetail.length; i++) {
                            // console.log(rsDetail[i]);
                            addTableRow(rsDetail[i]['idbarang'], rsDetail[i]['namabarang'], rsDetail[i][
                                    'jumlahbeli'
                                ], rsDetail[i]['hargasatuan'], rsDetail[i]['hargadpp'], rsDetail[i]['jumlahppn'], rsDetail[i]['subtotalbeli'], rsDetail[i]['jenisdiskon'], rsDetail[i]['jumlahdiskon'], rsDetail[i]['diskonpersen1'], rsDetail[i]['diskonpersen2'], rsDetail[i]['diskonpersen3'], 0);
                        }
                    }
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            $('.label-judul').html('Tambah');

        }


        $('#biayapengiriman').on('change', function() {
            hitungTotalFaktur();
        });

        $('#totalpotongan').on('change', function() {
            hitungTotalFaktur();
        });

        $('#idpembelian').select2({
                placeholder: 'Cari nomor PO...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('pembelianpenerimaan.searchPO') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                            idsupplier: $('#idsupplier').val()
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results, // Format data untuk Select2
                        };
                    },
                    cache: true
                },
            });

        
            $("#tableDetail").on("click", ".btnEditDetail", function() {       
                var varidpembelian = $(this).attr('data-idpembelian');
                // var varidbarang = $(this).attr('data-idbarang');
                // var varnamabarang = $(this).attr('data-namabarang');

                var row = $(this).closest('tr');
                var rowIndex = row.index(); // dimulai dari row 0        
                var tableRow = $("#tableDetail tbody tr:eq(" + rowIndex + ")");

                var varidbarang = tableRow.find('td:eq(1)').text();
                var varjenisdiskon = tableRow.find('td:eq(2)').text();
                var vardiskonpersen1 = tableRow.find('td:eq(3)').text();
                var vardiskonpersen2 = tableRow.find('td:eq(4)').text();
                var vardiskonpersen3 = tableRow.find('td:eq(5)').text();
                var varjumlahdiskon = tableRow.find('td:eq(6)').text();
                var varnamabarang = tableRow.find('td:eq(7)').text();
                var varjumlahbeli_po = tableRow.find('td:eq(8)').text();
                var varjumlahbeli = tableRow.find('td:eq(9)').text();
                var varhargasatuan = tableRow.find('td:eq(10)').text();
                var varhargadpp = tableRow.find('td:eq(11)').text();
                var varjumlahppn = tableRow.find('td:eq(12)').text();

                var varsubtotalbeli = tableRow.find('td:eq(14)').text();
                var variddetail = tableRow.find('td:eq(15)').text();
                
                $('#modalTambahBarang').modal('show');
                $('.modal-title').html('Ubah Detail Penerimaan');
                $('#ltambahbarang').val('0'); //penanda apakah tambah (1) barang atau edit (0)
                $('#tambahkan').html('Ubah');


                $('#idbarang').empty().val('').trigger('change'); //wajib dikosogkan terlebih dahulu supaya bisa diisi ulang

                addSelectOption('idbarang', varidbarang, varnamabarang)
                setTimeout(function() {
                    $('#idbarang').val(varidbarang).trigger('change');
                }, 1000); // Tambahkan delay agar Select2 siap
                $('#idbarang').attr('disabled', true);

                $('#namabarang').val(varnamabarang);

                

                $('#rowIndex').val(rowIndex);
                

                if (varidpembelian == "") {
                    swal("Info", "Tidak ditemukan nomor purchase order!", "info");
                    return;
                }
                if (varidbarang == "") {
                    swal("Info", "Tidak ditemukan nama barang!", "info");
                    return;
                }

                

                $('#jumlahbeli').val(varjumlahbeli);
                $('#hargasatuan').val( varhargasatuan );
                $('#hargadpp').val( varhargadpp );
                $('#jumlahppn').val( varjumlahppn );
                $('#jumlahdiskon').val( varjumlahdiskon );
                $('#subtotalbeli').val( varsubtotalbeli );

                if (varjenisdiskon == null || varjenisdiskon == "") {
                    $('#jenisdiskon1').prop('checked', true).trigger('change');
                    $('input[name="jenisdiskon"]').trigger('change');
                    $('#jumlahdiskon').val('0');
                    $('#diskonpersen1').val('0');
                    $('#diskonpersen2').val('0');
                    $('#diskonpersen3').val('0');                            
                }else{
                    $('#jumlahdiskon').val('0');
                    $('#diskonpersen1').val('0');
                    $('#diskonpersen2').val('0');
                    $('#diskonpersen3').val('0');

                    if (varjenisdiskon == 'Nominal') {
                        $('#jenisdiskon1').prop('checked', true).trigger('change');
                        jenisDiskonChange(varjenisdiskon);

                        $('#jumlahdiskon').val(varjumlahdiskon);
                    }else{
                        $('#jenisdiskon2').prop('checked', true).trigger('change');
                        jenisDiskonChange(varjenisdiskon);

                        $('#diskonpersen1').val(vardiskonpersen1);
                        $('#diskonpersen2').val(vardiskonpersen2);
                        $('#diskonpersen3').val(vardiskonpersen3).trigger('change');
                        $('#jumlahdiskon').val(varjumlahdiskon);
                    }            
                }


                // $('#idbarang').focus();

                    // $.ajax({
                    //         url: "{{ url('pembelianpenerimaan/getDetailId') }}",
                    //         type: 'GET',
                    //         dataType: 'json',
                    //         data: {
                    //             'idpembelian': varidpembelian,
                    //             'idbarang': varidbarang,
                    //         },
                    //     })
                    //     .done(function(response) {
                    //         console.log(response);
                    //         var rowDetail = response['rowDetail'];
                    //         $('#stok').val(rowDetail['stokreal']);
                    //         $('#tdKategori').html(rowDetail['namakategori']);
                    //         $('#tdStok').html(rowDetail['stokreal']);                    
                    //     })
                    //     .fail(function() {
                    //         console.log('error getDetailID');
                    //     });
                

                

                // setTimeout(function() {
                //     loadModalTambahBarang(rowIndex, varidpembelian, varidbarang);
                // }, 1000); // Tambahkan delay agar Select2 siap

                
            });

            $(document).on("click", "#btnTambahDetail", function() {        
                
                $('#modalTambahBarang').modal('show');
                $('.modal-title').html('Tambah Detail Penerimaan');
                $('#tambahkan').html('Tambahkan');
                $('#ltambahbarang').val('1'); //penanda apakah tambah (1) barang atau edit (0)
                kosongkanModal();
                $('#idbarang').attr('disabled', false);
            });


        $("form").attr('autocomplete', 'off');
    });



    $("#tableDetail").on("click", ".deleteRow", function() {
        $(this).closest("tr").remove();
    });

    

    

    

    $('#simpan').click(function() {
        $('#simpan').attr('disabled', true);
        
        var idpembelian = $("#idpembelian").val();
        var nofaktur = $("#nofaktur").val();
        var tglfaktur = $("#tglfaktur").val();
        var tglditerima = $("#tglditerima").val();
        var carabayar = $("#carabayar").val();
        var idbank = $("#idbank").val();
        var nobilyetgiro = $("#nobilyetgiro").val();
        var tglbilyetgiro = $("#tglbilyetgiro").val();
        var idsupplier = $("#idsupplier").val();
        var idekspedisi = $("#idekspedisi").val();
        var keterangan = $("#keterangan").val();

        var totaldpp = $("#totaldpp").val();
        var totaldiskon = $("#totaldiskon").val();
        var totalbersih = $("#totalbersih").val();
        var ppnpersen = $("#ppnpersen").val();
        var totalppn = $("#totalppn").val();
        var totalpotongan = $("#totalpotongan").val();
        var totalfaktur = $("#totalfaktur").val();
        var biayapengiriman = $("#biayapengiriman").val();

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });


        if (idpembelian == '' || idpembelian == null) {
            swal("Informasi", "Nomor PO tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idpembelian').focus();
                });
            return;
        }

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
            idbank = null;
        }

        if (carabayar == 'Giro') {


            if (nobilyetgiro == '') {
                swal("Informasi", "No Bilyet Giro tidak boleh kosong!", "info")
                    .then(function() {
                        $('#simpan').attr('disabled', false);
                        $('#nobilyetgiro').focus();
                    });
                return;
            }

            if (tglbilyetgiro == '') {
                swal("Informasi", "Tgl Bilyet Giro tidak boleh kosong!", "info")
                    .then(function() {
                        $('#simpan').attr('disabled', false);
                        $('#tglbilyetgiro').focus();
                    });
                return;
            }
        } else {
            nobilyetgiro = '';            
        }


        if (ppnpersen == '') {
            swal("Informasi", "PPN tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#ppnpersen').focus();
                });
            return;
        }

        if (idsupplier == '' || idsupplier == null) {
            swal("Informasi", "Nama supplier tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idsupplier').focus();
                });
            return;
        }

        if (idekspedisi == '' || idekspedisi == null) {
            swal("Informasi", "Nama ekspedisi tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idekspedisi').focus();
                });
            return;
        }

        if (nofaktur == '') {
            swal("Informasi", "Nomor faktur tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#nofaktur').focus();
                });
            return;
        }

        if (tglfaktur == '') {
            swal("Informasi", "Tanggal faktur tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#tglfaktur').focus();
                });
            return;
        }

        if (tglditerima == '') {
            swal("Informasi", "Tanggal diterima boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#tglditerima').focus();
                });
            return;
        }

        if ($("#tableDetail tbody tr").length == 0) {
            $('#simpan').attr('disabled', false);
            swal("Informasi", "Detail pembelian belum ada!!", "info");
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
                'jumlahbeli': tableData[i][9],
                'hargasatuan': tableData[i][10],
                'hargadpp': tableData[i][11],
                'jumlahppn': tableData[i][12],
                'subtotalbeli': tableData[i][14],
                'iddetail': tableData[i][15],
            })
        }

        var formData = {
            "idpembelian": idpembelian,
            "nofaktur": nofaktur,
            "tglfaktur": tglfaktur,
            "tglditerima": tglditerima,
            "carabayar": carabayar,
            "idbank": idbank,
            "nobilyetgiro": nobilyetgiro,
            "tglbilyetgiro": tglbilyetgiro,
            "idsupplier": idsupplier,
            "idekspedisi": idekspedisi,
            "keterangan": keterangan,
            "totaldpp": totaldpp,
            "totaldiskon": totaldiskon,
            "totalbersih": totalbersih,
            "ppnpersen": ppnpersen,
            "totalppn": totalppn,
            "totalpotongan": totalpotongan,
            "totalfaktur": totalfaktur,
            "biayapengiriman": biayapengiriman,
            "isidatatable": isidatatable
        };

        // console.log(formData);
        // return;

        $.ajax({
                type: 'POST',
                url: "{{ url('pembelianpenerimaan/simpanData') }}",
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
                            window.location.href = "{{ url('pembelianpenerimaan') }}";
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


    function hitungTotalFaktur()
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

        var totaldpp = 0;
        var totalDiskon = 0;
        var totalPPN = 0;
        
        for (var i = 0; i < arrTable.length; i++) {
            var jumlahbeli = parseInt(untitik(arrTable[i][9]));
            totaldpp += jumlahbeli * parseInt(untitik(arrTable[i][11]));
            totalDiskon += jumlahbeli * parseInt(untitik(arrTable[i][6]));            
            totalPPN += jumlahbeli * parseInt(untitik(arrTable[i][12]));
        }
        var totalpotongan = parseInt(untitik($('#totalpotongan').val()));
        var totalFaktur = totaldpp + totalPPN - totalDiskon - totalpotongan;

        $('#totaldpp').val(totitik(totaldpp));
        $('#totaldiskon').val(totitik(totalDiskon));
        $('#totalppn').val(totitik(totalPPN));
        $('#totalfaktur').val(totitik(totalFaktur));
    }

    $(document).on('change', '#carabayar', function() {
        var carabayar = $(this).val();
        $('#divBank').hide();
        $('.divGiro').hide();

        if (carabayar == 'Transfer') {
            $('#divBank').show();
        }

        if (carabayar == 'Giro') {
            $('#divBank').show();
            $('.divGiro').show();
        }
    });

    $(document).on('change', '#idsupplier', function() {
        $('#idpembelian').val('').trigger('change');
    });

    $(document).on('change', '#idpembelian', function() {
        var varidpembelian = $(this).val();
        // console.log(varidpembelian);
        $('#tableDetail tbody').empty();

        if (varidpembelian != "" && varidpembelian != null) {
            $.ajax({
                url: "{{ url('pembelianpenerimaan/getPurchaseOrder') }}",
                type: 'GET',
                dataType: 'json',
                data: {'idpembelian': varidpembelian},
            })
            .done(function(response) {
                console.log(response);
                var rsDetail = response['rsPembelianDetail'];

                if (rsDetail.length > 0) {
                    for (var i = 0; i < rsDetail.length; i++) {
                        var jenisdiskon = 'Nominal';
                        var jumlahdiskon = 0;
                        var diskonpersen1 = 0;
                        var diskonpersen2 = 0;
                        var diskonpersen3 = 0;
        
                        addTableRow(rsDetail[i]['id'], rsDetail[i]['idpembelian'], rsDetail[i]['idbarang'], rsDetail[i]['namabarang'], rsDetail[i][
                                            'jumlahbeli_po'
                                        ], rsDetail[i]['hargasatuan_po'], rsDetail[i]['hargadpp_po'], rsDetail[i]['jumlahppn_po'], rsDetail[i]['subtotalbeli_po'], jenisdiskon, jumlahdiskon, diskonpersen1, diskonpersen2, diskonpersen3, 0);
                    }

                    $('#btnTambahDetail').attr('disabled', false);

                }
            })
            .fail(function() {
                console.log('error getPurchaseOrder');
            });            
        }else{
            $('#btnTambahDetail').attr('disabled', true);
        };

    });

</script>




@endsection