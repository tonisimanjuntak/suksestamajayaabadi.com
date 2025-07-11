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
        <div class="nama-laporan">LAPORAN BONUS SALES</div>
        @if ($tglawal != $tglakhir)
            <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</div>
        @else
            <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }}</div>

        @endif
    </div>

    <div class="content">

        
        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 9px; font-weight: bold;">
                    <th width="5%" style="text-align:center;" rowspan="2">NO</th>
                    <th width="10%" style="text-align:center;" rowspan="2">TANGGAL</th>
                    <th width="15%" style="text-align:center;" rowspan="2">NAMA SALES</th>
                    <th width="10%" style="text-align:center;" rowspan="2">TOTAL PENJUALAN</th>
                    <th width="10%" style="text-align:center;" rowspan="2">TOTAL PENAGIHAN</th>
                    <th width="10%" style="text-align:center;" rowspan="2">BONUS PENJUALAN</th>
                    <th width="10%" style="text-align:center;" rowspan="2">BONUS PENAGIHAN</th>
                    <th width="20%" style="text-align:center;" colspan="2">TARGET PENJUALAN</th>
                    <th width="10%" style="text-align:center;" rowspan="2">TOTAL BONUS</th>
                </tr>
                <tr style="font-size: 9px; font-weight: bold;">
                    <th width="10%" style="text-align:center;">%</th>
                    <th width="10%" style="text-align:center;">JUMLAH</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $no = 1;
                    $totalBonus = 0;
                    $totalpenjualan = 0;
                    $totalpenagihan = 0;
                    $totalbonuspenjualan = 0;
                    $totalbonuspenagihan = 0;
                    $totalbonustarget = 0;

                @endphp


                @if (count($rsBonus) == 0)
                    <tr style="font-size:9px;">
                        <td width="100%" style="text-align:center;" colspan="5">Data tidak
                            ditemukan...</td>
                    </tr>
                @else

                    @foreach ($rsBonus as $row)

                        <tr style="font-size: 9px;">
                            <td width="5%" style="text-align:center;">{{ $no++ }}</td>
                            <td width="10%" style="text-align:center;">{{ tgldmy($row->tglbonus) }}</td>
                            <td width="15%" style="text-align:left;">{{ $row->namasales }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->totalpenjualan) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->totalpenagihan) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->totalbonuspenjualan) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->totalbonuspenagihan) }}</td>
                            <td width="10%" style="text-align:center;">{{ format_decimal( ($row->pencapaiantarget / $row->targetpenjualan) * 100, 0 ) }} %</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->totalbonustarget) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->totalbonuspenjualan + $row->totalbonuspenagihan + $row->totalbonustarget) }}</td>
                        </tr>

                        @php
                            $totalBonus += $row->totalbonuspenjualan + $row->totalbonuspenagihan + $row->totalbonustarget;
                            $totalpenjualan += $row->totalpenjualan;
                            $totalpenagihan += $row->totalpenagihan;
                            $totalbonuspenjualan += $row->totalbonuspenjualan;
                            $totalbonuspenagihan += $row->totalbonuspenagihan;
                            $totalbonustarget += $row->totalbonustarget;
                        @endphp
                    @endforeach

                    <tr style="font-size: 9px; font-weight: bold;">
                        <td width="30%" style="text-align:right;" colspan="3">TOTAL</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalpenjualan) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalpenagihan) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalbonuspenjualan) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalbonuspenagihan) }}</td>
                        <td width="10%" style="text-align:center;"></td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalbonustarget) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalbonuspenjualan + $totalbonuspenagihan + $totalbonustarget) }}</td>
                    </tr>

                @endif

                
            </tbody>
        </table>
    </div>
</body>

</html>
