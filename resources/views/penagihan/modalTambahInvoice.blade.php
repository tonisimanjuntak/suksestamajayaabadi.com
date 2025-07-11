<!-- Modal -->
<div class="modal fade" id="modalTambahInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penagihan Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                        <div class="row">

                            <div class="col-12">
                                    <div class="alert alert-secondary" role="alert">
                                        <strong>Info!</strong> Tagihan piutang yang muncul adalah tagihan piutang yang jatuh tempo nya minggu depan.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <div class="form-group row">
                                            <label for="" class="col-md-3">Nama Sales</label>
                                            <div class="col-md-9">
                                                <select name="idsaleswilayah" id="idsaleswilayah" class="form-control searchSales">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <table class="table" id="tablePiutang">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15%; text-align: center;">No Invoice</th>
                                                    <th style="width: 15%; text-align: center;">Tanggal</th>
                                                    <th style="width: 30%; text-align: left;">Nama Konsumen</th>
                                                    <th style="width: 15%; text-align: center;">Wilayah</th>
                                                    <th style="width: 15%; text-align: right;">Tagihan</th>
                                                    <th style="width: 10%; text-align: center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablePiutangBody">
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary float-right ml-1" id="tambahkan">Tambahkan</button>
                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $(document).on('click', '.btnAddPiutang', function(){
            var idpiutang = $(this).attr('data-idpiutang');
            var idsales = $(this).attr('data-idsales');

            console.log(idpiutang);
            
            var tableData = [];
            $("#tableDetail tbody tr").each(function() {
                var rowData = [];
                $(this).find("td").not(":last").each(function() {
                    rowData.push($(this).text());
                });
                tableData.push(rowData);
            });

            for (var i = 0; i < tableData.length; i++) {
                if (idpiutang == tableData[i][1]) {
                    swal("Informasi", "Nomor invoice sudah ada!", "info");
                    return;
                }
            }



            $.ajax({
                    url: "<?php echo url('penagihan/getPiutangID') ?>",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpiutang': idpiutang
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPiutang = response.rsPiutang;

                    if (rsPiutang['idsales'] != $('#idsales').val()) {
                        swal("Penerima Bonus", "Bonus penagihan nya akan diterima oleh sales an. " + rsPiutang['namasales'] + "?", "error");
                        swal({
                            title: "Penerima Bonus?",
                            text: "Bonus penagihan nya akan diterima oleh sales an. " + rsPiutang['namasales'] + "?",
                            icon: "warning",
                            buttons: ["Batal", "Ya"],
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                addTableRow(rsPiutang, rsPiutang['idsales'], rsPiutang['namasales']);
                            }else{
                                addTableRow(rsPiutang, $('#idsales').val(), $("#idsales option:selected").text());
                            }
                        });
                        return;
                    }else{
                        addTableRow(rsPiutang, $('#idsales').val(), $("#idsales option:selected").text());
                    }
                    
                })
                .fail(function() {
                    console.log('error add table row');
                });

        })
    });

    function loadModal(idsaleswilayah, namasaleswilayah) {
        addSelectOption('idsaleswilayah', idsaleswilayah, namasaleswilayah)
        $('#idsaleswilayah').val(idsaleswilayah).trigger('change');
    }

    function addTableRow(rsPiutang, idsalesbonus, namasalesbonus, jumlahtagihan = 0) {


        if (jumlahtagihan == 0) {
            jumlahtagihan = parseInt(rsPiutang['totaldebet']) - parseInt(rsPiutang['totalkredit']);
        }

        var No = $("#tableDetail tbody tr").length + 1;
        var addText = `<tr>
                                <td style="text-align: center;">` + No + `</td>
                                <td style="">` + rsPiutang['idpiutang'] + `</td>
                                <td style="">` + idsalesbonus + `</td>
                                <td style="text-align: center;">` + rsPiutang['noinvoice'] + `</td>
                                <td style="text-align: center;">` + rsPiutang['tglinvoice'] + `</td>
                                <td style="text-align: left;">` + rsPiutang['namakonsumen'] + `<br>(` + rsPiutang['namawilayah'] + `)</td>
                                <td style="text-align: left;">` + namasalesbonus + `</td>
                                <td style="text-align: right;">` + numberWithCommas(jumlahtagihan) + `</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

        $('#tableDetail tbody').append(addText);
        $('#tableDetail thead tr :nth-child(2)').hide();
        $('#tableDetail tbody tr :nth-child(2)').hide();
        $('#tableDetail thead tr :nth-child(3)').hide();
        $('#tableDetail tbody tr :nth-child(3)').hide();

        setTimeout(function() {
            hitungTotal();
        }, 200); // Tambahkan delay agar Select2 siap

    }


    $('#idsaleswilayah').on('change', function() {

        var idsaleswilayah = $(this).val();
        var tgltagihanakhir = $('#tgltagihanakhir').val();

        $('#tablePiutangBody').empty();

        $.ajax({
                url: "{{ url('penagihan/getPiutangBelumLunas') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    'idsales': idsaleswilayah,
                    'tgltagihanakhir': tgltagihanakhir,
                },
            })
            .done(function(responsePiutang) {
                console.log(responsePiutang);
                var rsPiutang = responsePiutang['results'];

                if (rsPiutang.length > 0 ) {
                    
                    for (var i = 0; i < rsPiutang.length; i++) {
                        // console.log(rsPiutang[i]);

                        var addText = `<tr>
                                        <td style="text-align: center;">` + rsPiutang[i]['noinvoice'] + `</td>
                                        <td style="text-align: center;">` + rsPiutang[i]['tglinvoice'] + `</td>
                                        <td style="text-align: left;">` + rsPiutang[i]['namakonsumen'] + `</td>
                                        <td style="text-align: center;">` + rsPiutang[i]['namawilayah'] + `</td>
                                        <td style="text-align: right;">` + numberWithCommas( parseInt(rsPiutang[i]['totaldebet']) - parseInt(rsPiutang[i]['totalkredit']) ) + `</td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-primary btnAddPiutang" data-idpiutang="` + rsPiutang[i]['idpiutang'] + `" data-idsales="` + rsPiutang[i]['idsales'] + `"><i class="fa fa-plus-circle"></i></button>
                                        </td>
                                    </tr>`;

                        $('#tablePiutangBody').append(addText);
                        
                    }
                }else{

                    var addText = `<tr>
                                        <td style="text-align: center;" colspan="6">Data tagihan sales tidak ditemukan...</td>
                                    </tr>`;

                        $('#tablePiutangBody').append(addText);

                }
            })
            .fail(function() {
                console.log('error');
            });

    });


</script>