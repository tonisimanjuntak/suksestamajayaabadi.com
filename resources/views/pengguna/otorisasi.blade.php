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

                                <input type="hidden" name="idpengguna" id="idpengguna">
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
                                                @foreach ($rsMenus as $row)
                                                    <tr>
                                                        <td>
                                                            {!! str_repeat('&nbsp;', $row->levels * 5 ) !!} {{ $row->menus }}
                                                        </td>
                                                        <td>
                                                            @if (str_contains($row->event_exist, 'Lihat'))
                                                                <input type="checkbox" class="Switch-Lihat" name="Lihat[]" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-idmenus="{{ $row->idmenus }}">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (str_contains($row->event_exist, 'Tambah'))
                                                                <input type="checkbox" name="Tambah[]" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (str_contains($row->event_exist, 'Edit'))
                                                                <input type="checkbox" name="Edit[]" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if (str_contains($row->event_exist, 'Hapus'))
                                                                <input type="checkbox" name="Hapus[]" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                                            @endif
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
        $("input[data-bootstrap-switch]").bootstrapSwitch();
        
        // Pasang event listener untuk perubahan switch
        $(document).on('switchChange.bootstrapSwitch', '.Switch-Lihat', function(event, state) {
            var $tr = $(this).closest('tr');
            
            $tr.find('input[name^="Tambah[]"], input[name^="Edit[]"], input[name^="Hapus[]"]').each(function() {
                var $input = $(this);
                // console.log(state); 
                if (state) {
                    // $input.removeAttr('disabled').bootstrapSwitch('enable');
                    // $input.bootstrapSwitch('state', true); // Mengaktifkan switch
                    $input.attr('readonly', true);

                    // Aktifkan switch
                    // $input.bootstrapSwitch('enable');  // Aktifkan switch
                } else {
                    // $input.attr('disabled', true).bootstrapSwitch('disable');
                    // $input.bootstrapSwitch('state', false); // Menonaktifkan switch
                    $input.attr('readonly', true);

                    // Nonaktifkan switch
                    // $input.bootstrapSwitch('disable'); // Nonaktifkan switch
                }
            });
        });

        // $(document).on('change', '.Switch-Lihat', function() {
        //     var state = $(this).prop('checked');
        //     console.log('Switch changed:', state);
        // });

    });





</script>
@endsection