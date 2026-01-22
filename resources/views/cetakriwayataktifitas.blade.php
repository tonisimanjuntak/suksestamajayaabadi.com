<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .judullaporan .nama-laporan {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .judullaporan .periode-laporan {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .content {
            margin-top: 200px;
        }

        .barisKosong {
            display: block;
        }

        .no-border-bottom {
            border-bottom: 1px solid #eee;
        }

        .no-border-top {
            border-top: 1px solid #eee;
        }

        .add-border-top {
            border-top: 1px solid black;
        }

        .add-border-bottom {
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>

    <table>
        <thead>
            <tr>
                <th class="" style="width: 10%; text-align: center;" rowspan="3"><img
                        src="{{ public_path('images/'. session('usaha_logo')) }}" alt="" style="width: 50px;"></th>
                <th style="width: 90%; font-size: 15px; text-align: left; padding-right: 50px;" colspan="7">{{ session('usaha_nama') }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="7">{{ session('usaha_alamat') }}</th>
            </tr>
            <tr>
                <th class="" style="font-size: 10px; text-align: left;" colspan="7">No Telepon. {{ session('usaha_telepon') }}
                </th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <div class="nama-laporan">RIWAYAT AKTIFITAS WEBSITE</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</div>
    </div>


    <div class="content">


        <table border="1" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th width="15%" style="font-size:10px; font-weight:bold; text-align:center;">TANGGAL</th>
                    <th width="40%" style="font-size:10px; font-weight:bold; text-align:center;">DESKRIPSI</th>
                    <th width="15%" style="font-size:10px; font-weight:bold; text-align:center;">AKTIFITAS</th>
                    <th width="15%" style="font-size:10px; font-weight:bold; text-align:center;">NAMA TABEL</th>
                    <th width="15%" style="font-size:10px; font-weight:bold; text-align:center;">NAMA PENGGUNA</th>
                </tr>
            </thead>
            <tbody>
                @php

                    $no = 1;
                    $totalDebet = 0;
                    $totalKredit = 0;
                    $idjurnallama = '';
                    $jenisLama = '';
                @endphp



                @foreach ($rsRiwayat as $row)

                    <tr>
                        <td width="15%" style="font-size:10px; text-align:center;">{{ $row->inserted_date }}</td>
                        <td width="40%" style="font-size:10px; text-align:left;">{{ $row->deskripsi }}</td>
                        <td width="15%" style="font-size:10px; text-align:center;">{{ $row->namafunction }}</td>
                        <td width="15%" style="font-size:10px; text-align:center;">{{ $row->namatabel }}</td>
                        <td width="15%" style="font-size:10px; text-align:center;">{{ $row->namapengguna }}</td>
                    </tr>

                @endforeach

            </tbody>
        </table>


    </div>
</body>

</html>
