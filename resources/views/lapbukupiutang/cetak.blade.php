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
        <table border="1" cellpadding="10" width="100%">
            <thead>
                <tr style="font-size:9px; font-weight: bold;">
                    <th width="10%" style="text-align:center;">NO</th>
                    <th width="20%" style="text-align:center;">ID PIUTANG</th>
                    <th width="20%" style="text-align:center;">TANGGAL</th>
                    <th width="25%" style="text-align:right;">PIUTANG</th>
                    <th width="25%" style="text-align:right;">JLH DIBAYAR</th>                    
                </tr>
            </thead>
            <tbody>
                @if (count($rsDetail) == 0)

                    <tr style="font-size:9px;">
                        <td width="100%" style="text-align:center;" colspan="5">Data tidak ditemukan...</td>                        
                    </tr>

                @else
                    @php
                        $no = 1;
                        $totalDebet = 0;
                        $totalKredit = 0;
                        $idpenjualan_old = '';

                    @endphp

                    @foreach ($rsDetail as $row)

                        @if ($idpenjualan_old != $row->idpenjualan)
                            
                            @if ($no != 1)
                                <tr style="font-size:9px; font-weight: bold;">
                                    <td width="50%" style="text-align:right;" colspan="3">TOTAL</td>
                                    <td width="25%" style="text-align:right;">{{ format_rupiah($totalDebet) }}</td>
                                    <td width="25%" style="text-align:right;">{{ format_rupiah($totalKredit) }}</td>
                                </tr>
                            @endif

                            <tr style="font-size:10px; font-weight: bold">
                                <td width="100%" style="text-align:left;" colspan="5" class="no-border-right">NO INVOICE: {{ $row->noinvoice }}; TANGGAL: {{ tglindonesia($row->tglinvoice) }}
                                    @php
                                        if ($row->totaldebet > $row->totalkredit) {
                                            echo str_repeat('&nbsp;', 5).'
                                            <span style="color: red;">(BELUM LUNAS - SISA RP. '.format_rupiah($row->totaldebet - $row->totalkredit).')</span>
                                            ';
                                        }else{
                                            echo '
                                            <span>(LUNAS)</span>
                                            ';
                                        }
                                    @endphp
                                    <br>An. {{ $row->namakonsumen }}

                                </td>                                
                            </tr>

                            @php
                                $no = 1;
                                $totalDebet = 0;
                                $totalKredit = 0;
                            @endphp
                        @endif

                        <tr style="font-size:9px;">
                            <td width="10%" style="text-align:center;">{{ $no++ }}</td>
                            <td width="20%" style="text-align:center;">{{ $row->idpiutangdetail }}</td>
                            <td width="20%" style="text-align:center;">{{ $row->tglpiutang }}</td>
                            <td width="25%" style="text-align:right;">{{ format_rupiah($row->debet) }}</td>
                            <td width="25%" style="text-align:right;">{{ format_rupiah($row->kredit) }}</td>
                        </tr>
                        @php
                            $idpenjualan_old = $row->idpenjualan;
                            $totalDebet += $row->debet;
                            $totalKredit += $row->kredit;

                        @endphp
                    @endforeach

                    <tr style="font-size:9px; font-weight: bold;">
                        <td width="50%" style="text-align:right;" colspan="3">TOTAL</td>
                        <td width="25%" style="text-align:right;">{{ format_rupiah($totalDebet) }}</td>
                        <td width="25%" style="text-align:right;">{{ format_rupiah($totalKredit) }}</td>
                    </tr>

                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
