@extends('template/layout')

@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Laporan Buku Utang Ekspedisi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan Buku Utang Ekspedisi</li>
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
                                                        <h1>Laporan Buku Utang Ekspedisi</h1>
                                                    </div>
                                                    <div class="col-12 mb-5 text-lg">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="statusLunasOption" id="inlineRadio1"
                                                                value="Belum">
                                                            <label class="form-check-label"
                                                                for="inlineRadio1">Yang Belum Lunas</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="statusLunasOption" id="inlineRadio2"
                                                                value="Sudah">
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Sudah Lunas</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="statusLunasOption" id="inlineRadio3"
                                                                value="Semua" checked>
                                                            <label class="form-check-label"
                                                                for="inlineRadio3">Semua</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">

                                                        <div class="form-group row">
                                                            <label for="idekspedisi" class="col-md-3 col-form-label">Nama
                                                                Ekspedisi</label>
                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <select name="idekspedisi" id="idekspedisi"
                                                                            class="form-control searchEkspedisi">
                                                                        </select>
                                                                    </div>
                                                                </div>
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

            

        });

        $('#btnCetakPdf').click(function() {
            cetak('pdf');
        });

        $('#btnCetakExcel').click(function() {
            cetak('excel');
        });

        function cetak(jenisCetakan) {
            var idekspedisi = $('#idekspedisi').val();
            var statusLunasOption = $('input[name="statusLunasOption"]:checked').val();;

            if (idekspedisi == "" || idekspedisi == null) {
                idekspedisi = '-';
            }

            const params = new URLSearchParams();            
            params.append('idekspedisi', idekspedisi);
            params.append('statusLunasOption', statusLunasOption);
            
            window.open("{{ url('laputangekspedisi/cetak') }}/" + jenisCetakan + "?" + params.toString());

        }
    </script>
@endsection
