@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Saldo Awal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('saldoawal') }}">Saldo Awal</a></li>
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
                                        class="label-judul"></span> Data Saldo Awal</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idsaldoawal" id="idsaldoawal">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 required">
                                                    <div class="form-group row">
                                                        <label for="tahun" class="col-md-2 col-form-label">Tahun</label>
                                                        <div class="col-md-2">
                                                            <select name="tahun" id="tahun" class="form-control select2">
                                                                @php
                                                                    for ($i=2024; $i <= date('Y')  ; $i++) { 
                                                                        if ($i == date('Y')) {
                                                                            echo "<option value='$i' selected>$i</option>";
                                                                        } else {
                                                                            echo "<option value='$i'>$i</option>";
                                                                        }
                                                                    }
                                                                @endphp
                                                            </select>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <button class="btn btn-md btn-success" data-toggle="modal" data-target="#modalTambahAkun" id="btnTambahDetail"><i class="fa fa-plus-circle mr-1"></i> Tambah Detail</button>
                                                        </div>

                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 mt-3">
                                                    <div class="table-responsive">
                                                        <table id="tableDetail" class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 5%; text-align: center;">No</th>
                                                                    <th style="">Kode Akun</th>
                                                                    <th style="">Nama Akun</th>
                                                                    <th style="width: 15%; text-align: right;">Debet</th>
                                                                    <th style="width: 15%; text-align: right;">Kredit</th>
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
                                        <div class="col-md-6 text-right">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Total Debet</label>
                                                <input type="text" name="totaldebet" id="totaldebet"
                                                    class="form-control rupiah" value="0" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Total Kredit</label>
                                                <input type="text" name="totalkredit" id="totalkredit"
                                                    class="form-control rupiah" value="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('saldoawal') }}" class="btn btn-default float-right mr-1"><i
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


@include('saldoawal/modalTambahAkun')

<script type="text/javascript">
    var idsaldoawal = "<?php echo $idsaldoawal; ?>";

    $(document).ready(function() {

        $('.select2').select2();

        if (idsaldoawal != "") {
            $('#idsaldoawal').val(idsaldoawal);
            $('.label-judul').html('Edit');
            $.ajax({
                    url: "{{ url('saldoawal/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idsaldoawal': idsaldoawal
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    var rsSaldoAwal = response.rsSaldoAwal;
                    $('#tahun').val(rsSaldoAwal['tahun']);
                    $('#tahun').attr('disabled', true);

                    var rsDetail = response.rsDetail;
                    // console.log(rsDetail.length);
                    if (rsDetail.length > 0) {
                        for (var i = 0; i < rsDetail.length; i++) {
                            // console.log(rsDetail[i]);
                            addTableRow(rsDetail[i]['kdakun'], rsDetail[i]['namaakun'], rsDetail[i]['debet'], rsDetail[i]['kredit'])
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

        hitungTotalDebetKredit();
    });

    $('#simpan').click(function() {
        var idsaldoawal = $("#idsaldoawal").val();
        var tahun = $("#tahun").val();
        var totaldebet = $("#totaldebet").val();
        var totalkredit = $("#totalkredit").val();

        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        if (tahun == '') {
            swal("Informasi", "Tahun tidak boleh kosong!", "info")
                .then(function() {
                    $('#tahun').focus();
                });
            return;
        }

        if (totaldebet != totalkredit) {
            swal("Informasi", "Total debet dan total kredit harus sama!", "info");
            return;
        }


        if ($("#tableDetail tbody tr").length == 0) {
            swal("Informasi", "Detail saldo belum ada!!", "info");
            return;
        }

        isidatatable = [];
        for (var i = 0; i < tableData.length; i++) {
            isidatatable.push({
                'kdakun': tableData[i][1],
                'namaakun': tableData[i][2],
                'debet': tableData[i][3],
                'kredit': tableData[i][4],
            })
        }

        var formData = {
            "idsaldoawal": idsaldoawal,
            "tahun": tahun,
            "totaldebet": totaldebet,
            "totalkredit": totalkredit,
            "isidatatable": isidatatable
        };

        $.ajax({
                type: 'POST',
                url: "{{ url('saldoawal/simpanData') }}",
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
                            window.location.href = "{{ url('saldoawal') }}";
                        });
                } else {
                    swal("Informasi", result.msg, "info");
                }
            })
            .fail(function() {
                console.log("Gagal script simpanData!");
            });

    })


    function hitungTotalDebetKredit() {
        var tableData = [];
        $("#tableDetail tbody tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        var totaldebet = 0;
        var totalkredit = 0;
        for (var i = 0; i < tableData.length; i++) {
            totaldebet += parseInt(untitik(tableData[i][3]));
            totalkredit += parseInt(untitik(tableData[i][4]));
            if (kdakun == tableData[i][1]) {
                swal("Informasi", "Nama akun sudah ada!", "info");
                return;
            }
        }

        $('#totaldebet').val(numberWithCommas(totaldebet));
        $('#totalkredit').val(numberWithCommas(totalkredit));
    }
</script>




@endsection