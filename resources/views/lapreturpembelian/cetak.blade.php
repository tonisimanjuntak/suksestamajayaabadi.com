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
        <div class="nama-laporan">LAPORAN RETUR PEMBELIAN</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</div>
    </div>

    <div class="content">
        <table border="0" cellpadding="5" width="100%">
            <thead>
                <tr style="font-size:9px; font-weight: bold;">
                    <th width="5%" style="text-align:center;" class="add-border-top add-border-bottom">NO</th>
                    <th width="15%" style="text-align:center;" class="add-border-top add-border-bottom">NO FAKTUR<br>TGL FAKTUR</th>
                    <th width="15%" style="text-align:center;" class="add-border-top add-border-bottom">SUPPLIER</th>
                    <th width="10%" style="text-align:center;" class="add-border-top add-border-bottom">TANGGAL RETUR<br>TGL DIBAYAR</th>
                    <th width="30%" style="text-align:center;" class="add-border-top add-border-bottom">KETERANGAN</th>
                    <th width="5%" style="text-align:center;" class="add-border-top add-border-bottom">QTY</th>
                    <th width="10%" style="text-align:center;" class="add-border-top add-border-bottom">HARGA</th>
                    <th width="10%" style="text-align:center;" class="add-border-top add-border-bottom">SUB TOTAL
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp

                @if (count($rsRetur) == 0)
                    <tr>
                        <td width="100%" style="font-size:10px; text-align:center;" colspan="6">Data tidak
                            ditemukan...</td>
                    </tr>
                @else
                @php
                    $total = 0;
                    $idpembelian_old = '';
                @endphp
                    @foreach ($rsRetur as $row)
                        @if ($idpembelian_old != $row->idpembelian)
                            <tr style="font-size:9px;">
                                <td width="5%" style="text-align:center;" class="add-border-top">{{ $no++ }}</td>
                                <td width="15%" style="text-align:center;" class="add-border-top">{{ $row->nofaktur }}<br>{{ tglindonesia($row->tglfaktur) }}</td>
                                <td width="15%" style="text-align:center;" class="add-border-top">{{ $row->namasupplier }}</td>
                                <td width="10%" style="text-align:center;" class="add-border-top">{{ tglindonesia($row->tglpengajuan) }}<br>{{ tglindonesia($row->tglretur) }}</td>
                                <td width="30%" style="text-align:left;" class="add-border-top">
                                    {{ $row->keterangan }}
                                </td>
                                <td width="5%" style="text-align:center;" class="add-border-top"></td>
                                <td width="10%" style="text-align:right;" class="add-border-top"></td>
                                <td width="10%" style="text-align:right;" class="add-border-top"></td>
                            </tr>
                        @endif

                        <tr style="font-size:9px;">
                            <td width="5%" style="text-align:center;"></td>
                            <td width="15%" style="text-align:center;"></td>
                            <td width="15%" style="text-align:center;"></td>
                            <td width="10%" style="text-align:center;"></td>
                            <td width="30%" style="text-align:left;">
                                {{ $row->namabarang }}
                            </td>
                            <td width="5%" style="text-align:center;">
                                {{ $row->jumlahretur }}
                            </td>
                            <td width="10%" style="text-align:right;">
                                {{ format_rupiah($row->hargaretur) }}</td>
                            <td width="10%" style="text-align:right;">
                                {{ format_rupiah($row->subtotalretur) }}</td>
                        </tr>

                
                        
                    @php
                        $idpembelian = $row->idpembelian;
                        $total += $row->subtotalretur;
                    @endphp
                    @endforeach

                    <tr style="font-size:9px; font-weight: bold;">
                        <td width="90%" style="text-align:right;" class="add-border-top add-border-bottom" colspan="6">T O T A L</td>
                        <td width="10%" style="text-align:right;" class="add-border-top add-border-bottom">
                            {{ format_rupiah($total) }}</td>
                    </tr>

                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
