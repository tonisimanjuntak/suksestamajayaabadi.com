<!-- Modal -->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Detail Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ url('penjualan/simpanData') }}" method="post" id="formModalTambahDetail" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

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

                                        <div class="form-group row">
                                            <label for="jumlahjual" class="col-md-4 col-form-label">Jumlah Qty</label>
                                            <div class="col-md-8">
                                                <input type="number" name="jumlahjual" id="jumlahjual" class="form-control" min="1" value="1">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="hargasatuan" class="col-md-4 col-form-label">Harga Jual</label>
                                            <div class="col-md-8">
                                                <input type="text" name="hargasatuan" id="hargasatuan" class="form-control rupiah">
                                            </div>
                                        </div>

                                        <div class="form-group row p-1">
                                            <label for="jumlahdppsatuan" class="col-md-4 col-form-label p-1">Jumlah DPP</label>
                                            <div class="col-md-8 p-1">
                                                <input type="hidden" name="jumlahdppsatuan" id="jumlahdppsatuan" class="form-control rupiah" value="0" readonly>
                                                <input type="text" name="jumlahdppsatuan_display" id="jumlahdppsatuan_display" class="form-control rupiah" value="0" readonly>
                                            </div>

                                            <label for="jumlahppnsatuan" class="col-md-4 col-form-label p-1">Jumlah PPN (<?php echo session()->get('ppn_penjualan') ?>%)</label>
                                            <div class="col-md-8 p-1">
                                                <input type="hidden" name="jumlahppnsatuan" id="jumlahppnsatuan" class="form-control rupiah" value="0" readonly>
                                                <input type="text" name="jumlahppnsatuan_display" id="jumlahppnsatuan_display" class="form-control rupiah" value="0" readonly>
                                            </div>

                                            <label for="jumlahdiskonsatuan" class="col-md-4 col-form-label p-1">Jumlah Diskon</label>
                                            <div class="col-md-8 p-1">
                                                <input type="hidden" name="jumlahdiskonsatuan" id="jumlahdiskonsatuan" class="form-control rupiah" value="0" readonly>
                                                <input type="text" name="jumlahdiskonsatuan_display" id="jumlahdiskonsatuan_display" class="form-control rupiah" value="0" readonly>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>

                                            <label for="subtotalsemua" class="col-md-4 col-form-label p-1">Sub Total</label>
                                            <div class="col-md-8 p-1">
                                                <input type="text" name="subtotalsemua" id="subtotalsemua" class="form-control rupiah" value="0" readonly>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6 pl-4">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="diskonpersen1" class="col-md-12">Jenis Diskon Satuan</label>
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
                                <span class="text-danger"><i><strong>INFO! </strong> Harga jual yang diinput adalah harga setelah dikenakan PPN.</i></span>
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
                    jumlahjual: {
                        validators: {
                            notEmpty: {
                                message: "jumlah tidak boleh kosong"
                            },
                        }
                    },
                    hargasatuan: {
                        validators: {
                            notEmpty: {
                                message: "harga jual tidak boleh kosong"
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
                var jumlahjual = $('#jumlahjual').val();
                var hargasatuan = untitik($('#hargasatuan').val());
                var subtotalsemua = untitik($('#subtotalsemua').val());
                var jenisdiskon = $('input[name="jenisdiskon"]:checked').val();
                var jumlahdiskon = untitik($('#jumlahdiskon').val());
                var diskonpersen1 = untitik($('#diskonpersen1').val());
                var diskonpersen2 = untitik($('#diskonpersen2').val());
                var diskonpersen3 = untitik($('#diskonpersen3').val());
                var jumlahdppsatuan = untitik($('#jumlahdppsatuan').val());
                var jumlahppnsatuan = untitik($('#jumlahppnsatuan').val());
                var jumlahdiskonsatuan = untitik($('#jumlahdiskonsatuan').val());
                var stok = untitik($('#stok').val());

                addTableRow(idbarang, namabarang, jumlahjual, hargasatuan, jumlahdppsatuan, jumlahppnsatuan, subtotalsemua, jenisdiskon, jumlahdiskonsatuan, diskonpersen1, diskonpersen2, diskonpersen3, stok, 1);
                $('#tambahkan').attr('disabled', false);
            });

        $('#modalTambahBarang').on('hidden.bs.modal', function() {
            $('#keterangan').focus();
        });


        $('input[name="jenisdiskon"]').change(function() {
            var jenisDiskon = $(this).val();
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

        });

    });


    function addTableRow(idbarang, namabarang, jumlahjual, hargasatuan, jumlahdppsatuan, jumlahppnsatuan, subtotalsemua, jenisdiskon, jumlahdiskon, diskonpersen1, diskonpersen2, diskonpersen3, stok, cekStok = 1) {
        // console.log(subtotalsemua);

        if (cekStok == 1) {
            if (parseInt(stok) < parseInt(jumlahjual)) {
                swal("Informasi", "Jumlah stok tidak mencukupi! Jumlah stok = " + stok, "info");
                return;
            }
        }

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var totalSemua = parseInt(subtotalsemua);
        for (var i = 0; i < tableData.length; i++) {
            totalSemua += parseInt(untitik(tableData[i][11]));

            if (idbarang == tableData[i][1]) {
                swal("Informasi", "Data barang sudah ada!", "info");
                return;
            }
        }


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
                                <td style="text-align: center;">` + numberWithCommas(jumlahjual) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(hargasatuan) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(jumlahdppsatuan) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(jumlahppnsatuan) + `</td>
                                <td style="text-align: right;">` + jumlahdiskonText + `</td>
                                <td style="text-align: right;">` + numberWithCommas(subtotalsemua) + `</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

        $('#tableDetail').append(addText);

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

        hitungTotalInvoice();
        kosongkanModal();
    }

    $('#idbarang').on('change', function() {
        var idbarang = $(this).val();
        $.ajax({
                url: "<?php echo url('barang/getDataID') ?>",
                type: 'GET',
                dataType: 'json',
                data: {
                    'idbarang': idbarang
                },
            })
            .done(function(response) {
                // console.log(response);
                $('#jenisdiskon1').prop('checked', true);
                $('#jenisdiskon1').trigger('change');

                if (JSON.stringify(response) != '{}') {

                    $('#namabarang').val(response['namabarang']);
                    $('#stok').val(response['stok']);
                    $('#tdKategori').html(response['namakategori']);
                    $('#tdStok').html(response['stok']);
                    $('#hargasatuan').val(numberWithCommas(response['hargajualasli']));

                    $('#jumlahjual').val(1);
                    $('#jumlahjual').focus();


                } else {
                    $('#hargasatuan').val('');
                }
            })
            .fail(function() {
                console.log('error getBarangId');
            });




    });

    $('#jumlahjual').on('change', function() {
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
        var jumlahjual = untitik($('#jumlahjual').val());
        var hargasatuan = untitik($('#hargasatuan').val());





        var jenisdiskon = $('input[name="jenisdiskon"]:checked').val();

        if (jenisdiskon == 'Nominal') {
            var jumlahdiskon = untitik($('#jumlahdiskon').val());
            var jumlahdiskonsatuan = parseInt(jumlahdiskon);
            $('#jumlahdiskonsatuan').val(numberWithCommas(jumlahdiskonsatuan));
            $('#jumlahdiskonsatuan_display').val(numberWithCommas(parseInt(jumlahdiskonsatuan) * parseInt(jumlahjual)));
        } else {
            var diskon1 = untitik($('#diskonpersen1').val());
            var diskon2 = untitik($('#diskonpersen2').val());
            var diskon3 = untitik($('#diskonpersen3').val());

            var jumlahdiskon1 = parseInt(hargasatuan) * (parseInt(diskon1) / 100);
            var jumlahdiskon2 = (parseInt(hargasatuan) - parseInt(jumlahdiskon1)) * (parseInt(diskon2) / 100);
            var jumlahdiskon3 = (parseInt(hargasatuan) - parseInt(jumlahdiskon1) - parseInt(jumlahdiskon2)) * (parseInt(diskon3) / 100);


            var jumlahdiskon = parseInt(jumlahdiskon1) + parseInt(jumlahdiskon2) + parseInt(jumlahdiskon3);
            $('#jumlahdiskon').val(numberWithCommas(jumlahdiskon));
            var jumlahdiskonsatuan = parseInt(jumlahdiskon);
            $('#jumlahdiskonsatuan').val(numberWithCommas(jumlahdiskonsatuan));
            $('#jumlahdiskonsatuan_display').val(numberWithCommas(parseInt(jumlahdiskonsatuan) * parseInt(jumlahjual)));
        }

        var jumlahppnsatuan = parseInt((11 / 111) * (parseInt(hargasatuan)));

        var jumlahdppsatuan = parseInt(hargasatuan) - parseInt(jumlahppnsatuan);


        $('#jumlahdppsatuan').val(numberWithCommas(jumlahdppsatuan));
        $('#jumlahdppsatuan_display').val(numberWithCommas(parseInt(jumlahdppsatuan) * parseInt(jumlahjual)));
        $('#jumlahppnsatuan').val(numberWithCommas(jumlahppnsatuan));
        $('#jumlahppnsatuan_display').val(numberWithCommas(parseInt(jumlahppnsatuan) * parseInt(jumlahjual)));

        var subtotal = parseInt(jumlahjual) * parseInt(jumlahdppsatuan + jumlahppnsatuan - jumlahdiskonsatuan);
        $('#subtotalsemua').val(numberWithCommas(subtotal));
    }

    function kosongkanModal() {
        $('#idbarang').val('').trigger('change');
        $('#namabarang').val('');
        $('#stok').val('');
        $('#tdKategori').html('');
        $('#tdStok').html('');
        $('#jumlahjual').val(1);
        $('#hargasatuan').val('');
        $('#jumlahdiskonsatuan').val('0');
        $('#subtotalsemua').val('0');
        $('#jenisdiskon1').prop('checked', true);
        $('input[name="jenisdiskon"]').trigger('change');
        $('#idbarang').focus();
    }
</script>