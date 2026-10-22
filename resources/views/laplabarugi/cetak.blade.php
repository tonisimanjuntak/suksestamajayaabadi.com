<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Laba Rugi</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: times, serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 3px 6px;
            text-align: left;
            font-size: 10px;
        }
        .kop-garis {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
        }
        .sub-judul {
            text-align: center;
            font-size: 10px;
        }
        .section-header td {
            font-weight: bold;
            font-size: 10px;
            padding-top: 8px;
            text-decoration: underline;
        }
        .group-header td {
            font-weight: bold;
            font-size: 10px;
            padding-top: 4px;
        }
        .akun-item td {
            font-size: 10px;
        }
        .subtotal td {
            font-weight: bold;
            border-top: 1px solid #999;
        }
        .total-row td {
            font-weight: bold;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        .grand-total td {
            font-weight: bold;
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            font-size: 11px;
        }
        .text-right {
            text-align: right;
        }
        .separator {
            height: 6px;
        }
    </style>
</head>

<body>
    {{-- Kop Surat --}}
    <table>
        <tr>
            <td style="width:15%; text-align:center; vertical-align:middle;" rowspan="3">
                <img src="{{ public_path('images/' . session('usaha_logo')) }}" alt="" style="width:55px;">
            </td>
            <td style="width:75%; text-align:center; font-size:14px; font-weight:bold;">
                {{ session('usaha_nama') }}
            </td>
            <td style="width:10%;"></td>
        </tr>
        <tr>
            <td style="text-align:center; font-size:9px;">{{ session('usaha_alamat') }}</td>
            <td></td>
        </tr>
        <tr class="kop-garis">
            <td style="text-align:center; font-size:9px;">Telp. {{ session('usaha_telepon') }}</td>
            <td></td>
        </tr>
    </table>

    <table style="margin-top:8px;">
        <tr>
            <td class="judul">LAPORAN LABA RUGI</td>
        </tr>
        <tr>
            <td class="sub-judul">
                PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}
            </td>
        </tr>
    </table>

    <table style="margin-top:10px;">
        @php
            $prevL2 = '';
            $prevL3 = '';
        @endphp

        {{-- ============================================================ --}}
        {{-- I. PENDAPATAN --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">I. PENDAPATAN</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @php
            $prevL2 = ''; $prevL3 = '';
            $subtotalL3 = 0; $subtotalL2 = 0;
            $groupedL2 = []; $groupedL3 = [];
            // Bangun struktur hierarki untuk pendapatan
            foreach ($pendapatan as $row) {
                $groupedL2[$row->kdparent_l2 . '|' . $row->namaparent_l2] = true;
                $groupedL3[$row->kdparent_l3 . '|' . $row->namaparent_l3][$row->kdparent_l2 . '|' . $row->namaparent_l2] = true;
            }
        @endphp

        @foreach ($pendapatan as $idx => $row)
            @if ($prevL2 != $row->kdparent_l2)
                @if ($prevL2 != '')
                    {{-- Subtotal L3 sebelumnya --}}
                    @php /* subtotalL3 sudah ditambahkan di bawah */ @endphp
                @endif
                @php $prevL2 = $row->kdparent_l2; $prevL3 = ''; @endphp
                <tr class="group-header">
                    <td width="55%">&nbsp;&nbsp;{{ $row->namaparent_l2 }}</td>
                    <td width="22%" class="text-right"></td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endif

            @if ($prevL3 != $row->kdparent_l3)
                @php $prevL3 = $row->kdparent_l3; @endphp
                <tr>
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaparent_l3 }}</td>
                    <td width="22%" class="text-right"></td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endif

            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaakun }}</td>
                <td width="22%" class="text-right">{{ format_rupiah($row->saldo) }}</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @endforeach

        <tr class="total-row">
            <td width="55%">Total Pendapatan</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($totalPendapatan) }}</td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- II. HARGA POKOK PENJUALAN (HPP) --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">II. HARGA POKOK PENJUALAN</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @php $prevL2 = ''; $prevL3 = ''; @endphp
        @foreach ($hpp as $row)
            @if ($prevL2 != $row->kdparent_l2)
                @php $prevL2 = $row->kdparent_l2; $prevL3 = ''; @endphp
                <tr class="group-header">
                    <td width="55%">&nbsp;&nbsp;{{ $row->namaparent_l2 }}</td>
                    <td width="22%" class="text-right"></td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endif
            @if ($prevL3 != $row->kdparent_l3)
                @php $prevL3 = $row->kdparent_l3; @endphp
                <tr>
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaparent_l3 }}</td>
                    <td width="22%" class="text-right"></td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endif
            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaakun }}</td>
                <td width="22%" class="text-right">{{ format_rupiah($row->saldo) }}</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @endforeach

        <tr class="total-row">
            <td width="55%">Total HPP</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($totalHPP) }}</td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- Laba Kotor --}}
        <tr class="grand-total">
            <td width="55%">LABA KOTOR</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($labaKotor) }}</td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- III. BEBAN OPERASIONAL --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">III. BEBAN OPERASIONAL</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @php $prevL2 = ''; $prevL3 = ''; @endphp
        @foreach ($beban as $row)
            @if ($prevL2 != $row->kdparent_l2)
                @php $prevL2 = $row->kdparent_l2; $prevL3 = ''; @endphp
                <tr class="group-header">
                    <td width="55%">&nbsp;&nbsp;{{ $row->namaparent_l2 }}</td>
                    <td width="22%" class="text-right"></td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endif
            @if ($prevL3 != $row->kdparent_l3)
                @php $prevL3 = $row->kdparent_l3; @endphp
                <tr>
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaparent_l3 }}</td>
                    <td width="22%" class="text-right"></td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endif
            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaakun }}</td>
                <td width="22%" class="text-right">{{ format_rupiah($row->saldo) }}</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @endforeach

        <tr class="total-row">
            <td width="55%">Total Beban Operasional</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($totalBeban) }}</td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- Laba Bersih --}}
        <tr class="grand-total">
            <td width="55%">LABA BERSIH SEBELUM PAJAK</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($labaBersih) }}</td>
        </tr>

    </table>
</body>

</html>

