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
                                            class="label-judul"></span> Ubah Status Retur Pembelian</h4>
                                </div>
                            </div>
                            <div class="card-body">


                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <input type="hidden" name="idreturpembelian" id="idreturpembelian">
                                <input type="hidden" name="idpembelian" id="idpembelian">
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
                                                                        <h5 class="text-muted">Pengajuan Retur Pembelian
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">ID Pembelian</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-idpembelian">{{ $rsPembelian->idpembelian }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">No Faktur</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-nofaktur">{{ $rsPembelian->nofaktur }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">Tgl Faktur</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-tglfaktur">{{ $rsPembelian->tglfaktur }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">Supplier</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-namasupplier">{{ $rsPembelian->namasupplier }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">Tgl Pengajuan Retur</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-tglpengajuan">{{ $rsRetur->tglpengajuan }}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="label-detail">Keterangan</div>
                                                                        <div class="value-detail"><span
                                                                                id="span-keterangan">{{ $rsRetur->keterangan }}</span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 mt-3">
                                                                        <h5 class="text-muted">Detail Retur</h5>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="table-responsive">
                                                                            <table id="tableDetail" class="table"
                                                                                style="width: 100%;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th
                                                                                            style="width: 5%; text-align: center;">
                                                                                            No</th>
                                                                                        <th style="">idbarang</th>
                                                                                        <th style="">Nama Barang</th>
                                                                                        <th
                                                                                            style="width: 5%; text-align: center;">
                                                                                            Jumlah
                                                                                            Retur</th>
                                                                                        <th
                                                                                            style="width: 15%; text-align: right;">
                                                                                            Harga
                                                                                            Retur</th>
                                                                                        <th
                                                                                            style="width: 15%; text-align: right;">
                                                                                            Sub
                                                                                            Total</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 text-right">
                                                                        <label for="" class="col-form-label">TOTAL
                                                                            RETUR
                                                                            Rp. <span id="total"></span></label>
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
                                                                        <h5 class="text-muted mb-3">Ubah Status Retur
                                                                        </h5>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="statusretur">Status Retur</label>
                                                                            <select name="statusretur" id="statusretur"
                                                                                class="form-control select2">
                                                                                <option value="Proses">Proses</option>
                                                                                <option value="Selesai">Selesai</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12" id="divProses"
                                                                        style="display: none;">
                                                                        <div class="row">
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="tglretur">Tanggal Proses
                                                                                        Retur</label>
                                                                                    <input type="date" name="tglretur"
                                                                                        id="tglretur"
                                                                                        class="form-control"
                                                                                        value="{{ date('Y-m-d') }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="carabayar">Cara
                                                                                        Pengembalian</label>
                                                                                    <select name="carabayar"
                                                                                        id="carabayar"
                                                                                        class="form-control select2">
                                                                                        <option value="">Pilih cara
                                                                                            pengembalian...</option>
                                                                                        <option value="Tunai">Tunai
                                                                                        </option>
                                                                                        <option value="Transfer">Transfer
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12" id="divBank"
                                                                                style="display: none;">
                                                                                <div class="form-group">
                                                                                    <label for="idbank">Nama Bank</label>

                                                                                    <select name="idbank" id="idbank"
                                                                                        class="form-control searchBank">
                                                                                    </select>
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
    <script type="text/javascript">
        var idreturpembelian = "<?php echo $idreturpembelian; ?>";

        $(document).ready(function() {

            $('#tableDetail thead tr :nth-child(2)').hide();
            $('#tableDetail tbody tr :nth-child(2)').hide();

            $('.select2').select2();

            $('#idreturpembelian').val(idreturpembelian);

            $.ajax({
                    url: "{{ url('returpembelian/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idreturpembelian': idreturpembelian
                    },
                })
                .done(function(response) {
                    console.log(response);
                    var rsRetur = response.rsRetur;
                    $('#idpembelian').val(rsRetur['idpembelian']);
                    if (rsRetur['tglretur'] != null) {
                        $('#tglretur').val(rsRetur['tglretur']);
                    }
                    if (rsRetur['statusretur'] != '') {
                        $('#statusretur').val(rsRetur['statusretur']).trigger('change');
                    }
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


        $("#tableDetail").on("click", ".deleteRow", function() {
            $(this).closest("tr").remove();
        });








        $('#simpan').click(function() {
            var idreturpembelian = $("#idreturpembelian").val();
            var idpembelian = $("#idpembelian").val();
            var statusretur = $("#statusretur").val();
            var tglretur = $("#tglretur").val();
            var carabayar = $("#carabayar").val();
            var idbank = $("#idbank").val();

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

            if (carabayar == '') {
                swal("Informasi", "Cara bayar tidak boleh kosong!", "info")
                    .then(function() {
                        $('#carabayar').focus();
                    });
                return;
            }

            if (tglretur == '') {
                swal("Informasi", "Tanggal retur tidak boleh kosong!", "info")
                    .then(function() {
                        $('#tglretur').focus();
                    });
                return;
            }


            var formData = {
                "idreturpembelian": idreturpembelian,
                "idpembelian": idpembelian,
                "tglretur": tglretur,
                "statusretur": statusretur,
                "carabayar": carabayar,
                "idbank": idbank
            };

            // console.log(formData);
            // return;

            $.ajax({
                    type: 'POST',
                    url: "{{ url('returpembelian/simpanubahstatus') }}",
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

        function addTableRow(idbarang, namabarang, jumlahretur, hargaretur, subtotalretur,
            jumlahbeli) {

            if (jumlahbeli == "" || jumlahbeli == "0") {
                swal("Informasi", "Jumlah pembelian tidak ada!", "info");
                return;
            }

            if (parseInt(jumlahbeli) < parseInt(jumlahretur)) {
                swal("Informasi", "Jumlah retur melebihi jumlah pembelian!", "info");
                return;
            }

            var tableData = [];
            $("#tableDetail tbody tr").each(function() {
                var rowData = [];
                $(this).find("td").not(":last").each(function() {
                    rowData.push($(this).text());
                });
                tableData.push(rowData);
            });

            var totalSemua = parseInt(subtotalretur);
            for (var i = 0; i < tableData.length; i++) {
                totalSemua += parseInt(untitik(tableData[i][5]));
                if (idbarang == tableData[i][1]) {
                    swal("Informasi", "Data barang sudah ada!", "info");
                    return;
                }
            }

            $('#total').html(numberWithCommas(totalSemua));

            var No = $("#tableDetail tbody tr").length + 1;
            var addText = `<tr>
                                                    <td style="text-align: center;">` + No + `</td>
                                                    <td style="">` + idbarang + `</td>
                                                    <td style="">` + namabarang + `</td>
                                                    <td style="text-align: center;">` + numberWithCommas(jumlahretur) + `</td>
                                                    <td style="text-align: right;">` + numberWithCommas(hargaretur) + `</td>
                                                    <td style="text-align: right;">` + numberWithCommas(
                subtotalretur) + `</td>
                                                </tr>`;

            $('#tableDetail').append(addText);
            $('#tableDetail thead tr :nth-child(2)').hide();
            $('#tableDetail tbody tr :nth-child(2)').hide();
        }

        $(document).on('change', '#statusretur', function() {
            var statusretur = $(this).val();
            if (statusretur == 'Selesai') {
                showDivProses();
            } else {
                hideDivProses();
            }
        });

        function showDivProses() {
            $('#divProses').show();
        }

        function hideDivProses() {
            $('#divProses').hide();
        }
    </script>
@endsection
