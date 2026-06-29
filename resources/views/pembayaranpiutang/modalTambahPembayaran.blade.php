<!-- Modal -->
<div class="modal fade" id="modalTambahPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ url('piutang/simpanData') }}" method="post" id="formModalTambahDetail" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="modalidpiutang" id="modalidpiutang" value="{{ $idpiutang }}">
                        <input type="hidden" name="idpiutangdetail" id="idpiutangdetail">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">

                                        <div class="form-group row">
                                            <label for="tglpiutang" class="col-md-3 col-form-label">Tanggal Bayar</label>
                                            <div class="col-md-4">
                                                <input type="date" name="tglpiutang" id="tglpiutang"
                                                    class="form-control" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="carabayar" class="col-md-3 col-form-label">Cara Bayar</label>
                                            <div class="col-md-9">
                                                <select name="carabayar" id="carabayar" class="form-control select2">
                                                    <option value="">Pilih cara bayar...</option>
                                                    <option value="Tunai">Tunai</option>
                                                    <option value="Transfer">Transfer</option>
                                                    <option value="Giro">Giro</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row" style="display: none;" id="divBank">
                                            <label for="idbank" class="col-md-3 col-form-label">Nama Bank</label>
                                            <div class="col-md-9">
                                                <select name="idbank" id="idbank" class="form-control searchBank">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="divGiro" style="display: none;">
                                            <label for="nobilyetgiro" class="col-md-3 col-form-label">No Bilyet Giro</label>
                                            <div class="col-md-9">
                                                <input type="text" name="nobilyetgiro" id="nobilyetgiro"
                                                    class="form-control" placeholder="No Bilyet Giro">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kredit" class="col-md-3 col-form-label">Jumlah Bayar</label>
                                            <div class="col-md-4">
                                                <input type="text" name="kredit" id="kredit" class="form-control rupiah" value="{{ format_rupiah($rsPiutang->totaldebet - $rsPiutang->totalkredit) }}">
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-primary float-right ml-1" id="btnsimpan">Simpan</button>
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
                    tglpiutang: {
                        validators: {
                            notEmpty: {
                                message: "tanggal tidak boleh kosong"
                            },
                        }
                    },
                    carabayar: {
                        validators: {
                            notEmpty: {
                                message: "cara bayar tidak boleh kosong"
                            },
                        }
                    },
                    idbank: {
                        validators: {
                            callback: {
                                message: "nama bank tidak boleh kosong",
                                callback: function(value, validator, idbank) {

                                    if ($('#carabayar').val() == "Transfer" || $('#carabayar').val() == "Giro") {
                                        if ($('#idbank').val() == '' || $('#idbank').val() == null) {
                                            return {
                                                valid: false,
                                                message: "nama bank tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                        }
                    },
                    nobilyetgiro: {
                        validators: {
                            callback: {
                                message: "Nomor bilyet giro tidak boleh kosong",
                                callback: function(value, validator, nobilyetgiro) {

                                    if ($('#carabayar').val() == "Giro") {
                                        if ($('#nobilyetgiro').val() == '' || $('#nobilyetgiro').val() == null) {
                                            return {
                                                valid: false,
                                                message: "Nomor bilyet giro tidak boleh kosong"
                                            }
                                        }
                                    }
                                    return true
                                }
                            }
                        }
                    },
                    kredit: {
                        validators: {
                            notEmpty: {
                                message: "jumlah bayar tidak boleh kosong"
                            },
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnsimpan').attr('disabled', true);
            });
    });

    $(document).on('change', '#carabayar', function() {
        var carabayar = $(this).val();
        $('#divBank').hide();
        $('#divGiro').hide();

        if (carabayar == 'Transfer') {
            $('#divBank').show();
        } 
        if (carabayar == 'Giro') {
            $('#divBank').show();
            $('#divGiro').show();
        }


    })
</script>