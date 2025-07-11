<!-- Modal -->
<div class="modal fade" id="modalTambahAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Detail Jurnal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="#" method="post" id="formModalTambahDetail" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">

                                        <div class="form-group row">
                                            <label for="kdakun" class="col-md-3 col-form-label">Nama Akun</label>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <select name="kdakun" id="kdakun" class="form-control searchAkunAll" nama-parent="#modalTambahAkun"></select>
                                                        <input type="hidden" name="namaakun" id="namaakun">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="debet" class="col-md-3 col-form-label">Jumlah Debet</label>
                                            <div class="col-md-4">
                                                <input type="text" name="debet" id="debet" class="form-control rupiah" value="0">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kredit" class="col-md-3 col-form-label">Jumlah Kredit</label>
                                            <div class="col-md-4">
                                                <input type="text" name="kredit" id="kredit" class="form-control rupiah" value="0">
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
                                message: "nama akun tidak boleh kosong"
                            },
                        }
                    },
                    debet: {
                        validators: {
                            notEmpty: {
                                message: "jumlah debet tidak boleh kosong"
                            },
                        }
                    },
                    kredit: {
                        validators: {
                            notEmpty: {
                                message: "jumlah kredit tidak boleh kosong"
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
                var debet = untitik($('#debet').val());
                var kredit = untitik($('#kredit').val());

                addTableRow(kdakun, namaakun, debet, kredit);
                $('#tambahkan').attr('disabled', false);
            });
    });


    function addTableRow(kdakun, namaakun, debet, kredit) {

        if (debet == '') {
            debet = '0';
        }
        if (kredit == '') {
            kredit = '0';
        }

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        for (var i = 0; i < tableData.length; i++) {
            if (kdakun == tableData[i][1]) {
                swal("Informasi", "Nama akun sudah ada!", "info");
                return;
            }
        }

        var No = $("#tableDetail tbody tr").length + 1;
        var addText = `<tr>
                                <td style="text-align: center;">` + No + `</td>
                                <td style="">` + kdakun + `</td>
                                <td style="">` + namaakun + `</td>
                                <td style="text-align: right;">` + numberWithCommas(debet) + `</td>
                                <td style="text-align: right;">` + numberWithCommas(kredit) + `</td>
                                <td style="text-align: center;">
                                    <button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

        $('#tableDetail').append(addText);
        hitungTotalDebetKredit();
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
                    $('#debet').val('0');
                    $('#kredit').val('0');
                    $('#debet').focus();
                } else {
                    $('#debet').val('0');
                    $('#kredit').val('0');
                }
            })
            .fail(function() {
                console.log('error getDataID');
            });

    });
</script>