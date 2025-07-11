<?php

namespace App\Http\Controllers;

use App\Models\Akun1;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Akun1Controller extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Akun1;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $akun1 = Akun1::all();
        $data['akun1'] = $akun1;
        $data['menu'] = 'akun1';
        return view('akun1.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'akun1';
        $data['kdakun'] = "";
        $data['ltambah'] = "1";
        return view('akun1.form', $data);
    }

    public function edit($kdakun)
    {
        try {
            $kdakun = Crypt::decrypt($kdakun);
            $rsAkun1 = Akun1::findOrFail($kdakun);
        } catch (ModelNotFoundException $e) {
            return redirect('/akun1')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'akun1';
        $data['kdakun'] = $kdakun;
        $data['ltambah'] = "0";
        return view('akun1.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Akun1::select(['kdakun', 'namaakun']);

        $query->where('levels', '1');

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
        $totalData = Akun1::count();

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
                'namaakun' => $row->namaakun,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('akun1/hapus/' . Crypt::encrypt($row->kdakun)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('akun1/edit/' . Crypt::encrypt($row->kdakun)) . '" class="btn btn-warning">Edit</a>                                
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
        $kdakun = $request->get('kdakun');
        $ltambah = $request->get('ltambah');
        $namaakun = $request->get('namaakun');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($ltambah == '1') {
            $data = array(
                'kdakun' => $kdakun,
                'namaakun' => $namaakun,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
                'levels' => '1',
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
            return redirect('/akun1')->with('success', $simpan['message']);
        } else {
            return redirect('/akun1')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($kdakun)
    {
        $kdakun = Crypt::decrypt($kdakun);
        try {
            $rsAkun1 = Akun1::findOrFail($kdakun);
        } catch (ModelNotFoundException $e) {
            return redirect('/akun1')->with('other', 'Data tidak ditemukan!');
        }

        if (App::adaTurunanAkun($kdakun)) {
            return redirect('/akun1')->with('other', 'Akun ' . $kdakun . ' mempunyai turunan akun. tidak dapat dihapus!');
        }

        $hapus = $this->model->hapusData($kdakun, $rsAkun1);
        if ($hapus['status'] == 'success') {
            return redirect('/akun1')->with('success', $hapus['message']);
        } else {
            return redirect('/akun1')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $kdakun = $request->input('kdakun');
        $rsAkun1 = Akun1::find($kdakun);
        return response()->json($rsAkun1);
    }
}
