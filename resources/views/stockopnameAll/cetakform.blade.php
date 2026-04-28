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
                <th style="width: 90%; font-size: 15px; text-align: left; padding-right: 50px;" colspan="6">{{ session('usaha_nama') }}</th>
            </tr>
            <tr>
                <th style="font-size: 10px; text-align: left;" colspan="6">{{ session('usaha_alamat') }}</th>
            </tr>
            <tr>
                <th class="" style="font-size: 10px; text-align: left;" colspan="6">No Telepon. {{ session('usaha_telepon') }}
                </th>
            </tr>
        </thead>
    </table>

    <div class="judullaporan">
        <div class="nama-laporan">FORM STOK OPNAME</div>
        <div class="periode-laporan">TANGGAL {{ tgldatetime(date('Y-m-d H:i:s')) }}</div>
    </div>

    <div class="content">
        <table border="1" cellpadding="10" width="100%">
            <thead class="">
                <tr style="font-size: 9px; font-weight: bold;">
                    <th style="width: 10%; text-align: center;">NO</th>
                    <th style="width: 15%; text-align: center;">ID BARANG</th>
                    <th style="width: 45%; text-align: left;">NAMA BARANG</th>
                    <th style="width: 15%; text-align: center;">STOK SYSTEM</th>
                    <th style="width: 15%; text-align: center;">STOK REAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp

                @if (count($rsBarang) > 0)
                @php
                    $idkategori_old = '';
                @endphp

                @foreach ($rsBarang as $p)

                
                @if ($idkategori_old != $p->idkategori)

                <tr style="font-size: 10px; font-weight: bold;">
                    <td style="width: 100%; text-align: left;" colspan="5">{{ $p->namakategori }}</td>
                </tr>                    
                
                @endif
                    
                
                <tr style="font-size: 9px;">
                    <td style="width: 10%; text-align: center;">{{ $no++ }}</td>
                    <td style="width: 15%; text-align: center;">{{ $p->idbarang }}</td>
                    <td style="width: 45%; text-align: left;">
                        {{ $p->namabarang }}
                    </td>
                    <td style="width: 15%; text-align: center;">{{ $p->stok }}</td>
                    <td style="width: 15%; text-align: right;"></td>
                </tr>

                @php   
                    $idkategori_old = $p->idkategori; 
                @endphp
                @endforeach

                @else
                <tr style="font-size: 9px;">
                    <td style="width: 100%; text-align: center;" colspan="5">Data tidak ditemukan...</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>