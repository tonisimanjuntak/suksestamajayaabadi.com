<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <style>
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

        .no-border-left {
            border-left: 0px solid #eee;
        }

        .no-border-right {
            border-right: 0px solid #eee;
        }

        .float-right {
            float: right;
            clear: none;
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
        <div class="nama-laporan">BUKU PIUTANG</div>        
    </div>

    <div class="content">
        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size:9px; font-weight: bold;">
                    <th width="5%" style="text-align:center;">NO</th>
                    <th width="10%" style="text-align:center;">NO PIUTANG</th>
                    <th width="10%" style="text-align:center;">NO INVOICE</th>
                    <th width="10%" style="text-align:center;">TGL INVOICE</th>
                    <th width="10%" style="text-align:center;">J. TEMPO</th>
                    <th width="25%" style="text-align:center;">NAMA KONSUMEN</th>
                    <th width="10%" style="text-align:center;">JLH PIUTANG</th>
                    <th width="10%" style="text-align:center;">JLH DIBAYAR</th>
                    <th width="10%" style="text-align:center;">SISA PIUTANG</th>                    
                </tr>
            </thead>
            <tbody>
                @if (count($rsLaporan) == 0)

                    <tr style="font-size:9px;">
                        <td width="100%" style="text-align:center;" colspan="9">Data tidak ditemukan...</td>                        
                    </tr>

                @else
                    @php
                        $no = 1;
                        $totalPiutang = 0;
                        $totalDibayar = 0;
                        $idpenjualan_old = '';

                    @endphp

                    @foreach ($rsLaporan as $row)

                        <tr style="font-size:9px;">
                            <td width="5%" style="text-align:center;">{{ $no++ }}</td>
                            <td width="10%" style="text-align:center;">{{ $row->idpiutang }}</td>
                            <td width="10%" style="text-align:center;">{{ $row->noinvoice }}</td>
                            <td width="10%" style="text-align:center;">{{ (!empty($row->tglinvoice)) ? tgldmy($row->tglinvoice) : '' }}</td>
                            <td width="10%" style="text-align:center;">{{ (!empty($row->tgljatuhtempo)) ? tgldmy($row->tgljatuhtempo) : '' }}</td>
                            <td width="25%" style="text-align:left;">{{ $row->namakonsumen }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->jumlahpiutang) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->jumlahdibayar) }}</td>
                            <td width="10%" style="text-align:right;">{{ format_rupiah($row->jumlahpiutang - $row->jumlahdibayar) }}</td>
                        </tr>

                        @php
                            $idpenjualan_old = $row->idpenjualan;
                            $totalPiutang += $row->jumlahpiutang;
                            $totalDibayar += $row->jumlahdibayar;

                        @endphp
                    @endforeach

                    <tr style="font-size:9px; font-weight: bold;">
                        <td width="70%" style="text-align:right;" colspan="6">TOTAL</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalPiutang) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalDibayar) }}</td>
                        <td width="10%" style="text-align:right;">{{ format_rupiah($totalPiutang - $totalDibayar) }}</td>
                    </tr>

                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
