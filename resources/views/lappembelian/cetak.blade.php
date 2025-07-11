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
        <div class="nama-laporan">LAPORAN PEMBELIAN</div>
        <div class="periode-laporan">PERIODE {{ Str::upper(tglindonesia($tglawal)) }} S/D {{ Str::upper(tglindonesia($tglakhir)) }}</div>
    </div>

    <div class="content">
        <table border="0" cellpadding="5" width="100%">
            <thead>
                <tr style="font-size:9px; font-weight: bold;">
                    <th width="5%" style="text-align:center;" class="add-border-top add-border-bottom">NO</th>
                    <th width="10%" style="text-align:center;" class="add-border-top add-border-bottom">NO FAKTUR/<br>TANGGAL</th>
                    <th width="10%" style="text-align:center;" class="add-border-top add-border-bottom">TANGGAL<br>DITERIMA</th>
                    <th width="22%" style="text-align:left;" class="add-border-top add-border-bottom">KETERANGAN</th>
                    <th width="5%" style="text-align:center;" class="add-border-top add-border-bottom">QTY</th>
                    <th width="8%" style="text-align:right;" class="add-border-top add-border-bottom">HARGA BELI</th>
                    <th width="8%" style="text-align:right;" class="add-border-top add-border-bottom">DPP</th>
                    <th width="8%" style="text-align:right;" class="add-border-top add-border-bottom">PPN</th>
                    <th width="8%" style="text-align:right;" class="add-border-top add-border-bottom">DISKON</th>
                    <th width="8%" style="text-align:right;" class="add-border-top add-border-bottom">POTO-<br>NGAN</th>
                    <th width="8%" style="text-align:right;" class="add-border-top add-border-bottom">SUB TOTAL</th>                    
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp

                @if (count($rsPembelian) == 0)
                    <tr>
                        <td width="100%" style="font-size:10px; text-align:center;" colspan="6">Data tidak
                            ditemukan...</td>
                    </tr>
                @else
                @php
                    $totalhargasatuan = 0;
                    $totalhargadpp = 0;
                    $totaljumlahppn = 0;
                    $totaljumlahdiskon = 0;
                    $totalsubtotalbeli = 0;
                    $idpembelian_old = '';
                    $totalpotongan_old = 0;
                    $totalpotongan = 0;
                
                    $subtotalhargasatuan = 0;
                    $subtotalhargadpp = 0;
                    $subtotaljumlahppn =0;
                    $subtotaljumlahdiskon = 0;
                    $subtotalsubtotalbeli = 0;

                @endphp

                    @foreach ($rsPembelian as $row)

                        @if ($idpembelian_old != $row->idpembelian)
                            @php
                                $totalpotongan += $row->totalpotongan;                                
                            @endphp

                            @if ($no > 1)

                                <tr style="font-size:9px; font-weight: bold;">
                                    <td width="25%" style="text-align:center;" class="" colspan="3"></td>
                                    <td width="27%" style="text-align:right;" class="add-border-top" colspan="2">Sub Total</td>
                                    <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotalhargasatuan) }}</td> 
                                    <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotalhargadpp) }}</td> 
                                    <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotaljumlahppn) }}</td> 
                                    <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotaljumlahdiskon) }}</td>
                                    <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($totalpotongan_old) }}</td> 
                                    <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotalsubtotalbeli - $totalpotongan_old) }}</td> 
                                </tr>
                                @php
                                    $subtotalhargasatuan = 0;
                                    $subtotalhargadpp = 0;
                                    $subtotaljumlahppn =0;
                                    $subtotaljumlahdiskon = 0;
                                    $subtotalsubtotalbeli = 0;
                                @endphp                            
                            @endif

                            <tr style="font-size:9px;">
                                <td width="5%" style="text-align:center;" class="add-border-top">{{ $no++}}</td>
                                <td width="10%" style="text-align:center;" class="add-border-top">{{ $row->nofaktur }}<br>{{ tgldmy($row->tglfaktur) }}</td>
                                <td width="10%" style="text-align:center;" class="add-border-top">{{ tgldmy($row->tglditerima) }}</td>
                                <td width="22%" style="text-align:left;" class="add-border-top">{{ $row->keterangan }}</td>
                                <td width="5%" style="text-align:center;" class="add-border-top"></td>
                                <td width="8%" style="text-align:right;" class="add-border-top"></td>
                                <td width="8%" style="text-align:right;" class="add-border-top"></td>
                                <td width="8%" style="text-align:right;" class="add-border-top"></td>
                                <td width="8%" style="text-align:right;" class="add-border-top"></td>
                                <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($row->totalpotongan) }}</td>
                                <td width="8%" style="text-align:right;" class="add-border-top"></td>
                            </tr>  

                            
                        @endif
                    
                            

                        <tr style="font-size:9px;">
                            <td width="5%" style="text-align:center;"></td>
                            <td width="10%" style="text-align:center;"></td>
                            <td width="10%" style="text-align:center;"></td>
                            <td width="22%" style="text-align:left;">{{ $row->namabarang }}</td>
                            <td width="5%" style="text-align:center;">{{ $row->jumlahbeli }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->hargasatuan) }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->hargadpp) }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->jumlahppn) }}</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->jumlahdiskon) }}</td>
                            <td width="8%" style="text-align:right;">0</td>
                            <td width="8%" style="text-align:right;">{{ format_rupiah($row->subtotalbeli) }}</td> 
                        </tr>

                        @php
                            $totalhargasatuan += $row->hargasatuan;
                            $totalhargadpp += $row->hargadpp;
                            $totaljumlahppn += $row->jumlahppn;
                            $totaljumlahdiskon += $row->jumlahdiskon;
                            $totalsubtotalbeli += $row->subtotalbeli;
                            $idpembelian_old = $row->idpembelian;
                            $totalpotongan_old = $row->totalpotongan;

                            $subtotalhargasatuan += $row->hargasatuan;
                            $subtotalhargadpp += $row->hargadpp;
                            $subtotaljumlahppn += $row->jumlahppn;
                            $subtotaljumlahdiskon += $row->jumlahdiskon;
                            $subtotalsubtotalbeli += $row->subtotalbeli;

                        @endphp                         

                    @endforeach

                    @if ($no > 1)
                        
                        <tr style="font-size:9px; font-weight: bold;">
                            <td width="25%" style="text-align:center;" class="" colspan="3"></td>
                            <td width="27%" style="text-align:right;" class="add-border-top" colspan="2">Sub Total</td>
                            <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotalhargasatuan) }}</td> 
                            <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotalhargadpp) }}</td> 
                            <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotaljumlahppn) }}</td> 
                            <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotaljumlahdiskon) }}</td> 
                            <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($totalpotongan_old) }}</td> 
                            <td width="8%" style="text-align:right;" class="add-border-top">{{ format_rupiah($subtotalsubtotalbeli - $totalpotongan_old) }}</td> 
                        </tr>

                        <tr style="font-size:11px; font-weight: bold;">
                            <td width="100%" style="text-align:center;" colspan="11"></td>
                        </tr>

                        <tr style="font-size:9px; font-weight: bold;">
                            <td width="52%" style="text-align:center;" class="add-border-top add-border-bottom" colspan="5">T O T A L</td>
                            <td width="8%" style="text-align:right;" class="add-border-top add-border-bottom" colspan="2">{{ format_rupiah($totalhargasatuan) }}</td>
                            <td width="8%" style="text-align:right;" class="add-border-top add-border-bottom" colspan="2">{{ format_rupiah($totalhargadpp) }}</td>
                            <td width="8%" style="text-align:right;" class="add-border-top add-border-bottom" colspan="2">{{ format_rupiah($totaljumlahppn) }}</td>
                            <td width="8%" style="text-align:right;" class="add-border-top add-border-bottom" colspan="2">{{ format_rupiah($totaljumlahdiskon) }}</td>
                            <td width="8%" style="text-align:right;" class="add-border-top add-border-bottom" colspan="2">{{ format_rupiah($totalpotongan) }}</td>
                            <td width="8%" style="text-align:right;" class="add-border-top add-border-bottom" colspan="2">{{ format_rupiah($totalsubtotalbeli - $totalpotongan) }}</td> 
                        </tr>
                        
                        
                    @endif

                    

                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
