<?php

namespace App\Http\Controllers;

use App\Models\Uploads;
use App\Models\Konsumen;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;


class KonsumenController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Konsumen;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $konsumen = Konsumen::all();
        $data['konsumen'] = $konsumen;
        $data['menu'] = 'konsumen';
        return view('konsumen.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'konsumen';
        $data['idkonsumen'] = "";
        return view('konsumen.form', $data);
    }

    public function edit($idkonsumen)
    {
        try {
            $idkonsumen = Crypt::decrypt($idkonsumen);
            $rsKonsumen = Konsumen::findOrFail($idkonsumen);
        } catch (ModelNotFoundException $e) {
            return redirect('/konsumen')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'konsumen';
        $data['idkonsumen'] = $idkonsumen;
        return view('konsumen.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Konsumen::select(['idkonsumen', 'namakonsumen', 'namapemilik', 'statusaktif', 'nowapemilik', 'notelppemilik', 'limitkredit', 'jumlahpiutang']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idkonsumen', 'LIKE', "%{$search}%")
                ->orWhere('namakonsumen', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idkonsumen', 'namakonsumen', null, 'limitkredit', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namakonsumen', 'Asc');
            }
        } else {
            $query->orderBy('namakonsumen', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Konsumen::count();

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
            $informasiPemilik = '';
            if (!empty($row->namapemilik)) {
                $informasiPemilik = $row->namapemilik;
            }
            if (!empty($row->nowapemilik)) {
                $informasiPemilik .= '<br> No WA:' . $row->nowapemilik;
            }
            $data[] = [
                'no' => $no++,
                'idkonsumen' => $row->idkonsumen,
                'namakonsumen' => $row->namakonsumen,
                'namapemilik' => $informasiPemilik,
                'limitkredit' => 'Rp. ' . format_rupiah($row->limitkredit) . '<br><small><i>(Sisa: Rp.' . format_rupiah($row->limitkredit - $row->jumlahpiutang) . ')</i></small>',
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('konsumen/hapus/' . Crypt::encrypt($row->idkonsumen)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('konsumen/edit/' . Crypt::encrypt($row->idkonsumen)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('konsumen/edit/' . Crypt::encrypt($row->idkonsumen)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('konsumen/hapus/' . Crypt::encrypt($row->idkonsumen)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idkonsumen = $request->get('idkonsumen');
        $namakonsumen = $request->get('namakonsumen');
        $statusaktif = $request->get('statusaktif');
        $notelpkonsumen = $request->get('notelpkonsumen');
        $emailkonsumen = $request->get('emailkonsumen');
        $alamatkonsumen = $request->get('alamatkonsumen');
        $idwilayah = $request->get('idwilayah');
        $nikpemilik = $request->get('nikpemilik');
        $namapemilik = $request->get('namapemilik');
        $notelppemilik = $request->get('notelppemilik');
        $nowapemilik = $request->get('nowapemilik');
        $npwp = $request->get('npwp');
        $limitkredit = untitik($request->get('limitkredit'));
        $kdakunpiutang = untitik($request->get('kdakunpiutang'));

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        if (empty($emailkonsumen)) {
            $emailkonsumen = null;
        }

        if (empty($idkonsumen)) {
            $idkonsumen = $this->model->createID($namakonsumen);
            $data = array(
                'idkonsumen' => $idkonsumen,
                'namakonsumen' => $namakonsumen,
                'notelpkonsumen' => $notelpkonsumen,
                'alamatkonsumen' => $alamatkonsumen,
                'emailkonsumen' => $emailkonsumen,
                'nikpemilik' => $nikpemilik,
                'namapemilik' => $namapemilik,
                'notelppemilik' => $notelppemilik,
                'nowapemilik' => $nowapemilik,
                'idwilayah' => $idwilayah,
                'npwp' => $npwp,
                'limitkredit' => $limitkredit,
                'kdakunpiutang' => $kdakunpiutang,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
            );
            $simpan = $this->model->simpanData($data);
        } else {

            $rsKonsumenOld = Konsumen::find($idkonsumen);
            if ($limitkredit < $rsKonsumenOld->jumlahpiutang) {
                return redirect('/konsumen')->with('fail', 'Data gagal disimpan! Jumlah kredit tidak boleh lebih kecil dari jumlah piutang konsumen. Jumlah kredit saat ini: Rp.' . format_rupiah($rsKonsumenOld->jumlahpiutang) . ' Jumlah kredit yang diinput: Rp.' . format_rupiah($limitkredit));
            }

            $data = array(
                'idkonsumen' => $idkonsumen,
                'namakonsumen' => $namakonsumen,
                'notelpkonsumen' => $notelpkonsumen,
                'alamatkonsumen' => $alamatkonsumen,
                'emailkonsumen' => $emailkonsumen,
                'nikpemilik' => $nikpemilik,
                'namapemilik' => $namapemilik,
                'notelppemilik' => $notelppemilik,
                'nowapemilik' => $nowapemilik,
                'idwilayah' => $idwilayah,
                'npwp' => $npwp,
                'limitkredit' => $limitkredit,
                'kdakunpiutang' => $kdakunpiutang,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
            );
            $simpan = $this->model->updateData($data, $idkonsumen);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/konsumen')->with('success', $simpan['message']);
        } else {
            return redirect('/konsumen')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idkonsumen)
    {
        $idkonsumen = Crypt::decrypt($idkonsumen);
        try {
            $rsKonsumen = Konsumen::findOrFail($idkonsumen);
        } catch (ModelNotFoundException $e) {
            return redirect('/konsumen')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idkonsumen, $rsKonsumen);
        if ($hapus['status'] == 'success') {
            return redirect('/konsumen')->with('success', $hapus['message']);
        } else {
            return redirect('/konsumen')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idkonsumen = $request->input('idkonsumen');
        $rsKonsumen = Konsumen::find($idkonsumen);
        return response()->json($rsKonsumen);
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

    public function searchKonsumen(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Konsumen::where('namakonsumen', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idkonsumen,
                'text' => $item->namakonsumen . ' | NPWP: ' . $item->npwp . ' | ' . $item->namawilayah,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
