<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>

    <link rel="stylesheet" href="{{ asset('') }}assets/bootstrap4/bootstrap.min.css">
    <script src="{{ asset('') }}assets/bootstrap4/jquery-3.2.1.slim.min.js"></script>
    <script src="{{ asset('') }}assets/bootstrap4/popper.min.js"></script>
    <script src="{{ asset('') }}assets/bootstrap4/bootstrap.min.js"></script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }


        .nama-usaha h1 {
            font-size: 45px;
            font-weight: bold;
        }

        .nama-usaha h4 {
            font-size: 16px;
            font-weight: bold;
        }

        .nama-usaha span {
            font-size: 12px;
            display: block;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-8">
                        <div class="row nama-usaha">
                            <div class="col-5">
                                <h4>{{ session()->get('usaha_nama') }}</h4>
                                <span>{{ session()->get('usaha_alamat') }}</span>
                                <span>No Telepon. {{ session()->get('usaha_telepon')}}</span>
                            </div>
                            <div class="col-7 text-center">
                                <h1>K W I T A N S I</h1>
                                <h5>No. {{ $rowKwitansi->nokwitansi }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <table style="border: none;">

                            <body>
                                <tr>
                                    <td style="border: none; width: 25%;">Tanggal</td>
                                    <td style="border: none; width: 5%;">:</td>
                                    <td style="border: none; width: 70%;">
                                        {{ tglindonesia($rowKwitansi->tglkwitansi) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; width: 25%;">Nama</td>
                                    <td style="border: none; width: 5%;">:</td>
                                    <td style="border: none; width: 70%;">{{ $rowPenjualan->namakonsumen }}</td>
                                </tr>
                            </body>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <table border="1" cellpadding="5" width="100%">
                    <thead>
                        <tr style="font-size: 14px; font-weight: bold;">
                            <th width="7%" style="text-align:center;">NO</th>
                            <th style="text-align:center;">Nama Barang</th>
                            <th width="10%" style="text-align:center;">Qty
                            </th>
                            <th width="10%" style="text-align:center;">Harga Satuan
                            </th>
                            <th width="10%" style="text-align:center;">DPP
                            </th>
                            <th width="10%" style="text-align:center;">PPN
                            </th>
                            <th width="10%" style="text-align:center;">Discount
                            </th>
                            <th width="10%" style="text-align:center;">Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;

                        @endphp
                        @foreach ($rsDetail as $row)
                        
                            <tr style="font-size: 12px;">
                                <td style="text-align: center;">{{ $no++ }}</td>
                                <td style="text-align: left;">{{ $row->namabarang }}</td>
                                <td style="text-align: center;">{{ $row->jumlahjual }}</td>
                                <td style="text-align: right;">{{ format_rupiah($row->hargasatuan) }}</td>
                                </td>
                                <td style="text-align: right;">{{ format_rupiah($row->hargadpp) }}</td>
                                </td>
                                <td style="text-align: right;">{{ format_rupiah($row->jumlahppn) }}</td>
                                </td>
                                <td style="text-align: right;">{{ format_rupiah($row->jumlahdiskon) }}</td>
                                </td>
                                <td style="text-align: right;">{{ format_rupiah($row->subtotaljual) }}</td>
                            </tr>
                            @endforeach


                            @if ($no < 10)
                                @for ($i=$no; $i <=10; $i++)
                                <tr style="font-size: 12px;">
                                <td style="text-align: center;">{{ $i }}</td>
                                <td style="text-align: left;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;"></td>
                                <td style="text-align: right;"></td>
                                </tr>
                                @endfor
                                @endif

                                <tr style="font-size: 14px;">
                                    <td style="text-align: left;" colspan="5" rowspan="7">
                                        <strong>SUBTOTAL : </strong> {{ terbilang($rowKwitansi->jumlahbayar) }} rupiah
                                    </td>
                                    <td style="text-align: right; font-weight: bold;" colspan="2">JUMLAH DPP</td>
                                    <td style="text-align: right; font-weight: bold;">{{ format_rupiah($rowPenjualan->totaldpp) }}</td>
                                </tr>
                                <tr style="font-size: 14px;">
                                    <td style="text-align: right; font-weight: bold;" colspan="2">PPN ({{$rowPenjualan->ppnpersen}}%)</td>
                                    <td style="text-align: right; font-weight: bold;">{{ format_rupiah($rowPenjualan->totalppn) }}</td>
                                </tr>
                                <tr style="font-size: 14px;">
                                    <td style="text-align: right; font-weight: bold;" colspan="2">DISCOUNT</td>
                                    <td style="text-align: right; font-weight: bold;">{{ format_rupiah($rowPenjualan->totaldiskon) }}</td>
                                </tr>
                                <tr style="font-size: 14px;">
                                    <td style="text-align: right; font-weight: bold;" colspan="2">TOTAL</td>
                                    <td style="text-align: right; font-weight: bold;">{{ format_rupiah($rowPenjualan->totalinvoice) }}</td>
                                </tr>
                                <tr style="font-size: 14px;">
                                    <td style="text-align: right; font-weight: bold;" colspan="2">SUDAH DIBAYAR</td>
                                    <td style="text-align: right; font-weight: bold;">{{ format_rupiah($rowKwitansi->jumlahsudahbayar) }}</td>
                                </tr>
                                <tr style="font-size: 14px;">
                                    <td style="text-align: right; font-weight: bold;" colspan="2">JUMLAH PEMBAYARAN</td>
                                    <td style="text-align: right; font-weight: bold;">{{ format_rupiah($rowKwitansi->jumlahbayar) }}</td>
                                </tr>
                                <tr style="font-size: 14px;">
                                    <td style="text-align: right; font-weight: bold;" colspan="2">SISA PEMBAYARAN</td>
                                    <td style="text-align: right; font-weight: bold;">{{ format_rupiah($rowKwitansi->totalplusppn - $rowKwitansi->jumlahsudahbayar - $rowKwitansi->jumlahbayar) }}</td>
                                </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-3 text-center mt-3">
                <div class="row">
                    <div class="col-12">
                        Hormat Kami
                    </div>
                    <div class="col-12 mt-5">
                        @php
                        echo '(' . str_repeat('&nbsp;', 30) . ')';
                        @endphp
                    </div>
                </div>
            </div>
            <div class="col-9">

            </div>
        </div>
    </div>


</body>

</html>