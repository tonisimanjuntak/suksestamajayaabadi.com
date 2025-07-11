<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class JurnalController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Jurnal;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'jurnal';
        return view('jurnal.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'jurnal';
        $data['idjurnal'] = "";
        return view('jurnal.form', $data);
    }

    public function edit($idjurnal)
    {
        try {
            $idjurnal = Crypt::decrypt($idjurnal);
            $rsJurnal = Jurnal::findOrFail($idjurnal);
        } catch (ModelNotFoundException $e) {
            return redirect('/jurnal')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'jurnal';
        $data['idjurnal'] = $idjurnal;
        return view('jurnal.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Jurnal::select(['idjurnal', 'tgljurnal', 'keterangan', 'totaldebet', 'totalkredit', 'namapengguna']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $query->whereBetween("tgljurnal", [$tglawal, $tglakhir]);
        $query->where('jenis', 'Jurnal Penyesuaian');

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idjurnal', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idjurnal', 'tgljurnal', 'keterangan', 'totaldebet', 'totalkredit', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tgljurnal', 'Desc');
                $query->orderBy('idjurnal', 'Desc');
            }
        } else {
            $query->orderBy('tgljurnal', 'Desc');
            $query->orderBy('idjurnal', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Jurnal::count();

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
                'idjurnal' => $row->idjurnal,
                'tgljurnal' => tgldmy($row->tgljurnal),
                'keterangan' => $row->keterangan,
                'totaldebet' => format_rupiah($row->totaldebet),
                'totalkredit' => format_rupiah($row->totalkredit),
                'namapengguna' => $row->namapengguna,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('jurnal/hapus/' . Crypt::encrypt($row->idjurnal)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('jurnal/edit/' . Crypt::encrypt($row->idjurnal)) . '" class="btn btn-warning">Edit</a>                                
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
        $idjurnal = $request->get('idjurnal');
        $tgljurnal = $request->get('tgljurnal');
        $keterangan = $request->get('keterangan');
        $totaldebet = untitik($request->get('totaldebet'));
        $totalkredit = untitik($request->get('totalkredit'));
        $isidatatable = $request->get('isidatatable');

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tgljurnal)) {
            $bulan = bulan(date('m', strtotime($tgljurnal)));
            $tahun = date('Y', strtotime($tgljurnal));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if (empty($idjurnal)) {

            $idjurnal = $this->model->createIDJurnalPenyesuaian();
            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idjurnal' => $idjurnal,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'debet' => untitik($isidatatable[$i]['debet']),
                    'kredit' => untitik($isidatatable[$i]['kredit']),
                );
            }

            $data = array(
                'idjurnal' => $idjurnal,
                'tgljurnal' => $tgljurnal,
                'keterangan' => $keterangan,
                'totaldebet' => $totaldebet,
                'totalkredit' => $totalkredit,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'jenis' => 'Jurnal Penyesuaian',
            );
            $simpan = $this->model->simpanData($data, $dataDetail, $idjurnal);
        } else {

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idjurnal' => $idjurnal,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'debet' => untitik($isidatatable[$i]['debet']),
                    'kredit' => untitik($isidatatable[$i]['kredit']),
                );
            }

            $data = array(
                'idjurnal' => $idjurnal,
                'tgljurnal' => $tgljurnal,
                'keterangan' => $keterangan,
                'totaldebet' => $totaldebet,
                'totalkredit' => $totalkredit,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'jenis' => 'Jurnal Penyesuaian',
            );

            $simpan = $this->model->updateData($data, $dataDetail, $idjurnal);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idjurnal)
    {
        $idjurnal = Crypt::decrypt($idjurnal);
        try {
            $rsJurnal = Jurnal::findOrFail($idjurnal);
        } catch (ModelNotFoundException $e) {
            return redirect('/jurnal')->with('other', 'Data tidak ditemukan!');
        }

        $tgljurnal = $rsJurnal->tgljurnal;
        if (App::isPosting($tgljurnal)) {
            $bulan = bulan(date('m', strtotime($tgljurnal)));
            $tahun = date('Y', strtotime($tgljurnal));
            return redirect('/jurnal')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $hapus = $this->model->hapusData($idjurnal, $rsJurnal);
        if ($hapus['status'] == 'success') {
            return redirect('/jurnal')->with('success', $hapus['message']);
        } else {
            return redirect('/jurnal')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idjurnal = $request->input('idjurnal');
        $rsJurnal = Jurnal::find($idjurnal);

        $rsDetail = $this->model->getDetail($idjurnal);
        return response()->json(array('rsJurnal' => $rsJurnal, 'rsDetail' => $rsDetail));
    }
}
