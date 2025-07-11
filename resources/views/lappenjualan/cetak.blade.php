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
        <div class="nama-laporan">LAPORAN PENJUALAN</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</div>
    </div>

    <div class="content">
        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 10px; font-weight: bold;">
                    <th width="5%" style="text-align:center;">NO</th>
                    <th width="10%" style="text-align:center;">TANGGAL/<br>NO INVOICE</th>
                    <th width="20%" style="text-align:center;">KETERANGAN</th>
                    <th width="10%" style="text-align:center;">CARA<br>BAYAR</th>
                    <th width="15%" style="text-align:center;">SALES</th>
                    <th width="15%" style="text-align:center;">KASIR</th>
                    <th width="15%" style="text-align:center;">KONSUMEN</th>
                    <th width="10%" style="text-align:center;">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp

                @if (count($rsPenjualan) == 0)
                    <tr style="font-size:10px;">
                        <td width="100%" style="text-align:center;" colspan="5">Data tidak
                            ditemukan...</td>
                    </tr>
                @else
                    @php
                        $total = 0;
                    @endphp

                    @foreach ($rsPenjualan as $row)
                        @php
                            $total += $row->totalinvoice;
                        @endphp

                        <tr style="font-size: 9px;">
                            <td width="5%" style="text-align:center;">{{ $no++ }}</td>
                            <td width="10%" style="text-align:center;">{{ tglindonesia($row->tglinvoice) }} <br> {{ $row->noinvoice }}</td>
                            <td width="20%" style="text-align:left;">{{ $row->keterangan }}</td>
                            <td width="10%" style="text-align:center;">
                                    {{ $row->carabayar }} 
                                    @if ($row->carabayar=='Transfer')
                                    <br>{{ $row->namabank.' ('.$row->norekening.')' }}
                                    @endif
                            </td>
                            <td width="15%" style="text-align:center;">{{ $row->namasales }}</td>
                            <td width="15%" style="text-align:center;">{{ $row->namapengguna }}</td>
                            <td width="15%" style="text-align:left;">{{ $row->namakonsumen }}</td>
                            <td width="10%" style="text-align:right;">
                                {{ format_rupiah($row->totalinvoice) }}</td>
                        </tr>
                    @endforeach
                    
                    <tr style="font-size: 10px; font-weight: bold;">
                        <td width="90%" style="text-align:right;" colspan="7">TOTAL</td>
                        <td width="10%" style="text-align:right;">
                            {{ format_rupiah($total) }}</td>
                    </tr>

                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
