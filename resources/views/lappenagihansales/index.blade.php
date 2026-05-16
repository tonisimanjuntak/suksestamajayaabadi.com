@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Penagihan Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Laporan Penagihan Sales</li>
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
                                                    <h1>Laporan Penagihan Sales</h1>
                                                </div>
                                                <div class="col-12">

                                                    <div class="form-group row">
                                                        <label for="idsales" class="col-md-3 col-form-label">Periode Tgl
                                                            Piutang</label>
                                                        <div class="col-md-3">
                                                            <input type="date" name="tglawal" id="tglawal"
                                                                class="form-control" value="{{ date('Y-m-d') }}">
                                                        </div>
                                                        <label for=""
                                                            class="col-md-1 col-form-label text-center">S/D</label>
                                                        <div class="col-md-3">
                                                            <input type="date" name="tglakhir" id="tglakhir"
                                                                class="form-control" value="{{ date('Y-m-d') }}">
                                                        </div>
                                                    </div>
                                                    {{-- di hide dulu karena tidak ada status lunas --}}
                                                    <div class="form-group row" style="display: none;">
                                                        <label for="idsales" class="col-md-3 col-form-label">Status
                                                            Lunas</label>
                                                        <div class="col-md-9">
                                                            <select name="statuslunas" id="statuslunas"
                                                                class="form-control select2">
                                                                <option value="">Semua...</option>
                                                                <option value="Lunas">Lunas</option>
                                                                <option value="Belum Lunas" selected>Belum Lunas
                                                                </option>
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
           
        });

        $('#btnCetakExcel').click(function() {
            cetak('excel');
        });

        $('#btnCetakPdf').click(function() {
            cetak('pdf');
        });

        function cetak(jenisCetakan)
        {
            var idsales = $('#idsales').val();

            if (idsales == null || idsales == "") {
                swal("Informasi", "Harap pilih nama sales!", "info");
                return false;
            }

            const params = new URLSearchParams();
            params.append('idsales', idsales);
            params.append('tglawal', $('#tglawal').val());
            params.append('tglakhir', $('#tglakhir').val());
            params.append('statuslunas', $('#statuslunas').val());
            window.open("{{ url('lappenagihansales/cetak') }}/" + jenisCetakan + "?" + params.toString());

        }
</script>
@endsection