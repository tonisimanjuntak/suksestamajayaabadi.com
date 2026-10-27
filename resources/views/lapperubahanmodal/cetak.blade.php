<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Perubahan Modal</title>
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
        .text-center {
            text-align: center;
        }
        .separator {
            height: 6px;
        }
        .tabel-detail th {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .tabel-detail td {
            border-bottom: 1px solid #ddd;
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
            <td class="judul">LAPORAN PERUBAHAN MODAL</td>
        </tr>
        <tr>
            <td class="sub-judul">
                PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}
            </td>
        </tr>
    </table>

    <table style="margin-top:10px;">
        {{-- ============================================================ --}}
        {{-- I. MODAL AWAL --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">I. MODAL AWAL (PER {{ Str::upper(tglindonesia($tglawal)) }})</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Modal Disetor / Modal Pemilik Awal</td>
            <td width="22%" class="text-right">{{ format_rupiah($totalModalDisetorAwal) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>

        @if ($totalLabaDitahanAwal != 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Saldo Laba Ditahan Awal</td>
            <td width="22%" class="text-right">{{ format_rupiah($totalLabaDitahanAwal) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($labaKumulatifAwal != 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Akumulasi Laba (Rugi) Periode Lalu</td>
            <td width="22%" class="text-right">{{ format_rupiah($labaKumulatifAwal) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($totalPriveAwal != 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Prive Pemilik Awal</td>
            <td width="22%" class="text-right">({{ format_rupiah($totalPriveAwal) }})</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        <tr class="total-row">
            <td width="55%">Total Modal Awal</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($modalAwal) }}</td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- II. PENAMBAHAN MODAL --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">II. PENAMBAHAN MODAL</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @if ($labaBersihPeriode > 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Laba Bersih Periode Berjalan</td>
            <td width="22%" class="text-right">{{ format_rupiah($labaBersihPeriode) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($setoranModalPeriode > 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Setoran Modal Tambahan</td>
            <td width="22%" class="text-right">{{ format_rupiah($setoranModalPeriode) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($mutasiModalLainnya > 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Penambahan Ekuitas Lainnya</td>
            <td width="22%" class="text-right">{{ format_rupiah($mutasiModalLainnya) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($totalPenambahan == 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Tidak ada penambahan modal</td>
            <td width="22%" class="text-right">0</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        <tr class="total-row">
            <td width="55%">Total Penambahan</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($totalPenambahan) }}</td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- III. PENGURANGAN MODAL --}}
        {{-- ============================================================ --}}
        <tr class="section-header">
            <td width="55%">III. PENGURANGAN MODAL</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right"></td>
        </tr>

        @if ($labaBersihPeriode < 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Rugi Bersih Periode Berjalan</td>
            <td width="22%" class="text-right">{{ format_rupiah(abs($labaBersihPeriode)) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($privePeriode > 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Prive Pemilik (Pengambilan Pribadi)</td>
            <td width="22%" class="text-right">{{ format_rupiah($privePeriode) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($penarikanModalPeriode > 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Penarikan Modal Pemilik</td>
            <td width="22%" class="text-right">{{ format_rupiah($penarikanModalPeriode) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($mutasiModalLainnya < 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Pengurangan Ekuitas Lainnya</td>
            <td width="22%" class="text-right">{{ format_rupiah(abs($mutasiModalLainnya)) }}</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        @if ($totalPengurangan == 0)
        <tr class="akun-item">
            <td width="55%">&nbsp;&nbsp;&nbsp;&nbsp;Tidak ada pengurangan modal</td>
            <td width="22%" class="text-right">0</td>
            <td width="23%" class="text-right"></td>
        </tr>
        @endif

        <tr class="total-row">
            <td width="55%">Total Pengurangan</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($totalPengurangan) }}</td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- IV. KENAIKAN / PENURUNAN BERSIH MODAL --}}
        {{-- ============================================================ --}}
        <tr class="total-row">
            <td width="55%">KENAIKAN (PENURUNAN) BERSIH MODAL</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">
                @if ($kenaikanBersihModal < 0)
                    ({{ format_rupiah(abs($kenaikanBersihModal)) }})
                @else
                    {{ format_rupiah($kenaikanBersihModal) }}
                @endif
            </td>
        </tr>

        <tr class="separator"><td colspan="3"></td></tr>

        {{-- ============================================================ --}}
        {{-- V. MODAL AKHIR --}}
        {{-- ============================================================ --}}
        <tr class="grand-total">
            <td width="55%">MODAL AKHIR PER {{ Str::upper(tglindonesia($tglakhir)) }}</td>
            <td width="22%" class="text-right"></td>
            <td width="23%" class="text-right">{{ format_rupiah($modalAkhir) }}</td>
        </tr>
    </table>

    {{-- ============================================================ --}}
    {{-- VI. RINCIAN POSISI AKUN EKUITAS / MODAL --}}
    {{-- ============================================================ --}}
    <table style="margin-top:20px;">
        <tr>
            <td style="font-weight:bold; font-size:10px; text-decoration:underline;">
                RINCIAN MUTASI AKUN EKUITAS
            </td>
        </tr>
    </table>

    <table class="tabel-detail" style="margin-top:5px;">
        <thead>
            <tr>
                <th width="15%" class="text-center">Kode Akun</th>
                <th width="35%">Nama Akun</th>
                <th width="16%" class="text-right">Saldo Awal</th>
                <th width="17%" class="text-right">Mutasi Debet</th>
                <th width="17%" class="text-right">Mutasi Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rincianAkunModal as $item)
            <tr>
                <td class="text-center">{{ $item['kdakun'] }}</td>
                <td>{{ $item['namaakun'] }}</td>
                <td class="text-right">{{ format_rupiah($item['saldoAwal']) }}</td>
                <td class="text-right">{{ format_rupiah($item['debetMutasi']) }}</td>
                <td class="text-right">{{ format_rupiah($item['kreditMutasi']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Tanggal Cetak & Tanda Tangan --}}
    <table style="margin-top:30px;">
        <tr>
            <td width="60%"></td>
            <td width="40%" class="text-center">
                {{ session('usaha_kota') ?? 'Medan' }}, {{ tglindonesia(date('Y-m-d')) }}
            </td>
        </tr>
        <tr>
            <td width="60%"></td>
            <td width="40%" class="text-center">
                Pimpinan / Keuangan
            </td>
        </tr>
        <tr>
            <td height="50px"></td>
            <td></td>
        </tr>
        <tr>
            <td width="60%"></td>
            <td width="40%" class="text-center" style="border-bottom:1px solid black; font-weight:bold;">
                ( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )
            </td>
        </tr>
    </table>
</body>

</html>
