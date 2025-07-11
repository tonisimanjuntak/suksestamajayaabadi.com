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
        <div class="nama-laporan">LAPORAN JURNAL</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</div>
    </div>


    <div class="content">


        <table border="1" cellpadding="5" width="100%">
            <thead>
                <tr>
                    <th width="14%" style="font-size:10px; font-weight:bold; text-align:center;">TANGGAL</th>
                    <th width="44%" style="font-size:10px; font-weight:bold; text-align:center;">KETERANGAN</th>
                    <th width="12%" style="font-size:10px; font-weight:bold; text-align:center;">REF</th>
                    <th width="15%" style="font-size:10px; font-weight:bold; text-align:center;">DEBET</th>
                    <th width="15%" style="font-size:10px; font-weight:bold; text-align:center;">KREDIT</th>
                </tr>
                <tr>
                    <th width="14%" style="font-size:10px; text-align:center;">(1)</th>
                    <th width="44%" style="font-size:10px; text-align:center;">(2)</th>
                    <th width="12%" style="font-size:10px; text-align:center;">(3)</th>
                    <th width="15%" style="font-size:10px; text-align:center;">(4)</th>
                    <th width="15%" style="font-size:10px; text-align:center;">(5)</th>
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



                @foreach ($rsJurnal as $row)
                    @php
                        $totalDebet = $totalDebet + $row->debet;
                        $totalKredit = $totalKredit + $row->kredit;
                        $tgljurnal = $idjurnallama != $row->idjurnal ? tgldmy($row->tgljurnal) : '';
                        $namaakun = $row->debet != 0 ? $row->namaakun : str_repeat('&nbsp;', 10) . $row->namaakun;
                    @endphp



                    <tr>
                        <td width="14%" style="font-size:10px; text-align:center;">
                            {{ $tgljurnal }}</td>
                        <td width="44%" style="font-size:10px; text-align:left;">@php
                            echo $namaakun;
                        @endphp</td>
                        <td width="12%" style="font-size:10px; text-align:center;"></td>
                        <td width="15%" style="font-size:10px; text-align:right;">{{ ($row->debet != 0) ? format_rupiah($row->debet) : '' }}
                        </td>
                        <td width="15%" style="font-size:10px; text-align:right;">{{ ($row->kredit != 0) ? format_rupiah($row->kredit) : '' }}
                        </td>
                    </tr>

                    @php
                        $idjurnallama = $row->idjurnal;
                        $jenisLama = $row->jenis;
                    @endphp
                @endforeach

                <tr>
                    <td style="font-size:10px; text-align:right;" colspan="3"><B>TOTAL </B></td>
                    <td style="font-size:10px; text-align:right;"><B>{{ format_rupiah($totalDebet) }}</B></td>
                    <td style="font-size:10px; text-align:right;"><B>{{ format_rupiah($totalKredit) }}</B></td>
                </tr>
            </tbody>
        </table>


    </div>
</body>

</html>
