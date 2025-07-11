@extends('template/layout')

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Retur Pembelian</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('returpembelian') }}">Retur Pembelian</a></li>
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
                                            class="label-judul"></span> Data Faktur Retur Pembelian</h4>
                                </div>
                            </div>
                            <div class="card-body">


                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <input type="hidden" name="idreturpembelian" id="idreturpembelian">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <div class="card">
                                                            <div class="card-body card-detail">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h3>Faktur Pembelian</h3>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="idsupplier">Nama Supplier</label>
                                                                            <select name="idsupplier" id="idsupplier"
                                                                                class="form-control searchSupplier"></select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="idpembelian">ID/ No Faktur
                                                                                Pembelian</label>
                                                                            <select name="idpembelian" id="idpembelian"
                                                                                class="form-control"></select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">ID Pembelian</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-idpembelian">-</span></div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">No Faktur</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-nofaktur">-</span></div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">Tgl Faktur</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-tglfaktur">-</span></div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">Supplier</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-namasupplier">-</span></div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">Total Pembelian</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-totalsetelahdiskon">-</span></div>
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
                                                                        <h5 class="text-muted mb-3">Proses Pengajuan Retur
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="tglpengajuan">Tanggal Proses
                                                                                Retur</label>
                                                                            <input type="date" name="tglpengajuan"
                                                                                id="tglpengajuan" class="form-control"
                                                                                value="{{ date('Y-m-d') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="keterangan">Keterangan</label>
                                                                            <textarea name="keterangan" id="keterangan" rows="5" class="form-control"
                                                                                placeholder="Keterangan Retur Pembelian"></textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>
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
                                                        <h3 class="text-muted">Detail Retur</h3>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button class="btn btn-md btn-success float-right"
                                                            id="btnTambahDetail"><i class="fa fa-plus-circle mr-1"></i>
                                                            Tambah Detail</button>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="table-responsive">
                                                            <table id="tableDetail" class="table" style="width: 100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 5%; text-align: center;">No</th>
                                                                        <th style="">idbarang</th>
                                                                        <th style="">Nama Barang</th>
                                                                        <th style="width: 5%; text-align: center;">Jumlah
                                                                            Retur</th>
                                                                        <th style="width: 15%; text-align: right;">Harga
                                                                            Retur</th>
                                                                        <th style="width: 15%; text-align: right;">Sub
                                                                            Total</th>
                                                                        <th style="width: 15%; text-align: center;">Aksi
                                                                        </th>
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
                                <a href="{{ url('returpembelian') }}" class="btn btn-default float-right mr-1"><i
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
    @include('returpembelian/modalTambahBarang')

    <script type="text/javascript">
        var idreturpembelian = "<?php echo $idreturpembelian; ?>";

        $(document).ready(function() {

            $('#tableDetail thead tr :nth-child(2)').hide();
            $('#tableDetail tbody tr :nth-child(2)').hide();

            $('.select2').select2();

            if (idreturpembelian != "") {
                $('#idreturpembelian').val(idreturpembelian);
                $('.label-judul').html('Edit');
                $('#simpan').attr('disabled', true);

                $.ajax({
                        url: "{{ url('returpembelian/getDataID') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            'idreturpembelian': idreturpembelian
                        },
                    })
                    .done(function(response) {
                        // console.log(response);
                        var rsRetur = response.rsRetur;
                        addSelectOption('idpembelian', rsRetur['idpembelian'], rsRetur['idpembelian'] + " - " +
                            rsRetur['tglpengajuan'])
                        $('#idpembelian').val(rsRetur['idpembelian']).trigger('change');
                        $('#idpembelian').attr('disabled', true);
                        $('#tglpengajuan').val(rsRetur['tglpengajuan']);
                        $('#keterangan').val(rsRetur['keterangan']);
                        $('#carabayar').val(rsRetur['carabayar']).trigger('change');

                        if (rsRetur['idbank'] != '') {
                            addSelectOption('idbank', rsRetur['idbank'], rsRetur['namabank'])
                            $('#idbank').val(rsRetur['idbank']);
                        }


                        var rsDetail = response.rsDetail;
                        // console.log(rsDetail.length);
                        if (rsDetail.length > 0) {
                            for (var i = 0; i < rsDetail.length; i++) {
                                // console.log(rsDetail[i]);
                                addTableRow(rsDetail[i]['idbarang'], rsDetail[i]['namabarang'], rsDetail[i][
                                    'jumlahretur'
                                ], rsDetail[i]['hargaretur'], rsDetail[i]['subtotalretur'], rsDetail[i][
                                    'jumlahretur'
                                ])
                            }
                        }
                    })
                    .fail(function() {
                        console.log('error getDataID');
                    });
            } else {
                $('.label-judul').html('Tambah');

            }

            $('#idpembelian').select2({
                placeholder: 'Cari no faktur pembelian...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('pembelianpenerimaan.searchFaktur') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                            idsupplier: $('#idsupplier').val(), // Parameter pencarian
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

            $('.idbarangpembelian').select2({
                placeholder: 'Cari nama barang...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('returpembelian.searchBarangRetur') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
                            idpembelian: $('#idpembelian').val(),
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


        $(document).on('change', '#idpembelian', function() {
            var idpembelian = $(this).val();

            $.ajax({
                    url: "{{ url('returpembelian/getPembelian') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idpembelian': idpembelian
                    },
                })
                .done(function(response) {
                    // console.log(response);
                    $('#span-idpembelian').html(response['idpembelian']);
                    $('#span-nofaktur').html(response['nofaktur']);
                    $('#span-tglfaktur').html(response['tglfaktur']);
                    $('#span-namasupplier').html(response['namasupplier']);
                    $('#span-totalsetelahdiskon').html('Rp. ' + format_rupiah(response['totalsetelahdiskon']));
                })
                .fail(function() {
                    console.log('error getPembelian');
                });
        })


        $("#tableDetail").on("click", ".deleteRow", function() {
            $(this).closest("tr").remove();
        });








        $('#simpan').click(function() {
            var idreturpembelian = $("#idreturpembelian").val();
            var idpembelian = $("#idpembelian").val();
            var tglpengajuan = $("#tglpengajuan").val();
            var carabayar = $("#carabayar").val();
            var idbank = $("#idbank").val();
            var keterangan = $("#keterangan").val();
            var total = $("#total").val();

            if (idreturpembelian != "") {
                return; //disabled update
            }

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

            if (idpembelian == '') {
                swal("Informasi", "Pilih nomor faktur pembelian terlebih dahulu!", "info")
                    .then(function() {
                        $('#idpembelian').focus();
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

            if (tglpengajuan == '') {
                swal("Informasi", "Tanggal pengajuan retur tidak boleh kosong!", "info")
                    .then(function() {
                        $('#tglpengajuan').focus();
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
                    'jumlahretur': tableData[i][3],
                    'hargaretur': tableData[i][4],
                    'subtotalretur': tableData[i][5],
                })
            }

            var formData = {
                "idreturpembelian": idreturpembelian,
                "idpembelian": idpembelian,
                "tglpengajuan": tglpengajuan,
                "total": total,
                "keterangan": keterangan,
                "carabayar": carabayar,
                "idbank": idbank,
                "isidatatable": isidatatable
            };

            // console.log(formData);
            // return;

            $.ajax({
                    type: 'POST',
                    url: "{{ url('returpembelian/simpanData') }}",
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
                                window.location.href = "{{ url('returpembelian') }}";
                            });
                    } else {
                        swal("Informasi", result.msg, "info");
                    }
                })
                .fail(function() {
                    console.log("Gagal script simpanData!");
                });

        })

        $(document).on('change', '#carabayar', function() {
            var carabayar = $(this).val();
            if (carabayar == 'Transfer') {
                $('#divBank').show();
            } else {
                $('#divBank').hide();
            }
        });


        $('#btnTambahDetail').click(function() {
            var idpembelian = $('#idpembelian').val();
            if (idpembelian != null) {
                $('#modalTambahBarang').modal('show');
                $('#idbarang').val('').trigger('change');
                $('#stok').val('');
                $('#namabarang').val('');
                $('#tdKategori').html('');
                $('#tdStok').html('');

            } else {
                swal('Informasi', 'Pilih Faktur pembeliah terlebih dahulu!', 'info');
            }
        })
    </script>
@endsection
