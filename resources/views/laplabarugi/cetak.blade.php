<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <link rel="stylesheet" href="{{ asset('') }}assets/bootstrap4/bootstrap.min.css">
    <script src="{{ asset('') }}assets/bootstrap4/jquery-3.2.1.slim.min.js"></script>
    <script src="{{ asset('') }}assets/bootstrap4/popper.min.js"></script>
    <script src="{{ asset('') }}assets/bootstrap4/bootstrap.min.js"></script>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }


        th,
        td {
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }

        .judullaporan {
            margin-top: 50px;
        }

        .judullaporan h1 {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .judullaporan h2 {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            display: block;
            margin-top: -30px;
        }

        .content {
            margin-top: 20px;
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
                <th class="add-border-bottom" style="width: 20%; text-align: center;" rowspan="3"><img
                        src="{{ url('images') . '/logo.png' }}" alt="" style="width: 60px;"></th>
                <th style="width: 70%; font-size: 15px; text-align: center; padding-right: 50px;">CV. CAHAYA LAMBOY
                    KOTA PONTIANAK</th>
                <th style="width: 10%;"></th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: center;">Jl. A. Yani No. 233 Kec.
                    Pontianak Kota Kalimantan
                    Barat</th>
                <th></th>
            </tr>
            <tr>
                <th class="add-border-bottom" style="font-size: 10px; text-align: center;">No Telepon. (0561)
                    6427881 / FAX. (0561) 6427882
                </th>
                <th class="add-border-bottom"></th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <h1>LAPORAN LABA RUGI</h1>
        <h2>PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</h2>
    </div>

    <div class="content">


        <table border="0" cellpadding="10">

            <tbody>
                @php

                    $no = 1;

                    echo '
                        <tr style="font-weight: bold; font-size:10px;">
                            <td width="60%" style="text-align:left;">I. PENDAPATAN</td>
                            <td width="20%" style="text-align:right;"></td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                    ';

                    echo '
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Penjualan</td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($penjualan) .
                        '</td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Discount Penjualan</td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($penjualan_discount) .
                        '</td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Retur Penjualan</td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($penjualan_retur) .
                        '</td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                    ';

                    echo '
                        <tr style="font-weight: bold; font-size:10px;">
                            <td width="60%" style="text-align:right;">Total Pendapatan</td>
                            <td width="20%" style="text-align:right;"></td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($penjualan + $penjualan_discount + $penjualan_retur) .
                        '</td>
                        </tr>
                    ';

                    echo '
                        <tr style="font-weight: bold; font-size:10px;">
                            <td width="60%" style="text-align:left;">II. HARGA POKOK PENJAULAN</td>
                            <td width="20%" style="text-align:right;"></td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                    ';

                    echo '
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Persediaan Barang Dagang</td>
                            <td width="20%" style="text-align:right;"></td>
                            <td width="20%" style="text-align:right;">0</td>
                        </tr>
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Pembelian</td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($pembelian) .
                        '</td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Discount Barang Dagang</td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($pembelian_discount) .
                        '</td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Retur Pembelian</td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($pembelian_retur) .
                        '</td>
                            <td width="20%" style="text-align:right;"></td>
                        </tr>
                        <tr style="font-size:10px;">
                            <td width="60%" style="text-align:left;">Pendapatn Bersih</td>
                            <td width="20%" style="text-align:right;"></td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($pembelian + $pembelian_discount + $pembelian_retur) .
                        '</td>
                        </tr>
                    ';

                    $totalHPP = $pembelian + $pembelian_discount + $pembelian_retur;
                    echo '
                        <tr style="font-weight: bold; font-size:10px;">
                            <td width="60%" style="text-align:right;">Total HPP</td>
                            <td width="20%" style="text-align:right;"></td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($totalHPP) .
                        '</td>
                        </tr>
                    ';

                    echo '
                        <tr style="font-weight: bold; font-size:10px;">
                            <td width="60%" style="text-align:right;">Laba Kotor</td>
                            <td width="20%" style="text-align:right;"></td>
                            <td width="20%" style="text-align:right;">' .
                        format_rupiah($penjualan - $totalHPP) .
                        '</td>
                        </tr>
                    ';

                @endphp

            </tbody>
        </table>


    </div>
</body>

</html>
