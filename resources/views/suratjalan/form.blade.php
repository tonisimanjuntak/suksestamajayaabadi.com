@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Surat Jalan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('suratjalan') }}">Surat Jalan</a></li>
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
                                        class="label-judul"></span> Surat Jalan</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idsuratjalan" id="idsuratjalan">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-3 required">
                                                    <div class="form-group">
                                                        <label for="tglsuratjalan">Tanggal Surat</label>
                                                        <input type="date" name="tglsuratjalan" id="tglsuratjalan"
                                                            class="form-control" value="{{ date('Y-m-d') }}" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 required">
                                                    <div class="form-group">
                                                        <label for="idkonsumen">Nama Konsumen</label>
                                                        <select name="idkonsumen" id="idkonsumen" class="form-control searchKonsumen">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 required">
                                                    <div class="form-group">
                                                        <label for="idekspedisi">Nama Ekspedisi</label>
                                                        <select name="idekspedisi" id="idekspedisi" class="form-control searchEkspedisi">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 required">
                                                    <div class="form-group">
                                                        <label for="idjenisekspedisi">Jenis Ekspedisi</label>
                                                        <select name="idjenisekspedisi" id="idjenisekspedisi" class="form-control searchJenisEkspedisi">
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 required">
                                                    <div class="form-group">
                                                        <label for="biayapengiriman">Biaya Pengiriman</label>
                                                        <input type="text" name="biayapengiriman" id="biayapengiriman" class="form-control rupiah">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 required">
                                                    <div class="form-group">
                                                        <label for="idjenisekspedisi">Informasi/Identitas Ekspedisi</label>
                                                        <textarea name="identitasekspedisi" id="identitasekspedisi" class="form-control" rows="2" placeholder="Informasi tentang ekspedisi yang digunakan"></textarea>
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
                                                    <h3 class="text-muted">Data Invoice</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-md btn-success float-right" id="btnTambahDetail"><i class="fa fa-plus-circle mr-1"></i> Tambah Invoice</button>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="table-responsive">
                                                        <table id="tableDetail" class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%; text-align: center;">No</th>
                                                                    <th style="">idpenjualan</th>
                                                                    <th style="width: 15%; text-align: center;">No Invoice</th>
                                                                    <th style="width: 15%; text-align: center;">Tgl Invoice</th>
                                                                    <th style="width: 20%; text-align: left;">Nama Konsumen</th>
                                                                    <th style="width: 20%; text-align: left;">Wilayah</th>
                                                                    <th style="width: 15%; text-align: right;">Total Invoice</th>
                                                                    <th style="width: 15%; text-align: center;">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
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
                                            <hr>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class="text-muted">Detail Rincian Barang</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-md btn-info float-right" id="btnTambahDetailRincian"><i class="fa fa-plus-circle mr-1"></i> Tambah Rincian</button>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="table-responsive">
                                                        <table id="tableDetailRincian" class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%; text-align: center;">No</th>
                                                                    <th style="width: 10%; text-align: center;">Qty</th>
                                                                    <th style="width: 15%; text-align: center;">Satuan</th>
                                                                    <th style="text-align: left;">Keterangan</th>
                                                                    <th style="text-align: center;">Aksi</th>
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

                                

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('suratjalan') }}" class="btn btn-default float-right mr-1"><i
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


@include('suratjalan/modalTambahInvoice')
@include('suratjalan/modalTambahRincian')

