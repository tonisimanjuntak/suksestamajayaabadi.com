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
        <div class="nama-laporan">BONUS SALES</div>
    </div>

    <div class="content">

        <table>
            <thead>
                <tr style="font-size: 12px; font-weight: bold;">
                    <th style="width: 20%; text-align: left;">Nama Sales</th>
                    <th style="width: 5%; text-align: center;">:</th>                
                    <th style="width: 75%; text-align: left;">{{ $rsSales->namasales}}</th>                
                </tr>
                <tr style="font-size: 12px; font-weight: bold;">
                    <th style="width: 20%; text-align: left;">NPWP</th>
                    <th style="width: 5%; text-align: center;">:</th>                
                    <th style="width: 75%; text-align: left;">{{ $rsSales->npwp}}</th>                
                </tr>
                <tr style="font-size: 12px; font-weight: bold;">
                    <th style="width: 20%; text-align: left;">Tanggal Periode</th>
                    <th style="width: 5%; text-align: center;">:</th>                
                    <th style="width: 75%; text-align: left;">{{ tglindonesia($rsBonus->tglbonus) }}</th>                
                </tr>
            </thead>
        </table>
        <div style="display: block; margin-top: 30px; margin-bottom: 30px;"></div>

        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 10px; font-weight: bold;">
                    <th width="15%" style="text-align:center;" rowspan="2">TOTAL PENJUALAN</th>
                    <th width="15%" style="text-align:center;" rowspan="2">TOTAL PENAGIHAN</th>
                    <th width="15%" style="text-align:center;" rowspan="2">BONUS PENJUALAN</th>
                    <th width="15%" style="text-align:center;" rowspan="2">BONUS PENAGIHAN</th>
                    <th width="25%" style="text-align:center;" colspan="2">TARGET PENJUALAN</th>
                    <th width="15%" style="text-align:center;" rowspan="2">TOTAL BONUS</th>
                </tr>
                <tr>
                    <th width="10%" style="text-align:center;">%</th>
                    <th width="15%" style="text-align:center;">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <tr style="font-size: 10px;">
                    <td width="15%" style="text-align:center;">{{ format_rupiah($rsBonus->totalpenjualan) }}</td>
                    <td width="15%" style="text-align:center;">{{ format_rupiah($rsBonus->totalpenagihan) }}</td>
                    <td width="15%" style="text-align:center;">{{ format_rupiah($rsBonus->totalbonuspenjualan) }}</td>
                    <td width="15%" style="text-align:center;">{{ format_rupiah($rsBonus->totalbonuspenagihan) }}</td>
                    <td width="10%" style="text-align:center;">{{ format_decimal( ($rsBonus->totalpenjualan / $rsSales->targetpenjualan) * 100, 0 ) }} %</td>
                    <td width="15%" style="text-align:center;">{{ format_rupiah($rsBonus->totalbonustarget) }}</td>
                    <td width="15%" style="text-align:center;">{{ format_rupiah($rsBonus->totalbonuspenjualan + $rsBonus->totalbonuspenagihan + $rsBonus->totalbonustarget) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
