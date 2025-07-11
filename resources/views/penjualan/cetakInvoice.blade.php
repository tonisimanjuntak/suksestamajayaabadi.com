<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

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

        .info-konsumen {
            margin-top: 20px;
        }

        .info-konsumen .kepada {
            font-size: 16px;
            font-weight: bold;
        }

        .info-konsumen .nama {
            font-size: 20px;
            font-weight: bold;
        }

        .info-sales {
            margin-top: 20px;
        }

        .info-sales .kepada {
            font-size: 16px;
            font-weight: bold;
        }

        .info-sales .nama {
            font-size: 20px;
            font-weight: bold;
            display: block;
        }

        .info-sales .hp {
            font-size: 14px;
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
                                <h1>I N V O I C E</h1>
                                <h5>No. {{ $rowPenjualan->noinvoice }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <table style="border: none;">
                            <body>
                                <tr>
                                    <td style="border: none; width: 30%;">Tgl. Invoice</td>
                                    <td style="border: none; width: 5%;">:</td>
                                    <td style="border: none; width: 65%;">
                                        {{ tglindonesia($rowPenjualan->tglinvoice) }}
                                    </td>
                                </tr>
                                @if ($rowPenjualan->carabayar == 'Piutang')
                                    <tr>
                                        <td style="border: none; width: 30%;">Jenis Piutang</td>
                                        <td style="border: none; width: 5%;">:</td>
                                        <td style="border: none; width: 65%;">
                                            {{ $rowPenjualan->namajenispiutang }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none; width: 30%;">Jatuh Tempo</td>
                                        <td style="border: none; width: 5%;">:</td>
                                        <td style="border: none; width: 65%;">
                                            {{ tglindonesia($tgljatuhtempo) }}
                                        </td>
                                    </tr>
                                @endif
                            </body>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-8 info-konsumen mb-3">
                <div class="row">
                    <div class="col-12">
                        <span class="kepada">Kepada:</span>
                    </div>
                    <div class="col-12">
                        <span class="nama">{{ $rowPenjualan->namakonsumen }}</span>
                    </div>
                    <div class="col-12">
                        <table border="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td style="width: 15%;">Alamat</td>
                                    <td style="width: 5%; text-align: center;">:</td>
                                    <td style="width: 80%;">{{ $rowKonsumen->alamatkonsumen }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">No. Telp/ Email</td>
                                    <td style="width: 5%; text-align: center;">:</td>
                                    <td style="width: 80%;">{{ $rowKonsumen->notelpkonsumen . ' / ' . $rowKonsumen->emailkonsumen }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;">Nama Pemilik</td>
                                    <td style="width: 5%; text-align: center;">:</td>
                                    <td style="width: 80%;">{{ $rowKonsumen->namapemilik . ' ('.$rowKonsumen->notelppemilik.')'}}</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-4 info-sales">
                <div class="row">
                    <div class="col-12">
                        <span class="kepada">Sales:</span>
                    </div>
                    <div class="col-12">
                        <span class="nama">{{ $rowSales->namasales }}</span>
                        <span class="hp">HP: {{ $rowSales->nowa }}</span>
                    </div>
                    
                    
                </div>
            </div>

            @if (count($rsBank) > 0)
            <br><br>
                @foreach ($rsBank as $row)
                    <div class="col-12">
                        <span>{{$row->namabank .' No Rek. '. $row->norekening . ' An. '.$row->atasnama}}</span>                                
                    </div>
                @endforeach
            @endif

            <div class="col-12 mt-3">
                <h5>Detail Transaksi:</h5>
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
                            <th width="15%" style="text-align:center;">Jumlah
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
                                <td style="text-align: right;">
                                    @php
                                    echo $row->hargasatuan > 0 ? format_rupiah($row->hargasatuan) : '-';
                                    @endphp
                                </td>
                                <td style="text-align: right;">
                                    @php
                                    echo $row->hargadpp > 0 ? format_rupiah($row->hargadpp) : '-';
                                    @endphp
                                </td>
                                <td style="text-align: right;">
                                    @php
                                    echo $row->jumlahppn > 0 ? format_rupiah($row->jumlahppn) : '-';
                                    @endphp
                                </td>
                                <td style="text-align: right;">
                                    @php
                                    echo $row->jumlahdiskon > 0 ? format_rupiah($row->jumlahdiskon) : '-';
                                    @endphp
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

                                <tr style="font-size: 14px;;">
                                    <td style="text-align: left;" colspan="5" rowspan="5">
                                        <strong>TERBILANG: </strong> {{ terbilang($rowPenjualan->totalinvoice) }} rupiah
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
                    </tbody>
                </table>
            </div>
            <div class="col-4 text-center mt-3">
                <div class="row">
                    <div class="col-12">
                        Tanda Terima
                    </div>
                    <div class="col-12 mt-5">
                        @php
                        echo '(' . str_repeat('&nbsp;', 30) . ')';
                        @endphp
                    </div>
                </div>
            </div>

            <div class="col-4 text-center mt-3">
                <div class="row">
                    <div class="col-12">
                        Driver/Supir
                    </div>
                    <div class="col-12 mt-5">
                        @php
                        echo '(' . str_repeat('&nbsp;', 30) . ')';
                        @endphp
                    </div>
                </div>
            </div>

            <div class="col-4 text-center mt-3">
                <div class="row">
                    <div class="col-12">
                        Gudang
                    </div>
                    <div class="col-12 mt-5">
                        @php
                        echo '(' . str_repeat('&nbsp;', 30) . ')';
                        @endphp
                    </div>
                </div>
            </div>

            
        </div>
    </div>


</body>

</html>