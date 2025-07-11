<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class PenerimaanController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Penerimaan;
        $this->isLogin();
    }

    public function index()
    {
        $penerimaan = $this->model->allView();
        $data['penerimaan'] = $penerimaan;
        $data['menu'] = 'penerimaan';
        return view('penerimaan.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'penerimaan';
        $data['idpenerimaan'] = "";
        return view('penerimaan.form', $data);
    }

    public function edit($idpenerimaan)
    {
        try {
            $idpenerimaan = Crypt::decrypt($idpenerimaan);
            $rsPenerimaan = Penerimaan::findOrFail($idpenerimaan);
        } catch (ModelNotFoundException $e) {
            return redirect('/penerimaan')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'penerimaan';
        $data['idpenerimaan'] = $idpenerimaan;
        return view('penerimaan.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Penerimaan::select(['idpenerimaan', 'tglpenerimaan', 'keterangan', 'carabayar', 'totalpenerimaan', 'namapengguna']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $carabayar = $request->input('carabayar');

        $query->whereBetween("tglpenerimaan", [$tglawal, $tglakhir]);
        if (!empty($carabayar)) {
            $query->where('carabayar', $carabayar);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpenerimaan', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpenerimaan', 'tglpenerimaan', 'keterangan', 'carabayar', 'totalpenerimaan', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglpenerimaan', 'Desc');
                $query->orderBy('idpenerimaan', 'Desc');
            }
        } else {
            $query->orderBy('tglpenerimaan', 'Desc');
            $query->orderBy('idpenerimaan', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Penerimaan::count();

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
                'idpenerimaan' => $row->idpenerimaan,
                'tglpenerimaan' => $row->tglpenerimaan,
                'keterangan' => $row->keterangan,
                'carabayar' => $row->carabayar,
                'totalpenerimaan' => format_rupiah($row->totalpenerimaan),
                'namapengguna' => $row->namapengguna,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('penerimaan/hapus/' . Crypt::encrypt($row->idpenerimaan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('penerimaan/edit/' . Crypt::encrypt($row->idpenerimaan)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpenerimaan = $request->get('idpenerimaan');
        $tglpenerimaan = $request->get('tglpenerimaan');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $keterangan = $request->get('keterangan');
        $isidatatable = $request->get('isidatatable');

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglpenerimaan)) {
            $bulan = bulan(date('m', strtotime($tglpenerimaan)));
            $tahun = date('Y', strtotime($tglpenerimaan));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer') {
            $idbank = null;
        }

        if (empty($idpenerimaan)) {

            $idpenerimaan = $this->model->createID();

            $totalpenerimaan = 0;
            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpenerimaan' => $idpenerimaan,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'jumlahpenerimaan' => untitik($isidatatable[$i]['jumlahpenerimaan']),
                );
                $totalpenerimaan += untitik($isidatatable[$i]['jumlahpenerimaan']);
            }



            $data = array(
                'idpenerimaan' => $idpenerimaan,
                'tglpenerimaan' => $tglpenerimaan,
                'totalpenerimaan' => $totalpenerimaan,
                'keterangan' => $keterangan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
            );
            $simpan = $this->model->simpanData($data, $dataDetail, $idpenerimaan);
        } else {

            $totalpenerimaan = 0;
            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpenerimaan' => $idpenerimaan,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'jumlahpenerimaan' => untitik($isidatatable[$i]['jumlahpenerimaan']),
                );
                $totalpenerimaan += untitik($isidatatable[$i]['jumlahpenerimaan']);
            }



            $data = array(
                'idpenerimaan' => $idpenerimaan,
                'tglpenerimaan' => $tglpenerimaan,
                'totalpenerimaan' => $totalpenerimaan,
                'keterangan' => $keterangan,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
            );

            $simpan = $this->model->updateData($data, $dataDetail, $idpenerimaan);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idpenerimaan)
    {
        $idpenerimaan = Crypt::decrypt($idpenerimaan);
        try {
            $rsPenerimaan = Penerimaan::findOrFail($idpenerimaan);
        } catch (ModelNotFoundException $e) {
            return redirect('/penerimaan')->with('other', 'Data tidak ditemukan!');
        }

        $tglpenerimaan = $rsPenerimaan->tglpenerimaan;
        if (App::isPosting($tglpenerimaan)) {
            $bulan = bulan(date('m', strtotime($tglpenerimaan)));
            $tahun = date('Y', strtotime($tglpenerimaan));
            return redirect('/penerimaan')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $hapus = $this->model->hapusData($idpenerimaan, $rsPenerimaan);
        if ($hapus['status'] == 'success') {
            return redirect('/penerimaan')->with('success', $hapus['message']);
        } else {
            return redirect('/penerimaan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpenerimaan = $request->input('idpenerimaan');
        $rsPenerimaan = Penerimaan::find($idpenerimaan);

        $rsDetail = $this->model->getDetail($idpenerimaan);
        return response()->json(array('rsPenerimaan' => $rsPenerimaan, 'rsDetail' => $rsDetail));
    }
}
