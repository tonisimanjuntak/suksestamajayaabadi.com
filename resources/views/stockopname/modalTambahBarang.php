<!-- Modal -->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Detail Faktur Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ url('pembelian/simpanData') }}" method="post" id="formModalTambahDetail" enctype="multipart/form-data">
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

                                        <div class="form-group row">
                                            <label for="jumlahbeli" class="col-md-3 col-form-label">Jumlah Qty</label>
                                            <div class="col-md-2">
                                                <input type="number" name="jumlahbeli" id="jumlahbeli" class="form-control" min="1" value="1">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="hargasebelumdiskon" class="col-md-3 col-form-label">Harga Beli</label>
                                            <div class="col-md-4">
                                                <input type="text" name="hargasebelumdiskon" id="hargasebelumdiskon" class="form-control rupiah">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="hargasetelahdiskon" class="col-md-3 col-form-label">Harga Discount</label>
                                            <div class="col-md-4">
                                                <input type="text" name="hargasetelahdiskon" id="hargasetelahdiskon" class="form-control rupiah">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="subtotalbeli" class="col-md-3 col-form-label">Sub Total</label>
                                            <div class="col-md-4">
                                                <input type="text" name="subtotalbeli" id="subtotalbeli" class="form-control rupiah" value="0" readonly>
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
                    hargasebelumdiskon: {
                        validators: {
                            notEmpty: {
                                message: "harga beli tidak boleh kosong"
                            },
                        }
                    },
                    hargasetelahdiskon: {
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
                var hargasebelumdiskon = untitik($('#hargasebelumdiskon').val());
                var hargasetelahdiskon = untitik($('#hargasetelahdiskon').val());
                var subtotalbeli = untitik($('#subtotalbeli').val());
                var stok = untitik($('#stok').val());

                addTableRow(idbarang, namabarang, jumlahbeli, hargasebelumdiskon, hargasetelahdiskon,
                    subtotalbeli, stok, 0);
                $('#tambahkan').attr('disabled', false);
            });
    });


    function addTableRow(idbarang, namabarang, jumlahbeli, hargasebelumdiskon, hargasetelahdiskon, subtotalbeli,
        stok, cekStok = 1) {


        if (cekStok == 1) {
            if (parseInt(stok) < parseInt(jumlahbeli)) {
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

        var totalSemua = parseInt(subtotalbeli);
        for (var i = 0; i < tableData.length; i++) {
            totalSemua += parseInt(untitik(tableData[i][6]));
            if (idbarang == tableData[i][1]) {
                swal("Informasi", "Data barang sudah ada!", "info");
                return;
            }
        }

        $('#total').val(numberWithCommas(totalSemua));

        var No = $("#tableDetail tbody tr").length + 1;
        var addText = `<tr>
                                <td style="text-align: center;">` + No + `</td>
                                <td style="">` + idbarang + `</td>
                                <td style="">` + namabarang + `</td>
                                <td style="text-align: center;">` + numberWithCommas(jumlahbeli) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(hargasebelumdiskon) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(hargasetelahdiskon) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(subtotalbeli) + `</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

        $('#tableDetail').append(addText);
        $('#tableDetail thead tr :nth-child(2)').hide();
        $('#tableDetail tbody tr :nth-child(2)').hide();
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
                if (JSON.stringify(response) != '{}') {

                    $('#namabarang').val(response['namabarang']);
                    $('#stok').val(response['stok']);
                    $('#tdKategori').html(response['namakategori']);
                    $('#tdStok').html(response['stok']);



                    $('#hargasebelumdiskon').val(numberWithCommas(response['hargabeli']));
                    $('#hargasetelahdiskon').val(numberWithCommas(response['hargabeli']));
                    $('#jumlahbeli').val(1);
                    $('#jumlahbeli').focus();


                } else {
                    $('#hargasebelumdiskon').val('');
                    $('#hargasetelahdiskon').val('');
                }
                hitungSubTotal();
            })
            .fail(function() {
                console.log('error getBarangId');
            });

    });

    $('#jumlahbeli').on('change', function() {
        hitungSubTotal();
    });

    $('#hargasebelumdiskon').on('change', function() {
        hitungSubTotal();
    });

    $('#hargasetelahdiskon').on('change', function() {
        hitungSubTotal();
    });

    function hitungSubTotal() {
        var jumlahbeli = untitik($('#jumlahbeli').val());
        var hargasebelumdiskon = untitik($('#hargasebelumdiskon').val());
        var hargasetelahdiskon = untitik($('#hargasetelahdiskon').val());

        var subtotal = (parseInt(jumlahbeli) * parseInt(hargasetelahdiskon));
        $('#subtotalbeli').val(numberWithCommas(subtotal));
    }
</script>