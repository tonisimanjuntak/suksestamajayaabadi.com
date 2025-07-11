<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WilayahController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Wilayah;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $wilayah = Wilayah::all();
        $data['wilayah'] = $wilayah;
        $data['menu'] = 'wilayah';
        return view('wilayah.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'wilayah';
        $data['idwilayah'] = "";
        return view('wilayah.form', $data);
    }

    public function edit($idwilayah)
    {
        try {
            $idwilayah = Crypt::decrypt($idwilayah);
            $rsKategori = Wilayah::findOrFail($idwilayah);
        } catch (ModelNotFoundException $e) {
            return redirect('/wilayah')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'wilayah';
        $data['idwilayah'] = $idwilayah;
        return view('wilayah.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Wilayah::select(['idwilayah', 'namawilayah', 'statusaktif']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idwilayah', 'LIKE', "%{$search}%")
                ->orWhere('namawilayah', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idwilayah', 'namawilayah', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namawilayah', 'Asc');
            }
        } else {
            $query->orderBy('namawilayah', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Wilayah::count();

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
                'idwilayah' => $row->idwilayah,
                'namawilayah' => $row->namawilayah,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('wilayah/hapus/' . Crypt::encrypt($row->idwilayah)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('wilayah/edit/' . Crypt::encrypt($row->idwilayah)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('wilayah/edit/' . Crypt::encrypt($row->idwilayah)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('wilayah/hapus/' . Crypt::encrypt($row->idwilayah)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idwilayah = $request->get('idwilayah');
        $namawilayah = $request->get('namawilayah');
        $statusaktif = $request->get('statusaktif');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($idwilayah)) {
            $idwilayah = $this->model->createID($namawilayah);
            $data = array(
                'idwilayah' => $idwilayah,
                'namawilayah' => $namawilayah,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
            );
            $simpan = $this->model->simpanData($data);
        } else {
            $data = array(
                'idwilayah' => $idwilayah,
                'namawilayah' => $namawilayah,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
            );
            $simpan = $this->model->updateData($data, $idwilayah);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/wilayah')->with('success', $simpan['message']);
        } else {
            return redirect('/wilayah')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idwilayah)
    {
        $idwilayah = Crypt::decrypt($idwilayah);
        try {
            $rsKategori = Wilayah::findOrFail($idwilayah);
        } catch (ModelNotFoundException $e) {
            return redirect('/wilayah')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idwilayah, $rsKategori);
        if ($hapus['status'] == 'success') {
            return redirect('/wilayah')->with('success', $hapus['message']);
        } else {
            return redirect('/wilayah')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idwilayah = $request->input('idwilayah');
        $rsKategori = Wilayah::find($idwilayah);
        return response()->json($rsKategori);
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
}
