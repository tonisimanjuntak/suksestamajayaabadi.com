<?php

namespace App\Http\Controllers;

use App\Models\Kategoribarang;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class KategoribarangController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Kategoribarang;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $kategoribarang = Kategoribarang::all();
        $data['kategoribarang'] = $kategoribarang;
        $data['menu'] = 'kategoribarang';
        return view('kategoribarang.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'kategoribarang';
        $data['idkategori'] = "";
        return view('kategoribarang.form', $data);
    }

    public function edit($idkategori)
    {
        try {
            $idkategori = Crypt::decrypt($idkategori);
            $rsKategori = Kategoribarang::findOrFail($idkategori);
        } catch (ModelNotFoundException $e) {
            return redirect('/kategoribarang')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'kategoribarang';
        $data['idkategori'] = $idkategori;
        return view('kategoribarang.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Kategoribarang::select(['idkategori', 'namakategori', 'statusaktif']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idkategori', 'LIKE', "%{$search}%")
                ->orWhere('namakategori', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idkategori', 'namakategori', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namakategori', 'Asc');
            }
        } else {
            $query->orderBy('namakategori', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Kategoribarang::count();

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
                'idkategori' => $row->idkategori,
                'namakategori' => $row->namakategori,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('kategoribarang/hapus/' . Crypt::encrypt($row->idkategori)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('kategoribarang/edit/' . Crypt::encrypt($row->idkategori)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('kategoribarang/edit/' . Crypt::encrypt($row->idkategori)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('kategoribarang/hapus/' . Crypt::encrypt($row->idkategori)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idkategori = $request->get('idkategori');
        $namakategori = $request->get('namakategori');
        $statusaktif = $request->get('statusaktif');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($idkategori)) {
            $idkategori = $this->model->createID($namakategori);
            $data = array(
                'idkategori' => $idkategori,
                'namakategori' => $namakategori,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
            );
            $simpan = $this->model->simpanData($data);
        } else {
            $data = array(
                'idkategori' => $idkategori,
                'namakategori' => $namakategori,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
            );
            $simpan = $this->model->updateData($data, $idkategori);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/kategoribarang')->with('success', $simpan['message']);
        } else {
            return redirect('/kategoribarang')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idkategori)
    {
        $idkategori = Crypt::decrypt($idkategori);
        try {
            $rsKategori = Kategoribarang::findOrFail($idkategori);
        } catch (ModelNotFoundException $e) {
            return redirect('/kategoribarang')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idkategori, $rsKategori);
        if ($hapus['status'] == 'success') {
            return redirect('/kategoribarang')->with('success', $hapus['message']);
        } else {
            return redirect('/kategoribarang')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idkategori = $request->input('idkategori');
        $rsKategori = Kategoribarang::find($idkategori);
        return response()->json($rsKategori);
    }

    public function searchKategori(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Kategoribarang::where('statusaktif', 'Aktif')
            ->where('namakategori', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idkategori,
                'text' => $item->namakategori,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
