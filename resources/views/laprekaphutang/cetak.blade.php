<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <style>
        <style>table {
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

        .info-supplier {
            width: 100%;
            margin-top: 30px;
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
                        src="{{ public_path('images/' . session('usaha_logo')) }}" alt="" style="width: 50px;">
                </th>
                <th style="width: 90%; font-size: 15px; text-align: left; padding-right: 50px;" colspan="7">
                    {{ session('usaha_nama') }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="7">{{ session('usaha_alamat') }}</th>
            </tr>
            <tr>
                <th class="" style="font-size: 10px; text-align: left;" colspan="7">No Telepon.
                    {{ session('usaha_telepon') }}
                </th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <div class="nama-laporan">BUKU UTANG</div>
    </div>

    <div class="content">
        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size:9px; font-weight: bold;">
                    <th width="5%" style="text-align:center;">NO</th>
                    <th width="10%" style="text-align:center;">NO UTANG</th>
                    <th width="10%" style="text-align:center;">NO FAKTUR</th>
                    <th width="10%" style="text-align:center;">TGL FAKTUR</th>
                    <th width="35%" style="text-align:center;">NAMA SUPPLIER</th>
                    <th width="10%" style="text-align:center;">JLH UTANG</th>
                    <th width="10%" style="text-align:center;">JLH DIBAYAR</th>
                    <th width="10%" style="text-align:center;">SISA UTANG</th>   
                </tr>
            </thead>
            <tbody>
                @if (count($rsLaporan) == 0)
                    <tr style="font-size:9px;">
                        <td width="100%" style="text-align:center;" colspan="8">Data tidak ada..</td>
                    </tr>
                @else
                    @php
                        $no = 1;
                        $totalDibayar = 0;
                        $totalHutang = 0;

                    @endphp

                    @foreach ($rsLaporan as $row)
                        <tr style="font-size:9px;">
                            <td width="5%" style="text-align:center;">{{ $no++ }}</td>
                            <td width="10%" style="text-align:center;">{{ $row->idhutang }}</td>
                            <td width="10%" style="text-align:center;">{{ $row->nofaktur }}</td>
                            <td width="10%" style="text-align:center;">{{ (!empty($row->tglfaktur)) ? tgldmy($row->tglfaktur) : '' }}</td>
                            <td width="35%" style="text-align:left;">{{ $row->namasupplier }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->jumlahhutang) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->jumlahdibayar) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->jumlahhutang - $row->jumlahdibayar) }}</td>
                        </tr>

                        @php
                            $totalDibayar += $row->jumlahdibayar;
                            $totalHutang += $row->jumlahhutang;

                        @endphp
                    @endforeach

                    <tr style="font-size:9px; font-weight: bold;">
                        <td width="70%" style="text-align:right;" colspan="5">TOTAL</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalHutang) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalDibayar) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalHutang - $totalDibayar) }}</td>
                    </tr>

                @endif

            </tbody>
        </table>
    </div>
</body>

</html>
