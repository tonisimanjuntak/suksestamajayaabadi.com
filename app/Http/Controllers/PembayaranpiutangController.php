<?php

namespace App\Http\Controllers;

use App\Models\Pembayaranpiutang;
use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use TCPDF;

class PembayaranpiutangController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Pembayaranpiutang;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'pembayaranpiutang';
        return view('pembayaranpiutang.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'pembayaranpiutang';
        $data['idpembayaranpiutang'] = "";
        return view('pembayaranpiutang.form', $data);
    }

    public function edit($idpembayaranpiutang)
    {
        try {
            $idpembayaranpiutang = Crypt::decrypt($idpembayaranpiutang);
            $rsPiutang = Pembayaranpiutang::findOrFail($idpembayaranpiutang);
        } catch (ModelNotFoundException $e) {
            return redirect('/piutang')->with('other', 'Data tidak ditemukan!');
        }

        $tglpembayaran = $rsPiutang->tglpembayaran;
        if (App::isPosting($tglpembayaran)) {
            $bulan = bulan(date('m', strtotime($tglpembayaran)));
            $tahun = date('Y', strtotime($tglpembayaran));
            return redirect('/piutang')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran hutang
        if (Pembayaranpiutang::piutangSudahDibayarByidpembayaranpiutang($idpembayaranpiutang)) {
            return redirect('/piutang')->with('other', 'pembayaranpiutang ini sudah dilakukan pembayaran sehingga tidak dapat dirubah lagi!');
        }

        $data['menu'] = 'pembayaranpiutang';
        $data['idpembayaranpiutang'] = $idpembayaranpiutang;
        return view('pembayaranpiutang.form', $data);
    }

    public function detail($idpembayaranpiutang)
    {
        try {
            $idpembayaranpiutang = Crypt::decrypt($idpembayaranpiutang);
            $rsPiutang = Pembayaranpiutang::findOrFail($idpembayaranpiutang);
        } catch (ModelNotFoundException $e) {
            return redirect('/piutang')->with('other', 'Data tidak ditemukan!');
        }
        $rsPiutangDetail = $this->model->getDetailPembayaran($idpembayaranpiutang);

        $sisaPiutang = $rsPiutang->totaldebet - $rsPiutang->totalkredit;

        $data['menu'] = 'pembayaranpiutang';
        $data['idpembayaranpiutang'] = $idpembayaranpiutang;
        $data['rsPiutang'] = $rsPiutang;
        $data['rsPiutangDetail'] = $rsPiutangDetail;
        $data['sisaPiutang'] = $sisaPiutang;
        return view('pembayaranpiutang.detail', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Pembayaranpiutang::select("*");

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idkonsumen = $request->input('idkonsumen');

        $query->whereBetween("tglpembayaran", [$tglawal, $tglakhir]);
        if ($idkonsumen != '' && $idkonsumen != null) {
            $query->where('idkonsumen', $idkonsumen);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpembayaranpiutang', 'LIKE', "%{$search}%")
                    ->orWhere('namakonsumen', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpembayaranpiutang', 'tglpembayaran', 'namakonsumen', 'totaldibayar', 'totalpembayaran', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglpembayaran', 'Desc');
                $query->orderBy('idpembayaranpiutang', 'Desc');
            }
        } else {
            $query->orderBy('tglpembayaran', 'Desc');
            $query->orderBy('idpembayaranpiutang', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Pembayaranpiutang::count();

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
                'idpembayaranpiutang' => $row->idpembayaranpiutang,
                'tgljatuhtempo' => tgldmy($row->tglpembayaran),
                'namakonsumen' => $row->namakonsumen . '<br><i>' . $row->keterangan . '</i>',
                'totaldebet' => format_rupiah($row->totaldibayar),
                'totalkredit' => format_rupiah($row->totalpembayaran),
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pembayaranpiutang/cetakBukuPiutang/' . Crypt::encrypt($row->idpembayaranpiutang)) . '" class="dropdown-item" target="_blank">Cetak Kwitansi</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="' . url('pembayaranpiutang/hapusList/' . Crypt::encrypt($row->idpembayaranpiutang)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pembayaranpiutang/edit/' . Crypt::encrypt($row->idpembayaranpiutang)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpembayaranpiutang = $request->get('modalidpembayaranpiutang');
        $idpembayaranpiutangdetail = $request->get('idpembayaranpiutangdetail');
        $tglpembayaran = $request->get('tglpembayaran');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $nobilyetgiro = $request->get('nobilyetgiro');
        $kredit = untitik($request->get('kredit'));
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglpembayaran)) {
            $bulan = bulan(date('m', strtotime($tglpembayaran)));
            $tahun = date('Y', strtotime($tglpembayaran));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer' && $carabayar != 'Giro') {
            $idbank = null;
        }

        if ($carabayar != 'Giro') {
            $nobilyetgiro = null;
        }



        $idpembayaranpiutangdetail = $this->model->createIDDetail($idpembayaranpiutang);


        $rsPiutang = Pembayaranpiutang::find($idpembayaranpiutang);
        $idpenjualan = $rsPiutang->idpenjualan;
        
        //create kwitansi
        if (!empty($idpenjualan) && $idpenjualan != null) {
            $nokwitansi = Penjualan::createKwitansi($idpenjualan);
        }else{
            $nokwitansi = null;
        }

        if (($rsPiutang->totaldebet - $rsPiutang->totalkredit) < $kredit) {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpembayaranpiutang))->with('fail', 'Jumlah yang dibayar tidak boleh melebihi sisa piutang!');
        }

        $data = array(
            'idpembayaranpiutangdetail' => $idpembayaranpiutangdetail,
            'idpembayaranpiutang' => $idpembayaranpiutang,
            'tglpembayaran' => $tglpembayaran,
            'debet' => 0,
            'kredit' => $kredit,
            'inserted_date' => $inserted_date,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
            'carabayar' => $carabayar,
            'idbank' => $idbank,
            'nobilyetgiro' => $nobilyetgiro,
            'jenis' => 'Pembayaran Piutang',
            'nokwitansi' => $nokwitansi,
        );
        $simpan = $this->model->simpanData($data, $idpembayaranpiutang, $rsPiutang, $nokwitansi);

        if ($simpan['status'] == 'success') {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpembayaranpiutang))->with('success', $simpan['message']);
        } else {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpembayaranpiutang))->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idpembayaranpiutangdetail)
    {
        $idpembayaranpiutangdetail = Crypt::decrypt($idpembayaranpiutangdetail);
        try {
            $rsPiutangDetail = $this->model->getDetailID($idpembayaranpiutangdetail);
        } catch (ModelNotFoundException $e) {
            return redirect('/piutang')->with('other', 'Data tidak ditemukan!');
        }

        $idpembayaranpiutang = $rsPiutangDetail->idpembayaranpiutang;
        $tglpembayaran = $rsPiutangDetail->tglpembayaran;
        if (App::isPosting($tglpembayaran)) {
            $bulan = bulan(date('m', strtotime($tglpembayaran)));
            $tahun = date('Y', strtotime($tglpembayaran));
            return redirect('/piutang/detail/' . Crypt::encrypt($idpembayaranpiutang))->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        if ($this->model->cekPiutangSetelahnya($idpembayaranpiutang, $idpembayaranpiutangdetail)) {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpembayaranpiutang))->with('other', "Tidak boleh menghapus pembayaran ini. Hapus pembayaran harus dilakukan secara berurutan dari yang terakhir terlebih dahulu!");
        }

        $hapus = $this->model->hapusData($idpembayaranpiutang, $idpembayaranpiutangdetail, $rsPiutangDetail);
        if ($hapus['status'] == 'success') {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpembayaranpiutang))->with('success', $hapus['message']);
        } else {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpembayaranpiutang))->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpembayaranpiutang = $request->input('idpembayaranpiutang');
        $rsPiutang = Pembayaranpiutang::find($idpembayaranpiutang);

        $rsDetail = $this->model->getDetail($idpembayaranpiutang);
        return response()->json(array('rsPiutang' => $rsPiutang, 'rsDetail' => $rsDetail));
    }
}
