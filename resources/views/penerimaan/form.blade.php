@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penerimaan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('penerimaan') }}">Penerimaan</a></li>
                        <li class="breadcrumb-item label-judul active"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                        class="label-judul"></span> Data Penerimaan</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idpenerimaan" id="idpenerimaan">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-3 required">
                                                    <div class="form-group">
                                                        <label for="tglpenerimaan">Tanggal Penerimaan</label>
                                                        <input type="date" name="tglpenerimaan" id="tglpenerimaan"
                                                            class="form-control" value="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 required">
                                                    <div class="form-group">
                                                        <label for="carabayar">Cara Terima</label>
                                                        <select name="carabayar" id="carabayar" class="form-control select2">
                                                            <option value="">Pilih cara bayar...</option>
                                                            <option value="Tunai">Tunai</option>
                                                            <option value="Transfer">Transfer</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-5 required" id="divBank" style="display:none;">
                                                    <div class="form-group">
                                                        <label for="idbank">Nama Bank</label>
                                                        <select name="idbank" id="idbank" class="form-control searchBank">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                                                            placeholder="Keterangan Pembelian"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class="text-muted">Detail Penerimaan</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-md btn-success float-right" data-toggle="modal" data-target="#modalTambahAkun" id="btnTambahDetail"><i class="fa fa-plus-circle mr-1"></i> Tambah Detail</button>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="table-responsive">
                                                        <table id="tableDetail" class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%; text-align: center;">No</th>
                                                                    <th style="">Kode Akun</th>
                                                                    <th style="">Nama Akun</th>
                                                                    <th style="width: 15%; text-align: right;">Jumlah Penerimaan</th>
                                                                    <th style="width: 15%; text-align: center;">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-9 text-right">
                                            <label for="" class="col-form-label">TOTAL (Rp.)</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="total" id="total"
                                                class="form-control rupiah" value="0" readonly>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('penerimaan') }}" class="btn btn-default float-right mr-1"><i
                                    class="fa fa-chevron-left mr-1"></i>Kembali</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection



@section('scripts')


@include('penerimaan/modalTambahAkun')

<script type="text/javascript">
    var idpenerimaan = "<?php echo $idpenerimaan; ?>";

    $(document).ready(function() {

        $('.select2').select2();

        if (idpenerimaan != "") {
            $('#idpenerimaan').val(idpenerimaan);
            $('.label-judul').html('Edit');
            $.ajax({
                    url: "{{ url('penerimaan/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpenerimaan': idpenerimaan
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    var rsPenerimaan = response.rsPenerimaan;
                    $('#tglpenerimaan').val(rsPenerimaan['tglpenerimaan']);
                    $('#keterangan').val(rsPenerimaan['keterangan']);
                    $('#carabayar').val(rsPenerimaan['carabayar']).trigger('change');

                    if (rsPenerimaan['idbank'] != '') {
                        addSelectOption('idbank', rsPenerimaan['idbank'], rsPenerimaan['namabank'])
                        $('#idbank').val(rsPenerimaan['idbank']);
                    }


                    var rsDetail = response.rsDetail;
                    // console.log(rsDetail.length);
                    if (rsDetail.length > 0) {
                        for (var i = 0; i < rsDetail.length; i++) {
                            // console.log(rsDetail[i]);
                            addTableRow(rsDetail[i]['kdakun'], rsDetail[i]['namaakun'], rsDetail[i]['jumlahpenerimaan'])
                        }
                    }
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            $('.label-judul').html('Tambah');

        }

        $("form").attr('autocomplete', 'off');
    });



    $("#tableDetail").on("click", ".deleteRow", function() {
        $(this).closest("tr").remove();
    });

    $('#simpan').click(function() {
        var idpenerimaan = $("#idpenerimaan").val();
        var tglpenerimaan = $("#tglpenerimaan").val();
        var carabayar = $("#carabayar").val();
        var idbank = $("#idbank").val();
        var keterangan = $("#keterangan").val();
        var total = $("#total").val();

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });


        if (carabayar == 'Transfer') {
            if (idbank == null) {
                swal("Informasi", "Nama bank harus dipilih!", "info")
                    .then(function() {
                        $('#idbank').focus();
                    });
                return;
            }
        } else {
            idbank = '';
        }

        if (tglpenerimaan == '') {
            swal("Informasi", "Tanggal penerimaan tidak boleh kosong!", "info")
                .then(function() {
                    $('#tglpenerimaan').focus();
                });
            return;
        }

        if (carabayar == '') {
            swal("Informasi", "Cara bayar tidak boleh kosong!", "info")
                .then(function() {
                    $('#carabayar').focus();
                });
            return;
        }

        if ($("#tableDetail tbody tr").length == 0) {
            swal("Informasi", "Detail penerimaan belum ada!!", "info");
            return;
        }

        isidatatable = [];
        for (var i = 0; i < tableData.length; i++) {
            isidatatable.push({
                'kdakun': tableData[i][1],
                'namaakun': tableData[i][2],
                'jumlahpenerimaan': tableData[i][3],
            })
        }

        var formData = {
            "idpenerimaan": idpenerimaan,
            "tglpenerimaan": tglpenerimaan,
            "carabayar": carabayar,
            "idbank": idbank,
            "keterangan": keterangan,
            "total": total,
            "isidatatable": isidatatable
        };

        // console.log(formData);
        // return;

        $.ajax({
                type: 'POST',
                url: "{{ url('penerimaan/simpanData') }}",
                data: JSON.stringify(formData),
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                encode: true
            })
            .done(function(result) {
                console.log(result);

                if (result.success) {
                    swal("Berhasil", "Berhasil simpan data!", "success")
                        .then(function() {
                            window.location.href = "{{ url('penerimaan') }}";
                        });
                } else {
                    swal("Informasi", result.msg, "info");
                }
            })
            .fail(function() {
                console.log("Gagal script simpanData!");
            });

    })



    $('#modalQty').on('change', function() {
        hitungTotalModal();
    });

    $('#modalHargaBeli').on('change', function() {
        hitungTotalModal();
    });

    $('#modalDiscount').on('change', function() {
        hitungTotalModal();
    });

    function hitungTotalModal() {
        var jumlahbeli = $('#modalQty').val();
        var hargabeli = $('#modalHargaBeli').val();
        var discountbeli = $('#modalDiscount').val();

        var nHargaDiscount = hitungHargaDiscount(untitik(hargabeli), untitik(discountbeli));
        var subtotal = (parseInt(jumlahbeli) * parseInt(nHargaDiscount));
        $('#modalSubTotal').html(numberWithCommas(subtotal));
    }

    $(document).on('change', '#carabayar', function() {
        var carabayar = $(this).val();
        if (carabayar == 'Transfer') {
            $('#divBank').show();
        } else {
            $('#divBank').hide();
        }
    });
</script>




@endsection