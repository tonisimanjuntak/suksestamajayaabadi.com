<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Stok FIFO</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .judullaporan .nama-laporan {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .judullaporan .periode-laporan {
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            display: block;
        }

        .divSubJudul {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .content {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <table border="0" cellpadding="2">
        <thead>
            <tr>
                @php
                    $logoPath = public_path('images/' . session('usaha_logo'));
                @endphp
                @if (session('usaha_logo') && file_exists($logoPath))
                <th style="width: 10%; text-align: center;" rowspan="3">
                    <img src="{{ $logoPath }}" alt="Logo" style="width: 50px;">
                </th>
                <th style="width: 90%; font-size: 14px; text-align: left; font-weight: bold;" colspan="6">
                    {{ session('usaha_nama') }}
                </th>
                @else
                <th style="width: 100%; font-size: 14px; text-align: left; font-weight: bold;" colspan="7">
                    {{ session('usaha_nama') }}
                </th>
                @endif
            </tr>
            <tr>
                <th style="font-size: 9px; text-align: left;" colspan="6">{{ session('usaha_alamat') }}</th>
            </tr>
            <tr>
                <th style="font-size: 9px; text-align: left;" colspan="6">No Telepon: {{ session('usaha_telepon') }}</th>
            </tr>
        </thead>
    </table>

    <hr style="border: 1px solid black;">

    <div class="judullaporan">
        <div class="nama-laporan">LAPORAN STOK FIFO</div>
        @if ($tglawal && $tglakhir)
            <div class="periode-laporan">PERIODE: {{ $tglawal }} S/D {{ $tglakhir }}</div>
        @endif
    </div>

    @if ($rowBarang)
    <div class="divSubJudul">
        <table border="0" cellpadding="1" width="100%">
            <tr style="font-size: 9px; font-weight: bold;">
                <td width="12%">KODE BARANG</td>
                <td width="2%">:</td>
                <td width="86%">{{ $rowBarang->kdbarang }}</td>
            </tr>
            <tr style="font-size: 9px; font-weight: bold;">
                <td width="12%">NAMA BARANG</td>
                <td width="2%">:</td>
                <td width="86%">{{ $rowBarang->namabarang }}</td>
            </tr>
        </table>
    </div>
    @endif

    <div class="content">
        @php
            $isExcel = ($jenisCetakan ?? '') == 'excel';
        @endphp
        <table border="1" cellpadding="4" width="100%">
            <thead>
                @if ($isExcel)
                <tr style="font-size: 8px; font-weight: bold; background-color: #f2f2f2;">
                    <th width="3%" style="text-align: center;">NO</th>
                    <th width="7%" style="text-align: center;">ID FIFO</th>
                    <th width="7%" style="text-align: center;">TGL MASUK</th>
                    <th width="9%" style="text-align: center;">NO TRANSAKSI</th>
                    <th width="8%" style="text-align: center;">JENIS</th>
                    <th width="18%" style="text-align: left;">NAMA BARANG</th>
                    <th width="5%" style="text-align: center;">SATUAN</th>
                    <th width="6%" style="text-align: right;">MASUK</th>
                    <th width="6%" style="text-align: right;">TERPAKAI</th>
                    <th width="6%" style="text-align: right;">SISA</th>
                    <th width="9%" style="text-align: right;">NILAI HPP</th>
                    <th width="10%" style="text-align: right;">TOTAL SISA</th>
                    <th width="6%" style="text-align: left;">KET</th>
                </tr>
                @else
                <tr style="font-size: 8px; font-weight: bold; background-color: #f2f2f2;">
                    <th width="3%" style="text-align: center;">NO</th>
                    <th width="7%" style="text-align: center;">ID FIFO</th>
                    <th width="8%" style="text-align: center;">TGL MASUK</th>
                    <th width="10%" style="text-align: center;">NO TRANSAKSI</th>
                    <th width="9%" style="text-align: center;">JENIS</th>
                    <th width="20%" style="text-align: left;">NAMA BARANG</th>
                    <th width="5%" style="text-align: center;">SATUAN</th>
                    <th width="6%" style="text-align: right;">MASUK</th>
                    <th width="6%" style="text-align: right;">TERPAKAI</th>
                    <th width="6%" style="text-align: right;">SISA</th>
                    <th width="9%" style="text-align: right;">NILAI HPP</th>
                    <th width="11%" style="text-align: right;">TOTAL SISA</th>
                </tr>
                @endif
            </thead>
            <tbody>
                @php
                    $no = 1;
                    $totalMasuk = 0;
                    $totalTerpakai = 0;
                    $totalSisa = 0;
                    $totalNilaiSisa = 0;
                @endphp
                @forelse ($rsData as $row)
                    @php
                        $totalMasuk += $row->jumlahmasuk;
                        $totalTerpakai += $row->jumlahterpakai;
                        $totalSisa += $row->jumlahsisa;
                        $totalNilaiSisa += $row->totalsisa;
                    @endphp
                    @if ($isExcel)
                    <tr style="font-size: 8px;">
                        <td width="3%" style="text-align: center;">{{ $no++ }}</td>
                        <td width="7%" style="text-align: center;">{{ $row->idstokfifo }}</td>
                        <td width="7%" style="text-align: center;">{{ tgldmy($row->tglmasuk) }}</td>
                        <td width="9%" style="text-align: center;">{{ $row->idtransaksi }}</td>
                        <td width="8%" style="text-align: center;">{{ $row->jenistransaksi }}</td>
                        <td width="18%" style="text-align: left;">{{ $row->namabarang }}</td>
                        <td width="5%" style="text-align: center;">{{ $row->namasatuan ?? '-' }}</td>
                        <td width="6%" style="text-align: right;">{{ format_decimal($row->jumlahmasuk, 0) }}</td>
                        <td width="6%" style="text-align: right;">{{ format_decimal($row->jumlahterpakai, 0) }}</td>
                        <td width="6%" style="text-align: right;">{{ format_decimal($row->jumlahsisa, 0) }}</td>
                        <td width="9%" style="text-align: right;">{{ format_rupiah($row->nilaihpp) }}</td>
                        <td width="10%" style="text-align: right;">{{ format_rupiah($row->totalsisa) }}</td>
                        <td width="6%" style="text-align: left;">{{ $row->keterangan ?? '-' }}</td>
                    </tr>
                    @else
                    <tr style="font-size: 8px;">
                        <td width="3%" style="text-align: center;">{{ $no++ }}</td>
                        <td width="7%" style="text-align: center;">{{ $row->idstokfifo }}</td>
                        <td width="8%" style="text-align: center;">{{ tgldmy($row->tglmasuk) }}</td>
                        <td width="10%" style="text-align: center;">{{ $row->idtransaksi }}</td>
                        <td width="9%" style="text-align: center;">{{ $row->jenistransaksi }}</td>
                        <td width="20%" style="text-align: left;">{{ $row->namabarang }}</td>
                        <td width="5%" style="text-align: center;">{{ $row->namasatuan ?? '-' }}</td>
                        <td width="6%" style="text-align: right;">{{ format_decimal($row->jumlahmasuk, 0) }}</td>
                        <td width="6%" style="text-align: right;">{{ format_decimal($row->jumlahterpakai, 0) }}</td>
                        <td width="6%" style="text-align: right;">{{ format_decimal($row->jumlahsisa, 0) }}</td>
                        <td width="9%" style="text-align: right;">{{ format_rupiah($row->nilaihpp) }}</td>
                        <td width="11%" style="text-align: right;">{{ format_rupiah($row->totalsisa) }}</td>
                    </tr>
                    @endif
                @empty
                    <tr style="font-size: 8px;">
                        <td colspan="{{ $isExcel ? 13 : 12 }}" width="100%" style="text-align: center;">Tidak ada data stok FIFO.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                @if ($isExcel)
                <tr style="font-size: 8px; font-weight: bold; background-color: #f2f2f2;">
                    <td colspan="7" width="57%" style="text-align: right;">TOTAL:</td>
                    <td width="6%" style="text-align: right;">{{ format_decimal($totalMasuk, 0) }}</td>
                    <td width="6%" style="text-align: right;">{{ format_decimal($totalTerpakai, 0) }}</td>
                    <td width="6%" style="text-align: right;">{{ format_decimal($totalSisa, 0) }}</td>
                    <td width="9%" style="text-align: right;">-</td>
                    <td width="10%" style="text-align: right;">{{ format_rupiah($totalNilaiSisa) }}</td>
                    <td width="6%"></td>
                </tr>
                @else
                <tr style="font-size: 8px; font-weight: bold; background-color: #f2f2f2;">
                    <td colspan="7" width="62%" style="text-align: right;">TOTAL:</td>
                    <td width="6%" style="text-align: right;">{{ format_decimal($totalMasuk, 0) }}</td>
                    <td width="6%" style="text-align: right;">{{ format_decimal($totalTerpakai, 0) }}</td>
                    <td width="6%" style="text-align: right;">{{ format_decimal($totalSisa, 0) }}</td>
                    <td width="9%" style="text-align: right;">-</td>
                    <td width="11%" style="text-align: right;">{{ format_rupiah($totalNilaiSisa) }}</td>
                </tr>
                @endif
            </tfoot>
        </table>
    </div>
</body>

</html>
