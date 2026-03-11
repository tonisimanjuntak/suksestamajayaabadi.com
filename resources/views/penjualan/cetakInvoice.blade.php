<style>
    body {
        margin: 0;
        padding: 0;
    }

    table {
        margin: 0;
        padding: 0;
        border-collapse: collapse;
    }

    td,
    th {
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .fs-8 {
        font-size: 8px;
    }

    .fs-9 {
        font-size: 9px;
    }

    .fs-10 {
        font-size: 10px;
    }

    .fs-11 {
        font-size: 11px;
    }

    .fs-12 {
        font-size: 12px;
    }

    .fs-13 {
        font-size: 13px;
    }

    .fs-14 {
        font-size: 14px;
    }

    .fs-15 {
        font-size: 15px;
    }

    .fs-16 {
        font-size: 16px;
    }

    .fs-17 {
        font-size: 17px;
    }

    .fs-18 {
        font-size: 18px;
    }

    .mt-1 {
        margin-top: 10px;
    }

    .mt-2 {
        margin-top: 20px;
    }

    .mt-3 {
        margin-top: 30px;
    }

    .mt-4 {
        margin-top: 40px;
    }

    .mt-5 {
        margin-top: 50px;
    }

    .font-weight-bold {
        font-weight: bold;
    }
</style>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td width="35%">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="fs-10 font-weight-bold">{{ session()->get('usaha_nama') }}</td>
                </tr>
                <tr>
                    <td class="fs-8">{{ session()->get('usaha_alamat') }} No Telepon. {{
                        session()->get('usaha_telepon')}}
                    </td>
                </tr>
            </table>
        </td>
        <td width="35%" align="center">
            <span class="fs-16 font-weight-bold">I N V O I C E</span><br>
            <span class="fs-12 font-weight-bold">No. {{ $rowPenjualan->noinvoice }}</span>
        </td>
        <td width="30%">
            <table width="100%" cellpadding="0">
                <tr>
                    <td width="50%">Tgl. Invoice</td>
                    <td width="5%">:</td>
                    <td width="45%">{{ tglindonesia($rowPenjualan->tglinvoice) }}</td>
                </tr>
                @if ($rowPenjualan->carabayar == 'Piutang')
                <tr>
                    <td>Jenis Piutang</td>
                    <td>:</td>
                    <td>{{ $rowPenjualan->namajenispiutang }}</td>
                </tr>
                <tr>
                    <td>Jatuh Tempo</td>
                    <td>:</td>
                    <td>{{ tglindonesia($tgljatuhtempo) }}</td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>

<div style="font-size: 5px;">&nbsp;</div>

<table width="100%">
    <tr>
        <td width="70%">
            <table border="0" cellpadding="0">
                <tbody>
                    <tr class="fs-10 font-weight-bold">
                        <td colspan="3" width="100%">Kepada: {{ $rowKonsumen->namakonsumen }}</td>
                    </tr>
                    <tr class="fs-10">
                        <td width="25%">Alamat</td>
                        <td width="5%" align="center">:</td>
                        <td width="70%">{{ $rowKonsumen->alamatkonsumen }}</td>
                    </tr>
                    <tr class="fs-10">
                        <td>No. Telp/ Email</td>
                        <td align="center">:</td>
                        <td>{{ $rowKonsumen->notelpkonsumen . ' / ' . $rowKonsumen->emailkonsumen }}</td>
                    </tr>
                </tbody>
            </table>
        </td>
        <td width="30%">
            <table cellpadding="0" border="0" width="100%">
                <tbody>
                    <tr class="fs-10">
                        <td width="100%" align="left">Sales : {{ $rowSales->namasales }}</td>
                    </tr>
                    <tr class="fs-10">
                        <td width="100%" align="left">No. HP : {{ $rowSales->nowa }}</td>
                    </tr>
                </tbody>
            </table>

        </td>



    </tr>

    @if ($rsBank)

    <tr>
        <td width="100%" colspan="2">
            <br>
            <br>
            {{ $rsBank->namabank .' No Rek. '. $rsBank->norekening . ' An. '.$rsBank->atasnama }} .
            &nbsp;
        </td>
    </tr>
    @else
    <tr>
        <td width="100%" colspan="2">
            <br>
            <br>
            &nbsp;
        </td>
    </tr>
    @endif
</table>

<table width="100%">
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<table border="1" cellpadding="3" width="100%">
    <thead>
        <tr class="fs-10">
            <th width="7%" align="center">NO</th>
            <th width="38%" align="center">Nama Barang</th>
            <th width="10%" align="center">Qty</th>
            <th width="15%" align="center">Harga Satuan</th>
            <th width="15%" align="center">Discount</th>
            <th width="15%" align="center">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @php
        $no = 1;
        @endphp
        @foreach ($rsDetail as $row)
        <tr class="fs-12">
            <td width="7%" align="center">{{ $no++ }}</td>
            <td width="38%" align="left">{{ $row->namabarang }}</td>
            <td width="10%" align="center">{{ $row->jumlahjual }}</td>
            <td width="15%" align="right">
                @php
                echo $row->hargasatuan > 0 ? format_rupiah($row->hargasatuan) : '-';
                @endphp
            </td>
            <td width="15%" align="right">
                @php
                echo $row->jumlahdiskon > 0 ? format_rupiah($row->jumlahdiskon) : '-';
                @endphp
            </td>
            <td width="15%" align="right">{{ format_rupiah($row->subtotaljual) }}</td>
        </tr>
        @endforeach

        @if ($no < 4) @for ($i=$no; $i <=4; $i++) <tr>
            <td align="center">&nbsp;</td>
            <td align="left"></td>
            <td align="center"></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
            </tr>
            @endfor
            @endif


            <tr class="fs-10">
                <td colspan="3" rowspan="3" align="left">
                    <span class="terbilang"><strong>TERBILANG: </strong> {{
                        terbilang($rowPenjualan->totalinvoice) }} rupiah</span>
                </td>
                <td colspan="2" align="right" class="font-weight-bold">JUMLAH DPP</td>
                <td align="right" class="font-weight-bold">{{ format_rupiah($rowPenjualan->totaldpp) }}
                </td>
            </tr>
            <tr class="fs-10">
                <td colspan="2" align="right" class="font-weight-bold">PPN ({{$rowPenjualan->ppnpersen}}%)
                </td>
                <td align="right" class="font-weight-bold">{{ format_rupiah($rowPenjualan->totalppn) }}
                </td>
            </tr>

            <tr class="fs-10 font-weight-bold">
                <td colspan="2" align="right">TOTAL INVOICE</td>
                <td align="right">{{ format_rupiah($rowPenjualan->totalinvoice)
                    }}</td>
            </tr>
    </tbody>
</table>

<table width="100%">
    <tr>
        <td height="10">&nbsp;</td>
    </tr>
</table>

<table width="100%" style="margin-top: 30px;">
    <tr class="fs-10">
        <td width="33%" align="center">Tanda Terima</td>
        <td width="33%" align="center">Driver/Supir</td>
        <td width="33%" align="center">Gudang</td>
    </tr>
    <tr>
        <td height="20"></td>
        <td height="20"></td>
        <td height="20"></td>
    </tr>
    <tr>
        <td align="center">({!! str_repeat('&nbsp;', 30) !!})</td>
        <td align="center">({!! str_repeat('&nbsp;', 30) !!})</td>
        <td align="center">({!! str_repeat('&nbsp;', 30) !!})</td>
    </tr>
</table>