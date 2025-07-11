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
        <div class="nama-laporan">LAPORAN NERACA SALDO</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</div>
    </div>

    <div class="content">

        <table border="1" cellpadding="10">
            <thead>
                <tr style="font-size:10px; font-weight:bold;">
                    <th width="15%" style="text-align:center;">KODE</th>
                    <th width="45%" style="text-align:center;">URAIAN</th>
                    <th width="20%" style="text-align:center;">DEBET</th>
                    <th width="20%" style="text-align:center;">KREDIT</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDebet = 0;
                    $totalKredit = 0;
                @endphp
                @if (count($rsSaldoJurnal)>0)
                    @foreach ($rsSaldoJurnal as $row)
                    @php
                        $totalDebet += $row->debet;
                        $totalKredit += $row->kredit;
                    @endphp
                        <tr style="font-size:10px;">
                            <th width="15%" style="text-align:center;">{{ $row->kdakun }}</th>
                            <th width="45%" style="text-align:left;">{{ $row->namaakun }}</th>
                            <th width="20%" style="text-align:right;">{{ format_rupiah($row->debet) }}</th>
                            <th width="20%" style="text-align:right;">{{ format_rupiah($row->kredit) }}</th>
                        </tr>
                    @endforeach

                    <tr style="font-size:10px;; font-weight: bold;">
                        <th width="60%" style="text-align:right;" colspan="2">TOTAL</th>
                        <th width="20%" style="text-align:right;">{{ format_rupiah($totalDebet) }}</th>
                        <th width="20%" style="text-align:right;">{{ format_rupiah($totalKredit) }}</th>
                    </tr>
                @endif

            </tbody>
        </table>


    </div>
</body>

</html>
