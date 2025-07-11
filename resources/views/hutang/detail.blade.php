@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Utang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('hutang') }}">Detail Utang</a></li>
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
                                        class="label-judul"></span> Detail Utang</h4>
                                <a href="{{ url('hutang') }}" class="btn btn-sm btn-secondary"><i
                                        class="fa fa-chevron-left mr-1"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">


                            <input type="hidden" name="idhutang" id="idhutang">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body card-detail">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="label-detail">ID UTANG</div>
                                                    <div class="value-detail">{{ $rsHutang->idhutang }}</div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="label-detail">NO FAKTUR</div>
                                                    <div class="value-detail">{{ (!empty($rsHutang->nofaktur)) ? $rsHutang->nofaktur : '-' }}</div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="label-detail">TGL UTANG</div>
                                                    <div class="value-detail">{{ tgldmy($rsHutang->tglhutang) }}</div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="label-detail">SUPPLIER</div>
                                                    <div class="value-detail">{{ $rsHutang->namasupplier }}</div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="label-detail">JUMLAH UTANG</div>
                                                    <div class="value-detail">Rp. {{ format_rupiah($rsHutang->totalkredit) }}</div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="label-detail">SISA UTANG</div>
                                                    @if ($sisaHutang <= 0)
                                                    <div class="value-detail"><span class="badge badge-success">LUNAS</span>
                                                    </div>
                                                    @else
                                                    <div class="value-detail">Rp. {{ format_rupiah($sisaHutang) }}</div>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3>Detail Pembayaran</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($sisaHutang > 0 )
                                                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalTambahPembayaran"><i class="fa fa-plus"></i> Tambah Pembayaran</button>
                                                    @endif
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%; text-align: center;">No</th>
                                                                <th style="width: 15%; text-align: center;">Tgl Entri</th>
                                                                <th style="width: 15%; text-align: center;">Tgl Pembayaran</th>
                                                                <th style="text-align: center;">Cara Bayar</th>
                                                                <th style="width: 15%; text-align: right;">Jumlah Pembayaran</th>
                                                                <th style="width: 10%; text-align: center;">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $i = 1;
                                                            @endphp

                                                            @forelse ($rsHutangDetail as $row)

                                                            <tr>
                                                                <td style="text-align: center;">{{ $i++ }}</td>
                                                                <td style="text-align: center;">{{ tgldatetime($row->inserted_date) }} <br> {{ $row->namapengguna }}</td>
                                                                <td style="text-align: center;">{{ tgldmy($row->tglhutang) }}</td>
                                                                @if ($row->carabayar == 'Transfer')
                                                                <td style="text-align: center;">{{ $row->carabayar }} <br> {{ $row->namabank }}</td>
                                                                @elseif ($row->carabayar == 'Giro')
                                                                <td style="text-align: center;">{{ $row->carabayar }} <br> {{ $row->namabank }} <br> No. BG : {{ $row->nobilyetgiro }}</td>
                                                                @else

                                                                <td style="text-align: center;">{{ $row->carabayar }}</td>
                                                                @endif

                                                                <td style="text-align: right;">{{ format_rupiah($row->debet) }}</td>
                                                                <td style="text-align: center;"><a href="{{ url('hutang/hapusDetailPembayaran/'.Crypt::encrypt($row->idhutangdetail)) }}" class="btn btn-danger btn-sm" id="btnHapus"><i class="fa fa-trash"></i></a></td>
                                                            </tr>

                                                            @empty

                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-12 mt-5 text-right">
                                                    <h3>Total Pembayaran = <strong> Rp. {{ format_rupiah($rsHutang->totalkredit) }}</strong></h3>
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

@include('hutang/modalTambahPembayaran')


<script type="text/javascript">
    var idhutang = "<?php echo $idhutang; ?>";

    $(document).ready(function() {

        $('.select2').select2();

        $("form").attr('autocomplete', 'off');
    });

    $(document).on('click', '#btnHapus', function(e) {
        var link = $(this).attr("href");
        e.preventDefault();
        swal({
                title: "Hapus?",
                text: "Apakah anda yakin akan menghapus data ini!",
                icon: "warning",
                buttons: ["Batal", "Ya"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = link;
                }
            });

    });
</script>




@endsection