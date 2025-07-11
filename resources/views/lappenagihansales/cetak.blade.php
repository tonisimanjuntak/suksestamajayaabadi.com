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
            font-size: 15px;
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
        <div class="nama-laporan">LAPORAN PENAGIHAN</div>
    </div>

    <div class="content">

        
        <table border="0" cellpadding="2" width="100%">
            <thead>
                <tr style="font-size: 8px; font-weight: bold;">
                    <th width="5%" class="add-border-top add-border-bottom" style="text-align:center;">NO</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:left;">NAMA SALES</th>
                    <th width="14%" class="add-border-top add-border-bottom" style="text-align:left;">NAMA KONSUMEN</th>
                    <th width="10%" class="add-border-top add-border-bottom" style="text-align:center;">No INVOICE</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:center;">TANGGAL<br>INVOICE</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:center;">JATUH<br>TEMPO</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:right;">TOTAL INVOICE</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:right;">LANCAR</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:right;"> > 90 Hari</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:right;">BAD</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:center;">SISA UMUR</th>
                    <th width="8%" class="add-border-top add-border-bottom" style="text-align:center;">KET</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $no = 1;
                    $idkonsumen_old = '';

                @endphp


                @if (count($rsPenagihan) == 0)
                    <tr style="font-size:9px;">
                        <td width="100%" style="text-align:center;" colspan="10">Data tidak
                            ditemukan...</td>
                    </tr>
                @else

                    @foreach ($rsPenagihan as $row)

                        @php
                            if ($idkonsumen_old != $row->idkonsumen) {
                                $namakonsumen = $row->namakonsumen;
                            }else{
                                $namakonsumen = '';
                            }
                            $idkonsumen_old = $row->idkonsumen;
                        @endphp
                        <tr style="font-size: 8px;">
                            <td width="5%" style="text-align:center;">{{ $no++ }}</td>
                            <td width="8%" style="text-align:left;">{{ $row->namasales }}</td>
                            <td width="14%" style="text-align:left;">{{ $row->namakonsumen }}</td>
                            <td width="10%" style="text-align:center;">{{ $row->noinvoice }}</td>
                            <td width="8%" style="text-align:center;">{{ tgldmy($row->tglinvoice) }}</td>
                            <td width="8%" style="text-align:center;">{{ tgldmy($row->tgljatuhtempo) }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->totalinvoice) }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->jumlahlancar) }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->jumlahlebih90hari) }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->jumlahlebih150hari) }}</td>
                            <td width="8%" style="text-align:center; {{ ($row->sisaumur < 0) ? 'color: red;' : '' }}">{{ $row->sisaumur. ' hari' }}</td>
                            <td width="8%" style="text-align:center;">{{ (!empty($row->tgllunas) ? 'Lunas' : '') }}</td>
                        </tr>
                    @endforeach


                @endif

                
            </tbody>
        </table>
    </div>
</body>

</html>
