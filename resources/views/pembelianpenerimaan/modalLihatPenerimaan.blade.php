<!-- Modal -->
<div class="modal fade" id="modalLihatPenerimaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Penerimaan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-muted">Purchase Order</h5>
                                </div>
                                <div class="card-body card-detail">
                                    <div class="row">
                                        <div class="col-md-2 mb-3">
                                            <div class="label-detail">No. PO</div>
                                            <div class="value-detail" id="tdIdPembelian">-</div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <div class="label-detail">Tgl PO</div>
                                            <div class="value-detail" id="tdTglPo">-</div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="label-detail">Supplier</div>
                                            <div class="value-detail" id="tdNamaSupplier">-</div>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <div class="label-detail">Keterangan</div>
                                            <div class="value-detail" id="tdKeterangan_po">-</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-muted">Penerimaan Barang</h5>
                                </div>
                                <div class="card-body card-detail">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="label-detail">No Faktur</div>
                                            <div class="value-detail" id="tdNoFaktur">-</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="label-detail">Tgl. Faktur</div>
                                            <div class="value-detail" id="tdTglFaktur">-</div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="label-detail">Tgl. Diterima</div>
                                            <div class="value-detail" id="tdTglDiterima">-</div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="label-detail">Cara Bayar</div>
                                            <div class="value-detail" id="tdCaraBayar">-</div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="label-detail">Keterangan</div>
                                            <div class="value-detail" id="tdKeterangan">-</div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-muted">Detail Penerimaan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%; text-align: center;">No.</th>
                                                        <th style="text-align: left;">Nama Barang</th>
                                                        <th style="width: 10%; text-align: center;">Qty Order</th>
                                                        <th style="width: 10%; text-align: center;">Qty Terima</th>
                                                        <th style="width: 15%; text-align: right;">Harga Satuan</th>
                                                        <th style="width: 15%; text-align: right;">Diskon</th>
                                                        <th style="width: 15%; text-align: right;">Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tBodyDetail">
                                                    
                                                </tbody>
        
                                            </table>
                                        </div>

                                        <div class="col-md-6"></div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <label for="totaldpp" class="col-md-6 col-form-label">Jumlah DPP</label>
                                                <input type="text" name="totaldpp" id="totaldpp"
                                                class="form-control col-md-6 rupiah" value="0" readonly>
                                                                                                
                                                <label for="totalppn" class="col-md-6 col-form-label">PPN (<span id="spanppnpersen"></span>%)</label>
                                                <input type="text" name="totalppn" id="totalppn"
                                                    class="form-control col-md-6 rupiah" value="0" readonly>

                                                <label for="totaldiskon" class="col-md-6 col-form-label">Jumlah Diskon</label>
                                                <input type="text" name="totaldiskon" id="totaldiskon" class="form-control col-md-6 rupiah" value="0" readonly>

                                                <label for="totalpotongan" class="col-md-6 col-form-label">Jumlah Potongan</label>
                                                <input type="text" name="totalpotongan" id="totalpotongan" class="form-control col-md-6 rupiah" value="0" readonly>

                                                <div class="col-md-12">
                                                    <hr>
                                                </div>

                                                <label for="totalfaktur" class="col-md-6 col-form-label">Total Faktur</label>
                                                <input type="text" name="totalfaktur" id="totalfaktur"
                                                    class="form-control col-md-6 rupiah" value="0" readonly>
                                                
                                                <label for="biayapengiriman" class="col-md-6 col-form-label">Biaya Pengiriman</label>
                                                <input type="text" name="biayapengiriman" id="biayapengiriman"
                                                    class="form-control col-md-6 rupiah" value="0" readonly>

                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

    });

    function loadModalLihatPenerimaan(idpembelian) {
        // console.log(idpembelian);
        if (idpembelian != "" && idpembelian != null) {
            $('#modalLihatPenerimaan').modal('show');
            $.ajax({
                    url: "{{ url('pembelianpenerimaan/getModalInfo') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpembelian': idpembelian
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPembelian = response.rsPembelian;
                    var rsPembelianDetail = response.rsPembelianDetail;

                    $('#tdIdPembelian').html(rsPembelian['idpembelian']);
                    $('#tdTglPo').html(tgldmy(rsPembelian['tgl_po']));
                    $('#tdNamaSupplier').html(rsPembelian['namasupplier']);
                    $('#tdKeterangan_po').html(rsPembelian['keterangan_po']);
                    $('#tdNoFaktur').html(rsPembelian['nofaktur']);
                    $('#tdTglFaktur').html(tgldmy(rsPembelian['tglfaktur']));
                    $('#tdTglDiterima').html(tgldmy(rsPembelian['tglditerima']));
                    if (rsPembelian['carabayar'] == 'Transfer') {                        
                        $('#tdCaraBayar').html(rsPembelian['carabayar'] + ' (' + rsPembelian['namabank'] + ')');
                    }else if (rsPembelian['carabayar'] == 'Giro') {
                        $('#tdCaraBayar').html(rsPembelian['carabayar'] + ' (' + rsPembelian['namabank'] + ' No BG: ' + rsPembelian['nobilyetgiro'] + ' Tgl. ' + tgldmy(rsPembelian['tglbilyetgiro']) + ')');
                    }else{
                        $('#tdCaraBayar').html(rsPembelian['carabayar']);
                    }
                    $('#tdKeterangan').html(rsPembelian['keterangan']);

                    $('#totaldpp').val(totitik(rsPembelian['totaldpp']));
                    $('#totalppn').val(totitik(rsPembelian['totalppn']));
                    $('#totaldiskon').val(totitik(rsPembelian['totaldiskon']));
                    $('#totalpotongan').val(totitik(rsPembelian['totalpotongan']));
                    $('#totalfaktur').val(totitik(rsPembelian['totalfaktur']));
                    $('#biayapengiriman').val(totitik(rsPembelian['biayapengiriman']));
                    $('#spanppnpersen').html(rsPembelian['ppnpersen']);
                    


                    $('#tBodyDetail').empty();
                    if (rsPembelianDetail.length > 0) {
                        var no = 1;
                        for (var i = 0; i < rsPembelianDetail.length; i++) {
                            // console.log(rsPembelianDetail[i]);
                            var addText = `
                                <tr>
                                    <td style="width: 5%; text-align: center;">` + no++ + `</td>
                                    <td style="text-align: left;">` + rsPembelianDetail[i]['namabarang'] + `</td>
                                    <td style="width: 10%; text-align: center;">` + rsPembelianDetail[i]['jumlahbeli_po'] + `</td>
                                    <td style="width: 10%; text-align: center;">` + totitik(rsPembelianDetail[i]['jumlahbeli']) + `</td>
                                    <td style="width: 15%; text-align: right;">` + totitik(rsPembelianDetail[i]['hargasatuan']) + `</td>
                                    <td style="width: 15%; text-align: right;">` + totitik(rsPembelianDetail[i]['jumlahdiskon']) + `</td>
                                    <td style="width: 15%; text-align: right;">` + totitik(rsPembelianDetail[i]['subtotalbeli']) + `</td>
                                </tr>
                            `;
                            $('#tBodyDetail').append(addText);
                        }
                    }
                })
                .fail(function() {
                    console.log('error getModalInfo');
                });
        } else {
            swal("Informasi", "Penerimaan tidak ditemukan!");
        }
    }
</script>