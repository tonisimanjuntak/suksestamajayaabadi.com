<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Models\Uploads;
use App\Models\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BankController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Bank;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $bank = Bank::all();
        $data['bank'] = $bank;
        $data['menu'] = 'bank';
        return view('bank.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'bank';
        $data['idbank'] = "";
        return view('bank.form', $data);
    }

    public function edit($idbank)
    {
        try {
            $idbank = Crypt::decrypt($idbank);
            $rsBank = Bank::findOrFail($idbank);
        } catch (ModelNotFoundException $e) {
            return redirect('/bank')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'bank';
        $data['idbank'] = $idbank;
        return view('bank.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Bank::select(['idbank', 'namabank', 'cabang', 'atasnama', 'norekening', 'statusaktif']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idbank', 'LIKE', "%{$search}%")
                ->orWhere('namabank', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idbank', 'namabank', 'atasnama', 'norekening', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namabank', 'Asc');
            }
        } else {
            $query->orderBy('namabank', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Bank::count();

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
                'idbank' => $row->idbank,
                'namabank' => $row->namabank . '<br>Cabang: ' . $row->cabang,
                'atasnama' => $row->atasnama,
                'norekening' => $row->norekening,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('bank/hapus/' . Crypt::encrypt($row->idbank)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('bank/edit/' . Crypt::encrypt($row->idbank)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('bank/edit/' . Crypt::encrypt($row->idbank)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('bank/hapus/' . Crypt::encrypt($row->idbank)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idbank = $request->get('idbank');
        $namabank = $request->get('namabank');
        $cabang = $request->get('cabang');
        $norekening = $request->get('norekening');
        $atasnama = $request->get('atasnama');
        $kdakun = $request->get('kdakun');
        $statusaktif = $request->get('statusaktif');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($idbank)) {
            $idbank = $this->model->createID($namabank);
            $data = array(
                'idbank' => $idbank,
                'namabank' => $namabank,
                'cabang' => $cabang,
                'norekening' => $norekening,
                'atasnama' => $atasnama,
                'kdakun' => $kdakun,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
            );
            $simpan = $this->model->simpanData($data);
        } else {
            $data = array(
                'idbank' => $idbank,
                'namabank' => $namabank,
                'cabang' => $cabang,
                'norekening' => $norekening,
                'atasnama' => $atasnama,
                'kdakun' => $kdakun,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
            );
            $simpan = $this->model->updateData($data, $idbank);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/bank')->with('success', $simpan['message']);
        } else {
            return redirect('/bank')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idbank)
    {
        $idbank = Crypt::decrypt($idbank);
        try {
            $rsBank = Bank::findOrFail($idbank);
        } catch (ModelNotFoundException $e) {
            return redirect('/bank')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idbank, $rsBank);
        if ($hapus['status'] == 'success') {
            return redirect('/bank')->with('success', $hapus['message']);
        } else {
            return redirect('/bank')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idbank = $request->input('idbank');
        $rsBank = Bank::find($idbank);
        return response()->json($rsBank);
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


    public function searchBank(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Bank::where('namabank', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idbank,
                'text' => $item->namabank . ' Rek: ' . $item->norekening . ' (' . $item->atasnama . ')',
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
