<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Neraca Saldo</title>
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
            padding: 3px 5px;
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
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-left {
            text-align: left;
        }
        .font-bold {
            font-weight: bold;
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
            <td class="judul">LAPORAN NERACA SALDO</td>
        </tr>
        <tr>
            <td class="sub-judul">
                PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}
            </td>
        </tr>
    </table>

    <table border="1" cellpadding="3" style="margin-top:10px;">
        <thead>
            <tr style="font-weight:bold; background-color:#e0e0e0;">
                <th width="18%" class="text-center font-bold">KODE AKUN</th>
                <th width="46%" class="text-center font-bold">NAMA AKUN</th>
                <th width="18%" class="text-center font-bold">DEBET</th>
                <th width="18%" class="text-center font-bold">KREDIT</th>
            </tr>
        </thead>
        <tbody>
            @php
                $prevL1 = '';
                $prevL2 = '';
            @endphp
            @if (count($rsSaldoJurnal) > 0)
                @foreach ($rsSaldoJurnal as $row)
                    @if ($prevL1 != $row->kdparent_l1)
                        @php
                            $prevL1 = $row->kdparent_l1;
                            $prevL2 = '';
                        @endphp
                        <tr style="font-weight:bold; background-color:#eeeeee;">
                            <td colspan="4" class="font-bold" style="font-size:9px;">
                                <strong>{{ $row->kdparent_l1 }} - {{ Str::upper($row->namaparent_l1) }}</strong>
                            </td>
                        </tr>
                    @endif
                    @if ($prevL2 != $row->kdparent_l2)
                        @php $prevL2 = $row->kdparent_l2; @endphp
                        <tr style="font-weight:bold; background-color:#f8f8f8;">
                            <td colspan="4" style="font-size:9px; padding-left:10px;">
                                <em>&nbsp;&nbsp;{{ $row->kdparent_l2 }} {{ $row->namaparent_l2 }}</em>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td width="18%" class="text-center" style="font-size:9px;">{{ $row->kdakun }}</td>
                        <td width="46%" class="text-left" style="font-size:9px; padding-left:15px;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->namaakun }}</td>
                        <td width="18%" class="text-right" style="font-size:9px;">{{ format_rupiah($row->debet) }}</td>
                        <td width="18%" class="text-right" style="font-size:9px;">{{ format_rupiah($row->kredit) }}</td>
                    </tr>
                @endforeach

                <tr style="font-weight:bold; background-color:#e0e0e0;">
                    <td colspan="2" width="64%" class="text-right font-bold" style="font-size:10px;">TOTAL</td>
                    <td width="18%" class="text-right font-bold" style="font-size:10px;">{{ format_rupiah($totalDebet) }}</td>
                    <td width="18%" class="text-right font-bold" style="font-size:10px;">{{ format_rupiah($totalKredit) }}</td>
                </tr>
                <tr style="font-weight:bold;">
                    <td colspan="4" class="text-center font-bold" style="font-size:9px;">
                        STATUS: {{ $isBalance ? 'SEIMBANG / BALANCE' : 'TIDAK SEIMBANG / OUT OF BALANCE (SELISIH: ' . format_rupiah(abs($totalDebet - $totalKredit)) . ')' }}
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="4" class="text-center">Data akun tidak ditemukan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>

