@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('sales') }}">Sales</a></li>
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

                    <form action="{{ url('sales/simpanData') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i><span
                                            class="label-judul"></span> Data Sales</h4>
                                    <span class="float-right font-weight-bold" id="lblidsales"></span>

                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idsales" id="idsales">
                                <div class="row">

                                    <div class="col-12 mb-3">
                                        <h5>Informasi Umum</h5>
                                    </div>

                                    <div class="col-md-3 required">
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" name="nik" id="nik"
                                                class="form-control nik" autofocus="">
                                        </div>
                                    </div>

                                    <div class="col-md-9 required">
                                        <div class="form-group">
                                            <label for="namasales">Nama Sales</label>
                                            <input type="text" name="namasales" id="namasales"
                                                class="form-control" placeholder="Nama sales">
                                        </div>
                                    </div>



                                    <div class="col-md-9 required">
                                        <div class="form-group">
                                            <label for="tempatlahir">Tempat Lahir</label>
                                            <input type="text" name="tempatlahir" id="tempatlahir"
                                                class="form-control" placeholder="Tempat lahir">
                                        </div>
                                    </div>

                                    <div class="col-md-3 required">
                                        <div class="form-group">
                                            <label for="tgllahir">Tanggal Lahir</label>
                                            <input type="date" name="tgllahir" id="tgllahir"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4 required">
                                        <div class="form-group">
                                            <label for="namasales">Jenis Kelamin</label>
                                            <select name="jeniskelamin" id="jeniskelamin" class="form-control select2">
                                                <option value="">Pilih jenis kelamin...</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 required">
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select name="agama" id="agama" class="form-control select2">
                                                <option value="">Pilih agama...</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 required">
                                        <div class="form-group">
                                            <label for="statusperkawinan">Status Perkawinan</label>
                                            <select name="statusperkawinan" id="statusperkawinan" class="form-control select2">
                                                <option value="">Pilih status perkawinan...</option>
                                                <option value="Tidak Kawin">Tidak Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-12 required">
                                        <div class="form-group">
                                            <label for="alamatktp">Alamat Lengkap KTP <small> (lengkap dengan kecamatan dan kelurahan)</small></label>
                                            <textarea name="alamatktp" id="alamatktp" class="form-control" rows="2" placeholder="Alamat ktp"></textarea>
                                        </div>
                                    </div>




                                    <div class="col-12 mt-5 mb-3">
                                        <h5>Informasi Lainnya</h5>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="npwp">NPWP</label>
                                            <input type="text" name="npwp" id="npwp"
                                                class="form-control npwp">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tglkontrak">Tanggal Kontrak</label>
                                            <input type="date" name="tglkontrak" id="tglkontrak"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="filekontrak">File Kontrak</label>
                                            <input type="file" name="filekontrak" id="filekontrak" class="form-control">
                                            <input type="hidden" name="filekontrak_lama" id="filekontrak_lama" class="form-control">
                                            <a href="" id="filekontrak_link" target="_blank"></a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 required">
                                        <div class="form-group">
                                            <label for="nowa">Nomor Whatsapp</label>
                                            <input type="text" name="nowa" id="nowa"
                                                class="form-control" placeholder="Nomor whatsapp">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email"
                                                class="form-control" placeholder="email">
                                        </div>
                                    </div>



                                    <div class="col-md-12 required">
                                        <div class="form-group">
                                            <label for="alamattinggal">Alamat Tinggal <small> (lengkap dengan kecamatan dan kelurahan)</small></label>
                                            <textarea name="alamattinggal" id="alamattinggal" class="form-control" rows="2" placeholder="Alamat tinggal"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="idwilayah">Wilayah</label>
                                            <select name="idwilayah[]" id="idwilayah" class="form-control" multiple="multiple">
                                                @foreach ($rsWilayah as $row)
                                                    <option value="{{ $row->idwilayah }}">{{ $row->namawilayah }}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="idwilayah">Target Penjualan Sales</label>
                                            <input type="text" name="targetpenjualan" id="targetpenjualan" class="form-control rupiah" value="{{ session('default_target_sales') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-8 required" style="display: none;" id="divStatusAktif">
                                        <div class="form-group">
                                            <label for="statusaktif">Status</label>
                                            <select name="statusaktif" id="statusaktif" class="form-control select2">
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('sales') }}" class="btn btn-default float-right mr-1"><i
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
    var idsales = "{{ $idsales }}";

    $(document).ready(function() {

        $('#idwilayah').select2({
                placeholder: 'Cari nama wilayah...',
                minimumInputLength: 0, // Minimal karakter untuk memulai pencarian
                ajax: {
                    url: "{{ route('wilayah.searchWilayah') }}", // URL untuk pencarian
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

        // $('#idwilayah').select2();

        if (idsales != "") {
            $('#idsales').val(idsales);
            $('#lblidsales').html("ID: " + idsales);
            $('.label-judul').html('Edit');
            $('#divStatusAktif').show();

            $.ajax({
                    url: "{{ url('sales/getDataID') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'idsales': idsales
                    },
                })
                .done(function(response) {
                    // console.log(response);

                    var rsSales = response['rsSales'];

                    $('#nik').val(rsSales['nik']);
                    $('#namasales').val(rsSales['namasales']);
                    $('#tempatlahir').val(rsSales['tempatlahir']);
                    $('#tgllahir').val(rsSales['tgllahir']);
                    $('#jeniskelamin').val(rsSales['jeniskelamin']).trigger('change');
                    $('#agama').val(rsSales['agama']).trigger('change');
                    $('#statusperkawinan').val(rsSales['statusperkawinan']).trigger('change');
                    $('#alamatktp').val(rsSales['alamatktp']);

                    if (rsSales['tglkontrak'] != "") {
                        $('#tglkontrak').val(rsSales['tglkontrak']);
                    }
                    $('#npwp').val(rsSales['npwp']);
                    $('#filekontrak_link').prop('href', "{{ asset('') }}" + 'uploads/sales/kontrak/' + rsSales['filekontrak']);
                    $('#filekontrak_link').html(rsSales['filekontrak']);
                    $('#filekontrak_lama').val(rsSales['filekontrak']);

                    $('#nowa').val(rsSales['nowa']);
                    $('#email').val(rsSales['email']);
                    $('#alamattinggal').val(rsSales['alamattinggal']);
                    $('#targetpenjualan').val( totitik(rsSales['targetpenjualan']));
                    $('#statusaktif').val(rsSales['statusaktif']).trigger('change');

                    var rsWilayah = response['dataWilayah'];
                    setTimeout(function() {
                        $('#idwilayah').val(rsWilayah).trigger('change');
                    }, 500); // Tambahkan delay agar Select2 siap
                })
                .fail(function() {
                    console.log('error getDataID');
                });
        } else {
            $('.label-judul').html('Tambah');
        }

        $('#form').bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nik: {
                        validators: {
                            notEmpty: {
                                message: 'nik tidak boleh kosong'
                            }
                        }
                    },
                    namasales: {
                        validators: {
                            notEmpty: {
                                message: 'nama sales tidak boleh kosong'
                            }
                        }
                    },
                    tempatlahir: {
                        validators: {
                            notEmpty: {
                                message: 'tempat lahir tidak boleh kosong'
                            }
                        }
                    },
                    tgllahir: {
                        validators: {
                            notEmpty: {
                                message: 'tanggal lahir tidak boleh kosong'
                            }
                        }
                    },
                    jeniskelamin: {
                        validators: {
                            notEmpty: {
                                message: 'jenis kelamin tidak boleh kosong'
                            }
                        }
                    },
                    agama: {
                        validators: {
                            notEmpty: {
                                message: 'agama tidak boleh kosong'
                            }
                        }
                    },
                    statusperkawinan: {
                        validators: {
                            notEmpty: {
                                message: 'status perkawinan tidak boleh kosong'
                            }
                        }
                    },
                    alamatktp: {
                        validators: {
                            notEmpty: {
                                message: 'alamat ktp tidak boleh kosong'
                            }
                        }
                    },
                    nowa: {
                        validators: {
                            notEmpty: {
                                message: 'nomor whatsapp tidak boleh kosong'
                            }
                        }
                    },
                    alamattinggal: {
                        validators: {
                            notEmpty: {
                                message: 'alamat tinggal tidak boleh kosong'
                            }
                        }
                    },
                }
            })
            .on('success.form.bv', function(e) {
                $('#btnSimpan').attr("disabled", true);
            });

        $("form").attr('autocomplete', 'off');

    });

    
</script>
@endsection