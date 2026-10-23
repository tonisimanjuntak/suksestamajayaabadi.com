<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Arus Kas</title>
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
            font-size: 10px;
        }
        .text-right {
            text-align: right;
        }
        .separator {
            height: 6px;
        }
        .table-border th, .table-border td {
            border: 1px solid #333;
        }
        .bg-gray {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    {{-- Kop Surat --}}
    <table>
        <tr>
            <td style="width:15%; text-align:center; vertical-align:middle;" rowspan="3">
                @if(session('usaha_logo') && file_exists(public_path('images/' . session('usaha_logo'))))
                    <img src="{{ public_path('images/' . session('usaha_logo')) }}" alt="" style="width:55px;">
                @endif
            </td>
            <td style="width:75%; text-align:center; font-size:14px; font-weight:bold;">
                {{ session('usaha_nama', 'PT. SUKSES TAMA JAYA ABADI') }}
            </td>
            <td style="width:10%;"></td>
        </tr>
        <tr>
            <td style="text-align:center; font-size:9px;">{{ session('usaha_alamat', '') }}</td>
            <td></td>
        </tr>
        <tr class="kop-garis">
            <td style="text-align:center; font-size:9px;">Telp. {{ session('usaha_telepon', '') }}</td>
            <td></td>
        </tr>
    </table>

    <table style="margin-top:8px;">
        <tr>
            <td class="judul">LAPORAN ARUS KAS (METODE LANGSUNG)</td>
        </tr>
        <tr>
            <td class="sub-judul">
                PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}
            </td>
        </tr>
    </table>

    <table style="margin-top:10px;">
        {{-- ============================================================ --}}
        {{-- I. ARUS KAS DARI AKTIVITAS OPERASI --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">I. ARUS KAS DARI AKTIVITAS OPERASI</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        {{-- Kelompok Masuk Operasi --}}
        @php
            $operasiMasuk = array_filter($operasi, fn($item) => $item['net'] > 0);
            $operasiKeluar = array_filter($operasi, fn($item) => $item['net'] < 0);
        @endphp

        <tr class="group-header">
            <td width="55%">&nbsp;&nbsp;Penerimaan Kas dari Operasi:</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>
        @if(count($operasiMasuk) == 0)
            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;- Tidak ada penerimaan operasi -</td>
                <td width="22%" class="text-right">0</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @else
            @foreach($operasiMasuk as $item)
                <tr class="akun-item">
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;{{ $item['tgljurnal'] }} - {{ $item['namaakun_lawan'] }} ({{ $item['jenis'] }})</td>
                    <td width="22%" class="text-right">{{ format_rupiah($item['net']) }}</td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endforeach
        @endif

        {{-- Kelompok Keluar Operasi --}}
        <tr class="group-header">
            <td width="55%">&nbsp;&nbsp;Pengeluaran Kas untuk Operasi:</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>
        @if(count($operasiKeluar) == 0)
            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;- Tidak ada pengeluaran operasi -</td>
                <td width="22%" class="text-right">0</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @else
            @foreach($operasiKeluar as $item)
                <tr class="akun-item">
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;{{ $item['tgljurnal'] }} - {{ $item['namaakun_lawan'] }} ({{ $item['jenis'] }})</td>
                    <td width="22%" class="text-right">({{ format_rupiah(abs($item['net'])) }})</td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endforeach
        @endif

        <tr class="total-row">
            <td width="55%">Arus Kas Bersih dari Aktivitas Operasi</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">
                @if($totalOperasi < 0)
                    ({{ format_rupiah(abs($totalOperasi)) }})
                @else
                    {{ format_rupiah($totalOperasi) }}
                @endif
            </td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- II. ARUS KAS DARI AKTIVITAS INVESTASI --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">II. ARUS KAS DARI AKTIVITAS INVESTASI</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>
        @if(count($investasi) == 0)
            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;- Tidak ada transaksi investasi -</td>
                <td width="22%" class="text-right">0</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @else
            @foreach($investasi as $item)
                <tr class="akun-item">
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;{{ $item['tgljurnal'] }} - {{ $item['namaakun_lawan'] }}</td>
                    <td width="22%" class="text-right">
                        @if($item['net'] < 0)
                            ({{ format_rupiah(abs($item['net'])) }})
                        @else
                            {{ format_rupiah($item['net']) }}
                        @endif
                    </td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endforeach
        @endif

        <tr class="total-row">
            <td width="55%">Arus Kas Bersih dari Aktivitas Investasi</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">
                @if($totalInvestasi < 0)
                    ({{ format_rupiah(abs($totalInvestasi)) }})
                @else
                    {{ format_rupiah($totalInvestasi) }}
                @endif
            </td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- III. ARUS KAS DARI AKTIVITAS PENDANAAN --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">III. ARUS KAS DARI AKTIVITAS PENDANAAN</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>
        @if(count($pendanaan) == 0)
            <tr class="akun-item">
                <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;- Tidak ada transaksi pendanaan -</td>
                <td width="22%" class="text-right">0</td>
                <td width="23%" class="text-right"></td>
            </tr>
        @else
            @foreach($pendanaan as $item)
                <tr class="akun-item">
                    <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;{{ $item['tgljurnal'] }} - {{ $item['namaakun_lawan'] }}</td>
                    <td width="22%" class="text-right">
                        @if($item['net'] < 0)
                            ({{ format_rupiah(abs($item['net'])) }})
                        @else
                            {{ format_rupiah($item['net']) }}
                        @endif
                    </td>
                    <td width="23%" class="text-right"></td>
                </tr>
            @endforeach
        @endif

        <tr class="total-row">
            <td width="55%">Arus Kas Bersih dari Aktivitas Pendanaan</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">
                @if($totalPendanaan < 0)
                    ({{ format_rupiah(abs($totalPendanaan)) }})
                @else
                    {{ format_rupiah($totalPendanaan) }}
                @endif
            </td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- REKAPITULASI ARUS KAS --}}
        {{-- ============================================================ --}}
        <tr class="grand-total">
            <td width="55%">KENAIKAN / (PENURUNAN) BERSIH KAS & BANK</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">
                @if($totalMutasi < 0)
                    ({{ format_rupiah(abs($totalMutasi)) }})
                @else
                    {{ format_rupiah($totalMutasi) }}
                @endif
            </td>
        </tr>

        <tr>
            <td width="55%">SALDO AWAL KAS & BANK</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">
                @if($totalSaldoAwal < 0)
                    ({{ format_rupiah(abs($totalSaldoAwal)) }})
                @else
                    {{ format_rupiah($totalSaldoAwal) }}
                @endif
            </td>
        </tr>

        <tr class="grand-total">
            <td width="55%">SALDO AKHIR KAS & BANK</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">
                @if($totalSaldoAkhir < 0)
                    ({{ format_rupiah(abs($totalSaldoAkhir)) }})
                @else
                    {{ format_rupiah($totalSaldoAkhir) }}
                @endif
            </td>
        </tr>
    </table>

    <br><br>

    {{-- ============================================================ --}}
    {{-- RINCIAN SALDO KAS DAN BANK --}}
    {{-- ============================================================ --}}
    <table class="table-border" style="margin-top:15px;">
        <thead>
            <tr class="bg-gray">
                <th width="8%" style="text-align:center;">No</th>
                <th width="15%" style="text-align:center;">Kode Akun</th>
                <th width="37%">Nama Akun Kas / Bank</th>
                <th width="20%" class="text-right">Saldo Awal</th>
                <th width="20%" class="text-right">Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($rincianKas as $row)
                <tr>
                    <td style="text-align:center;">{{ $no++ }}</td>
                    <td style="text-align:center;">{{ $row->kdakun }}</td>
                    <td>{{ $row->namaakun }}</td>
                    <td class="text-right">
                        @if($row->saldo_awal < 0)
                            ({{ format_rupiah(abs($row->saldo_awal)) }})
                        @else
                            {{ format_rupiah($row->saldo_awal) }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($row->saldo_akhir < 0)
                            ({{ format_rupiah(abs($row->saldo_akhir)) }})
                        @else
                            {{ format_rupiah($row->saldo_akhir) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-gray" style="font-weight:bold;">
                <td colspan="3" style="text-align:right;">TOTAL KAS & BANK</td>
                <td class="text-right">
                    @if($totalSaldoAwal < 0)
                        ({{ format_rupiah(abs($totalSaldoAwal)) }})
                    @else
                        {{ format_rupiah($totalSaldoAwal) }}
                    @endif
                </td>
                <td class="text-right">
                    @if($totalSaldoAkhir < 0)
                        ({{ format_rupiah(abs($totalSaldoAkhir)) }})
                    @else
                        {{ format_rupiah($totalSaldoAkhir) }}
                    @endif
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
