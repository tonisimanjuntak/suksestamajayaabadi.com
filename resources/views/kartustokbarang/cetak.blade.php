<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .divSubJudul {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 100px;
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
                <th style="width: 90%; font-size: 15px; text-align: left; padding-right: 50px;" colspan="6">{{
                    session('usaha_nama') }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="6">{{ session('usaha_alamat') }}</th>
            </tr>
            <tr>
                <th class="" style="font-size: 10px; text-align: left;" colspan="6">No Telepon. {{
                    session('usaha_telepon') }}
                </th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <div class="nama-laporan">KARTU STOK BARANG</div>
    </div>


    <div class="divSubJudul">

        <table border="0" cellpadding="0" width="100%">
            <thead>
                <tr style="font-size:10px; font-weight:bold;">
                    <th width="15%" style="text-align:left;">KODE BARANG</th>
                    <th width="5%" style="text-align:center;">:</th>
                    <th width="80%" style="text-align:left;">{{ $rowBarang->kdbarang }}</th>
                </tr>
                <tr style="font-size:10px; font-weight:bold;">
                    <th width="15%" style="text-align:left;">NAMA BARANG</th>
                    <th width="5%" style="text-align:center;">:</th>
                    <th width="80%" style="text-align:left;">{{ $rowBarang->namabarang }}</th>
                </tr>
                <tr style="font-size:10px; font-weight:bold;">
                    <th width="15%" style="text-align:left;">PERIODE</th>
                    <th width="5%" style="text-align:center;">:</th>
                    <th width="80%" style="text-align:left;">{{ $tglawal . ' S/D ' . $tglakhir }}</th>
                </tr>
            </thead>
        </table>
    </div>


    <div class="content">
        <table border="1" cellpadding="5" width="100%">
            <thead class="">
                <tr style="font-size: 9px; font-weight: bold;">
                    <th style="width: 20%; text-align: center;">Tanggal</th>
                    <th style="width: 20%; text-align: center;">Keterangan</th>
                    <th style="width: 15%; text-align: center;">Awal</th>
                    <th style="width: 15%; text-align: center;">In</th>
                    <th style="width: 15%; text-align: center;">Out</th>
                    <th style="width: 15%; text-align: center;">Akhir</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp

                @if (count($rsKartuStok) > 0)

                @foreach ($rsKartuStok as $p)
                <tr style="font-size: 9px;">
                    <td style="width: 20%; text-align: center;">{{ tgldatetime($p->tglriwayat) }}</td>
                    <td style="width: 20%; text-align: left;">{{ $p->deskripsi }}</td>
                    <td style="width: 15%; text-align: center;">{{ format_decimal($p->stokawal, 0) }}</td>
                    <td style="width: 15%; text-align: center;">{{ format_decimal($p->stokmasuk, 0) }}</td>
                    <td style="width: 15%; text-align: center;">{{ format_decimal($p->stokkeluar, 0) }}</td>
                    <td style="width: 15%; text-align: center;">{{ format_decimal($p->stokakhir, 0) }}</td>
                </tr>
                @endforeach

                @else
                <tr style="font-size: 9px;">
                    <td style="width: 100%; text-align: center;" colspan="8">Data tidak ditemukan...</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>