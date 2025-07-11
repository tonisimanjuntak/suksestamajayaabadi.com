@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('pembelian') }}">Purchase Order</a></li>
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
                                        class="label-judul"></span> Data Purchase Order</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idpembelian" id="idpembelian">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label for="tgl_po" class="col-md-3 col-form-label">Tanggal PO</label>
                                                        <div class="col-md-4">
                                                            <input type="text" name="tgl_po" id="tgl_po" class="form-control" value="{{ date('Y-m-d') }}">
                                                        </div>
                                                    </div>                                             
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label for="idsupplier" class="col-md-3 col-form-label">Nama Supplier</label>
                                                        <div class="col-md-9">
                                                            <select name="idsupplier" id="idsupplier" class="form-control searchSupplier"></select>
                                                        </div>
                                                    </div>                                             
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                                                        <div class="col-md-9">
                                                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                                                                placeholder="Keterangan PO"></textarea>
                                                        </div>
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
                                                    <h3 class="text-muted">Detail Purchase Order</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-md btn-success float-right" data-toggle="modal" data-target="#modalTambahBarang" id="btnTambahDetail"><i class="fa fa-plus-circle mr-1"></i> Tambah Detail</button>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="table-responsive">
                                                        <table id="tableDetail" class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%; text-align: center;">No</th>
                                                                    <th style="">idbarang</th>
                                                                    <th style="">Nama Barang</th>
                                                                    <th style="width: 5%; text-align: center;">Qty</th>
                                                                    <th style="width: 10%; text-align: right;">Harga Satuan</th>
                                                                    <th style="width: 10%; text-align: right;">DPP</th>
                                                                    <th style="width: 10%; text-align: right;">PPN</th>
                                                                    <th style="width: 10%; text-align: right;">Sub Total</th>
                                                                    <th style="width: 10%; text-align: center;">Aksi</th>
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
                                <div class="col-6">
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label for="totaldpp" class="col-md-6 col-form-label">Jumlah DPP</label>
                                        <input type="text" name="totaldpp" id="totaldpp"
                                        class="form-control col-md-6 rupiah" value="0" readonly>
                                        
                                        <input type="hidden" name="ppnpersen" id="ppnpersen" value="{{ session()->get('ppn_pembelian') }}" readonly>
                                        <label for="totalppn" class="col-md-6 col-form-label">PPN (%)</label>
                                        <input type="text" name="totalppn" id="totalppn"
                                            class="form-control col-md-6 rupiah" value="0" readonly>


                                        <div class="col-md-12">
                                            <hr>
                                        </div>

                                        <label for="totalfaktur" class="col-md-6 col-form-label">Total Faktur</label>
                                        <input type="text" name="totalfaktur" id="totalfaktur"
                                            class="form-control col-md-6 rupiah" value="0" readonly>

                                        
                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('pembelian') }}" class="btn btn-default float-right mr-1"><i
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


@include('pembelian/modalTambahBarang')

<script type="text/javascript">
    var idpembelian = "<?php echo $idpembelian; ?>";

    $(document).ready(function() {

        $('#tableDetail thead tr :nth-child(2)').hide();
        

        $('#tableDetail tbody tr :nth-child(2)').hide();
        

        $('.select2').select2();

        if (idpembelian != "") {
            $('#idpembelian').val(idpembelian);
            $('.label-judul').html('Edit');
            $.ajax({
                    url: "{{ url('pembelian/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpembelian': idpembelian
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPembelian = response.rsPembelian;
                    addSelectOption('idsupplier', rsPembelian['idsupplier'], rsPembelian['namasupplier'])
                    $('#idsupplier').val(rsPembelian['idsupplier']).trigger('change');
                    $('#tgl_po').val(rsPembelian['tgl_po']);
                    $('#keterangan').val(rsPembelian['keterangan_po']);
                    $('#ppnpersen').val(rsPembelian['ppnpersen']);


                    var rsDetail = response.rsDetail;
                    // console.log(rsDetail.length);
                    if (rsDetail.length > 0) {
                        for (var i = 0; i < rsDetail.length; i++) {
                            // console.log(rsDetail[i]);
                            addTableRow(rsDetail[i]['idbarang'], rsDetail[i]['namabarang'], rsDetail[i][
                                    'jumlahbeli_po'
                                ], rsDetail[i]['hargasatuan_po'], rsDetail[i]['hargadpp_po'], rsDetail[i]['jumlahppn_po'], rsDetail[i]['subtotalbeli_po'], 0)
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
        var idpembelian = $("#idpembelian").val();
        var tgl_po = $("#tgl_po").val();
        var idsupplier = $("#idsupplier").val();
        var keterangan = $("#keterangan").val();

        var totaldpp = $("#totaldpp").val();
        var totalbersih = $("#totalbersih").val();
        var ppnpersen = $("#ppnpersen").val();
        var totalppn = $("#totalppn").val();
        var totalfaktur = $("#totalfaktur").val();

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        if (tgl_po == '') {
            swal("Informasi", "Tanggal PO tidak boleh kosong!", "info")
                .then(function() {
                    $('#ppnpersen').focus();
                });
            return;
        }


        if (ppnpersen == '') {
            swal("Informasi", "PPN tidak boleh kosong!", "info")
                .then(function() {
                    $('#ppnpersen').focus();
                });
            return;
        }

        if (idsupplier == '' || idsupplier == null) {
            swal("Informasi", "Nama supplier tidak boleh kosong!", "info")
                .then(function() {
                    $('#idsupplier').focus();
                });
            return;
        }

        if ($("#tableDetail tbody tr").length == 0) {
            swal("Informasi", "Detail pembelian belum ada!!", "info");
            return;
        }

        isidatatable = [];
        for (var i = 0; i < tableData.length; i++) {

            isidatatable.push({
                'idbarang': tableData[i][1],
                'namabarang': tableData[i][2],
                'jumlahbeli': tableData[i][3],
                'hargasatuan': tableData[i][4],
                'hargadpp': tableData[i][5],
                'jumlahppn': tableData[i][6],
                'subtotalbeli': tableData[i][7],
            })
        }

        var formData = {
            "idpembelian": idpembelian,
            "tgl_po": tgl_po,
            "idsupplier": idsupplier,
            "keterangan": keterangan,
            "totaldpp": totaldpp,
            "totalbersih": totalbersih,
            "ppnpersen": ppnpersen,
            "totalppn": totalppn,
            "totalfaktur": totalfaktur,
            "isidatatable": isidatatable
        };


        $.ajax({
                type: 'POST',
                url: "{{ url('pembelian/simpanData') }}",
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
                            window.location.href = "{{ url('pembelian') }}";
                        });
                } else {
                    swal("Informasi", result.msg, "info");
                }
            })
            .fail(function() {
                console.log("Gagal script simpanData!");
            });

    })


    function hitungTotalFaktur()
    {
        var ppnpersen = parseInt($('#ppnpersen').val());

        var arrTable = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            arrTable.push(rowData);
        });

        var totaldpp = 0;
        var totalPPN = 0;

        for (var i = 0; i < arrTable.length; i++) {
            totaldpp += parseInt(untitik(arrTable[i][3])) * parseInt(untitik(arrTable[i][5]));
            totalPPN += parseInt(untitik(arrTable[i][3])) * parseInt(untitik(arrTable[i][6]));
        }

        var totalFaktur = totaldpp + totalPPN;

        $('#totaldpp').val(totitik(totaldpp));
        $('#totalppn').val(totitik(totalPPN));
        $('#totalfaktur').val(totitik(totalFaktur));
    }
</script>




@endsection