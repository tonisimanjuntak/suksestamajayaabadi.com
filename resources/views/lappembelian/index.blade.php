@extends('template/layout')

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Pembelian</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan Pembelian</li>
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
                                                        <h1>Laporan Pembelian</h1>
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
                                                                    <option value="Hutang">Hutang</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="" class="col-md-3 col-form-label">Nama
                                                                Supplier</label>
                                                            <div class="col-md-9">
                                                                <select name="idsupplier" id="idsupplier"
                                                                    class="form-control searchSupplier">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="idpembelian" class="col-md-3 col-form-label">No Faktur</label>
                                                            <div class="col-md-9">
                                                                <select name="idpembelian" id="idpembelian"
                                                                    class="form-control">
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-12 mt-5">
                                                        <button class="btn btn-danger float-right ml-1" id="btnCetakPdf"><i
                                                            class="fa fa-file-pdf"></i> Cetak Pdf</button>
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
        $(document).ready(function() {

            $('#idpembelian').select2({
                placeholder: 'Cari nomor faktur...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('pembelian.searchFaktur') }}", // URL untuk pencarian
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

        $('#btnCetakPdf').click(function() {
            cetak('pdf');
        });

        $('#btnCetakExcel').click(function() {
            cetak('excel');
        });

        function cetak(jenisCetakan)
        {
            var tglawal = $('#tglawal').val();
            var tglakhir = $('#tglakhir').val();
            var idsupplier = $('#idsupplier').val();
            var carabayar = $('#carabayar').val();
            var idpembelian = $('#idpembelian').val();

            if (idsupplier == "" || idsupplier == null) {
                idsupplier = "-";
            }
            if (idpembelian == "" || idpembelian == null) {
                idpembelian = "-";
            }

            if (carabayar == "") {
                carabayar = "-";
            }

            if (tglawal === '' || tglakhir === '') {
                swal("Informasi", "Tanggal periode belum dipilih!", "info");
                return;
            }

            // window.open("{{ url('lappembelian/cetak') }}" + "/" + jenisCetakan+ "/" + tglawal + "/" + tglakhir + "/" + idsupplier +
            //     "/" + carabayar + "/" + idpembelian);

            const params = new URLSearchParams();
            params.append('tglawal', tglawal);
            params.append('tglakhir', tglakhir);
            params.append('supplier', idsupplier);
            params.append('carabayar', carabayar);
            params.append('idpembelian', idpembelian);
            
            window.open("{{ url('lappembelian/cetak') }}/" + jenisCetakan + "?" + params.toString());

        }
    </script>
@endsection
