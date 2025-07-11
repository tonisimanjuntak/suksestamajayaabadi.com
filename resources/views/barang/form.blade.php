@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Barang Dagang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('barang') }}">Barang Dagang</a></li>
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

                    <form action="{{ url('barang/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Barang Dagang </h4>
                                    <span class="float-right font-weight-bold" id="lblidbarang"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="idbarang" id="idbarang">
                                <div class="row">
                                    <div class="col-md-3 required">
                                        <div class="form-group">
                                            <label for="kdbarang">Kode Barang</label>
                                            <input type="text" name="kdbarang" id="kdbarang"
                                                class="form-control" placeholder="Nama barang" autofocus="">
                                        </div>
                                    </div>
                                    <div class="col-md-9 required">
                                        <div class="form-group">
                                            <label for="namabarang">Nama Barang</label>
                                            <input type="text" name="namabarang" id="namabarang"
                                                class="form-control" placeholder="Nama barang">
                                        </div>
                                    </div>
                                    <div class="col-md-4 required">
                                        <div class="form-group">
                                            <label for="idkategori">Kategori Barang</label>
                                            <select name="idkategori" id="idkategori" class="form-control">
                                                <option value="">Pilih kategori barang...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 required">
                                        <div class="form-group">
                                            <label for="kdakun">Akun Barang</label>
                                            <select name="kdakun" id="kdakun" class="form-control">
                                                <option value="">Pilih akun barang...</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 required">
                                        <div class="form-group">
                                            <label for="idjenisbarang">Jenis Barang</label>
                                            <select name="idjenisbarang" id="idjenisbarang" class="form-control searchJenisBarang">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hargabeli">Harga Beli</label>
                                            <input type="text" name="hargabeli" id="hargabeli" class="form-control rupiah">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hargajualdiskon">Harga Jual</label>
                                            <input type="text" name="hargajualdiskon" id="hargajualdiskon" class="form-control rupiah">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="stokminimum">Stok Minimum</label>
                                            <input type="number" name="stokminimum" id="stokminimum" class="form-control rupiah">
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="display: none;" id="divStatusAktif">
                                        <div class="form-group">
                                            <label for="statusaktif">Status</label>
                                            <select name="statusaktif" id="statusaktif" class="form-control select2">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5 mb-3">
                                        <h5>BONUS PENJUALAN SALES</h5>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input mt-1" type="radio" name="jenisbonuspenjualan" id="jenisbonuspenjualan1" value="Persen" checked>
                                            <label class="form-check-label" for="jenisbonuspenjualan1">
                                                Persen
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input mt-1" type="radio" name="jenisbonuspenjualan" id="jenisbonuspenjualan2" value="Nominal">
                                            <label class="form-check-label" for="jenisbonuspenjualan2">
                                                Nominal
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="divPersenPenjualan" style="display: none;">
                                        <div class="form-group">
                                            <label for="persenbonuspenjualan">Persen Bonus (%) <small class="text-danger">(2 digit Decimal)</small></label>
                                            <input type="text" name="persenbonuspenjualan" id="persenbonuspenjualan" class="form-control persen" value="{{ session('bonus_penjualan_default') }}">
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="divJumlahPenjualan" style="display: none;">
                                        <div class="form-group">
                                            <label for="jumlahbonuspenjualan">Jumlah Bonus</label>
                                            <input type="text" name="jumlahbonuspenjualan" id="jumlahbonuspenjualan" class="form-control rupiah">
                                        </div>
                                    </div>


                                    <div class="col-12 mt-5 mb-3">
                                        <h5>BONUS PENAGIHAN SALES</h5>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input mt-1" type="radio" name="jenisbonustagihan" id="jenisbonustagihan1" value="Persen" checked>
                                            <label class="form-check-label" for="jenisbonustagihan1">
                                                Persen
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input mt-1" type="radio" name="jenisbonustagihan" id="jenisbonustagihan2" value="Nominal">
                                            <label class="form-check-label" for="jenisbonustagihan2">
                                                Nominal
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="divPersenTagihan" style="display: none;">
                                        <div class="form-group">
                                            <label for="persenbonustagihan">Persen Bonus (%) <small class="text-danger">(2 digit Decimal)</small></label>
                                            <input type="text" name="persenbonustagihan" id="persenbonustagihan" class="form-control persen" value="{{ session('bonus_penagihan_default') }}">
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-4" id="divJumlahTagihan" style="display: none;">
                                        <div class="form-group">
                                            <label for="jumlahbonustagihan">Jumlah Bonus</label>
                                            <input type="text" name="jumlahbonustagihan" id="jumlahbonustagihan" class="form-control rupiah">
                                        </div>
                                    </div>

                                    
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('barang') }}" class="btn btn-default float-right mr-1"><i
                                        class="fa fa-chevron-left mr-1"></i>Kembali</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('scripts')