<script type="text/javascript">
    var idsuratjalan = "<?php echo $idsuratjalan; ?>";

    var lInit = true;

    $(document).ready(function() {

        $('#tableDetail thead tr :nth-child(2)').hide();
        $('#tableDetail tbody tr :nth-child(2)').hide();

        $('.select2').select2();

        if (idsuratjalan != "") {
            $('#idsuratjalan').val(idsuratjalan);
            $('.label-judul').html('Edit');
            $.ajax({
                    url: "{{ url('suratjalan/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idsuratjalan': idsuratjalan
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    var rsSuratJalan = response.rsSuratJalan;
                    
                    $('#idsuratjalan').val(rsSuratJalan['idsuratjalan']);
                    $('#tglsuratjalan').val(rsSuratJalan['tglsuratjalan']);

                    addSelectOption('idkonsumen', rsSuratJalan['idkonsumen'], rsSuratJalan['namakonsumen'] + ' | NPWP : ' + rsSuratJalan['npwp'] + ' | ' + rsSuratJalan['namawilayah'])
                    $('#idkonsumen').val(rsSuratJalan['idkonsumen']).trigger('change');
                    $('#idkonsumen').attr('disabled', true);

                    addSelectOption('idekspedisi', rsSuratJalan['idekspedisi'], rsSuratJalan['namaekspedisi'])
                    $('#idekspedisi').val(rsSuratJalan['idekspedisi']).trigger('change');

                    addSelectOption('idjenisekspedisi', rsSuratJalan['idjenisekspedisi'], rsSuratJalan['namajenisekspedisi'])
                    $('#idjenisekspedisi').val(rsSuratJalan['idjenisekspedisi']).trigger('change');
                    $('#biayapengiriman').val(totitik(rsSuratJalan['biayapengiriman']));
                    $('#identitasekspedisi').val(rsSuratJalan['identitasekspedisi']);


                    var rsDetail = response.rsDetail;
                    if (rsDetail.length > 0) {
                        for (var i = 0; i < rsDetail.length; i++) {                            
                            addTableRow(rsDetail[i]['idpenjualan']);                            
                        }
                    }

                    var rsDetailRincian = response.rsDetailRincian;
                    if (rsDetailRincian.length > 0) {
                        for (var i = 0; i < rsDetailRincian.length; i++) {                            
                            addTableRowRincian(rsDetailRincian[i]['qty'], rsDetailRincian[i]['satuan'], rsDetailRincian[i]['keterangan'] );                            
                        }
                    }


                    lInit = false;
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            lInit = false;
            $('.label-judul').html('Tambah');
        }


        $('#idpenjualan').select2({
            placeholder: 'Cari nomor invoice...',
            minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
            ajax: {
                url: "{{ route('suratjalan.searchInvoice') }}", // URL untuk pencarian
                dataType: 'json',
                delay: 250, // Delay saat mengetik (ms)
                data: function(params) {
                    console.log(params);
                    return {
                        q: params.term, // Parameter pencarian
                        idkonsumen: $('#idkonsumen').val(),
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.results, // Format data untuk Select2
                    };
                },
                cache: true
            },
        });

        $("form").attr('autocomplete', 'off');
    });



    $("#tableDetail").on("click", ".deleteRow", function() {
        $(this).closest("tr").remove();
        hitungTotal();
    });

    $("#tableDetailRincian").on("click", ".deleteRow", function() {
        $(this).closest("tr").remove();
    });

    $('#simpan').click(function() {
        var idsuratjalan = $("#idsuratjalan").val();
        var tglsuratjalan = $("#tglsuratjalan").val();
        var idkonsumen = $("#idkonsumen").val();
        var total = $("#total").val();
        var idekspedisi = $("#idekspedisi").val();
        var idjenisekspedisi = $("#idjenisekspedisi").val();
        var biayapengiriman = $("#biayapengiriman").val();
        var identitasekspedisi = $("#identitasekspedisi").val();
        $('#simpan').attr('disabled', true);

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var tableDataRincian = [];
        $("#tableDetailRincian tbody tr").each(function() {
            var rowDataRincian = [];
            $(this).find("td").not(":last").each(function() {
                rowDataRincian.push($(this).text());
            });
            tableDataRincian.push(rowDataRincian);
        });


        if (idkonsumen == '' || idkonsumen == null) {
            swal("Informasi", "Nama konsumen tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idkonsumen').focus();
                });
            return;
        }

        if (tglsuratjalan == '') {
            swal("Informasi", "Tanggal surat jalan tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#tglsuratjalan').focus();
                });
            return;
        }

        if (idekspedisi == '' || idekspedisi == null) {
            swal("Informasi", "Nama ekspedisi tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idekspedisi').focus();
                });
            return;
        }

        if (idjenisekspedisi == '' || idjenisekspedisi == null) {
            swal("Informasi", "Jenis ekspedisi tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idjenisekspedisi').focus();
                });
            return;
        }


        if (biayapengiriman=='') {
            biayapengiriman = 0;
        }

        if ($("#tableDetail tbody tr").length == 0) {
            $('#simpan').attr('disabled', false);
            swal("Informasi", "Detail invoice pengiriman belum ada!!", "info");
            return;
        }

        isidatatable = [];
        for (var i = 0; i < tableData.length; i++) {
            isidatatable.push({
                'idpenjualan': tableData[i][1],
            })
        }


        if ($("#tableDetailRincian tbody tr").length == 0) {
            $('#simpan').attr('disabled', false);
            swal("Informasi", "Rincian barang belum ada!!", "info");
            return;
        }

        isidatatableRincian = [];
        for (var i = 0; i < tableDataRincian.length; i++) {
            isidatatableRincian.push({
                'qty': tableDataRincian[i][1],
                'satuan': tableDataRincian[i][2],
                'keterangan': tableDataRincian[i][3],
            })
        }

        var formData = {
            "idsuratjalan": idsuratjalan,
            "tglsuratjalan": tglsuratjalan,
            "idkonsumen": idkonsumen,
            "idekspedisi": idekspedisi,
            "idjenisekspedisi": idjenisekspedisi,
            "biayapengiriman": biayapengiriman,
            "identitasekspedisi": identitasekspedisi,
            "total": total,            
            "isidatatable": isidatatable,
            "isidatatableRincian": isidatatableRincian,
        };

        //console.log(formData);
        //return;

        $.ajax({
                type: 'POST',
                url: "{{ url('suratjalan/simpanData') }}",
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
                            window.location.href = "{{ url('suratjalan') }}";
                        });
                } else {
                    $('#simpan').attr('disabled', false);
                    swal("Informasi", result.msg, "info");
                }
            })
            .fail(function() {
                $('#simpan').attr('disabled', false);
                console.log("Gagal script simpanData!");
            });

    })


    $(document).on('change', '#carabayar', function() {
        var carabayar = $(this).val();
        $('#divBank').hide();
        $('#divJenisPiutang').hide();

        if (carabayar == 'Transfer') {
            $('#divBank').show();
        }

        if (carabayar == 'Piutang') {
            $('#divJenisPiutang').show();

        }
    });

    function hitungTotal() {
        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var totalSemua = 0;
        for (var i = 0; i < tableData.length; i++) {
            totalSemua += parseInt(untitik(tableData[i][6]));
        }

        $('#total').val(numberWithCommas(totalSemua));
    }

    $(document).on('click', '#btnTambahDetail', function() {
        var idkonsumen = $('#idkonsumen').val();
        if (idkonsumen == null || idkonsumen == '') {
            swal("Informasi", "Nama konsumen harus dipilih!", "info")
                .then(function() {
                    $('#idkonsumen').focus();
                });
            return;             
        }
        $('#modalTambahInvoice').modal('show');
    });

    $(document).on('click', '#btnTambahDetailRincian', function() {
        var idkonsumen = $('#idkonsumen').val();

        if (idkonsumen == null || idkonsumen == '') {
            swal("Informasi", "Nama konsumen harus dipilih!", "info")
                .then(function() {
                    $('#idkonsumen').focus();
                });
            return;             
        }

        $('#modalTambahRincian').modal('show');
    });
</script>




@endsection