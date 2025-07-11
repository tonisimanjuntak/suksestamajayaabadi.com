<!-- Modal -->
<div class="modal fade" id="modalTambahRincian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rincian Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ url('suratjalan/simpanData') }}" method="post" id="formModalTambahRincian" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">

                                        <div class="form-group row">
                                            <label for="qty" class="col-md-3 col-form-label">Qty</label>
                                            <div class="col-md-2">
                                                <input type="number" name="qty" id="qty" class="form-control" placeholder="0" min="1">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="satuan" class="col-md-3 col-form-label">Satuan</label>
                                            <div class="col-md-4">
                                                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="keteranganRincian" class="col-md-3 col-form-label">KeteranganRincian</label>
                                            <div class="col-md-9">
                                                <textarea name="keteranganRincian" id="keteranganRincian" class="form-control" placeholder="Keterangan barang" row="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary float-right ml-1" id="tambahkanRincian">Tambahkan</button>
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
        $('#formModalTambahRincian').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    qty: {
                        validators: {
                            notEmpty: {
                                message: "qty tidak boleh kosong"
                            },
                        }
                    },
                    satuan: {
                        validators: {
                            notEmpty: {
                                message: "satuan tidak boleh kosong"
                            },
                        }
                    },
                    keteranganRincian: {
                        validators: {
                            notEmpty: {
                                message: "keterangan barang tidak boleh kosong"
                            },
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                e.preventDefault();
                $('#tambahkanRincian').attr('disabled', true);

                var qty = $('#qty').val();
                var satuan = $('#satuan').val();
                var keterangan = $('#keteranganRincian').val();

                addTableRowRincian(qty, satuan, keterangan);
                $('#tambahkanRincian').attr('disabled', false);
            });

        $('#modalTambahRincian').on('hidden.bs.modal', function() {
            $('#keterangan').focus();
        });

    });


    function addTableRowRincian(qty, satuan, keterangan) {


        var tableData = [];
        $("#tableDetailRincian tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var No = $("#tableDetailRincian tbody tr").length + 1;
        var addText = `<tr>
                                        <td style="text-align: center;">` + No + `</td>
                                        <td style="text-align: center;">` + qty + `</td>
                                        <td style="text-align: center;">` + satuan + `</td>
                                        <td style="text-align: left;">` + keterangan + `</td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`;

        $('#tableDetailRincian').append(addText);
    }
</script>