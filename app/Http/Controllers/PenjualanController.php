<?php

namespace App\Http\Controllers;

use App\Models\Uploads;
use App\Models\Konsumen;
use App\Models\Material;
use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\Piutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use App\Models\Bank;
use App\Models\Returpenjualan;
use App\Models\Sales;

class PenjualanController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Penjualan;
        $this->isLogin();
    }

    public function index()
    {
        $penjualan = $this->model->allView();
        $data['penjualan'] = $penjualan;
        $data['menu'] = 'penjualan';
        return view('penjualan.index', $data);
    }

    public function tambah()
    {
        $rsSales = Sales::getSalesAktif();
        $noinvoice = $this->model->createInvoice();
        $data['menu'] = 'penjualan';
        $data['idpenjualan'] = "";
        $data['noinvoice'] = $noinvoice;
        $data['rsSales'] = $rsSales;
        $data['ppnpersen'] = session('ppn_penjualan');
        return view('penjualan.form', $data);
    }

    public function edit($idpenjualan)
    {
        try {
            $idpenjualan = Crypt::decrypt($idpenjualan);
            $rsPenjualan = Penjualan::findOrFail($idpenjualan);
        } catch (ModelNotFoundException $e) {
            return redirect('/penjualan')->with('other', 'Data tidak ditemukan!');
        }

        $tglinvoice = $rsPenjualan->tglinvoice;
        if (App::isPosting($tglinvoice)) {
            $bulan = bulan(date('m', strtotime($tglinvoice)));
            $tahun = date('Y', strtotime($tglinvoice));
            return redirect('/penjualan')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran piutang
        if (Piutang::piutangSudahDibayar($idpenjualan)) {
            return redirect('/penjualan')->with('other', 'Piutang untuk invoice ini sudah dilakukan pembayaran sehingga tidak dapat dirubah lagi!');
        }

        //cek jika sudah ada retur
        if (Returpenjualan::penjualanSudahDiRetur($idpenjualan)) {
            return redirect('/penjualan')->with('other', 'Penjualan ini sudah di retur, sehingga tidak dapat dirubah lagi!');
        }

        $rsSales = Sales::getSalesAktif();
        $data['menu'] = 'penjualan';
        $data['idpenjualan'] = $idpenjualan;
        $data['noinvoice'] = $rsPenjualan['noinvoice'];
        $data['rsSales'] = $rsSales;
        $data['ppnpersen'] = session('ppn_penjualan');
        return view('penjualan.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Penjualan::select(['idpenjualan', 'tglinvoice', 'namakonsumen', 'keterangan', 'carabayar', 'totalinvoice', 'namasales', 'noinvoice', 'namawilayah']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idkonsumen = $request->input('idkonsumen');
        $carabayar = $request->input('carabayar');

        $query->whereBetween("tglinvoice", [$tglawal, $tglakhir]);
        if ($idkonsumen != '' && $idkonsumen != null) {
            $query->where('idkonsumen', $idkonsumen);
        }
        if (!empty($carabayar)) {
            $query->where('carabayar', $carabayar);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpenjualan', 'LIKE', "%{$search}%")
                    ->orWhere('noinvoice', 'LIKE', "%{$search}%")
                    ->orWhere('namakonsumen', 'LIKE', "%{$search}%")
                    ->orWhere('namasales', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpenjualan', 'tglinvoice', 'namakonsumen', 'keterangan', 'carabayar', 'totalinvoice', 'namasales', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglinvoice', 'Desc');
                $query->orderBy('idpenjualan', 'Desc');
            }
        } else {
            $query->orderBy('tglinvoice', 'Desc');
            $query->orderBy('idpenjualan', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Penjualan::count();

        // Hitung total data setelah filter (jika ada pencarian)
        $totalFiltered = $query->count();

        // Ambil parameter 'length' dan 'start' dari DataTables
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Ambil data dengan limit dan offset
        $rsData = $query->offset($start)
            ->limit($limit)
            ->get();

        // Format data untuk DataTables
        $data = [];
        $no = 1;
        foreach ($rsData as $row) {

            $data[] = [
                'no' => $no++,
                'idpenjualan' => $row->idpenjualan,
                'tglinvoice' => $row->tglinvoice . '<br>' . $row->noinvoice,
                'namakonsumen' => $row->namakonsumen . '<br>(' . $row->namawilayah . ')',
                'carabayar' => $row->carabayar,
                'keterangan' => $row->keterangan,
                'totalinvoice' => format_rupiah($row->totalinvoice),
                'namasales' => $row->namasales . '<br>ID: ' . $row->idpenjualan,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('penjualan/cetakInvoice/' . Crypt::encrypt($row->idpenjualan)) . '" class="dropdown-item" target="_blank">Cetak Invoice</a>
                                        <a href="' . url('penjualan/cetakKwitansi/' . Crypt::encrypt($row->idpenjualan)) . '" class="dropdown-item" target="_blank">Cetak Kwitansi</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="' . url('penjualan/hapus/' . Crypt::encrypt($row->idpenjualan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('penjualan/edit/' . Crypt::encrypt($row->idpenjualan)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }


        // Response untuk DataTables
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function simpanData(Request $request)
    {
        $idpenjualan = $request->get('idpenjualan');
        $noinvoice = $request->get('noinvoice');
        $tglinvoice = $request->get('tglinvoice');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $nobilyetgiro = $request->get('nobilyetgiro');
        $idjenispiutang = $request->get('idjenispiutang');
        $idkonsumen = $request->get('idkonsumen');
        $keterangan = $request->get('keterangan');
        $totaldpp = untitik($request->get('totaldpp'));
        $ppnpersen = $request->get('ppnpersen');
        $totalppn = untitik($request->get('totalppn'));
        $totaldiskon = untitik($request->get('totaldiskon'));
        $biayapengiriman = untitik($request->get('biayapengiriman'));
        $totalinvoice = untitik($request->get('totalinvoice'));


        $idsales = $request->get('idsales');
        $isidatatable = $request->get('isidatatable');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglinvoice)) {
            $bulan = bulan(date('m', strtotime($tglinvoice)));
            $tahun = date('Y', strtotime($tglinvoice));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer' && $carabayar != 'Giro') {
            $idbank = null;
        }

        if ($carabayar != 'Giro') {
            $nobilyetgiro = null;
        }

        if ($carabayar != 'Piutang') {
            $idjenispiutang = null;
        }


        if ($carabayar == 'Piutang') {

            //jika konsumen lewat jatuh tempo maka tidak diijinkan untuk melakukan piutang lagi
            if ($this->model->adaPiutangKadaluarsa($idpenjualan)) {
                return response()->json(array("msg" => "Ada piutang konsumen yang sudah melewati tanggal jatuh tempo! Konsumen tidak dapat membeli lagi dengan cara piutang!"));
            }

            //cek jika limit kredit tidak cukup
            $rsKonsumen = Konsumen::find($idkonsumen);
            $sisakredit = $rsKonsumen->limitkredit - $rsKonsumen->jumlahpiutang;
            if (empty($idpenjualan)) { // tambah data
                if ($totalinvoice > $sisakredit) {
                    return response()->json(array("msg" => "Kredit konsumen tidak mencukupi! Sisa kredit konsumen : Rp." . format_rupiah($sisakredit)));
                }
            } else { // edit data
                $rsPenjualan = Penjualan::find($idpenjualan);
                if (($totalinvoice - $rsPenjualan->totalinvoice) > $sisakredit) {
                    return response()->json(array("msg" => "Kredit konsumen tidak mencukupi! Sisa kredit konsumen : Rp." . format_rupiah($sisakredit)));
                }
            }
        }


        if (empty($idpenjualan)) {

            $idpenjualan = $this->model->createID();
            $nokwitansi = null;
            if ($carabayar != 'Piutang') {
                $nokwitansi = $this->model->createKwitansi($idpenjualan);
            }

            if ($this->model->cekNoInvoice($noinvoice)) {
                return response()->json(array('msg' => 'Data gagal disimpan karena Nomor invoice sudah ada!'));
            }

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpenjualan' => $idpenjualan,
                    'idbarang' => $isidatatable[$i]['idbarang'],
                    'jumlahjual' => untitik($isidatatable[$i]['jumlahjual']),
                    'hargasatuan' => untitik($isidatatable[$i]['hargasatuan']),
                    'hargadpp' => untitik($isidatatable[$i]['hargadpp']),
                    'jumlahppn' => untitik($isidatatable[$i]['jumlahppn']),
                    'jumlahdiskon' => untitik($isidatatable[$i]['jumlahdiskon']),
                    'subtotaljual' => untitik($isidatatable[$i]['subtotaljual']),
                    'jenisdiskon' => $isidatatable[$i]['jenisdiskon'],
                    'diskonpersen1' => $isidatatable[$i]['diskonpersen1'],
                    'diskonpersen2' => $isidatatable[$i]['diskonpersen2'],
                    'diskonpersen3' => $isidatatable[$i]['diskonpersen3'],
                );
            }

            $data = array(
                'idpenjualan' => $idpenjualan,
                'idkonsumen' => $idkonsumen,
                'noinvoice' => $noinvoice,
                'tglinvoice' => $tglinvoice,
                'keterangan' => $keterangan,
                'totaldpp' => $totaldpp,
                'totaldiskon' => $totaldiskon,
                'ppnpersen' => $ppnpersen,
                'totalppn' => $totalppn,
                'totalinvoice' => $totalinvoice,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
                'idjenispiutang' => $idjenispiutang,
                'idsales' => $idsales,
                'nokwitansi' => $nokwitansi,
                'nobilyetgiro' => $nobilyetgiro,
            );


            $simpan = $this->model->simpanData($data, $dataDetail, $idpenjualan, $nokwitansi);
        } else {

            $nokwitansi = null;
            if ($carabayar != 'Piutang') {
                $nokwitansi = $this->model->createKwitansi($idpenjualan);
            }

            //cek jika sudah dilakukan pembayaran piutang
            if (Piutang::piutangSudahDibayar($idpenjualan)) {
                return response()->json(array('msg' => 'Piutang untuk invoice ini sudah dilakukan pembayaran sehingga tidak dapat diubah lagi!'));
            }

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpenjualan' => $idpenjualan,
                    'idbarang' => $isidatatable[$i]['idbarang'],
                    'jumlahjual' => untitik($isidatatable[$i]['jumlahjual']),
                    'hargasatuan' => untitik($isidatatable[$i]['hargasatuan']),
                    'hargadpp' => untitik($isidatatable[$i]['hargadpp']),
                    'jumlahppn' => untitik($isidatatable[$i]['jumlahppn']),
                    'jumlahdiskon' => untitik($isidatatable[$i]['jumlahdiskon']),
                    'subtotaljual' => untitik($isidatatable[$i]['subtotaljual']),
                    'jenisdiskon' => $isidatatable[$i]['jenisdiskon'],
                    'diskonpersen1' => $isidatatable[$i]['diskonpersen1'],
                    'diskonpersen2' => $isidatatable[$i]['diskonpersen2'],
                    'diskonpersen3' => $isidatatable[$i]['diskonpersen3'],
                );
            }

            $data = array(
                'idpenjualan' => $idpenjualan,
                'idkonsumen' => $idkonsumen,
                'noinvoice' => $noinvoice,
                'tglinvoice' => $tglinvoice,
                'keterangan' => $keterangan,
                'totaldpp' => $totaldpp,
                'totaldiskon' => $totaldiskon,
                'ppnpersen' => $ppnpersen,
                'totalppn' => $totalppn,
                'totalinvoice' => $totalinvoice,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
                'idjenispiutang' => $idjenispiutang,
                'idsales' => $idsales,
                'nokwitansi' => $nokwitansi,
                'nobilyetgiro' => $nobilyetgiro,
            );

            $simpan = $this->model->updateData($data, $dataDetail, $idpenjualan, $nokwitansi);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idpenjualan)
    {
        $idpenjualan = Crypt::decrypt($idpenjualan);
        try {
            $rsPenjualan = Penjualan::findOrFail($idpenjualan);
        } catch (ModelNotFoundException $e) {
            return redirect('/penjualan')->with('other', 'Data tidak ditemukan!');
        }

        $tglinvoice = $rsPenjualan->tglinvoice;
        if (App::isPosting($tglinvoice)) {
            $bulan = bulan(date('m', strtotime($tglinvoice)));
            $tahun = date('Y', strtotime($tglinvoice));
            return redirect('/penjualan')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran piutang
        if (Piutang::piutangSudahDibayar($idpenjualan)) {
            return redirect('/penjualan')->with('other', 'Piutang untuk invoice ini sudah dilakukan pembayaran sehingga tidak dapat dihapus lagi!');
        }

        //cek jika sudah ada retur
        if (Returpenjualan::penjualanSudahDiRetur($idpenjualan)) {
            return redirect('/penjualan')->with('other', 'Penjualan ini sudah di retur, sehingga tidak dapat dihapus lagi!');
        }

        $hapus = $this->model->hapusData($idpenjualan, $rsPenjualan);
        if ($hapus['status'] == 'success') {
            return redirect('/penjualan')->with('success', $hapus['message']);
        } else {
            return redirect('/penjualan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpenjualan = $request->input('idpenjualan');
        $rsPenjualan = Penjualan::find($idpenjualan);

        $rsDetail = $this->model->getDetail($idpenjualan);
        return response()->json(array('rsPenjualan' => $rsPenjualan, 'rsDetail' => $rsDetail));
    }

    public function cetakInvoice($idpenjualan)
    {
        $idpenjualan = Crypt::decrypt($idpenjualan);
        $rsPenjualan = Penjualan::findOrFail($idpenjualan);
        $rsDetail = $this->model->getDetail($idpenjualan);

        $tgljatuhtempo = '-';
        if ($rsPenjualan->carabayar == "Piutang") {
            $tgljatuhtempo = tglindonesia(App::createTglJatuhTempo($rsPenjualan->idjenispiutang, $rsPenjualan->tglinvoice));
        }

        $rowKonsumen = Konsumen::find($rsPenjualan->idkonsumen);
        $rowSales = Sales::find($rsPenjualan->idsales);
        $rsBank = Bank::where('statusaktif', 'Aktif')->get();

        $data['idpenjualan'] = $idpenjualan;
        $data['rowPenjualan'] = $rsPenjualan;
        $data['rsDetail'] = $rsDetail;
        $data['rowKonsumen'] = $rowKonsumen;
        $data['rowSales'] = $rowSales;
        $data['rsBank'] = $rsBank;
        $data['tgljatuhtempo'] = $tgljatuhtempo;
        return view('penjualan.cetakInvoice', $data);
    }

    public function cetakKwitansi($idpenjualan)
    {
        $idpenjualan = Crypt::decrypt($idpenjualan);
        $rsPenjualan = Penjualan::findOrFail($idpenjualan);
        $rsDetail = $this->model->getDetail($idpenjualan);

        $rowKwitansi = $this->model->getKwitansiTerakhir($idpenjualan);

        if (!$rowKwitansi) {
            echo 'Belum ada pembayaran...';
            exit();
        }

        $data['idpenjualan'] = $idpenjualan;
        $data['rowPenjualan'] = $rsPenjualan;
        $data['rsDetail'] = $rsDetail;
        $data['rowKwitansi'] = $rowKwitansi;
        return view('penjualan.cetakKwitansi', $data);
    }

    public function searchInvoice(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Penjualan::where('noinvoice', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpenjualan,
                'text' => $item->tglinvoice . ' || No Invoice: ' . $item->noinvoice,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchInvoicePiutang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Penjualan::where('noinvoice', 'LIKE', "%{$search}%")
            ->where('carabayar', 'Piutang')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpenjualan,
                'text' => $item->tglinvoice . ' || No Invoice: ' . $item->noinvoice,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
