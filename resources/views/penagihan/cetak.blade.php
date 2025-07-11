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
        <div class="nama-laporan">PENAGIHAN SALES</div>
    </div>

    <div class="content">

        <table>
            <thead>
                <tr style="font-size: 12px; font-weight: bold;">
                    <th style="width: 20%; text-align: left;">Nama Sales</th>
                    <th style="width: 5%; text-align: center;">:</th>                
                    <th style="width: 75%; text-align: left;">{{ $rsSales->namasales}}</th>                
                </tr>
                <tr style="font-size: 12px; font-weight: bold;">
                    <th style="width: 20%; text-align: left;">NPWP</th>
                    <th style="width: 5%; text-align: center;">:</th>                
                    <th style="width: 75%; text-align: left;">{{ $rsSales->npwp}}</th>                
                </tr>
                <tr style="font-size: 12px; font-weight: bold;">
                    <th style="width: 20%; text-align: left;">Tanggal Penagihan</th>
                    <th style="width: 5%; text-align: center;">:</th>                
                    <th style="width: 75%; text-align: left;">{{ tglindonesia($rsPenagihan->tglpenagihan) }}</th>                
                </tr>
            </thead>
        </table>
        <div style="display: block; margin-top: 30px; margin-bottom: 30px;"></div>

        <table border="1" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 9px; font-weight: bold;">
                    <th width="5%" style="text-align:center;">NO</th>
                    <th width="10%" style="text-align:center;">NO INVOICE</th>
                    <th width="25%" style="text-align:center;">NAMA KONSUMEN</th>
                    <th width="10%" style="text-align:center;">TGL PIUTANG</th>
                    <th width="10%" style="text-align:center;">JATUH TEMPO</th>
                    <th width="10%" style="text-align:center;">TOTAL PIUTANG</th>
                    <th width="10%" style="text-align:center;">SUDAH DIBAYAR</th>
                    <th width="10%" style="text-align:center;">SISA PEMBAYARAN</th>
                    <th width="10%" style="text-align:center;">KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp

                    @if (count($rsDetail) == 0)
                        <tr style="font-size:9px;">
                            <td width="100%" style="text-align:center;" colspan="10">Data tidak
                                ditemukan...</td>
                        </tr>
                    @else

                        @foreach ($rsDetail as $row)
                            
    
                            <tr style="font-size: 9px;">
                                <th width="5%" style="text-align:center;">{{ $no++ }}</th>
                                <th width="10%" style="text-align:center;">{{ $row->noinvoice }}</th>
                                <th width="25%" style="text-align:left;">{{ $row->namakonsumen }}</th>
                                <th width="10%" style="text-align:center;">{{ tgldmy($row->tglpiutang) }}</th>
                                <th width="10%" style="text-align:center;">{{ tgldmy($row->tgljatuhtempo) }}</th>
                                <th width="10%" style="text-align:right;">{{ format_rupiah($row->totaldebet) }}</th>
                                <th width="10%" style="text-align:right;">{{ format_rupiah($row->totaldebet - $row->jumlahtagihan) }}</th>
                                <th width="10%" style="text-align:right;">{{ format_rupiah($row->jumlahtagihan) }}</th>
                                <th width="10%" style="text-align:center;"></th>
                            </tr>
                        @endforeach
                    @endif
            </tbody>
        </table>
    </div>
</body>

</html>
