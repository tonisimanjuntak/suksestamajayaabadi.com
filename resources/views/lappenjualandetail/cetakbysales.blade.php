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
                <th style="width: 90%; font-size: 15px; text-align: left; padding-right: 50px;" colspan="7">{{
                    session('usaha_nama') }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="7">{{ session('usaha_alamat') }}</th>
            </tr>
            <tr>
                <th class="" style="font-size: 10px; text-align: left;" colspan="7">No Telepon. {{
                    session('usaha_telepon') }}
                </th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <div class="nama-laporan">LAPORAN PENJUALAN</div>
        @if ($tglawal == $tglakhir)
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }}</div>

        @else
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{
            Str::upper(tglindonesia($tglakhir)) }}</div>

        @endif
    </div>

    <div class="content">
        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 10px; font-weight: bold;">
                    <th width="5%" style="text-align:center;">NO</th>
                    <th width="10%" style="text-align:center;">TANGGAL/<br>NO INVOICE</th>
                    <th width="25%" style="text-align:center;">KETERANGAN</th>
                    <th width="10%" style="text-align:center;">KASIR</th>
                    <th width="10%" style="text-align:center;">KONSUMEN</th>
                    <th width="10%" style="text-align:center;">UMUR<br>(HARI)</th>
                    <th width="10%" style="text-align:center;">DPP</th>
                    <th width="10%" style="text-align:center;">PPN</th>
                    <th width="10%" style="text-align:center;">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                $idsales_old = '';
                $namasales_old = '';
                @endphp



                @if (count($rsPenjualan) == 0)
                <tr style="font-size:10px;">
                    <td width="100%" style="text-align:center;" colspan="5">Data tidak
                        ditemukan...</td>
                </tr>
                @else
                @php
                $total = 0;
                $totaldpp = 0;
                $totalppn = 0;
                $subtotalsales = 0;
                $subtotaldppsales = 0;
                $subtotalppnsales = 0;
                @endphp

                @foreach ($rsPenjualan as $row)

                @php

                $total += $row->totalinvoice; //total keseluruhan
                $totaldpp += $row->totaldpp; //total keseluruhan
                $totalppn += $row->totalppn; //total keseluruhan

                if ($row->idsales != $idsales_old) {

                if ($no != 1) {
                echo '
                <tr style="font-size: 10px;">
                    <td width="70%" style="text-align:right; font-weight: bold;" colspan="6">
                        SUBTOTAL '. strtoupper($namasales_old) . '
                    </td>
                    <td width="10%" style="text-align:right; font-weight: bold;">'. format_rupiah($subtotaldppsales) .'
                    </td>
                    <td width="10%" style="text-align:right; font-weight: bold;">'. format_rupiah($subtotalppnsales) .'
                    </td>
                    <td width="10%" style="text-align:right; font-weight: bold;">'. format_rupiah($subtotalsales) .'
                    </td>
                </tr>
                ';
                $subtotalsales = 0;
                $subtotaldppsales = 0;
                $subtotalppnsales = 0;
                }

                echo '
                <tr style="font-size: 10px;">
                    <td width="100%" style="text-align:left; font-weight: bold;" colspan="9">
                        '. strtoupper($row->namasales) . '
                    </td>
                </tr>
                ';
                }
                @endphp



                <tr style="font-size: 9px;">
                    <td width="5%" style="text-align:center;">{{ $no++ }}</td>
                    <td width="10%" style="text-align:center;">{{ tglindonesia($row->tglinvoice) }} <br> {{
                        $row->noinvoice }}</td>
                    <td width="25%" style="text-align:left;">
                        {{ $row->keterangan }}<br>
                        Cara Bayar: {{ $row->carabayar }}
                        @if ($row->carabayar=='Transfer')
                        <br>{{ $row->namabank.' ('.$row->norekening.')' }}
                        @endif
                    </td>
                    <td width="10%" style="text-align:center;">{{ $row->namapengguna }}</td>
                    <td width="10%" style="text-align:left;">{{ $row->namakonsumen }}</td>
                    <td width="10%" style="text-align:center;">
                        @if ($row->carabayar == 'Piutang')
                        @if (!empty($row->tgllunas))
                        {{ hitungUmurPiutang($row->tglpiutang, $row->tgllunas) }}
                        {{-- {{ hitungUmurPiutang($row->tglpiutang, '2026-05-16') }} --}}

                        @else
                        {{ hitungUmurPiutang($row->tglpiutang) }}
                        @endif
                        @else
                        -
                        @endif
                    </td>
                    <td width="10%" style="text-align:right;">
                        {{ format_rupiah($row->totaldpp) }}</td>
                    <td width="10%" style="text-align:right;">
                        {{ format_rupiah($row->totalppn) }}</td>
                    <td width="10%" style="text-align:right;">
                        {{ format_rupiah($row->totalinvoice) }}</td>
                </tr>

                @php
                $idsales_old = $row->idsales;
                $subtotalsales += $row->totalinvoice;
                $subtotaldppsales += $row->totaldpp;
                $subtotalppnsales += $row->totalppn;
                $namasales_old = $row->namasales;
                @endphp
                @endforeach


                @php
                if ($no != 1) {
                echo '
                <tr style="font-size: 10px;">
                    <td width="70%" style="text-align:right; font-weight: bold;" colspan="6">
                        SUBTOTAL '. strtoupper($namasales_old) . '
                    </td>
                    <td width="10%" style="text-align:right; font-weight: bold;">'. format_rupiah($subtotaldppsales) .'
                    </td>
                    <td width="10%" style="text-align:right; font-weight: bold;">'. format_rupiah($subtotalppnsales) .'
                    </td>
                    <td width="10%" style="text-align:right; font-weight: bold;">'. format_rupiah($subtotalsales) .'
                    </td>
                </tr>
                ';
                $subtotalsales = 0;
                }
                @endphp
                <tr style="font-size: 10px; font-weight: bold;">
                    <td width="90%" style="text-align:right;" colspan="8"></td>
                    <td width="10%" style="text-align:right;"></td>
                </tr>
                <tr style="font-size: 10px; font-weight: bold;">
                    <td width="70%" style="text-align:right;" colspan="6">TOTAL</td>
                    <td width="10%" style="text-align:right;">
                        {{ format_rupiah($totaldpp) }}</td>
                    <td width="10%" style="text-align:right;">
                        {{ format_rupiah($totalppn) }}</td>
                    <td width="10%" style="text-align:right;">
                        {{ format_rupiah($total) }}</td>
                </tr>

                @endif
            </tbody>
        </table>
    </div>
</body>

</html>