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
        $this->model = new Piutang;
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
        $data['idpiutang'] = "";
        return view('pembayaranpiutang.form', $data);
    }

    public function edit($idpiutang)
    {
        try {
            $idpiutang = Crypt::decrypt($idpiutang);
            $rsPiutang = Piutang::findOrFail($idpiutang);
        } catch (ModelNotFoundException $e) {
            return redirect('/piutang')->with('other', 'Data tidak ditemukan!');
        }

        $tglpiutang = $rsPiutang->tglpiutang;
        if (App::isPosting($tglpiutang)) {
            $bulan = bulan(date('m', strtotime($tglpiutang)));
            $tahun = date('Y', strtotime($tglpiutang));
            return redirect('/piutang')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran hutang
        if (Piutang::piutangSudahDibayarByIdPiutang($idpiutang)) {
            return redirect('/piutang')->with('other', 'pembayaranpiutang ini sudah dilakukan pembayaran sehingga tidak dapat dirubah lagi!');
        }

        $data['menu'] = 'pembayaranpiutang';
        $data['idpiutang'] = $idpiutang;
        return view('pembayaranpiutang.form', $data);
    }

    public function detail($idpiutang)
    {
        try {
            $idpiutang = Crypt::decrypt($idpiutang);
            $rsPiutang = Piutang::findOrFail($idpiutang);
        } catch (ModelNotFoundException $e) {
            return redirect('/piutang')->with('other', 'Data tidak ditemukan!');
        }
        $rsPiutangDetail = $this->model->getDetailPembayaran($idpiutang);

        $sisaPiutang = $rsPiutang->totaldebet - $rsPiutang->totalkredit;

        $data['menu'] = 'pembayaranpiutang';
        $data['idpiutang'] = $idpiutang;
        $data['rsPiutang'] = $rsPiutang;
        $data['rsPiutangDetail'] = $rsPiutangDetail;
        $data['sisaPiutang'] = $sisaPiutang;
        return view('pembayaranpiutang.detail', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Piutang::select(['idpiutang', 'tglpiutang', 'tgljatuhtempo', 'namakonsumen', 'totaldebet', 'totalkredit', 'noinvoice', 'namajenispiutang', 'jatuhtempo', 'jenissumber', 'keterangan']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idkonsumen = $request->input('idkonsumen');
        $statusbayar = $request->input('statusbayar');

        $query->whereBetween("tglpiutang", [$tglawal, $tglakhir]);
        if ($idkonsumen != '' && $idkonsumen != null) {
            $query->where('idkonsumen', $idkonsumen);
        }

        if (!empty($statusbayar)) {
            if ($statusbayar == 'Belum Lunas') {
                $query->whereRaw('totaldebet > totalkredit');
            } else {
                $query->whereRaw('totaldebet <= totalkredit');
            }
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpiutang', 'LIKE', "%{$search}%")
                    ->orWhere('noinvoice', 'LIKE', "%{$search}%")
                    ->orWhere('namakonsumen', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpiutang', 'noinvoice', 'tgljatuhtempo', 'namakonsumen', 'totaldebet', 'totalkredit', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglpiutang', 'Desc');
                $query->orderBy('idpiutang', 'Desc');
            }
        } else {
            $query->orderBy('tglpiutang', 'Desc');
            $query->orderBy('idpiutang', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Piutang::count();

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

            if ($row->totaldebet <= $row->totalkredit) {
                $statuslunas = '<span class="badge badge-success">Lunas</span>';
            } else {
                $statuslunas = '<span class="badge badge-danger">Belum Lunas</span>';
            }

            if ($row->jenissumber == 'Penjualan') {
                $btnAksi = '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pembayaranpiutang/cetakBukuPiutang/' . Crypt::encrypt($row->idpiutang)) . '" class="dropdown-item" target="_blank">Cetak Buku Hutang</a>
                                    </div>
                                </div>
                                <a href="' . url('pembayaranpiutang/detail/' . Crypt::encrypt($row->idpiutang)) . '" class="btn btn-primary">Bayar</a>                                
                            </div>';
            } else {
                $btnAksi = '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pembayaranpiutang/cetakBukuPiutang/' . Crypt::encrypt($row->idpiutang)) . '" class="dropdown-item" target="_blank">Cetak Buku Hutang</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="' . url('pembayaranpiutang/edit/' . Crypt::encrypt($row->idpiutang)) . '" class="dropdown-item">Edit</a>
                                        <a href="' . url('pembayaranpiutang/hapusList/' . Crypt::encrypt($row->idpiutang)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pembayaranpiutang/detail/' . Crypt::encrypt($row->idpiutang)) . '" class="btn btn-primary">Bayar</a>                                
                            </div>';
            }

            $data[] = [
                'no' => $no++,
                'idpiutang' => $row->idpiutang . '<br>' . tgldmy($row->tglpiutang),
                'noinvoice' => (!empty($row->noinvoice) ? $row->noinvoice : '-'),
                'tgljatuhtempo' => tgldmy($row->tgljatuhtempo) . '<br>' . $row->namajenispiutang . ' (' . $row->jatuhtempo . ' hari)',
                'namakonsumen' => $row->namakonsumen . '<br><i>' . $row->keterangan . '</i>',
                'totaldebet' => format_rupiah($row->totaldebet),
                'totalkredit' => format_rupiah($row->totalkredit),
                'statuslunas' => $statuslunas,
                'action' => $btnAksi,

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
        $idpiutang = $request->get('modalidpiutang');
        $idpiutangdetail = $request->get('idpiutangdetail');
        $tglpiutang = $request->get('tglpiutang');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $nobilyetgiro = $request->get('nobilyetgiro');
        $kredit = untitik($request->get('kredit'));
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglpiutang)) {
            $bulan = bulan(date('m', strtotime($tglpiutang)));
            $tahun = date('Y', strtotime($tglpiutang));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer' && $carabayar != 'Giro') {
            $idbank = null;
        }

        if ($carabayar != 'Giro') {
            $nobilyetgiro = null;
        }



        $idpiutangdetail = $this->model->createIDDetail($idpiutang);


        $rsPiutang = Piutang::find($idpiutang);
        $idpenjualan = $rsPiutang->idpenjualan;
        
        //create kwitansi
        if (!empty($idpenjualan) && $idpenjualan != null) {
            $nokwitansi = Penjualan::createKwitansi($idpenjualan);
        }else{
            $nokwitansi = null;
        }

        if (($rsPiutang->totaldebet - $rsPiutang->totalkredit) < $kredit) {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpiutang))->with('fail', 'Jumlah yang dibayar tidak boleh melebihi sisa piutang!');
        }

        $data = array(
            'idpiutangdetail' => $idpiutangdetail,
            'idpiutang' => $idpiutang,
            'tglpiutang' => $tglpiutang,
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
        $simpan = $this->model->simpanData($data, $idpiutang, $rsPiutang, $nokwitansi);

        if ($simpan['status'] == 'success') {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpiutang))->with('success', $simpan['message']);
        } else {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpiutang))->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idpiutangdetail)
    {
        $idpiutangdetail = Crypt::decrypt($idpiutangdetail);
        try {
            $rsPiutangDetail = $this->model->getDetailID($idpiutangdetail);
        } catch (ModelNotFoundException $e) {
            return redirect('/piutang')->with('other', 'Data tidak ditemukan!');
        }

        $idpiutang = $rsPiutangDetail->idpiutang;
        $tglpiutang = $rsPiutangDetail->tglpiutang;
        if (App::isPosting($tglpiutang)) {
            $bulan = bulan(date('m', strtotime($tglpiutang)));
            $tahun = date('Y', strtotime($tglpiutang));
            return redirect('/piutang/detail/' . Crypt::encrypt($idpiutang))->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        if ($this->model->cekPiutangSetelahnya($idpiutang, $idpiutangdetail)) {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpiutang))->with('other', "Tidak boleh menghapus pembayaran ini. Hapus pembayaran harus dilakukan secara berurutan dari yang terakhir terlebih dahulu!");
        }

        $hapus = $this->model->hapusData($idpiutang, $idpiutangdetail, $rsPiutangDetail);
        if ($hapus['status'] == 'success') {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpiutang))->with('success', $hapus['message']);
        } else {
            return redirect('/piutang/detail/' . Crypt::encrypt($idpiutang))->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpiutang = $request->input('idpiutang');
        $rsPiutang = Piutang::find($idpiutang);

        $rsDetail = $this->model->getDetail($idpiutang);
        return response()->json(array('rsPiutang' => $rsPiutang, 'rsDetail' => $rsDetail));
    }
}
