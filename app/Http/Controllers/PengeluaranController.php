<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class PengeluaranController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Pengeluaran;
        $this->isLogin();
    }

    public function index()
    {
        $pegngeluaran = $this->model->allView();
        $data['pengeluaran'] = $pegngeluaran;
        $data['menu'] = 'pengeluaran';
        return view('pengeluaran.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'pengeluaran';
        $data['idpengeluaran'] = "";
        return view('pengeluaran.form', $data);
    }

    public function edit($idpengeluaran)
    {
        try {
            $idpengeluaran = Crypt::decrypt($idpengeluaran);
            $rsPengeluaran = Pengeluaran::findOrFail($idpengeluaran);
        } catch (ModelNotFoundException $e) {
            return redirect('/pengeluaran')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'pengeluaran';
        $data['idpengeluaran'] = $idpengeluaran;
        return view('pengeluaran.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Pengeluaran::select(['idpengeluaran', 'tglpengeluaran', 'nokwitansi', 'keterangan', 'carabayar', 'totalpengeluaran', 'namapengguna']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $carabayar = $request->input('carabayar');

        $query->whereBetween("tglpengeluaran", [$tglawal, $tglakhir]);
        if (!empty($carabayar)) {
            $query->where('carabayar', $carabayar);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpengeluaran', 'LIKE', "%{$search}%")
                    ->orWhere('nokwitansi', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpengeluaran', 'tglpengeluaran', 'nokwitansi', 'keterangan', 'carabayar', 'totalpengeluaran', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglpengeluaran', 'Desc');
                $query->orderBy('idpengeluaran', 'Desc');
            }
        } else {
            $query->orderBy('tglpengeluaran', 'Desc');
            $query->orderBy('idpengeluaran', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Pengeluaran::count();

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
                'idpengeluaran' => $row->idpengeluaran,
                'tglpengeluaran' => $row->tglpengeluaran . '<br>' . $row->nokwitansi,
                'nokwitansi' => $row->nokwitansi,
                'keterangan' => $row->keterangan,
                'carabayar' => $row->carabayar,
                'totalpengeluaran' => format_rupiah($row->totalpengeluaran),
                'namapengguna' => $row->namapengguna,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pengeluaran/hapus/' . Crypt::encrypt($row->idpengeluaran)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pengeluaran/edit/' . Crypt::encrypt($row->idpengeluaran)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpengeluaran = $request->get('idpengeluaran');
        $nokwitansi = $request->get('nokwitansi');
        $tglpengeluaran = $request->get('tglpengeluaran');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $keterangan = $request->get('keterangan');
        $isidatatable = $request->get('isidatatable');

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglpengeluaran)) {
            $bulan = bulan(date('m', strtotime($tglpengeluaran)));
            $tahun = date('Y', strtotime($tglpengeluaran));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer') {
            $idbank = null;
        }

        if (empty($idpengeluaran)) {

            $idpengeluaran = $this->model->createID();

            $totalpengeluaran = 0;
            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpengeluaran' => $idpengeluaran,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'jumlahpengeluaran' => untitik($isidatatable[$i]['jumlahpengeluaran']),
                );
                $totalpengeluaran += untitik($isidatatable[$i]['jumlahpengeluaran']);
            }



            $data = array(
                'idpengeluaran' => $idpengeluaran,
                'tglpengeluaran' => $tglpengeluaran,
                'nokwitansi' => $nokwitansi,
                'totalpengeluaran' => $totalpengeluaran,
                'keterangan' => $keterangan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
            );
            $simpan = $this->model->simpanData($data, $dataDetail, $idpengeluaran);
        } else {

            $totalpengeluaran = 0;
            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpengeluaran' => $idpengeluaran,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'jumlahpengeluaran' => untitik($isidatatable[$i]['jumlahpengeluaran']),
                );
                $totalpengeluaran += untitik($isidatatable[$i]['jumlahpengeluaran']);
            }



            $data = array(
                'idpengeluaran' => $idpengeluaran,
                'tglpengeluaran' => $tglpengeluaran,
                'nokwitansi' => $nokwitansi,
                'totalpengeluaran' => $totalpengeluaran,
                'keterangan' => $keterangan,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
            );

            $simpan = $this->model->updateData($data, $dataDetail, $idpengeluaran);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idpengeluaran)
    {
        $idpengeluaran = Crypt::decrypt($idpengeluaran);
        try {
            $rsPengeluaran = Pengeluaran::findOrFail($idpengeluaran);
        } catch (ModelNotFoundException $e) {
            return redirect('/pengeluaran')->with('other', 'Data tidak ditemukan!');
        }

        $tglpengeluaran = $rsPengeluaran->tglpengeluaran;
        if (App::isPosting($tglpengeluaran)) {
            $bulan = bulan(date('m', strtotime($tglpengeluaran)));
            $tahun = date('Y', strtotime($tglpengeluaran));
            return redirect('/pengeluaran')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $hapus = $this->model->hapusData($idpengeluaran, $rsPengeluaran);
        if ($hapus['status'] == 'success') {
            return redirect('/pengeluaran')->with('success', $hapus['message']);
        } else {
            return redirect('/pengeluaran')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpengeluaran = $request->input('idpengeluaran');
        $rsPengeluaran = Pengeluaran::find($idpengeluaran);

        $rsDetail = $this->model->getDetail($idpengeluaran);
        return response()->json(array('rsPengeluaran' => $rsPengeluaran, 'rsDetail' => $rsDetail));
    }
}
