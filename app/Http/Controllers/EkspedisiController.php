<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use Illuminate\Http\Request;
use App\Models\Uploads;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class EkspedisiController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Ekspedisi;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $ekspedisi = Ekspedisi::all();
        $data['ekspedisi'] = $ekspedisi;
        $data['menu'] = 'ekspedisi';
        return view('ekspedisi.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'ekspedisi';
        $data['idekspedisi'] = "";
        return view('ekspedisi.form', $data);
    }

    public function edit($idekspedisi)
    {
        try {
            $idekspedisi = Crypt::decrypt($idekspedisi);
            $rsEkspedisi = Ekspedisi::findOrFail($idekspedisi);
        } catch (ModelNotFoundException $e) {
            return redirect('/ekspedisi')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'ekspedisi';
        $data['idekspedisi'] = $idekspedisi;
        return view('ekspedisi.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Ekspedisi::select(['idekspedisi', 'namaekspedisi', 'namapemilik', 'statusaktif']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idekspedisi', 'LIKE', "%{$search}%")
                ->orWhere('namaekspedisi', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idekspedisi', 'namaekspedisi', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namaekspedisi', 'Asc');
            }
        } else {
            $query->orderBy('namaekspedisi', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Ekspedisi::count();

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
            if ($row->statusaktif == 'Aktif') {
                $statusaktif = '<span class="badge badge-success">' . $row->statusaktif . '</span>';
            } else {
                $statusaktif = '<span class="badge badge-danger">' . $row->statusaktif . '</span>';
            }
            $data[] = [
                'no' => $no++,
                'idekspedisi' => $row->idekspedisi,
                'namaekspedisi' => $row->namaekspedisi,
                'namapemilik' => $row->namapemilik,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('ekspedisi/hapus/' . Crypt::encrypt($row->idekspedisi)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('ekspedisi/edit/' . Crypt::encrypt($row->idekspedisi)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('ekspedisi/edit/' . Crypt::encrypt($row->idekspedisi)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('ekspedisi/hapus/' . Crypt::encrypt($row->idekspedisi)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idekspedisi = $request->get('idekspedisi');
        $namaekspedisi = $request->get('namaekspedisi');
        $statusaktif = $request->get('statusaktif');
        $notelpekspedisi = $request->get('notelpekspedisi');
        $emailekspedisi = $request->get('emailekspedisi');
        $alamatekspedisi = $request->get('alamatekspedisi');
        $kdakunutang = $request->get('kdakunutang');

        $nikpemilik = $request->get('nikpemilik');
        $namapemilik = $request->get('namapemilik');
        $notelppemilik = $request->get('notelppemilik');
        $nowapemilik = $request->get('nowapemilik');

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($emailekspedisi)) {
            $emailekspedisi = null;
        }

        if (empty($idekspedisi)) {

            $idekspedisi = $this->model->createID();
            $data = array(
                'idekspedisi' => $idekspedisi,
                'namaekspedisi' => $namaekspedisi,
                'notelpekspedisi' => $notelpekspedisi,
                'alamatekspedisi' => $alamatekspedisi,
                'emailekspedisi' => $emailekspedisi,
                'nikpemilik' => $nikpemilik,
                'namapemilik' => $namapemilik,
                'notelppemilik' => $notelppemilik,
                'nowapemilik' => $nowapemilik,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
                'kdakunutang' => $kdakunutang,
            );
            $simpan = $this->model->simpanData($data);
        } else {

            $data = array(
                'idekspedisi' => $idekspedisi,
                'namaekspedisi' => $namaekspedisi,
                'notelpekspedisi' => $notelpekspedisi,
                'alamatekspedisi' => $alamatekspedisi,
                'emailekspedisi' => $emailekspedisi,
                'nikpemilik' => $nikpemilik,
                'namapemilik' => $namapemilik,
                'notelppemilik' => $notelppemilik,
                'nowapemilik' => $nowapemilik,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'kdakunutang' => $kdakunutang,
            );
            $simpan = $this->model->updateData($data, $idekspedisi);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/ekspedisi')->with('success', $simpan['message']);
        } else {
            return redirect('/ekspedisi')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idekspedisi)
    {
        $idekspedisi = Crypt::decrypt($idekspedisi);
        try {
            $rsEkspedisi = Ekspedisi::findOrFail($idekspedisi);
        } catch (ModelNotFoundException $e) {
            return redirect('/ekspedisi')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idekspedisi, $rsEkspedisi);
        if ($hapus['status'] == 'success') {
            return redirect('/ekspedisi')->with('success', $hapus['message']);
        } else {
            return redirect('/ekspedisi')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idekspedisi = $request->input('idekspedisi');
        $rsEkspedisi = Ekspedisi::find($idekspedisi);
        return response()->json($rsEkspedisi);
    }

    public function searchWilayah(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Wilayah::where('namawilayah', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idwilayah,
                'text' => $item->namawilayah,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchEkspedisi(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Ekspedisi::where('namaekspedisi', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idekspedisi,
                'text' => $item->namaekspedisi,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
