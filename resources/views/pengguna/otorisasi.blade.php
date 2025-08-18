@extends('template/layout')

@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('pengguna') }}">Pengguna</a></li>
                        <li class="breadcrumb-item active">Otorisasi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <form action="{{ url('pengguna/simpanotorisasi') }}" method="POST" id="form"
                        enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title font-weight-bold"><i class="fab fa-wpforms mr-1"></i>Otorisasi Pengguna</h4>
                                    <span class="float-right font-weight-bold" id="lblidpengguna"></span>
                                </div>
                            </div>
                            <div class="card-body">

                                @csrf

                                <input type="hidden" name="idpengguna" id="idpengguna" value="{{ $idpengguna }}">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <img src="{{ ($rsPengguna->fotopengguna == '') ? url('images/profil1.png') : url('uploads/pengguna/'.$rsPengguna->fotopengguna) }}" alt=""
                                                    class="rounded" style="width: 30%;" id="imgProfil">

                                    </div>
                                    <div class="col-8">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td width="25%">Nama</td>
                                                        <td width="2%">:</td>
                                                        <td width="73%">{{ $rsPengguna->namapengguna }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%">Jenis Kelamin</td>
                                                        <td width="2%">:</td>
                                                        <td width="73%">{{ $rsPengguna->jeniskelamin }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%">Email</td>
                                                        <td width="2%">:</td>
                                                        <td width="73%">{{ $rsPengguna->emailpengguna }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%">No Telepon</td>
                                                        <td width="2%">:</td>
                                                        <td width="73%">{{ $rsPengguna->notelppengguna }}</td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-5">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="60%;">Menu</th>
                                                    <th width="10%;">Lihat</th>
                                                    <th width="10%;">Tambah</th>
                                                    <th width="10%;">Edit</th>
                                                    <th width="10%;">Hapus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- switch tetap diinisiasi tapi di hidden saja karena untuk ambil urutan arraay name nya --}}
                                                @foreach ($rsMenus as $row)
                                                    <tr>
                                                        <td>
                                                            {!! str_repeat('&nbsp;', $row->levels * 5 ) !!} {{ $row->menus }}
                                                            <input type="hidden" name="idmenus[]" value="{{ $row->idmenus }}">
                                                        </td>
                                                        <td>
                                                            <div class="switch-container" style="{{ (str_contains($row->event_exist, 'Lihat')) ? 'display: block;' : 'display: none;' }}">
                                                                <input type="checkbox" class="Switch-Lihat" name="Lihat{{$row->idmenus}}" id="Lihat{{$row->idmenus}}" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-idmenus="{{ $row->idmenus }}" value="{{ $row->idmenus }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="switch-container" style="{{ (str_contains($row->event_exist, 'Tambah')) ? 'display: block;' : 'display: none;' }}">
                                                                <input type="checkbox" name="Tambah{{$row->idmenus}}" id="Tambah{{$row->idmenus}}" data-bootstrap-switch data-off-color="danger" data-on-color="success" value="{{ $row->idmenus }}" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="switch-container" style="{{ (str_contains($row->event_exist, 'Edit')) ? 'display: block;' : 'display: none;' }}">
                                                                <input type="checkbox" name="Edit{{$row->idmenus}}" id="Edit{{$row->idmenus}}" data-bootstrap-switch data-off-color="danger" data-on-color="success" value="{{ $row->idmenus }}" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="switch-container" style="{{ (str_contains($row->event_exist, 'Hapus')) ? 'display: block;' : 'display: none;' }}">
                                                                <input type="checkbox" name="Hapus{{$row->idmenus}}" id="Hapus{{$row->idmenus}}" data-bootstrap-switch data-off-color="danger" data-on-color="success" value="{{ $row->idmenus }}" readonly>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                
                                            </tbody>

                                        </table>

                                    </div>

                                    
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" id="btnSimpan"><i
                                        class="fa fa-save mr-1"></i>Simpan</button>
                                <a href="{{ url('pengguna') }}" class="btn btn-default float-right mr-1"><i
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
    var idpengguna = "{{ $idpengguna }}";

    $(document).ready(function() {
        // Inisialisasi bootstrapSwitch
        $("input[data-bootstrap-switch]").bootstrapSwitch();

        $.ajax({
            url: "{{ url('pengguna/getOtorisasi') }}",
            type: 'GET',
            dataType: 'json',
            data: {'idpengguna': idpengguna},
        })
        .done(function(response) {
            for (let i = 0; i < response.length; i++) {
                var hakaksi = response[i]['hakaksi'];
                var arrHakAksi = hakaksi.split(',');
                
                for (let j = 0; j < arrHakAksi.length; j++) {
                    var NamaSwitch = arrHakAksi[j]+response[i]['idmenus'];
                    $('#'+NamaSwitch).bootstrapSwitch('state', true);
                }               
            }
        })
        .fail(function() {
            console.log('error getOtorisasi');
        });
        
        // Event: Ketika switch "Lihat" diubah
        $(document).on('switchChange.bootstrapSwitch', '.Switch-Lihat', function(event, state) {
            var idmenus = $(this).data('idmenus');

            // Aktifkan/non-aktifkan switch lain berdasarkan status "Lihat"
            $('#Tambah' + idmenus).bootstrapSwitch('state', state); // Opsional: reset status
            $('#Edit' + idmenus).bootstrapSwitch('state', state);
            $('#Hapus' + idmenus).bootstrapSwitch('state', state);

            $('#Tambah' + idmenus).bootstrapSwitch('readonly', !state);
            $('#Edit' + idmenus).bootstrapSwitch('readonly', !state);
            $('#Hapus' + idmenus).bootstrapSwitch('readonly', !state);
        });

        // Handle form submission dengan AJAX
        $('#form').on('submit', function(e) {
            e.preventDefault(); // Cegah submit default

            let formData = new FormData(this); // Ambil semua data form termasuk file
            $('#btnSimpan').prop('disabled', true).text('Menyimpan...');

            $.ajax({
                url: $(this).attr('action'), // URL dari atribut action
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    $('#btnSimpan').prop('disabled', false).html('<i class="fa fa-save mr-1"></i>Simpan');

                    if (response.status === 'success') {
                        swal({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "{{ url('pengguna') }}";
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    $('#btnSimpan').prop('disabled', false).html('<i class="fa fa-save mr-1"></i>Simpan');

                    let errorMessage = 'Terjadi kesalahan pada server.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    swal({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage
                    });
                }
            });
        });
    });
</script>
@endsection