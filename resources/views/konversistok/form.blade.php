@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Konversi Stok</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('konversistok') }}">Konversi Stok</a></li>
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
                                        class="label-judul"></span> Data Konversi Stok</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idkonversi" id="idkonversi">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea name="keterangan" id="keterangan" rows="3"
                                                            class="form-control" placeholder="Keterangan konversi stok"
                                                            autofocus></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h3 class="text-muted">Barang Asal</h3>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="">Nama Barang</label>
                                                        <select name="idbarangasal" id="idbarangasal"
                                                            class="form-control searchBarang">
                                                        </select>
                                                        <input type="hidden" name="namabarangasal" id="namabarangasal">
                                                        <input type="hidden" name="idsatuanasal" id="idsatuanasal">
                                                        <input type="hidden" name="jumlahstokasal" id="jumlahstokasal">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Jumlah Konversi</label>
                                                        <input type="number" name="jumlahbarangasal"
                                                            id="jumlahbarangasal" class="form-control" min="0"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody id="tbodyBarangAsal">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h3 class="text-muted">Barang Tujuan</h3>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="">Nama Barang</label>
                                                        <select name="idbarangtujuan" id="idbarangtujuan"
                                                            class="form-control searchBarang">
                                                        </select>
                                                        <input type="hidden" name="namabarangtujuan"
                                                            id="namabarangtujuan">
                                                        <input type="hidden" name="idsatuantujuan" id="idsatuantujuan">
                                                        <input type="hidden" name="jumlahstoktujuan"
                                                            id="jumlahstoktujuan">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Jumlah Hasil</label>
                                                        <input type="number" name="jumlahbarangtujuan"
                                                            id="jumlahbarangtujuan" class="form-control" min="0"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody id="tbodyBarangTujuan">

                                                            </tbody>
                                                        </table>
                                                    </div>
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
                            <a href="{{ url('konversistok') }}" class="btn btn-default float-right mr-1"><i
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
    var idkonversi = "<?php echo $idkonversi; ?>";

    $(document).ready(function() {
        $("form").attr('autocomplete', 'off');
    });

    $(document).on('change', '#idbarangasal', function(e) {
        var idbarangasal = $(this).val();        

        $.ajax({
            url: "{{ url('ajax/getBarangId') }}",
            type: 'GET',
            dataType: 'json',
            data: {'idbarang': idbarangasal},
        })
        .done(function(response) {
            console.log(response);
            if (response) {
                var addText = `<tr>
                                    <td style="text-alignment: left;">Kode
                                        Barang</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                         ` + response.kdbarang + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">Nama
                                        Barang</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                         ` + response.namabarang + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">Satuan
                                    </td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                         ` + response.namasatuan + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">
                                        Kategori</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                        ` + response.namakategori + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">
                                        Stok</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                        ` + response.stok + `
                                    </td>
                                </tr>`;

                $('#tbodyBarangAsal').html(addText);
                $('#idsatuanasal').val(response.idsatuan);
                $('#namabarangasal').val(response.namabarang);
                $('#jumlahstokasal').val(response.stok);
            }
        })
        .fail(function() {
            console.log('error');
        });
    });


    $(document).on('change', '#idbarangtujuan', function(e) {
        var idbarangtujuan = $(this).val();        

        $.ajax({
            url: "{{ url('ajax/getBarangId') }}",
            type: 'GET',
            dataType: 'json',
            data: {'idbarang': idbarangtujuan},
        })
        .done(function(response) {
            console.log(response);
            if (response) {
                var addText = `<tr>
                                    <td style="text-alignment: left;">Kode
                                        Barang</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                         ` + response.kdbarang + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">Nama
                                        Barang</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                         ` + response.namabarang + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">Satuan
                                    </td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                         ` + response.namasatuan + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">
                                        Kategori</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                        ` + response.namakategori + `
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-alignment: left;">
                                        Stok</td>
                                    <td style="text-alignment: left;">:</td>
                                    <td style="text-alignment: left;">
                                        ` + response.stok + `
                                    </td>
                                </tr>`;

                $('#tbodyBarangTujuan').html(addText);
                $('#idsatuantujuan').val(response.idsatuan);
                $('#namabarangtujuan').val(response.namabarang);
                $('#jumlahstoktujuan').val(response.stok);
            }
        })
        .fail(function() {
            console.log('error');
        });
    });

    

    function simpanData() {
        $('#simpan').attr('disabled', true);

        const idkonversi = $('#idkonversi').val();
        const keterangan = $('#keterangan').val();
        const idsatuanasal = $('#idsatuanasal').val();
        const idsatuantujuan = $('#idsatuantujuan').val();
        const idbarangasal = $('#idbarangasal').val();
        const idbarangtujuan = $('#idbarangtujuan').val();
        const jumlahbarangasal = $('#jumlahbarangasal').val();
        const jumlahbarangtujuan = $('#jumlahbarangtujuan').val();
        const namabarangasal = $('#namabarangasal').val();
        const namabarangtujuan = $('#namabarangtujuan').val();
        const jumlahstokasal = $('#jumlahstokasal').val();
        const jumlahstoktujuan = $('#jumlahstoktujuan').val();

        if (keterangan=="") {
            swal("Informasi", "Keterangan penyesuaian stok tidak boleh kosong!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (idbarangasal=="" || idbarangasal == null) {
            swal("Informasi", "Nama barang asal tidak boleh kosong!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (idbarangtujuan=="" || idbarangtujuan == null) {
            swal("Informasi", "Nama barang tujuan tidak boleh kosong!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (idsatuanasal=="" || idsatuanasal == null) {
            swal("Informasi", "Nama Satuan Barang asal belum ada!, silahkan input terlebih dahulu di master barang!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (idsatuantujuan=="" || idsatuantujuan == null) {
            swal("Informasi", "Nama Satuan Barang tujuan belum ada!, silahkan input terlebih dahulu di master barang!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (jumlahbarangasal=="" || parseInt(jumlahbarangasal) == 0) {
            swal("Informasi", "Jumlah barang asal tidak boleh kosong!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (jumlahbarangtujuan=="" || parseInt(jumlahbarangtujuan) == 0) {
            swal("Informasi", "Jumlah barang tujuan tidak boleh kosong!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (idbarangasal == idbarangtujuan) {
            swal("Informasi", "Barang asal dan barang tujuan tidak boleh sama!", "info");
            $('#simpan').attr('disabled', false);
            return;            
        }

        /*
        ## REQUEST TGL 25-05-2026

        if (idsatuanasal == idsatuantujuan) {
            swal("Informasi", "Satuan asal dan satuan tujuan tidak boleh sama!", "info");
            $('#simpan').attr('disabled', false);
            return;            
        }
        */

        if ( parseInt(jumlahbarangasal) > parseInt(jumlahstokasal) ) {
            swal("Informasi", "Jumlah barang asal tidak boleh melebihi stok barang asal!", "info");
            $('#simpan').attr('disabled', false);
            return;            
        }

        

        var formData = {
            'idkonversi' : idkonversi,
            'keterangan' : keterangan,
            'idsatuanasal' : idsatuanasal,
            'idsatuantujuan' : idsatuantujuan,
            'idbarangasal' : idbarangasal,
            'idbarangtujuan' : idbarangtujuan,
            'jumlahbarangasal' : jumlahbarangasal,
            'jumlahbarangtujuan' : jumlahbarangtujuan
        }

        $.ajax({
                type: 'POST',
                url: "{{ url('konversistok/simpanData') }}",
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
                            window.location.href = "{{ url('konversistok') }}";
                        });
                } else {
                    swal("Informasi", result.msg, "info");
                    $('#simpan').attr('disabled', false);
                }
            })
            .fail(function() {
                $('#simpan').attr('disabled', false);
                console.log("Gagal script simpanData1!");
                swal("Error", "Terjadi kesalahan script!!", "error");
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