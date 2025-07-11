<!-- Modal -->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Detail Penerimaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ url('pembelianpenerimaan/simpanData') }}" method="post" id="formModalTambahDetail" enctype="multipart/form-data">

                        <input type="hidden" name="ltambahbarang" id="ltambahbarang">
                        <input type="hidden" name="rowIndex" id="rowIndex">

                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="alert alert-warning" role="alert">
                                            <strong>INFO! </strong> Harga yang diinput adalah harga sebelum dikenakan PPN.
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="idbarang" class="col-md-3 col-form-label">Nama Barang</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <select name="idbarang" id="idbarang" class="form-control searchBarang"></select>
                                                        <input type="hidden" name="stok" id="stok">
                                                        <input type="hidden" name="namabarang" id="namabarang">
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 15%; text-align: left;">Kategori</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdKategori"></td>
                                                                    <td style="width: 15%; text-align: left;">Stok</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdStok"></td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>









                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="jumlahbeli" class="col-md-4 col-form-label">Jumlah Qty</label>
                                                    <div class="col-md-8">
                                                        <input type="number" name="jumlahbeli" id="jumlahbeli" class="form-control" min="1" value="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="hargasatuan" class="col-md-4 col-form-label">Harga Beli</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="hargasatuan" id="hargasatuan" class="form-control rupiah">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="hargadpp" class="col-md-4 col-form-label">Harga DPP</label>
                                                    <div class="col-md-8">
                                                        <input type="hidden" name="hargadpp" id="hargadpp" class="form-control rupiah" value="0" readonly>
                                                        <input type="text" name="hargadpp_display" id="hargadpp_display" class="form-control rupiah" value="0" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="jumlahppn" class="col-md-4 col-form-label">Jumlah PPN</label>
                                                    <div class="col-md-8">
                                                        <input type="hidden" name="jumlahppn" id="jumlahppn" class="form-control rupiah" value="0" readonly>
                                                        <input type="text" name="jumlahppn_display" id="jumlahppn_display" class="form-control rupiah" value="0" readonly>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="jumlahdiskon2" class="col-md-4 col-form-label">Jumlah Diskon</label>
                                                    <div class="col-md-8">
                                                        <input type="hidden" name="jumlahdiskon2" id="jumlahdiskon2" class="form-control rupiah" value="0" readonly>
                                                        <input type="text" name="jumlahdiskon2_display" id="jumlahdiskon2_display" class="form-control rupiah" value="0" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="subtotalbeli" class="col-md-4 col-form-label">Sub Total</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="subtotalbeli" id="subtotalbeli" class="form-control rupiah" value="0" readonly>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-4">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="jenisdiskon" class="col-md-12">Jenis Diskon</label>
                                                            <div class="col-12">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="jenisdiskon" id="jenisdiskon1" value="Nominal" checked>
                                                                    <label class="form-check-label" for="jenisdiskon1">Diskon Nominal</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="jenisdiskon" id="jenisdiskon2" value="Persen">
                                                                    <label class="form-check-label" for="jenisdiskon2">Diskon Persen</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-12 diskonpersen" style="display: none;">
                                                        <div class="form-group row">
                                                            <label for="diskonpersen1" class="col-md-5 col-form-label">Discount 1 (%)</label>
                                                            <div class="col-md-7">
                                                                <input type="number" name="diskonpersen1" id="diskonpersen1" class="form-control" min="0" max="100" value="0" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="diskonpersen2" class="col-md-5 col-form-label">Discount 2 (%)</label>
                                                            <div class="col-md-7">
                                                                <input type="number" name="diskonpersen2" id="diskonpersen2" class="form-control" min="0" max="100" value="0" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="diskonpersen3" class="col-md-5 col-form-label">Discount 3 (%)</label>
                                                            <div class="col-md-7">
                                                                <input type="number" name="diskonpersen3" id="diskonpersen3" class="form-control" min="0" max="100" value="0" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="jumlahdiskon" class="col-md-5 col-form-label">Jumlah Satuan Discount</label>
                                                            <div class="col-md-7">
                                                                <input type="text" name="jumlahdiskon" id="jumlahdiskon" class="form-control rupiah">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary float-right ml-1" id="tambahkan">Tambahkan</button>
                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#formModalTambahDetail').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    idbarang: {
                        validators: {
                            notEmpty: {
                                message: "nama barang tidak boleh kosong"
                            },
                        }
                    },
                    jumlahbeli: {
                        validators: {
                            notEmpty: {
                                message: "jumlah tidak boleh kosong"
                            },
                        }
                    },
                    hargasatuan: {
                        validators: {
                            notEmpty: {
                                message: "harga beli tidak boleh kosong"
                            },
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                e.preventDefault();
                $('#tambahkan').attr('disabled', true);

                var idbarang = $('#idbarang').val();
                var namabarang = $('#namabarang').val();
                var jumlahbeli = $('#jumlahbeli').val();
                var hargasatuan = untitik($('#hargasatuan').val());
                var jumlahdppsatuan = untitik($('#hargadpp').val());
                var jumlahppnsatuan = untitik($('#jumlahppn').val());
                var subtotalbeli = untitik($('#subtotalbeli').val());
                var jenisdiskon = $('input[name="jenisdiskon"]:checked').val();
                var jumlahdiskon = untitik($('#jumlahdiskon').val());
                var diskonpersen1 = untitik($('#diskonpersen1').val());
                var diskonpersen2 = untitik($('#diskonpersen2').val());
                var diskonpersen3 = untitik($('#diskonpersen3').val());
                var jumlahdiskon = untitik($('#jumlahdiskon').val());
                var stok = untitik($('#stok').val());

                var ltambahbarang = $('#ltambahbarang').val();
                var rowIndex = $('#rowIndex').val();
                var varidpembelian = $('#idpembelian').val();

                if (ltambahbarang=='0') {
                    
                    updateTableRow(varidpembelian, idbarang, namabarang, jumlahbeli, hargasatuan, jumlahdppsatuan, jumlahppnsatuan,
                        subtotalbeli, jenisdiskon, jumlahdiskon, diskonpersen1, diskonpersen2, diskonpersen3, stok, rowIndex);

                        

                }else{
                    var variddetail= "";
                    addTableRow(variddetail, varidpembelian, idbarang, namabarang, jumlahbeli, hargasatuan, jumlahdppsatuan, jumlahppnsatuan,
                        subtotalbeli, jenisdiskon, jumlahdiskon, diskonpersen1, diskonpersen2, diskonpersen3, stok);
                }

                $('#tambahkan').attr('disabled', false);
            });


        $('input[name="jenisdiskon"]').change(function() {
            var jenisDiskon = $(this).val();
            jenisDiskonChange(jenisDiskon);
        });


    });

    function loadModalTambahBarang(rowIndex = 0, varidpembelian = "", varidbarang = "") {
        $('#rowIndex').val(rowIndex);
        $('#modalTambahBarang').modal('show');

        if (varidpembelian != "" && varidbarang != "") {
            $('.modal-title').html('Ubah Detail Penerimaan');
            $('#ltambahbarang').val('0'); //penanda apakah tambah (1) barang atau edit (0)
            $('#tambahkan').html('Ubah');

            $.ajax({
                    url: "{{ url('pembelianpenerimaan/getDetailId') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpembelian': varidpembelian,
                        'idbarang': varidbarang,
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    var rowDetail = response['rowDetail'];


                    
                    $('#stok').val(rowDetail['stokreal']);
                    $('#tdKategori').html(rowDetail['namakategori']);
                    $('#tdStok').html(rowDetail['stokreal']);


                    $('#jumlahbeli').val( (parseInt(rowDetail['jumlahbeli']) != 0) ? rowDetail['jumlahbeli'] : rowDetail['jumlahbeli_po'] );

                    $('#hargasatuan').val( totitik((parseInt(rowDetail['hargasatuan']) != 0) ? rowDetail['hargasatuan'] : rowDetail['hargasatuan_po'] ) );
                    $('#hargadpp').val( (parseInt(rowDetail['hargadpp']) != 0) ? rowDetail['hargadpp'] : rowDetail['hargadpp_po'] );
                    $('#jumlahppn').val( (parseInt(rowDetail['jumlahppn']) != 0) ? rowDetail['jumlahppn'] : rowDetail['jumlahppn_po'] );
                    $('#jumlahdiskon').val( rowDetail['jumlahdiskon'] );
                    $('#subtotalbeli').val( (parseInt(rowDetail['subtotalbeli']) != 0) ? rowDetail['subtotalbeli'] : rowDetail['subtotalbeli_po'] );

                    if (rowDetail['jenisdiskon'] == null || rowDetail['jenisdiskon'] == "") {
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

                        if (rowDetail['jenisdiskon'] == 'Nominal') {
                            $('#jenisdiskon1').prop('checked', true).trigger('change');
                            $('input[name="jenisdiskon"]').trigger('change');

                            $('#jumlahdiskon').val(rowDetail['jumlahdiskon']);
                        }else{
                            $('#jenisdiskon2').prop('checked', true).trigger('change');
                            $('input[name="jenisdiskon"]').trigger('change');

                            $('#diskonpersen1').val(rowDetail['diskonpersen1']);
                            $('#diskonpersen2').val(rowDetail['diskonpersen2']);
                            $('#diskonpersen3').val(rowDetail['diskonpersen3']).trigger('change');
                            $('#jumlahdiskon').val(rowDetail['jumlahdiskon']);
                        }

                        
                    }
                    $('input[name="jenisdiskon"]').trigger('change');
                    $('#idbarang').focus();
                        

                    
                })
                .fail(function() {
                    console.log('error getDetailID');
                });
        }else{
            kosongkanModal();
            $('.modal-title').html('Tambah Detail Penerimaan');
            $('#tambahkan').html('Tambahkan');
            $('#ltambahbarang').val('1'); //penanda apakah tambah (1) barang atau edit (0)
        }

    }

    function addTableRow(variddetail, varidpembelian, idbarang, namabarang, jumlahbeli, hargasatuan, jumlahdppsatuan, jumlahppnsatuan, subtotalbeli,
        jenisdiskon, jumlahdiskon, diskonpersen1, diskonpersen2, diskonpersen3, stok) {

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var totalSemua = parseInt(subtotalbeli);
        for (var i = 0; i < tableData.length; i++) {
            totalSemua += parseInt(untitik(tableData[i][13]));
            if (idbarang == tableData[i][1]) {
                swal("Informasi", "Data barang sudah ada!", "info");
                return;
            }
        }

        $('#total').val(numberWithCommas(totalSemua));
        var jumlahdiskonText = '';
        if (jenisdiskon == 'Nominal') {
            jumlahdiskonText = numberWithCommas(jumlahdiskon);
        } else {
            if (diskonpersen1 != "0" && diskonpersen1 != "") {
                jumlahdiskonText = diskonpersen1 + '%';
            }
            if (diskonpersen2 != "0" && diskonpersen2 != "") {
                if (jumlahdiskonText != '') {
                    jumlahdiskonText += ' + ';
                }
                jumlahdiskonText += diskonpersen2 + '%';
            }
            if (diskonpersen3 != "0" && diskonpersen3 != "") {
                if (jumlahdiskonText != '') {
                    jumlahdiskonText += ' +';
                }
                jumlahdiskonText += diskonpersen3 + '%';
            }
            jumlahdiskonText += '<br>(' + numberWithCommas(jumlahdiskon) + ')';
        }

        jumlahbeli_po = jumlahbeli;
        if (variddetail == "") {
            jumlahbeli_po = "0"; //jika tambah barang
        }

        var No = $("#tableDetail tbody tr").length + 1;
        var addText = `<tr>
                                <td style="text-align: center;">` + No + `</td>
                                <td style="">` + idbarang + `</td>
                                <td style="">` + jenisdiskon + `</td>
                                <td style="">` + diskonpersen1 + `</td>
                                <td style="">` + diskonpersen2 + `</td>
                                <td style="">` + diskonpersen3 + `</td>
                                <td style="">` + jumlahdiskon + `</td>
                                <td style="">` + namabarang + `</td>
                                <td style="text-align: center;">` + numberWithCommas(jumlahbeli_po) + `</td>
                                <td style="text-align: center;">` + numberWithCommas(jumlahbeli) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(hargasatuan) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(jumlahdppsatuan) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(jumlahppnsatuan) + `</td>
                                <td style="text-align: right;">` + jumlahdiskonText + `</td>
                                <td style="text-align: right;">` + numberWithCommas(subtotalbeli) + `</td>
                                <td style="">` + variddetail + `</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-warning btnEditDetail" data-idpembelian="` + varidpembelian + `" data-idbarang="` + idbarang + `" data-namabarang="` + namabarang + `"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>`;

        $('#tableDetail').append(addText);
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
        $('#tableDetail tbody tr :nth-child(7)').hide();
        $('#tableDetail tbody tr :nth-child(16)').hide(); //iddetail
        hitungTotalFaktur();
        kosongkanModal();
        $('#modalTambahBarang').modal('hide');
    }

    function updateTableRow(varidpembelian, idbarang, namabarang, jumlahbeli, hargasatuan, jumlahdppsatuan, jumlahppnsatuan, subtotalbeli,
        jenisdiskon, jumlahdiskon, diskonpersen1, diskonpersen2, diskonpersen3, stok, rowIndex) {        


        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var jumlahdiskonText = '';
        if (jenisdiskon == 'Nominal') {
            jumlahdiskonText = numberWithCommas(jumlahdiskon);
        } else {
            if (diskonpersen1 != "0" && diskonpersen1 != "") {
                jumlahdiskonText = diskonpersen1 + '%';
            }
            if (diskonpersen2 != "0" && diskonpersen2 != "") {
                if (jumlahdiskonText != '') {
                    jumlahdiskonText += ' + ';
                }
                jumlahdiskonText += diskonpersen2 + '%';
            }
            if (diskonpersen3 != "0" && diskonpersen3 != "") {
                if (jumlahdiskonText != '') {
                    jumlahdiskonText += ' +';
                }
                jumlahdiskonText += diskonpersen3 + '%';
            }
            jumlahdiskonText += ' (' + numberWithCommas(jumlahdiskon) + ')';
        }


        //Update tabel sesuai dengan row nya
        var tableRow = $("#tableDetail tbody tr:eq(" + rowIndex + ")");

        var jenisdiskonCell = tableRow.find('td:eq(2)');
        var diskonpersen1Cell = tableRow.find('td:eq(3)');
        var diskonpersen2Cell = tableRow.find('td:eq(4)');
        var diskonpersen3Cell = tableRow.find('td:eq(5)');
        var jumlahdiskonCell = tableRow.find('td:eq(6)');

        var jumlahbeliCell = tableRow.find('td:eq(9)');
        var hargasatuanCell = tableRow.find('td:eq(10)');
        var jumlahdppsatuanCell = tableRow.find('td:eq(11)');
        var jumlahppnsatuanCell = tableRow.find('td:eq(12)');
        var jumlahdiskonTextCell = tableRow.find('td:eq(13)');
        var subtotalbeliCell = tableRow.find('td:eq(14)');


        jenisdiskonCell.text(jenisdiskon);
        diskonpersen1Cell.text(diskonpersen1);
        diskonpersen2Cell.text(diskonpersen2);
        diskonpersen3Cell.text(diskonpersen3);
        jumlahdiskonCell.text(jumlahdiskon);
        jumlahbeliCell.text(jumlahbeli);
        hargasatuanCell.text(numberWithCommas(hargasatuan));
        jumlahdppsatuanCell.text(numberWithCommas(jumlahdppsatuan));
        jumlahppnsatuanCell.text(numberWithCommas(jumlahppnsatuan));
        jumlahdiskonTextCell.text(jumlahdiskonText);
        subtotalbeliCell.text(numberWithCommas(subtotalbeli));

        hitungTotalFaktur();
        $('#modalTambahBarang').modal('hide');
        
        // kosongkanModal();
    }

    $('#idbarang').on('change', function() {
        var idbarang = $(this).val();
        var ltambahbarang = $('#ltambahbarang').val(); 

        if (ltambahbarang=="1") {
            
            $.ajax({
                    url: "<?php echo url('barang/getDataID') ?>",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idbarang': idbarang
                    },
                })
                .done(function(response) {
                    console.log(response);
    
                    if (JSON.stringify(response) != '{}') {
    
                        $('#namabarang').val(response['namabarang']);
                        $('#stok').val(response['stok']);
                        $('#tdKategori').html(response['namakategori']);
                        $('#tdStok').html(response['stok']);
    
    
                        $('#hargasatuan').val(numberWithCommas(response['hargabeli'])).trigger('change');
                        $('#jumlahbeli').val(1).trigger('change');
                        $('#jumlahbeli').focus();
    
                    } else {
                        $('#hargasatuan').val('');
                    }
    
                    $('#jenisdiskon1').prop('checked', true);
                    $('#jenisdiskon1').trigger('change');
                    hitungSubTotal();
                })
                .fail(function() {
                    $('#jenisdiskon1').prop('checked', true);
                    $('input[name="jenisdiskon"]').trigger('change');
                    console.log('error getBarangId');
                });
        }

    });

    $('#jumlahbeli').on('change', function() {
        hitungSubTotal();
    });
    $('#hargasatuan').on('change', function() {
        hitungSubTotal();
    });
    $('#jumlahdiskon').on('change', function() {
        hitungSubTotal();
    });
    $('#diskonpersen1').on('change', function() {
        hitungSubTotal();
    });
    $('#diskonpersen2').on('change', function() {
        hitungSubTotal();
    });
    $('#diskonpersen3').on('change', function() {
        hitungSubTotal();
    });

    function hitungSubTotal() {
        var jumlahbeli = untitik($('#jumlahbeli').val());
        var hargasatuan = untitik($('#hargasatuan').val());
        var jenisdiskon = $('input[name="jenisdiskon"]:checked').val();

        if (jenisdiskon == 'Nominal') {
            var jumlahdiskon = untitik($('#jumlahdiskon').val());
            var jumlahdiskon = parseInt(jumlahdiskon);
            //console.log(jumlahdiskon);
            $('#jumlahdiskon').val(numberWithCommas(jumlahdiskon));
            $('#jumlahdiskon2').val(numberWithCommas(jumlahdiskon));
            $('#jumlahdiskon2_display').val(numberWithCommas( parseInt(jumlahdiskon) * parseInt(jumlahbeli) ));
        } else {
            var diskon1 = untitik($('#diskonpersen1').val());
            var diskon2 = untitik($('#diskonpersen2').val());
            var diskon3 = untitik($('#diskonpersen3').val());

            var jumlahdiskon1 = parseInt(hargasatuan) * (parseInt(diskon1) / 100);
            var jumlahdiskon2 = (parseInt(hargasatuan) - parseInt(jumlahdiskon1)) * (parseInt(diskon2) / 100);
            var jumlahdiskon3 = (parseInt(hargasatuan) - parseInt(jumlahdiskon1) - parseInt(jumlahdiskon2)) * (parseInt(diskon3) / 100);


            var jumlahdiskon = parseInt(jumlahdiskon1) + parseInt(jumlahdiskon2) + parseInt(jumlahdiskon3);
            $('#jumlahdiskon').val(numberWithCommas(jumlahdiskon));
            $('#jumlahdiskon2').val(numberWithCommas(jumlahdiskon));
            $('#jumlahdiskon2_display').val(numberWithCommas( parseInt(jumlahdiskon) * parseInt(jumlahbeli) ));
        }
        var jumlahppnsatuan = parseInt((11 / 111) * (parseInt(hargasatuan) ));
        var jumlahdppsatuan = parseInt(hargasatuan) - parseInt(jumlahppnsatuan);

        $('#hargadpp').val(numberWithCommas(jumlahdppsatuan));
        $('#hargadpp_display').val(numberWithCommas(parseInt(jumlahdppsatuan) * parseInt(jumlahbeli) ));
        $('#jumlahppn').val(numberWithCommas(jumlahppnsatuan));
        $('#jumlahppn_display').val(numberWithCommas(parseInt(jumlahppnsatuan) * parseInt(jumlahbeli) ));

        var subtotal = parseInt(jumlahbeli) * (parseInt(jumlahdppsatuan + jumlahppnsatuan - jumlahdiskon));
        $('#subtotalbeli').val(numberWithCommas(subtotal));
    }

    function kosongkanModal() {
        $('#idbarang').val('').trigger('change');
        $('#namabarang').val('');
        $('#stok').val('');
        $('#tdKategori').html('');
        $('#tdStok').html('');
        $('#jumlahbeli').val(1);
        $('#hargasatuan').val('');
        $('#hargadpp').val('0');
        $('#jumlahppn').val('0');
        $('#jumlahdiskon').val('0');
        $('#subtotalbeli').val('0');
        $('#jenisdiskon1').prop('checked', true);
        $('input[name="jenisdiskon"]').trigger('change');
        $('#jumlahdiskon').val('0');
        $('#diskonpersen1').val('0');
        $('#diskonpersen2').val('0');
        $('#diskonpersen3').val('0');

        // $('#idbarang').focus();
    }

    function jenisDiskonChange(jenisDiskon)
    {
        if (jenisDiskon === 'Nominal') {
            $('#jumlahdiskon').val('0').removeAttr('readonly');
            $('.diskonpersen').hide();
            $('.diskonpersen input').val('0').attr('readonly', true);
            $('#jumlahdiskon').focus();

        } else if (jenisDiskon === 'Persen') {
            $('#jumlahdiskon').val('0').attr('readonly', true);
            $('.diskonpersen').show();
            $('.diskonpersen input').val('0').attr('readonly', false);
            $('#diskonpersen1').focus();
        }
        hitungSubTotal();
    }
</script>