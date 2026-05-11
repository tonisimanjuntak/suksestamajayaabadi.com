@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penyesuaian Stok</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('penyesuaianstok') }}">Penyesuaian Stok</a></li>
                        <li class="breadcrumb-item label-judul active">Tambah</li>
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
                                        class="label-judul"></span> Data Penyesuaian Stok</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idpenyesuaianstok" id="idpenyesuaianstok">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea name="keterangan" id="keterangan" rows="3"
                                                            class="form-control"
                                                            placeholder="Keterangan Penyesuaian Stok"
                                                            autofocus></textarea>
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
                                                <div class="col-12">
                                                    <h3 class="text-muted">Detail Barang</h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nama Barang</label>
                                                        <select name="idbarang" id="idbarang"
                                                            class="form-control searchBarang">
                                                        </select>
                                                        <input type="hidden" name="namabarang" id="namabarang">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stok System</label>
                                                        <input type="number" name="stoksystem" id="stoksystem"
                                                            class="form-control" value="0" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stok Real</label>
                                                        <input type="number" name="stokreal" id="stokreal"
                                                            class="form-control" min="0" value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Selisih</label>
                                                        <input type="number" name="selisih" id="selisih"
                                                            class="form-control" value="0" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label for="">Keterangan Barang</label>
                                                        <textarea name="keterangandetail" id="keterangandetail" rows="2"
                                                            class="form-control"
                                                            placeholder="Keterangan detail barang"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary mt-5"
                                                            id="tambahbarang"><i
                                                                class="fas fa-plus mr-1"></i>Tambah</button>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%; text-align: center;">No</th>
                                                                <th style="width: 10%; text-align: center;">Id Barang
                                                                </th>
                                                                <th style="width: 35%; text-align: center;">Nama Barang
                                                                </th>
                                                                <th style="width: 10%; text-align: center;">Stock System
                                                                </th>
                                                                <th style="width: 10%; text-align: center;">Stock Real
                                                                </th>
                                                                <th style="width: 10%; text-align: center;">Selisih</th>
                                                                <th style="width: 20%; text-align: center;">Keterangan
                                                                </th>
                                                                <th style="width: 5%; text-align: center;">#</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="detailbarang">
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>






                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('penyesuaianstok') }}" class="btn btn-default float-right mr-1"><i
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

<script type="text/javascript">
    var idpenyesuaianstok = "<?php echo $idpenyesuaianstok; ?>";

    $(document).ready(function() {
        $("form").attr('autocomplete', 'off');
    });

    $(document).on('change', '#idbarang', function(e) {
        var idbarang = $(this).val();
        $('#namabarang').val("");
        $('#stoksystem').val("0");
        $('#stokreal').val("0");
        $('#selisih').val("0");
        $('#keterangandetail').val("");

        $.ajax({
            url: "{{ url('ajax/getBarangId') }}",
            type: 'GET',
            dataType: 'json',
            data: {'idbarang': idbarang},
        })
        .done(function(response) {
            console.log(response);
            if (response) {
                $('#namabarang').val(response.namabarang);
                $('#stoksystem').val(response.stok);
                $('#stokreal').val("");                
            }
        })
        .fail(function() {
            console.log('error');
        });
    });

    $(document).on('change', '#stokreal', function() {
        stoksystem = $('#stoksystem').val();
        stokreal = $(this).val();
        selisih = parseInt(stokreal) - parseInt(stoksystem);
        $('#selisih').val(selisih);
    })

    $(document).on('click', '#tambahbarang', function() {
        var idbarang = $('#idbarang').val();
        var namabarang = $('#namabarang').val();
        var stoksystem = $('#stoksystem').val();
        var stokreal = $('#stokreal').val();
        var selisih = $('#selisih').val();
        var keterangandetail = $('#keterangandetail').val();

        if (idbarang == "" || idbarang == null) {
            swal("Informasi", "Nama barang tidak boleh kosong!", "info");
            return;
        }

        if (stokreal == "") {
            swal("Informasi", "Stok real tidak boleh kosong!", "info");
            return;
        }

        var tableData = [];
        $("#detailbarang tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });

        for (var i = 0; i < tableData.length; i++) {
            if (idbarang == tableData[i][1]) {
                swal("Informasi", "Barang ini sudah ada!", "info");
                return;
            }
        }

        var nomorut = $('#detailbarang tr').length + 1;

        //add ke table
        var html = `<tr>
                        <td style="text-align: center;">${nomorut}</td>
                        <td style="text-align: center;">${idbarang}</td>
                        <td style="text-align: left;">${namabarang}</td>
                        <td style="text-align: center;">${stoksystem}</td>
                        <td style="text-align: center;">${stokreal}</td>
                        <td style="text-align: center;">${selisih}</td>
                        <td style="text-align: left;">${keterangandetail}</td>
                        <td style="text-align: center;"><button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-trash"></i></button></td>
                    </tr>`;

        $('#detailbarang').append(html);
        $('#stoksystem').val("0");
        $('#stokreal').val("0");
        $('#selisih').val("0");
        $('#keterangandetail').val("");
        $('#idbarang').focus();
    });

    $("#detailbarang").on("click", ".deleteRow", function() {
        $(this).closest("tr").remove();
    });

    function simpanData() {
        const idpenyesuaianstok = $('#idpenyesuaianstok').val();
        const keterangan = $('#keterangan').val();

        const inputs = document.querySelectorAll('input[name="barang[]"]');
        let detailPenyesuaianStok = [];

        //ambil detail barang dari row table
        $("#detailbarang tr").each(function() {
            var rowData = [];
            $(this).find("td").not(":last").each(function() {
                rowData.push($(this).text());
            });
            detailPenyesuaianStok.push(rowData);
        });

        if (detailPenyesuaianStok.length == 0) {
            swal("Informasi", "Detail barang penyesuaian stok tidak ada!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (keterangan=="") {
            swal("Informasi", "Keterangan penyesuaian stok tidak boleh kosong!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        var formData = {
            'idpenyesuaianstok' : idpenyesuaianstok,
            'keterangan' : keterangan,
            'detailPenyesuaianStok' : detailPenyesuaianStok,
        }


        $.ajax({
                type: 'POST',
                url: "{{ url('penyesuaianstok/simpanData') }}",
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
                            window.location.href = "{{ url('penyesuaianstok') }}";
                        });
                } else {
                    swal("Informasi", result.msg, "info");
                }
            })
            .fail(function() {
                console.log("Gagal script simpanData!");
            });
            
    }

    $('#simpan').click(function (e) { 
        e.preventDefault();
        $(this).attr('disabled', true);

        swal({
                title: "Simpan?",
                text: "Apakah anda yakin akan menyimpan data ini?",
                icon: "warning",
                buttons: ["Batal", "Ya"],
                dangerMode: true,
            })
            .then((willsave) => {
                if (willsave) {
                    simpanData();
                }else{
                    $(this).attr('disabled', false);

                }
            });

    });

</script>




@endsection