<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Uploads;
use App\Models\Barang;
use App\Models\Kategoribarang;
use App\Models\Akun4;
use App\Models\App;

class BarangController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Barang;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $barang = Barang::all();
        $data['barang'] = $barang;
        $data['menu'] = 'barang';
        return view('barang.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'barang';
        $data['idbarang'] = "";
        return view('barang.form', $data);
    }

    public function edit($idbarang)
    {
        try {
            $idbarang = Crypt::decrypt($idbarang);
            $rsKategori = Barang::findOrFail($idbarang);
        } catch (ModelNotFoundException $e) {
            return redirect('/barang')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'barang';
        $data['idbarang'] = $idbarang;
        return view('barang.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Barang::select('*');

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('kdbarang', 'LIKE', "%{$search}%")
                ->orWhere('namabarang', 'LIKE', "%{$search}%")
                ->orWhere('namakategori', 'LIKE', "%{$search}%")
                ->orWhere('jenisbarang', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'kdbarang', 'namabarang', null, null, null, null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namabarang', 'Asc');
            }
        } else {
            $query->orderBy('namabarang', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Barang::count();

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
            $bonussales = '';
            if ($row->jenisbonuspenjualan == 'Persen') {
                $bonussales = $row->persenbonuspenjualan . ' %';
            } else {
                $bonussales = 'Rp. ' . $row->jumlahbonuspenjualan;
            }


            $bonustagihan = '';
            if ($row->jenisbonustagihan == 'Persen') {
                $bonustagihan = $row->persenbonustagihan . ' %';
            } else {
                $bonustagihan = 'Rp. ' . $row->jumlahbonustagihan;
            }

            $data[] = [
                'no' => $no++,
                'kdbarang' => $row->kdbarang,
                'namabarang' => '<strong>' . $row->namabarang . '</strong><br><small>' . $row->namakategori . ' - ' . $row->jenisbarang . '</small>',
                'bonussales' => $bonussales . '<br>' . $bonustagihan,
                'hargabeli' => format_rupiah($row->hargabeli),
                'hargajualdiskon' => format_rupiah($row->hargajualdiskon),
                'stokminimum' => $row->stokminimum,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('barang/hapus/' . Crypt::encrypt($row->idbarang)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('barang/edit/' . Crypt::encrypt($row->idbarang)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('barang/edit/' . Crypt::encrypt($row->idbarang)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('barang/hapus/' . Crypt::encrypt($row->idbarang)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idbarang = $request->get('idbarang');
        $kdbarang = $request->get('kdbarang');
        $namabarang = $request->get('namabarang');
        $idkategori = $request->get('idkategori');
        $kdakun = $request->get('kdakun');
        $idjenisbarang = $request->get('idjenisbarang');
        $hargabeli = untitik($request->get('hargabeli'));
        $hargajualdiskon = untitik($request->get('hargajualdiskon'));
        $stokminimum = $request->get('stokminimum');

        $jenisbonuspenjualan = $request->get('jenisbonuspenjualan');
        $persenbonuspenjualan = $request->get('persenbonuspenjualan');
        $jumlahbonuspenjualan = untitik($request->get('jumlahbonuspenjualan'));


        $jenisbonustagihan = $request->get('jenisbonustagihan');
        $persenbonustagihan = $request->get('persenbonustagihan');
        $jumlahbonustagihan = untitik($request->get('jumlahbonustagihan'));

        $statusaktif = $request->get('statusaktif');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if ($jenisbonuspenjualan == 'Persen') {
            $jumlahbonuspenjualan = 0;
        }

        if ($jenisbonuspenjualan == 'Nominal') {
            $persenbonuspenjualan = 0;
        }


        if ($jenisbonustagihan == 'Persen') {
            $jumlahbonustagihan = 0;
        }

        if ($jenisbonustagihan == 'Nominal') {
            $persenbonustagihan = 0;
        }

        if (empty($idbarang)) {
            $idbarang = $this->model->createID($idkategori);
            $data = array(
                'idbarang' => $idbarang,
                'kdbarang' => $kdbarang,
                'namabarang' => $namabarang,
                'idkategori' => $idkategori,
                'kdakun' => $kdakun,
                'hargabeli' => $hargabeli,
                'hargajualasli' => $hargajualdiskon,
                'hargajualdiskon' => $hargajualdiskon,
                'stokminimum' => $stokminimum,
                'idjenisbarang' => $idjenisbarang,
                'jenisbonuspenjualan' => $jenisbonuspenjualan,
                'jumlahbonuspenjualan' => $jumlahbonuspenjualan,
                'persenbonuspenjualan' => $persenbonuspenjualan,
                'jenisbonustagihan' => $jenisbonustagihan,
                'jumlahbonustagihan' => $jumlahbonustagihan,
                'persenbonustagihan' => $persenbonustagihan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
            );
            $simpan = $this->model->simpanData($data);
        } else {
            $data = array(
                'idbarang' => $idbarang,
                'kdbarang' => $kdbarang,
                'namabarang' => $namabarang,
                'kdakun' => $kdakun,
                'hargabeli' => $hargabeli,
                'hargajualasli' => $hargajualdiskon,
                'hargajualdiskon' => $hargajualdiskon,
                'stokminimum' => $stokminimum,
                'idjenisbarang' => $idjenisbarang,
                'jenisbonuspenjualan' => $jenisbonuspenjualan,
                'jumlahbonuspenjualan' => $jumlahbonuspenjualan,
                'persenbonuspenjualan' => $persenbonuspenjualan,
                'jenisbonustagihan' => $jenisbonustagihan,
                'jumlahbonustagihan' => $jumlahbonustagihan,
                'persenbonustagihan' => $persenbonustagihan,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
            );
            $simpan = $this->model->updateData($data, $idbarang);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/barang')->with('success', $simpan['message']);
        } else {
            return redirect('/barang')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idbarang)
    {
        $idbarang = Crypt::decrypt($idbarang);
        try {
            $rsKategori = Barang::findOrFail($idbarang);
        } catch (ModelNotFoundException $e) {
            return redirect('/barang')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idbarang, $rsKategori);
        if ($hapus['status'] == 'success') {
            return redirect('/barang')->with('success', $hapus['message']);
        } else {
            return redirect('/barang')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idbarang = $request->input('idbarang');
        $rsBarang = Barang::find($idbarang);
        return response()->json($rsBarang);
    }

    public function searchKategoriBarang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Kategoribarang::where('namakategori', 'LIKE', "%{$search}%")
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


    public function searchAkunBarang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Akun4::where('namaakun', 'LIKE', "%{$search}%")
            ->where('kdparent', session()->get('akun_barang_dagang'))
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->kdakun,
                'text' => $item->namaakun,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchBarang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Barang::where('namabarang', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idbarang,
                'text' => $item->namabarang,
                'kategori' => $item->namakategori,
                'stok' => $item->stok,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
