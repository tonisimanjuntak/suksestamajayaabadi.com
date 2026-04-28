@extends('template/layout')

@section('content')


<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Stock Opname</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('stockopname') }}">Stock Opname</a></li>
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
                                        class="label-judul"></span> Data Stock Opname</h4>
                            </div>
                        </div>
                        <div class="card-body">


                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="idstockopname" id="idstockopname">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                                                            placeholder="Keterangan Stok Opname"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 class="text-muted">Detail Stock Opname</h3>
                                                </div>
                                                <div class="col-12">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%; text-align: center;">No</th>
                                                                <th style="width: 35%; text-align: center;">Nama Barang</th>
                                                                <th style="width: 10%; text-align: center;">Stock System</th>
                                                                <th style="width: 10%; text-align: center;">Stock Real</th>
                                                                <th style="width: 10%; text-align: center;">Selisih</th>
                                                                <th style="width: 30%; text-align: center;">Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($rsBarang->count() >0 )

                                                            @foreach ($rsBarang as $row)
                                                                
                                                            <tr>
                                                                <td style="text-align: center;">{{ $loop->index + 1}}</th>
                                                                <td style="text-align: left;">{{ $row->namabarang }}</th>
                                                                <td style="text-align: center;">{{ $row->stok }}</th>
                                                                <td style="text-align: center;"><input type="number" class="form-control stokInput" name="barang[]" data-idbarang="{{ $row->idbarang }}" data-stok="{{ $row->stok }}" value="{{ $row->stok }}"></th>
                                                                <td style="text-align: center;" class="selisih">{{ 0 }}</th>
                                                                <td style="text-align: center;"><textarea id="{{ 'ket'.$row->idbarang }}" class="form-control" placeholder="Keterangan detail" rows="2"></textarea></th>
                                                            </tr>

                                                            @endforeach
                                                                
                                                            

                                                            @endif
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary float-right" id="simpan"><i
                                    class="fa fa-save mr-1"></i>Simpan</button>
                            <a href="{{ url('stockopname') }}" class="btn btn-default float-right mr-1"><i
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
    var idstockopname = "<?php echo $idstockopname; ?>";

    $(document).ready(function() {
        $("form").attr('autocomplete', 'off');
    });

    function simpanData() {
        const idstockopname = $('#idstockopname').val();
        const keterangan = $('#keterangan').val();

        const inputs = document.querySelectorAll('input[name="barang[]"]');
        let detailStockOpname = [];
        inputs.forEach((input, index) => {
            const idbarang = input.getAttribute('data-idbarang');
            const stok = input.getAttribute('data-stok');
            const nilaiinput = input.value;
            const keterangandetail = $('#ket'+idbarang).val();

            detailStockOpname.push({
                'idbarang': idbarang,
                'stok': stok,
                'nilaiinput': nilaiinput,
                'keterangandetail': keterangandetail,
            });
        });

        if (detailStockOpname.length == 0) {
            swal("Informasi", "Detail barang yang di stock opname tidak ada!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        if (keterangan=="") {
            swal("Informasi", "Keterangan stock opname tidak boleh kosong!", "info");
            $('#simpan').attr('disabled', false);
            return;
        }

        var formData = {
            'idstockopname' : idstockopname,
            'keterangan' : keterangan,
            'detailStockOpname' : detailStockOpname,
        }

        $.ajax({
                type: 'POST',
                url: "{{ url('stockopname/simpanData') }}",
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
                            window.location.href = "{{ url('stockopname') }}";
                        });
                } else {
                    swal("Informasi", result.msg, "info");
                }
            })
            .fail(function() {
                console.log("Gagal script simpanData!");
            });
            
    }

    $('#simpan').click(function (e) { 
        e.preventDefault();
        $(this).attr('disabled', true);

        swal({
                title: "Simpan?",
                text: "Apakah anda yakin akan menyimpan data ini?",
                icon: "warning",
                buttons: ["Batal", "Ya"],
                dangerMode: true,
            })
            .then((willsave) => {
                if (willsave) {
                    simpanData();
                }else{
                    $(this).attr('disabled', false);

                }
            });

    });

    $('.stokInput').on('input', function() {
        const stockSystem = parseFloat($(this).data('stok'));
        const stockReal = parseFloat($(this).val());

        const selisih = stockReal - stockSystem;
        const selisihCell = $(this).closest('tr').find('.selisih');

        // Update nilai Selisih
        selisihCell.text(selisih);
    });
</script>




@endsection