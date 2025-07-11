<!-- Modal -->
<div class="modal fade" id="modalTambahAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                    <form action="{{ url('penerimaan/simpanData') }}" method="post" id="formModalTambahDetail" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">

                                        <div class="form-group row">
                                            <label for="kdakun" class="col-md-3 col-form-label">Nama Akun</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <select name="kdakun" id="kdakun" class="form-control searchAkunPenerimaan"></select>
                                                        <input type="hidden" name="namaakun" id="namaakun">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jumlahpenerimaan" class="col-md-3 col-form-label">Jumlah Pengeluaran</label>
                                            <div class="col-md-4">
                                                <input type="text" name="jumlahpenerimaan" id="jumlahpenerimaan" class="form-control rupiah">
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
                    kdakun: {
                        validators: {
                            notEmpty: {
                                message: "nama barang tidak boleh kosong"
                            },
                        }
                    },
                    jumlahpenerimaan: {
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

                var kdakun = $('#kdakun').val();
                var namaakun = $('#namaakun').val();
                var jumlahpenerimaan = untitik($('#jumlahpenerimaan').val());

                addTableRow(kdakun, namaakun, jumlahpenerimaan);
                $('#tambahkan').attr('disabled', false);
            });
    });


    function addTableRow(kdakun, namaakun, jumlahpenerimaan) {

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var totalSemua = parseInt(jumlahpenerimaan);
        for (var i = 0; i < tableData.length; i++) {
            totalSemua += parseInt(untitik(tableData[i][3]));
            if (kdakun == tableData[i][1]) {
                swal("Informasi", "Nama akun sudah ada!", "info");
                return;
            }
        }

        $('#total').val(numberWithCommas(totalSemua));

        var No = $("#tableDetail tbody tr").length + 1;
        var addText = `<tr>
                                <td style="text-align: center;">` + No + `</td>
                                <td style="">` + kdakun + `</td>
                                <td style="">` + namaakun + `</td>
                                <td style="text-align: right;">` + numberWithCommas(jumlahpenerimaan) + `</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

        $('#tableDetail').append(addText);
    }

    $('#kdakun').on('change', function() {
        var kdakun = $(this).val();
        $.ajax({
                url: "<?php echo url('akun4/getDataID') ?>",
                type: 'GET',
                dataType: 'json',
                data: {
                    'kdakun': kdakun
                },
            })
            .done(function(response) {
                // console.log(response);
                if (JSON.stringify(response) != '{}') {
                    $('#namaakun').val(response['namaakun']);
                    $('#jumlahpenerimaan').val('');
                    $('#jumlahpenerimaan').focus();
                } else {
                    $('#jumlahpenerimaan').val('');
                }
            })
            .fail(function() {
                console.log('error getBarangId');
            });

    });
</script>