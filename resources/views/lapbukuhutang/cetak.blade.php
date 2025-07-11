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
    @if ($rsSupplier)
        <div class="info-supplier">
            <table border="0" cellpadding="0" width="100%">
                <thead>
                    <tr style="font-size: 9px; font-weight: bold;">
                        <th width="20%" style="text-align: left;">NAMA SUPPLIER</th>
                        <th width="2%" style="text-align: center;">:</th>
                        <th width="38%" style="text-align: left;">{{ strtoupper($rsSupplier->namasupplier) }}</th>
                        <th width="15%" style="text-align: left;">TOTAL UTANG</th>
                        <th width="5%" style="text-align: center;">:</th>
                        <th width="20%" style="text-align: right;">Rp. {{ format_rupiah($rowTotal->totalkredit) }}
                        </th>
                    </tr>
                    <tr style="font-size: 9px; font-weight: bold;">
                        <th width="20%" style="text-align: left;">ID SUPPLIER</th>
                        <th width="2%" style="text-align: center;">:</th>
                        <th width="38%" style="text-align: left;">{{ $rsSupplier->idsupplier }}</th>
                        <th width="15%" style="text-align: left;">SUDAH DIBAYAR</th>
                        <th width="5%" style="text-align: center;">:</th>
                        <th width="20%" style="text-align: right;">Rp. {{ format_rupiah($rowTotal->totaldebet) }}
                        </th>
                    </tr>
                    <tr style="font-size: 9px; font-weight: bold;">
                        <th width="20%" style="text-align: left;">ALAMAT</th>
                        <th width="2%" style="text-align: center;">:</th>
                        <th width="38%" style="text-align: left;">{{ $rsSupplier->alamatsupplier }}</th>
                        <th width="15%" style="text-align: left;">SISA UTANG</th>
                        <th width="5%" style="text-align: center;">:</th>
                        <th width="20%" style="text-align: right;">Rp.
                            {{ format_rupiah($rowTotal->totalkredit - $rowTotal->totaldebet) }}</th>
                    </tr>
                </thead>

            </table>
        </div>
    @endif

    <div class="content">
        <table border="1" cellpadding="10" width="100%">
            <thead>
                <tr style="font-size:9px; font-weight: bold;">
                    <th width="10%" style="text-align:center;">NO</th>
                    <th width="20%" style="text-align:center;">ID UTANG</th>
                    <th width="20%" style="text-align:center;">TANGGAL</th>
                    <th width="25%" style="text-align:right;">UTANG</th>
                    <th width="25%" style="text-align:right;">PEMBAYARAN</th>
                </tr>
            </thead>
            <tbody>
                @if (count($rsDetail) == 0)
                    <tr style="font-size:9px;">
                        <td width="100%" style="text-align:center;" colspan="5">Data tidak ada..</td>
                    </tr>
                @else
                    @php
                        $no = 1;
                        $totalDebet = 0;
                        $totalKredit = 0;
                        $idpembelian_old = '';

                    @endphp

                    @foreach ($rsDetail as $row)
                        @if ($idpembelian_old != $row->idpembelian)
                            @if ($no != 1)
                                <tr style="font-size:9px; font-weight: bold;">
                                    <td width="50%" style="text-align:right;" colspan="3">TOTAL</td>
                                    <td width="25%" style="text-align:right;">{{ format_rupiah($totalDebet) }}</td>
                                    <td width="25%" style="text-align:right;">{{ format_rupiah($totalKredit) }}</td>
                                </tr>
                            @endif

                            <tr style="font-size:10px; font-weight: bold">
                                @php
                                    $no = 1;
                                    $totalDebet = 0;
                                    $totalKredit = 0;
                                @endphp
                                <td width="100%" style="text-align:left;" colspan="5">NO FAKTUR:
                                    {{ $row->nofaktur }}; TANGGAL: {{ tglindonesia($row->tglfaktur) }} 
                                    @php
                                        if ($row->totalkredit > $row->totaldebet) {
                                            echo str_repeat('&nbsp;', 5).'
                                            <span style="color: red;">(BELUM LUNAS - SISA RP. '.format_rupiah($row->totalkredit - $row->totaldebet).')</span>
                                            ';
                                        }else{
                                            echo '
                                            <span>(LUNAS)</span>
                                            ';
                                        }
                                    @endphp
                                        <br>An. {{ $row->namasupplier }}
                                </td>
                            </tr>
                        @endif

                        <tr style="font-size:9px;">
                            <td width="10%" style="text-align:center;">{{ $no++ }}</td>
                            <td width="20%" style="text-align:center;">{{ $row->idhutangdetail }}</td>
                            <td width="20%" style="text-align:center;">{{ $row->tglhutang }}</td>
                            <td width="25%" style="text-align:right;">{{ format_rupiah($row->kredit) }}</td>
                            <td width="25%" style="text-align:right;">{{ format_rupiah($row->debet) }}</td>
                        </tr>
                        @php
                            $idpembelian_old = $row->idpembelian;
                            $totalDebet += $row->debet;
                            $totalKredit += $row->kredit;

                        @endphp
                    @endforeach

                    <tr style="font-size:9px; font-weight: bold;">
                        <td width="50%" style="text-align:right;" colspan="3">TOTAL</td>
                        <td width="25%" style="text-align:right;">{{ format_rupiah($totalKredit) }}</td>
                        <td width="25%" style="text-align:right;">{{ format_rupiah($totalDebet) }}</td>
                    </tr>

                @endif

            </tbody>
        </table>
    </div>
</body>

</html>
