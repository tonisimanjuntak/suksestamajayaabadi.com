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

        .info-keterangan {
            margin-top: 20px;
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
                                <h1>SURAT JALAN</h1>
                                <h5>No. {{ $rowSuratJalan->idsuratjalan }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <table style="border: none;">
                            <body>
                                <tr>
                                    <td style="border: none; width: 30%;">Tgl. Kirim</td>
                                    <td style="border: none; width: 5%;">:</td>
                                    <td style="border: none; width: 65%;">
                                        {{ tglindonesia($rowSuratJalan->tglsuratjalan) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; width: 30%;">No Invoice</td>
                                    <td style="border: none; width: 5%;">:</td>
                                    <td style="border: none; width: 65%;">
                                        {{ $rowSuratJalan->daftarnoinvoice }}
                                    </td>
                                </tr>
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
                        <span class="nama">{{ $rowSuratJalan->namakonsumen }}</span>
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
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-4 info-keterangan" style="display: none;">
                <div class="row">
                    <div class="col-12">

                    </div>
                    <div class="col-12 mt-3">
                        <span>
                            Keterangan : 
                            @if (!empty($rowKonsumen->keterangan))
                                {{ $rowSuratJalan->keterangan }}
                            @else
                                -
                            @endif
                        </span>                    
                    </div>
                </div>
                
            </div>


            <div class="col-12 mt-3">
                <h5>Detail Transaksi:</h5>
                <table border="1" cellpadding="5" width="100%">
                    <thead>
                        <tr style="font-size: 14px; font-weight: bold;">
                            <th width="10%" style="text-align:center;">NO</th>
                            <th width="20%" style="text-align:center;">Jumlah</th>
                            <th width="70%" style="text-align:center;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;

                        @endphp
                        @foreach ($rsRincian as $row)
                        
                            <tr style="font-size: 12px;">
                                <td style="text-align: center;">{{ $no++ }}</td>
                                <td style="text-align: center;">{{ $row->qty . ' ' . $row->satuan }}</td>
                                <td style="text-align: left;">{{ $row->keterangan }}</td>
                            </tr>

                        @endforeach


                            @if ($no < 10)
                                @for ($i=$no; $i <=10; $i++)
                                <tr style="font-size: 12px;">
                                    <td style="text-align: center;">{{ $i }}</td>
                                    <td style="text-align: left;"></td>
                                    <td style="text-align: center;"></td>
                                </tr>
                                @endfor
                            @endif

                                
                    </tbody>
                </table>
            </div>
            <div class="col-3 text-center mt-3">
                <div class="row">
                    <div class="col-12">
                        Diterima oleh
                    </div>
                    <div class="col-12 mt-5">
                        @php
                        echo '(' . str_repeat('&nbsp;', 30) . ')';
                        @endphp
                    </div>
                </div>
            </div>

            <div class="col-3 text-center mt-3">
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

            <div class="col-3 text-center mt-3">
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

            
        </div>
    </div>


</body>

</html>