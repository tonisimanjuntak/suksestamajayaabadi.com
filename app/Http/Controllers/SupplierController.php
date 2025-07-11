<?php

namespace App\Http\Controllers;

use App\Models\Uploads;
use App\Models\Supplier;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Supplier;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $supplier = Supplier::all();
        $data['supplier'] = $supplier;
        $data['menu'] = 'supplier';
        return view('supplier.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'supplier';
        $data['idsupplier'] = "";
        return view('supplier.form', $data);
    }

    public function edit($idsupplier)
    {
        try {
            $idsupplier = Crypt::decrypt($idsupplier);
            $rsSupplier = Supplier::findOrFail($idsupplier);
        } catch (ModelNotFoundException $e) {
            return redirect('/supplier')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'supplier';
        $data['idsupplier'] = $idsupplier;
        return view('supplier.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Supplier::select(['idsupplier', 'namasupplier', 'npwp', 'kontakperson', 'statusaktif', 'alamatsupplier', 'notelp', 'email']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idsupplier', 'LIKE', "%{$search}%")
                ->orWhere('namasupplier', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idsupplier', 'namasupplier', 'npwp', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namasupplier', 'Asc');
            }
        } else {
            $query->orderBy('namasupplier', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Supplier::count();

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
                'idsupplier' => $row->idsupplier,
                'namasupplier' => $row->namasupplier . '<br>' . $row->alamatsupplier,
                'npwp' => $row->npwp,
                'kontakperson' => $row->kontakperson . '<br>Telp: ' . $row->notelp . '<br>Email: ' . $row->email,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('supplier/hapus/' . Crypt::encrypt($row->idsupplier)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('supplier/edit/' . Crypt::encrypt($row->idsupplier)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('supplier/edit/' . Crypt::encrypt($row->idsupplier)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('supplier/hapus/' . Crypt::encrypt($row->idsupplier)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idsupplier = $request->get('idsupplier');
        $namasupplier = $request->get('namasupplier');
        $npwp = $request->get('npwp');
        $alamatsupplier = $request->get('alamatsupplier');
        $kontakperson = $request->get('kontakperson');
        $notelp = $request->get('notelp');
        $email = $request->get('email');
        $statusaktif = $request->get('statusaktif');
        $kdakunutang = $request->get('kdakunutang');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($email)) {
            $email = null;
        }

        if (empty($idsupplier)) {
            $idsupplier = $this->model->createID($namasupplier);
            $data = array(
                'idsupplier' => $idsupplier,
                'namasupplier' => $namasupplier,
                'npwp' => $npwp,
                'alamatsupplier' => $alamatsupplier,
                'kontakperson' => $kontakperson,
                'notelp' => $notelp,
                'email' => $email,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
                'kdakunutang' => $kdakunutang,
            );
            $simpan = $this->model->simpanData($data);
        } else {
            $data = array(
                'idsupplier' => $idsupplier,
                'namasupplier' => $namasupplier,
                'npwp' => $npwp,
                'alamatsupplier' => $alamatsupplier,
                'kontakperson' => $kontakperson,
                'notelp' => $notelp,
                'email' => $email,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'kdakunutang' => $kdakunutang,
            );
            $simpan = $this->model->updateData($data, $idsupplier);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/supplier')->with('success', $simpan['message']);
        } else {
            return redirect('/supplier')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idsupplier)
    {
        $idsupplier = Crypt::decrypt($idsupplier);
        try {
            $rsSupplier = Supplier::findOrFail($idsupplier);
        } catch (ModelNotFoundException $e) {
            return redirect('/supplier')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idsupplier, $rsSupplier);
        if ($hapus['status'] == 'success') {
            return redirect('/supplier')->with('success', $hapus['message']);
        } else {
            return redirect('/supplier')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idsupplier = $request->input('idsupplier');
        $rsSupplier = Supplier::find($idsupplier);
        return response()->json($rsSupplier);
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


    public function searchSupplier(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Supplier::where('namasupplier', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idsupplier,
                'text' => $item->namasupplier . ' (NPWP: ' . $item->npwp . ')',
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
