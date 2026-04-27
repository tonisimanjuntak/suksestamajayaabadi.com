<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SatuanController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Satuan;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $satuan = Satuan::all();
        $data['satuan'] = $satuan;
        $data['menu'] = 'satuan';
        return view('satuan.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'satuan';
        $data['idsatuan'] = "";
        return view('satuan.form', $data);
    }

    public function edit($idsatuan)
    {
        try {
            $idsatuan = Crypt::decrypt($idsatuan);
            $rsSatuan = Satuan::findOrFail($idsatuan);
        } catch (ModelNotFoundException $e) {
            return redirect('/satuan')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'satuan';
        $data['idsatuan'] = $idsatuan;
        return view('satuan.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Satuan::select(['idsatuan', 'namasatuan', 'statusaktif']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idsatuan', 'LIKE', "%{$search}%")
                ->orWhere('namasatuan', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idsatuan', 'namasatuan', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namasatuan', 'Asc');
            }
        } else {
            $query->orderBy('namasatuan', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Satuan::count();

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
                'idsatuan' => $row->idsatuan,
                'namasatuan' => $row->namasatuan,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('satuan/hapus/' . Crypt::encrypt($row->idsatuan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('satuan/edit/' . Crypt::encrypt($row->idsatuan)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('satuan/edit/' . Crypt::encrypt($row->idsatuan)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('satuan/hapus/' . Crypt::encrypt($row->idsatuan)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idsatuan = $request->get('idsatuan');
        $namasatuan = $request->get('namasatuan');
        $statusaktif = $request->get('statusaktif');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($idsatuan)) {
            $idsatuan = $this->model->createID($namasatuan);
            $data = array(
                'idsatuan' => $idsatuan,
                'namasatuan' => $namasatuan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
            );
            $simpan = $this->model->simpanData($data);
        } else {
            $data = array(
                'idsatuan' => $idsatuan,
                'namasatuan' => $namasatuan,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
            );
            $simpan = $this->model->updateData($data, $idsatuan);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/satuan')->with('success', $simpan['message']);
        } else {
            return redirect('/satuan')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idsatuan)
    {
        $idsatuan = Crypt::decrypt($idsatuan);
        try {
            $rsSatuan = Satuan::findOrFail($idsatuan);
        } catch (ModelNotFoundException $e) {
            return redirect('/satuan')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idsatuan, $rsSatuan);
        if ($hapus['status'] == 'success') {
            return redirect('/satuan')->with('success', $hapus['message']);
        } else {
            return redirect('/satuan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idsatuan = $request->input('idsatuan');
        $rsSatuan = Satuan::find($idsatuan);
        return response()->json($rsSatuan);
    }

    public function searchSatuan(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Satuan::where('statusaktif', 'Aktif')
            ->where('namasatuan', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idsatuan,
                'text' => $item->namasatuan,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
