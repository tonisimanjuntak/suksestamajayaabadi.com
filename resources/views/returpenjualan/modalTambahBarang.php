<!-- Modal -->
<div class="modal fade" id="modalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Detail Retur Penjualan</h5>
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
                                                        <select name="idbarang" id="idbarang" class="form-control idbarangpembelian"></select>
                                                        <input type="hidden" name="jumlahjual" id="jumlahjual">
                                                        <input type="hidden" name="namabarang" id="namabarang">
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 15%; text-align: left;">Kategori</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdKategori"></td>
                                                                    <td style="width: 15%; text-align: left;">Jumlah</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdjumlahjual"></td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jumlahretur" class="col-md-3 col-form-label">Jumlah Retur</label>
                                            <div class="col-md-2">
                                                <input type="number" name="jumlahretur" id="jumlahretur" class="form-control" min="1" value="1">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="hargaretur" class="col-md-3 col-form-label">Harga Retur</label>
                                            <div class="col-md-4">
                                                <input type="text" name="hargaretur" id="hargaretur" class="form-control rupiah" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jumlahppn" class="col-md-3 col-form-label">PPN (<span id="spanPPN"></span>%)</label>
                                            <div class="col-md-4">
                                                <input type="text" name="jumlahppn" id="jumlahppn" class="form-control rupiah" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="subtotalretur" class="col-md-3 col-form-label">Sub Total Tanpa PPN</label>
                                            <div class="col-md-4">
                                                <input type="text" name="subtotalretur" id="subtotalretur" class="form-control rupiah" value="0" readonly>
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
                    jumlahretur: {
                        validators: {
                            notEmpty: {
                                message: "jumlah retur tidak boleh kosong"
                            },
                        }
                    },
                    hargaretur: {
                        validators: {
                            notEmpty: {
                                message: "harga retur tidak boleh kosong"
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
                var jumlahretur = $('#jumlahretur').val();
                var hargaretur = untitik($('#hargaretur').val());
                var subtotalretur = untitik($('#subtotalretur').val());
                var jumlahjual = untitik($('#jumlahjual').val());

                addTableRow(idbarang, namabarang, jumlahretur, hargaretur,
                    subtotalretur, jumlahjual);
                $('#tambahkan').attr('disabled', false);
            });




    });


    function addTableRow(idbarang, namabarang, jumlahretur, hargaretur, subtotalretur,
        jumlahjual) {

        if (jumlahjual == "" || jumlahjual == "0") {
            swal("Informasi", "Jumlah pembelian tidak ada!", "info");
            return;
        }

        if (parseInt(jumlahjual) < parseInt(jumlahretur)) {
            swal("Informasi", "Jumlah retur melebihi jumlah pembelian!", "info");
            return;
        }

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var totalSemua = parseInt(subtotalretur);
        for (var i = 0; i < tableData.length; i++) {
            totalSemua += parseInt(untitik(tableData[i][5]));
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
                                <td style="text-align: center;">` + numberWithCommas(jumlahretur) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(hargaretur) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(subtotalretur) + `</td>
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
        var idpenjualan = $('#idpenjualan').val();

        if (idbarang != null) {

            $.ajax({
                    url: "<?php echo url('returpenjualan/getDetailPenjualan') ?>",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idbarang': idbarang,
                        'idpenjualan': idpenjualan,
                    },
                })
                .done(function(response) {
                    console.log(response);
                    if (JSON.stringify(response) != '{}') {

                        var jumlahjual = parseInt(response['jumlahjual']);
                        var jumlahretur = (response['jumlahretur'] != null) ? parseInt(response['jumlahretur']) : 0;

                        $('#namabarang').val(response['namabarang']);
                        $('#jumlahjual').val(jumlahjual - jumlahretur);
                        $('#tdKategori').html(response['namakategori']);
                        $('#tdjumlahjual').html(jumlahjual - jumlahretur);
                        $('#hargaretur').val(numberWithCommas(response['hargasatuan']));
                        $('#jumlahretur').val(jumlahjual - jumlahretur);
                        $('#jumlahretur').focus();
                    } else {
                        $('#hargaretur').val('');
                    }
                    hitungSubTotal();
                })
                .fail(function() {
                    console.log('error getDetailPenjualan');
                });
        }

    });

    $('#jumlahretur').on('change', function() {
        hitungSubTotal();
    });

    $('#hargaretur').on('change', function() {
        hitungSubTotal();
    });

    function hitungSubTotal() {
        var jumlahretur = untitik($('#jumlahretur').val());
        var hargaretur = untitik($('#hargaretur').val());

        var subtotal = (parseInt(jumlahretur) * parseInt(hargaretur));
        $('#subtotalretur').val(numberWithCommas(subtotal));

        hitungPPNBarang();
    }

    function hitungPPNBarang() {
        var jumlahppn = parseInt(parseInt($('#jumlahretur').val()) * (parseInt($('#hargaretur').val()) * ppn_penjualan / 100))
        $('#jumlahppn').val(numberWithCommas(jumlahppn));
    }
</script>