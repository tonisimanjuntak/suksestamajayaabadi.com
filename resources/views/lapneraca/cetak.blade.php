<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Neraca</title>
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
        .group-header-l3 td {
            font-weight: bold;
            font-size: 9px;
            padding-top: 2px;
            color: #333333;
        }
        .akun-item td {
            font-size: 9px;
        }
        .subtotal td {
            font-weight: bold;
            border-top: 1px solid #999;
            font-size: 9px;
        }
        .total-row td {
            font-weight: bold;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            font-size: 10px;
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
        .text-center {
            text-align: center;
        }
        .separator {
            height: 6px;
        }
    </style>
</head>

<body>
    {{-- Kop Surat --}}
    @php
        $logoFile = session('usaha_logo');
        $logoPath = $logoFile ? public_path('images/' . $logoFile) : null;
        $hasLogo = $logoPath && file_exists($logoPath);
    @endphp
    <table>
        <tr>
            @if ($hasLogo)
                <td style="width:15%; text-align:center; vertical-align:middle;" rowspan="3">
                    <img src="{{ $logoPath }}" alt="" style="width:55px;">
                </td>
                <td style="width:75%; text-align:center; font-size:14px; font-weight:bold;">
                    {{ session('usaha_nama') }}
                </td>
                <td style="width:10%;"></td>
            @else
                <td style="width:100%; text-align:center; font-size:14px; font-weight:bold;" colspan="3">
                    {{ session('usaha_nama') }}
                </td>
            @endif
        </tr>
        <tr>
            <td style="text-align:center; font-size:9px;" colspan="{{ $hasLogo ? 1 : 3 }}">{{ session('usaha_alamat') }}</td>
            @if ($hasLogo) <td></td> @endif
        </tr>
        <tr class="kop-garis">
            <td style="text-align:center; font-size:9px;" colspan="{{ $hasLogo ? 1 : 3 }}">Telp. {{ session('usaha_telepon') }}</td>
            @if ($hasLogo) <td></td> @endif
        </tr>
    </table>

    <table style="margin-top:8px;">
        <tr>
            <td class="judul">LAPORAN NERACA</td>
        </tr>
        <tr>
            <td class="sub-judul">
                PER TANGGAL {{ Str::upper(tglindonesia($tglakhir)) }}
            </td>
        </tr>
    </table>

    <table style="margin-top:10px;">
        {{-- ============================================================ --}}
        {{-- I. ASET (AKTIVA) --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">I. ASET (AKTIVA)</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @php
            $prevL2 = '';
            $prevL3 = '';
        @endphp

        @if (count($aset) > 0)
            @foreach ($aset as $row)
                @if ($row->saldo == 0)
                    @continue
                @endif

                @if ($prevL2 != $row->kdparent_l2)
                    @php
                        $prevL2 = $row->kdparent_l2;
                        $prevL3 = '';
                    @endphp
                    <tr class="group-header">
                        <td width="55%">&nbsp;&nbsp;<strong>{{ $row->namaparent_l2 }}</strong></td>
                        <td width="22%" class="text-right"></td>
                        <td width="23%" class="text-right"></td>
                    </tr>
                @endif

                @if ($prevL3 != $row->kdparent_l3)
                    @php $prevL3 = $row->kdparent_l3; @endphp
                    <tr class="group-header-l3">
                        <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;<em>{{ $row->namaparent_l3 }}</em></td>
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
        @else
            <tr>
                <td colspan="3" class="text-center" style="font-size:9px;">Tidak ada data aset.</td>
            </tr>
        @endif

        <tr class="total-row">
            <td width="55%"><strong>TOTAL ASET (AKTIVA)</strong></td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"><strong>{{ format_rupiah($totalAset) }}</strong></td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- II. LIABILITAS (KEWAJIBAN) --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">II. LIABILITAS (KEWAJIBAN)</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @php
            $prevL2 = '';
            $prevL3 = '';
        @endphp

        @if (count($liabilitas) > 0)
            @foreach ($liabilitas as $row)
                @if ($row->saldo == 0)
                    @continue
                @endif

                @if ($prevL2 != $row->kdparent_l2)
                    @php
                        $prevL2 = $row->kdparent_l2;
                        $prevL3 = '';
                    @endphp
                    <tr class="group-header">
                        <td width="55%">&nbsp;&nbsp;<strong>{{ $row->namaparent_l2 }}</strong></td>
                        <td width="22%" class="text-right"></td>
                        <td width="23%" class="text-right"></td>
                    </tr>
                @endif

                @if ($prevL3 != $row->kdparent_l3)
                    @php $prevL3 = $row->kdparent_l3; @endphp
                    <tr class="group-header-l3">
                        <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;<em>{{ $row->namaparent_l3 }}</em></td>
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
        @endif

        <tr class="total-row">
            <td width="55%"><strong>TOTAL LIABILITAS</strong></td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"><strong>{{ format_rupiah($totalLiabilitas) }}</strong></td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- III. EKUITAS (MODAL) --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">III. EKUITAS (MODAL)</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @php
            $prevL2 = '';
            $prevL3 = '';
            $adaAkunModal = false;
        @endphp

        @foreach ($modal as $row)
            @if ($row->saldo != 0)
                @php $adaAkunModal = true; @endphp
                @if ($prevL2 != $row->kdparent_l2)
                    @php
                        $prevL2 = $row->kdparent_l2;
                        $prevL3 = '';
                    @endphp
                    <tr class="group-header">
                        <td width="55%">&nbsp;&nbsp;<strong>{{ $row->namaparent_l2 }}</strong></td>
                        <td width="22%" class="text-right"></td>
                        <td width="23%" class="text-right"></td>
                    </tr>
                @endif

                @if ($prevL3 != $row->kdparent_l3)
                    @php $prevL3 = $row->kdparent_l3; @endphp
                    <tr class="group-header-l3">
                        <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;<em>{{ $row->namaparent_l3 }}</em></td>
                        <td width="22%" class="text-right"></td>
                        <td width="23%" class="text-right"></td>
                    </tr>
                @endif

                <tr class="akun-item">
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaakun }}</td>
                    <td width="22%" class="text-right">{{ format_rupiah($row->saldo) }}</td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endif
        @endforeach

        @if (!$adaAkunModal)
            {{-- Jika modal belum diisi transaksi khusus modal, tampilkan modal pemilik --}}
            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modal Pemilik</td>
                <td width="22%" class="text-right">{{ format_rupiah($totalModal) }}</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @endif

        {{-- Laba (Rugi) Periode Berjalan --}}
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Laba (Rugi) Periode Berjalan</td>
            <td width="22%" class="text-right">{{ format_rupiah($labaBersih) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>

        @php
            $subtotalEkuitas = $totalModal + $labaBersih;
        @endphp

        <tr class="total-row">
            <td width="55%"><strong>TOTAL EKUITAS</strong></td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"><strong>{{ format_rupiah($subtotalEkuitas) }}</strong></td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- TOTAL LIABILITAS & EKUITAS (PASIVA) --}}
        {{-- ============================================================ --}}
        <tr class="grand-total">
            <td width="55%"><strong>TOTAL LIABILITAS & EKUITAS</strong></td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"><strong>{{ format_rupiah($totalPasiva) }}</strong></td>
        </tr>

        <tr style="font-weight:bold;">
            <td colspan="3" class="text-center font-bold" style="font-size:9px; padding-top:10px;">
                STATUS: {{ $isBalance ? 'SEIMBANG / BALANCE' : 'TIDAK SEIMBANG / OUT OF BALANCE (SELISIH: ' . format_rupiah(abs($totalAset - $totalPasiva)) . ')' }}
            </td>
        </tr>
    </table>
</body>

</html>
