@extends('template/layout')

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Penjualan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan Penjualan</li>
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

                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body p-5">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <h1>Laporan Penjualan</h1>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">Tanggal
                                                                Periode</label>
                                                            <div class="col-md-4">
                                                                <input type="date" name="tglawal" id="tglawal"
                                                                    class="form-control" value="{{ date('Y-m-d') }}">
                                                            </div>
                                                            <label for=""
                                                                class="col-md-1 col-form-label text-center">s/d</label>
                                                            <div class="col-md-4">
                                                                <input type="date" name="tglakhir" id="tglakhir"
                                                                    class="form-control" value="{{ date('Y-m-d') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">Cara Bayar</label>
                                                            <div class="col-md-9">
                                                                <select name="carabayar" id="carabayar"
                                                                    class="form-control select2">
                                                                    <option value="">Cara bayar...</option>
                                                                    <option value="Tunai">Tunai</option>
                                                                    <option value="Transfer">Transfer</option>
                                                                    <option value="Piutang">Piutang</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">Nama
                                                                Konsumen</label>
                                                            <div class="col-md-9">
                                                                <select name="idkonsumen" id="idkonsumen"
                                                                    class="form-control searchKonsumen">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">Nama
                                                                Kasir</label>
                                                            <div class="col-md-9">
                                                                <select name="idpengguna" id="idpengguna"
                                                                    class="form-control searchKasir">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="idsales" class="col-md-3 col-form-label">Nama
                                                                Sales</label>
                                                            <div class="col-md-9">
                                                                <select name="idsales" id="idsales"
                                                                    class="form-control searchSales">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="idwilayah" class="col-md-3 col-form-label">Nama
                                                                Wilayah</label>
                                                            <div class="col-md-9">
                                                                <select name="idwilayah" id="idwilayah"
                                                                    class="form-control searchWilayah">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="idpenjualan" class="col-md-3 col-form-label">Nomor Invoice</label>
                                                            <div class="col-md-9">
                                                                <select name="idpenjualan" id="idpenjualan"
                                                                    class="form-control">
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <button class="btn btn-danger float-right ml-1" id="btnCetakPdf"><i
                                                                class="fa fa-file-pdf"></i> Cetak PDF</button>
                                                        <button class="btn btn-success float-right" id="btnCetakExcel"><i
                                                            class="fa fa-file-excel"></i> Cetak Excel</button>
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
@endsection

@section('scripts')
    <script>

        $(document).ready(function () {
            $('#idpenjualan').select2({
                placeholder: 'Cari nomor invoice...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('penjualan.searchInvoice') }}", // URL untuk pencarian
                    dataType: 'json',
                    delay: 250, // Delay saat mengetik (ms)
                    data: function(params) {
                        return {
                            q: params.term, // Parameter pencarian
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
        });

        $('#btnCetakExcel').click(function() {
            cetak('excel');
        });

        $('#btnCetakPdf').click(function() {
            cetak('pdf');
        });

        function cetak(jenisCetakan)
        {
            var tglawal = $('#tglawal').val();
            var tglakhir = $('#tglakhir').val();
            var idkonsumen = $('#idkonsumen').val();
            var idpengguna = $('#idpengguna').val();
            var carabayar = $('#carabayar').val();
            var idsales = $('#idsales').val();
            var idwilayah = $('#idwilayah').val();
            var idpenjualan = $('#idpenjualan').val();

            if (idkonsumen == null) {
                idkonsumen = "-";
            }
            if (idpengguna == null) {
                idpengguna = "-";
            }
            if (carabayar == null || carabayar == "") {
                carabayar = "-";
            }

            if (idsales == null || idsales == "") {
                idsales = "-";
            }

            if (idwilayah == null || idwilayah == "") {
                idwilayah = "-";
            }

            if (idpenjualan == null || idpenjualan == "") {
                idpenjualan = "-";
            }

            if (tglawal === '' || tglakhir === '') {
                swal("Informasi", "Tanggal periode belum dipilih!", "info");
                return;
            }

            const params = new URLSearchParams();
            params.append('tglawal', tglawal);
            params.append('tglakhir', tglakhir);
            params.append('idkonsumen', idkonsumen);
            params.append('idpengguna', idpengguna);
            params.append('carabayar', carabayar);
            params.append('idsales', idsales);
            params.append('idwilayah', idwilayah);
            params.append('idpenjualan', idpenjualan);

            window.open("{{ url('lappenjualan/cetak') }}/" + jenisCetakan + "?" + params.toString());

        }
    </script>
@endsection
