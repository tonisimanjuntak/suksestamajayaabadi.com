<!-- Modal -->
<div class="modal fade" id="modalTambahInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ url('suratjalan/simpanData') }}" method="post" id="formModalTambahDetail" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">

                                        <div class="form-group row">
                                            <label for="idpenjualan" class="col-md-3 col-form-label">Nomor Invoice</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <select name="idpenjualan" id="idpenjualan" class="form-control"></select>
                                                    </div>
                                                    <div class="col-12">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width: 15%; text-align: left;">Tgl Invoice</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdtglinvoice"></td>
                                                                    <td style="width: 15%; text-align: left;">Konsumen</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdnamakonsumen"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 15%; text-align: left;">Wilayah</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdnamawilayah"></td>
                                                                    <td style="width: 15%; text-align: left;">Total Invoice</td>
                                                                    <td style="width: 3%; text-align: center;">:</td>
                                                                    <td style="width: 32%; text-align: left;" id="tdtotalinvoice"></td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
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
                    idpenjualan: {
                        validators: {
                            notEmpty: {
                                message: "nomor invoice tidak boleh kosong"
                            },
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                e.preventDefault();
                $('#tambahkan').attr('disabled', true);

                var idpenjualan = $('#idpenjualan').val();

                addTableRow(idpenjualan);
                $('#tambahkan').attr('disabled', false);
            });

        $('#modalTambahInvoice').on('hidden.bs.modal', function() {
            $('#keterangan').focus();
        });




    });


    function addTableRow(idpenjualan) {


        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        for (var i = 0; i < tableData.length; i++) {
            if (idpenjualan == tableData[i][1]) {
                swal("Informasi", "Nomor invoice sudah ada!", "info");
                return;
            }
        }



        $.ajax({
                url: "<?php echo url('penjualan/getDataID') ?>",
                type: 'GET',
                dataType: 'json',
                data: {
                    'idpenjualan': idpenjualan
                },
            })
            .done(function(response) {
                // console.log(response);
                var rsPenjualan = response.rsPenjualan;
                var rsDetail = response.rsDetail;

                var No = $("#tableDetail tbody tr").length + 1;
                var addText = `<tr>
                                        <td style="text-align: center;">` + No + `</td>
                                        <td style="">` + rsPenjualan['idpenjualan'] + `</td>
                                        <td style="text-align: center;">` + rsPenjualan['noinvoice'] + `</td>
                                        <td style="text-align: center;">` + rsPenjualan['tglinvoice'] + `</td>
                                        <td style="text-align: left;">` + rsPenjualan['namakonsumen'] + `</td>
                                        <td style="text-align: left;">` + rsPenjualan['namawilayah'] + `</td>
                                        <td style="text-align: right;">` + numberWithCommas(rsPenjualan['totalinvoice']) + `</td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`;

                $('#tableDetail').append(addText);
                $('#tableDetail thead tr :nth-child(2)').hide();
                $('#tableDetail tbody tr :nth-child(2)').hide();
                $('#idpenjualan').val('').trigger('change');

                setTimeout(function() {
                    hitungTotal();
                }, 200); // Tambahkan delay agar Select2 siap
            })
            .fail(function() {
                console.log('error add table row');
            });

    }





    $('#idpenjualan').on('change', function() {
        var idpenjualan = $(this).val();

        if (idpenjualan == '' || idpenjualan == null) {
            $('#tdtglinvoice').html('');
            $('#tdnamakonsumen').html('');
            $('#tdnamawilayah').html('');
            $('#tdtotalinvoice').html('');
            return;

        } else {
            $.ajax({
                    url: "<?php echo url('penjualan/getDataID') ?>",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpenjualan': idpenjualan
                    },
                })
                .done(function(response) {
                    var rsPenjualan = response.rsPenjualan;
                    var rsDetail = response.rsDetail;
                    $('#tdtglinvoice').html(tgldmy(rsPenjualan.tglinvoice));
                    $('#tdnamakonsumen').html(rsPenjualan.namakonsumen);
                    $('#tdnamawilayah').html(rsPenjualan.namawilayah);
                    $('#tdtotalinvoice').html(totitik(rsPenjualan.totalinvoice));
                })
                .fail(function() {
                    console.log('error penjualan getDataID');
                });
        }




    });
</script>