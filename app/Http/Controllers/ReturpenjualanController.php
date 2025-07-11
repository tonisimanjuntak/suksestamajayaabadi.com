<?php

namespace App\Http\Controllers;

use App\Models\Returpenjualan;
use App\Models\Uploads;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Penjualan;
use App\Models\Hutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class ReturpenjualanController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Returpenjualan;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'returpenjualan';
        return view('returpenjualan.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'returpenjualan';
        $data['idreturpenjualan'] = "";
        return view('returpenjualan.form', $data);
    }

    public function lihat($idreturpenjualan)
    {
        try {
            $idreturpenjualan = Crypt::decrypt($idreturpenjualan);
            $rsPenjualan = Returpenjualan::findOrFail($idreturpenjualan);
        } catch (ModelNotFoundException $e) {
            return redirect('/returpenjualan')->with('other', 'Data tidak ditemukan!');
        }
        $data['rsBarang'] = Barang::all();
        $data['rsSupplier'] = Supplier::all();
        $data['menu'] = 'returpenjualan';
        $data['idreturpenjualan'] = $idreturpenjualan;
        return view('returpenjualan.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Returpenjualan::select(['idreturpenjualan', 'tglretur', 'namakonsumen', 'keterangan', 'carabayar', 'totalretur', 'namapengguna', 'noinvoice', 'tglinvoice']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idkonsumen = $request->input('idkonsumen');
        $carabayar = $request->input('carabayar');

        $query->whereBetween("tglretur", [$tglawal, $tglakhir]);
        if ($idkonsumen != '' && $idkonsumen != null) {
            $query->where('idkonsumen', $idkonsumen);
        }

        if (!empty($carabayar)) {
            $query->where('carabayar', $carabayar);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idreturpenjualan', 'LIKE', "%{$search}%")
                    ->orWhere('namakonsumen', 'LIKE', "%{$search}%")
                    ->orWhere('namapengguna', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idreturpenjualan', 'tglretur', 'tglinvoice', 'namakonsumen', 'keterangan', 'carabayar', 'totalretur', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglretur', 'Desc');
                $query->orderBy('idreturpenjualan', 'Desc');
            }
        } else {
            $query->orderBy('tglretur', 'Desc');
            $query->orderBy('idreturpenjualan', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Returpenjualan::count();

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
                'tglretur' => tgldmy($row->tglretur) . '<br>' . $row->idreturpenjualan,
                'tglinvoice' => tgldmy($row->tglinvoice) . '<br>' . $row->noinvoice,
                'namakonsumen' => $row->namakonsumen,
                'keterangan' => $row->keterangan,
                'carabayar' => $row->carabayar,
                'totalretur' => format_rupiah($row->totalretur),
                'namapengguna' => $row->namapengguna,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('returpenjualan/hapus/' . Crypt::encrypt($row->idreturpenjualan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('returpenjualan/lihat/' . Crypt::encrypt($row->idreturpenjualan)) . '" class="btn btn-warning">Lihat</a>                                
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
        $idreturpenjualan = $request->get('idreturpenjualan');
        $idpenjualan = $request->get('idpenjualan');
        $tglretur = $request->get('tglretur');
        $total = $request->get('total');
        $keterangan = $request->get('keterangan');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $isidatatable = $request->get('isidatatable');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (App::isPosting($tglretur)) {
            $bulan = bulan(date('m', strtotime($tglretur)));
            $tahun = date('Y', strtotime($tglretur));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer') {
            $idbank = null;
        }

        if (empty($idreturpenjualan)) {

            $idreturpenjualan = $this->model->createID();
            $totalretur = 0;

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idreturpenjualan' => $idreturpenjualan,
                    'idbarang' => $isidatatable[$i]['idbarang'],
                    'jumlahretur' => untitik($isidatatable[$i]['jumlahretur']),
                    'hargaretur' => untitik($isidatatable[$i]['hargaretur']),
                    'subtotalretur' => untitik($isidatatable[$i]['subtotalretur']),
                );
                $hargaretur = untitik($isidatatable[$i]['hargaretur']) * untitik($isidatatable[$i]['jumlahretur']);
                $totalretur += $hargaretur;
            }



            $data = array(
                'idreturpenjualan' => $idreturpenjualan,
                'idpenjualan' => $idpenjualan,
                'tglretur' => $tglretur,
                'totalretur' => $totalretur,
                'keterangan' => $keterangan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
            );
            $simpan = $this->model->simpanData($data, $dataDetail, $idreturpenjualan);
        } else {
            return response()->json(array('msg' => 'Proses update tidak diperbolehkan untuk form ini!'));
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idreturpenjualan)
    {
        $idreturpenjualan = Crypt::decrypt($idreturpenjualan);
        try {
            $rsRetur = Returpenjualan::findOrFail($idreturpenjualan);
        } catch (ModelNotFoundException $e) {
            return redirect('/returpenjualan')->with('other', 'Data tidak ditemukan!');
        }

        $tglretur = $rsRetur->tglretur;
        if (App::isPosting($tglretur)) {
            $bulan = bulan(date('m', strtotime($tglretur)));
            $tahun = date('Y', strtotime($tglretur));
            return redirect('/returpenjualan')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $hapus = $this->model->hapusData($idreturpenjualan, $rsRetur);
        if ($hapus['status'] == 'success') {
            return redirect('/returpenjualan')->with('success', $hapus['message']);
        } else {
            return redirect('/returpenjualan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idreturpenjualan = $request->input('idreturpenjualan');
        $rsRetur = Returpenjualan::find($idreturpenjualan);

        $rsDetail = $this->model->getDetail($idreturpenjualan);
        return response()->json(array('rsRetur' => $rsRetur, 'rsDetail' => $rsDetail));
    }

    public function searchPenjualan(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Penjualan::where('idpenjualan', 'LIKE', "%{$search}%")
            ->orWhere('noinvoice', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpenjualan,
                'text' => $item->idpenjualan . ' - ' . tgldmy($item->tglinvoice),
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function getPenjualan(Request $request)
    {
        $idpenjualan = $request->input('idpenjualan');
        $rsPenjualan = Penjualan::find($idpenjualan);
        return response()->json($rsPenjualan);
    }

    public function searchBarangRetur(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian
        $idpenjualan = $request->input('idpenjualan');

        // Query pencarian
        $results = $this->model->searchBarangRetur($search, $idpenjualan);


        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idbarang,
                'text' => $item->namabarang,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function getDetailPenjualan(Request $request)
    {
        $idpenjualan = $request->idpenjualan;
        $idbarang = $request->idbarang;
        $rowBarang = $this->model->getDetailPenjualan($idpenjualan, $idbarang);
        return response()->json($rowBarang);
    }
}
