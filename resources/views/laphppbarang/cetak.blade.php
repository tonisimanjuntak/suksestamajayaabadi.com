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
                <th style="width: 10%; text-align: center;" rowspan="3"><img
                        src="{{ public_path('images/'. session('usaha_logo')) }}" alt="" style="width: 50px;"></th>
                <th style="width: 90%; font-size: 15px; text-align: left; padding-right: 50px;" colspan="5">{{
                    session('usaha_nama') }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="5">{{ session('usaha_alamat') }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="5">No Telepon. {{
                    session('usaha_telepon') }}
                </th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <div class="nama-laporan">LAPORAN HPP BARANG</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglriwayat)) }}</div>
    </div>

    <div class="content">
        <table border="1" cellpadding="5" width="100%">
            <thead>
                <tr style="font-size: 9px; font-weight: bold;">
                    <th style="width: 5%; text-align: center;">NO</th>
                    <th style="width: 15%; text-align: center;">KODE BARANG</th>
                    <th style="width: 35%; text-align: center;">NAMA BARANG</th>
                    <th style="width: 15%; text-align: center;">KUANTITAS</th>
                    <th style="width: 15%; text-align: center;">TOTAL HPP</th>
                    <th style="width: 15%; text-align: center;">HPP</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                $grandTotalKuantitas = 0;
                $grandTotalBiaya = 0;
                @endphp

                @if (count($rsBarang) > 0)
                    @foreach ($rsBarang as $p)
                    @php
                    $grandTotalKuantitas += $p->kuantitas;
                    $grandTotalBiaya += $p->totalbiaya;
                    @endphp
                    <tr style="font-size: 9px;">
                        <td style="width: 5%; text-align: center;">{{ $no++ }}</td>
                        <td style="width: 15%; text-align: center;">{{ $p->kdbarang }}</td>
                        <td style="width: 35%; text-align: left;">{{ $p->namabarang }}</td>
                        <td style="width: 15%; text-align: center;">{{ number_format($p->kuantitas, 0, ',', '.') }}</td>
                        <td style="width: 15%; text-align: right;">{{ format_rupiah($p->totalbiaya) }}</td>
                        <td style="width: 15%; text-align: right;">{{ format_rupiah($p->biayaratarata) }}</td>
                    </tr>
                    @endforeach
                    <tr style="font-size: 9px; font-weight: bold;">
                        <td colspan="3" style="width: 55%; text-align: right;">TOTAL:</td>
                        <td style="width: 15%; text-align: center;">{{ number_format($grandTotalKuantitas, 0, ',', '.') }}</td>
                        <td style="width: 15%; text-align: right;">{{ format_rupiah($grandTotalBiaya) }}</td>
                        <td style="width: 15%; text-align: right;"></td>
                    </tr>
                @else
                    <tr style="font-size: 9px;">
                        <td style="width: 100%; text-align: center;" colspan="6">Data tidak ditemukan...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