<script>
    var idbarang = "{{ $idbarang }}";
    $('#persenbonuspenjualan').attr('readonly', true);
    $('#persenbonustagihan').attr('readonly', true);

    $(document).ready(function() {
        
        if (idbarang != "") {
            $('#idbarang').val(idbarang);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();
            
            $.ajax({
                    url: "{{ url('barang/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idbarang': idbarang
                    },
                })
                .done(function(response) {
                    // console.log(response);
                     $('#lblidbarang').html('ID: ' + response['kdbarang']);
                    $('#kdbarang').val(response['kdbarang']);
                    $('#namabarang').val(response['namabarang']);
                    addSelectOption("idkategori", response['idkategori'], response['namakategori']);
                    $('#idkategori').val(response['idkategori']);
                    addSelectOption("kdakun", response['kdakun'], response['namaakun']);
                    $('#kdakun').val(response['kdakun']);

                    addSelectOption("idjenisbarang", response['idjenisbarang'], response['jenisbarang']);
                    $('#idjenisbarang').val(response['idjenisbarang']);

                    $('#hargabeli').val(format_rupiah(response['hargabeli']));
                    $('#hargajualdiskon').val(format_rupiah(response['hargajualdiskon']));
                    $('#stokminimum').val(response['stokminimum']);
                    $('#statusaktif').val(response['statusaktif']).trigger('change');
                    $('#idkategori').attr('disabled', true);

                    
                    //defaultnya 0.25%
                    if (response['jenisbonuspenjualan']=="Persen") {
                        $('#jenisbonuspenjualan1').prop('checked', true);
                        $('#jenisbonuspenjualan1').trigger('change');
                        $('#persenbonuspenjualan').val(response['persenbonuspenjualan']);
                    }else{
                        $('#jenisbonuspenjualan2').prop('checked', true);
                        $('#jenisbonuspenjualan2').trigger('change');
                        $('#jumlahbonuspenjualan').val(format_rupiah(response['jumlahbonuspenjualan']));
                        $('#persenbonuspenjualan').val("{{ session('bonus_penjualan_default') }}");
                    }

                    //defaultnya 0.25%
                    if (response['jenisbonustagihan']=="Persen") {
                        $('#jenisbonustagihan1').prop('checked', true);
                        $('#jenisbonustagihan1').trigger('change');
                        $('#persenbonustagihan').val(response['persenbonustagihan']);
                    }else{
                        $('#jenisbonustagihan2').prop('checked', true);
                        $('#jenisbonustagihan2').trigger('change');
                        $('#jumlahbonustagihan').val(format_rupiah(response['jumlahbonustagihan']));
                        $('#persenbonustagihan').val("{{ session('bonus_penagihan_default') }}");
                    }

                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            $('#jenisbonuspenjualan1').prop('checked', true);
            $('#jenisbonuspenjualan1').trigger('change');
            $('#jenisbonustagihan1').prop('checked', true);
            $('#jenisbonustagihan1').trigger('change');
            $('.label-judul').html('Tambah');
        }

        $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    kdbarang: {
                        validators: {
                            notEmpty: {
                                message: 'kode barang tidak boleh kosong'
                            },
                            stringLength: {
                                max: 15, // Maksimal 10 karakter
                                message: 'Kode akun maksimal 15 karakter'
                            }
                        }
                    },
                    namabarang: {
                        validators: {
                            notEmpty: {
                                message: 'nama barang tidak boleh kosong'
                            }
                        }
                    },
                    idkategori: {
                        validators: {
                            notEmpty: {
                                message: 'kategori barang tidak boleh kosong'
                            }
                        }
                    },
                    kdakun: {
                        validators: {
                            notEmpty: {
                                message: 'nama akun barang tidak boleh kosong'
                            }
                        }
                    },
                    idjenisbarang: {
                        validators: {
                            notEmpty: {
                                message: 'jenis barang tidak boleh kosong'
                            }
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnSimpan').attr("disabled", true);
            });


        $('#idkategori').select2({
            placeholder: 'Pilih kategori barang...',
            minimumInputLength: 0,
            ajax: {
                url: "{{ route('barang.searchKategoriBarang') }}", // URL untuk pencarian
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
            }
        });

        $('#kdakun').select2({
            placeholder: 'Pilih akun barang...',
            minimumInputLength: 0,
            ajax: {
                url: "{{ route('barang.searchAkunBarang') }}", // URL untuk pencarian
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
            }
        });

        $("form").attr('autocomplete', 'off');

    });

    $('input[name="jenisbonuspenjualan"]').change(function() {
            var jenisbonuspenjualan = $(this).val();
            $('#divPersenPenjualan').hide();
            $('#divJumlahPenjualan').hide();

            if (jenisbonuspenjualan === 'Nominal') {
                $('#divJumlahPenjualan').show();                
            } else if (jenisbonuspenjualan === 'Persen') {
                $('#divPersenPenjualan').show();
            }
        });

    $('input[name="jenisbonustagihan"]').change(function() {
            var jenisbonustagihan = $(this).val();
            $('#divPersenTagihan').hide();
            $('#divJumlahTagihan').hide();

            if (jenisbonustagihan === 'Nominal') {
                $('#divJumlahTagihan').show();                
            } else if (jenisbonustagihan === 'Persen') {
                $('#divPersenTagihan').show();
            }
        });
</script>
@endsection