@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penagihan Piutang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('penagihan') }}">Penagihan Piutang</a></li>
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
                                        class="label-judul"></span> Penagihan Piutang</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idpenagihan" id="idpenagihan">
                            <input type="hidden" name="tgltagihanakhir" id="tgltagihanakhir">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-3 required">
                                                    <div class="form-group">
                                                        <label for="tglpenagihan">Tanggal Penagihan</label>
                                                        <input type="date" name="tglpenagihan" id="tglpenagihan"
                                                            class="form-control" value="{{ date('Y-m-d') }}" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 required">
                                                    <div class="form-group">
                                                        <label for="idsales">Nama Sales</label>
                                                        <select name="idsales" id="idsales" class="form-control searchSales">
                                                        </select>
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
                                                    <h3 class="text-muted">Data Penagihan Invoice</h3>
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
                                                                    <th style="">idpiutang</th>
                                                                    <th style="">idsalesbonus</th>
                                                                    <th style="width: 15%; text-align: center;">No Invoice</th>
                                                                    <th style="width: 15%; text-align: center;">Tgl Invoice</th>
                                                                    <th style="width: 20%; text-align: left;">Nama Konsumen</th>
                                                                    <th style="width: 20%; text-align: left;">Bonus Sales</th>
                                                                    <th style="width: 15%; text-align: right;">Tagihan</th>
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
                                                            <label for="" class="col-form-label">TOTAL TAGIHAN (Rp.)</label>
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
                                
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('penagihan') }}" class="btn btn-default float-right mr-1"><i
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


@include('penagihan/modalTambahInvoice')

<script type="text/javascript">
    var idpenagihan = "<?php echo $idpenagihan; ?>";

    var lInit = true;

    $(document).ready(function() {

        $('#tableDetail thead tr :nth-child(2)').hide();
        $('#tableDetail tbody tr :nth-child(2)').hide();
        $('#tableDetail thead tr :nth-child(3)').hide();
        $('#tableDetail tbody tr :nth-child(3)').hide();

        $('.select2').select2();

        if (idpenagihan != "") {
            $('#idpenagihan').val(idpenagihan);
            $('#tglpenagihan').prop("disabled", true);
            $('#idsales').prop("disabled", true);
        
            $('.label-judul').html('Edit');
            $.ajax({
                    url: "{{ url('penagihan/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpenagihan': idpenagihan
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsPenagihan = response.rsPenagihan;
                    
                    $('#idpenagihan').val(rsPenagihan['idpenagihan']);
                    $('#tglpenagihan').val(rsPenagihan['tglpenagihan']);

                    addSelectOption('idsales', rsPenagihan['idsales'], rsPenagihan['namasales'] + ' | NPWP : ' + rsPenagihan['npwpsales']);
                    $('#idsales').val(rsPenagihan['idsales']).trigger('change');

                    var rsDetail = response.rsDetail;
                    if (rsDetail.length > 0) {
                        for (var i = 0; i < rsDetail.length; i++) {                            
                            addTableRow(rsDetail[i], rsDetail[i]['idsalesbonus'], rsDetail[i]['namasalesbonus'], rsDetail[i]['jumlahtagihan']);                            
                        }
                    }

                    lInit = false;
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            lInit = false;

            $('#tgltagihanakhir').val(getNextSundayFromDate($('#tglpenagihan').val()));
            $('.label-judul').html('Tambah');
        }
        
        $("form").attr('autocomplete', 'off');
    });
    
    $(document).on('change', '#tglpenagihan', function() {
        $('#tgltagihanakhir').val(getNextSundayFromDate($('#tglpenagihan').val()));
    });

    $(document).on('change', '#idsales', function() {
        $('#tableDetail tbody').empty();
    });


    $("#tableDetail").on("click", ".deleteRow", function() {
        $(this).closest("tr").remove();
        hitungTotal();
    });


    $('#simpan').click(function() {
        var idpenagihan = $("#idpenagihan").val();
        var tglpenagihan = $("#tglpenagihan").val();
        var tgltagihanakhir = $("#tgltagihanakhir").val();
        var idsales = $("#idsales").val();
        var total = $("#total").val();

        $('#simpan').attr('disabled', true);

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        if (tglpenagihan == '') {
            swal("Informasi", "Tanggal penagihan tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#tglpenagihan').focus();
                });
            return;
        }

        if (idsales == '' || idsales == null) {
            swal("Informasi", "Nama sales tidak boleh kosong!", "info")
                .then(function() {
                    $('#simpan').attr('disabled', false);
                    $('#idsales').focus();
                });
            return;
        }

        if ($("#tableDetail tbody tr").length == 0) {
            $('#simpan').attr('disabled', false);
            swal("Informasi", "Detail penagihan invoice pengiriman belum ada!!", "info");
            return;
        }

        isidatatable = [];
        for (var i = 0; i < tableData.length; i++) {
            isidatatable.push({
                'idpiutang': tableData[i][1],
                'idsalesbonus': tableData[i][2],
                'jumlahtagihan': tableData[i][7],
            })
        }

        var formData = {
            "idpenagihan": idpenagihan,
            "tglpenagihan": tglpenagihan,
            "tgltagihanakhir": tgltagihanakhir,
            "idsales": idsales,
            "total": total,            
            "isidatatable": isidatatable,
        };

        // console.log(formData);
        // return;

        $.ajax({
                type: 'POST',
                url: "{{ url('penagihan/simpanData') }}",
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
                            window.location.href = "{{ url('penagihan') }}";
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
            totalSemua += parseInt(untitik(tableData[i][7]));
        }

        $('#total').val(numberWithCommas(totalSemua));
    }

    $(document).on('click', '#btnTambahDetail', function() {
        var idsales = $('#idsales').val();
        var idsalestext = $("#idsales option:selected").text();

        if (idsales == null || idsales == '') {
            swal("Informasi", "Nama sales harus dipilih!", "info")
                .then(function() {
                    $('#idsales').focus();
                });
            return;             
        }
        $('#modalTambahInvoice').modal('show');

        loadModal(idsales, idsalestext);
    });


    function getNextSundayFromDate(tglmulai) {
        const startDate = new Date(tglmulai); // Parse tanggal awal
        const dayOfWeek = startDate.getDay(); // Dapatkan nomor hari dalam seminggu (0 = Minggu, 1 = Senin, ..., 6 = Sabtu)
        const daysUntilNextSunday = (7 - dayOfWeek) % 7; // Hitung hari tersisa hingga Minggu minggu ini
        const nextSunday = new Date(startDate);
        nextSunday.setDate(startDate.getDate() + daysUntilNextSunday + 7); // Tambahkan 7 hari untuk minggu depan

        // Format tanggal menjadi YYYY-MM-DD
        const year = nextSunday.getFullYear();
        const month = String(nextSunday.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
        const day = String(nextSunday.getDate()).padStart(2, '0'); // Tambahkan leading zero jika perlu

        return `${year}-${month}-${day}`;
    }

</script>




@endsection