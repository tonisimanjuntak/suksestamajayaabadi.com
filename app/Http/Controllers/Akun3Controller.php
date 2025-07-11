<?php

namespace App\Http\Controllers;

use App\Models\Akun2;
use App\Models\Akun3;
use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Akun3Controller extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Akun3;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $akun3 = Akun3::all();
        $data['akun3'] = $akun3;
        $data['menu'] = 'akun3';
        return view('akun3.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'akun3';
        $data['kdakun'] = "";
        $data['ltambah'] = "1";
        return view('akun3.form', $data);
    }

    public function edit($kdakun)
    {
        try {
            $kdakun = Crypt::decrypt($kdakun);
            $rsAkun3 = Akun3::findOrFail($kdakun);
        } catch (ModelNotFoundException $e) {
            return redirect('/akun3')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'akun3';
        $data['kdakun'] = $kdakun;
        $data['ltambah'] = "0";
        return view('akun3.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Akun3::select(['kdakun', 'namaakun', 'kdparent', 'namaparent']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('kdakun', 'LIKE', "%{$search}%")
                ->orWhere('namaakun', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'kdakun', 'namaakun', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('kdakun', 'Asc');
            }
        } else {
            $query->orderBy('kdakun', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Akun3::count();

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
                'kdakun' => $row->kdakun,
                'namaakun' => '<strong>' . $row->namaakun . '</strong><br><small>' . $row->kdparent . ' - ' . $row->namaparent . '</small>',
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('akun3/hapus/' . Crypt::encrypt($row->kdakun)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('akun3/edit/' . Crypt::encrypt($row->kdakun)) . '" class="btn btn-warning">Edit</a>                                
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
        $kdparent = $request->get('kdparent');
        $kdakun = $request->get('kdakun');
        $ltambah = $request->get('ltambah');
        $namaakun = $request->get('namaakun');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah == '1') {
            $data = array(
                'kdakun' => $kdakun,
                'namaakun' => $namaakun,
                'kdparent' => $kdparent,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
                'levels' => '3',
            );
            $simpan = $this->model->simpanData($data);
        } else {
            $data = array(
                'kdakun' => $kdakun,
                'namaakun' => $namaakun,
                'updated_date' => $updated_date,
            );
            $simpan = $this->model->updateData($data, $kdakun);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/akun3')->with('success', $simpan['message']);
        } else {
            return redirect('/akun3')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($kdakun)
    {
        $kdakun = Crypt::decrypt($kdakun);
        try {
            $rsAkun3 = Akun3::findOrFail($kdakun);
        } catch (ModelNotFoundException $e) {
            return redirect('/akun3')->with('other', 'Data tidak ditemukan!');
        }

        if (App::adaTurunanAkun($kdakun)) {
            return redirect('/akun3')->with('other', 'Akun ' . $kdakun . ' mempunyai turunan akun. tidak dapat dihapus!');
        }

        $hapus = $this->model->hapusData($kdakun, $rsAkun3);
        if ($hapus['status'] == 'success') {
            return redirect('/akun3')->with('success', $hapus['message']);
        } else {
            return redirect('/akun3')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $kdakun = $request->input('kdakun');
        $rsAkun3 = Akun3::find($kdakun);
        return response()->json($rsAkun3);
    }

    public function searchParentAkun(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Akun2::where('namaakun', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->kdakun,
                'text' => $item->kdakun . ' - ' . $item->namaakun,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
