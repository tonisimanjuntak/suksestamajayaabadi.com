<?php

namespace App\Http\Controllers;

use App\Models\Returpembelian;
use App\Models\Uploads;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\Hutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;


class ReturpembelianController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Returpembelian;
        $this->isLogin();
    }

    public function index()
    {
        $returpembelian = $this->model->allView();
        $data['returpembelian'] = $returpembelian;
        $data['menu'] = 'returpembelian';
        return view('returpembelian.index', $data);
    }

    public function tambah()
    {
        $data['rsBarang'] = Barang::all();
        $data['menu'] = 'returpembelian';
        $data['idreturpembelian'] = "";
        return view('returpembelian.form', $data);
    }

    public function ubahstatus($idreturpembelian)
    {
        try {
            $idreturpembelian = Crypt::decrypt($idreturpembelian);
            $rsRetur = Returpembelian::findOrFail($idreturpembelian);
        } catch (ModelNotFoundException $e) {
            return redirect('/returpembelian')->with('other', 'Data tidak ditemukan!');
        }
        $idpembelian = $rsRetur->idpembelian;
        $rsPembelian = Pembelian::findOrFail($idpembelian);

        $data['rsBarang'] = Barang::all();
        $data['rsSupplier'] = Supplier::all();
        $data['menu'] = 'returpembelian';
        $data['idreturpembelian'] = $idreturpembelian;
        $data['rsPembelian'] = $rsPembelian;
        $data['rsRetur'] = $rsRetur;
        return view('returpembelian.ubahstatus', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Returpembelian::select(['idreturpembelian', 'tglretur', 'namasupplier', 'keterangan', 'carabayar', 'totalretur', 'namapengguna', 'statusretur', 'tglpengajuan', 'nofaktur', 'tglfaktur']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsupplier = $request->input('idsupplier');
        $carabayar = $request->input('carabayar');

        $query->whereBetween("tglpengajuan", [$tglawal, $tglakhir]);
        if ($idsupplier != '' && $idsupplier != null) {
            $query->where('idsupplier', $idsupplier);
        }

        if (!empty($carabayar)) {
            $query->where('carabayar', $carabayar);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idreturpembelian', 'LIKE', "%{$search}%")
                    ->orWhere('namasupplier', 'LIKE', "%{$search}%")
                    ->orWhere('namapengguna', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'tglpengajuan', 'nofaktur', 'namasupplier', 'keterangan', 'carabayar', 'totalretur', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglpengajuan', 'Desc');
                $query->orderBy('idreturpembelian', 'Desc');
            }
        } else {
            $query->orderBy('tglpengajuan', 'Desc');
            $query->orderBy('idreturpembelian', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Returpembelian::count();

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

            if ($row->statusretur == 'Proses') {
                $status = '<span class="badge badge-warning">Proses</span>';
            } else {
                $status = '<span class="badge badge-success">Selesai</span>';
            }

            $data[] = [
                'no' => $no++,
                'tglretur' => tgldmy($row->tglpengajuan) . '<br>' . $row->idreturpembelian,
                'nofaktur' => $row->nofaktur . '<br>' . tgldmy($row->tglfaktur) . '<br>',
                'namasupplier' => $row->namasupplier,
                'keterangan' => $row->keterangan,
                'carabayar' => $row->carabayar,
                'totalretur' => format_rupiah($row->totalretur),
                'status' => $status,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('returpembelian/hapus/' . Crypt::encrypt($row->idreturpembelian)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('returpembelian/ubahstatus/' . Crypt::encrypt($row->idreturpembelian)) . '" class="btn btn-warning">Ubah Status</a>                                
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
        $idreturpembelian = $request->get('idreturpembelian');
        $idpembelian = $request->get('idpembelian');
        $keterangan = $request->get('keterangan');
        $tglpengajuan = $request->get('tglpengajuan');
        $carabayar = null;
        $idbank = null;
        $isidatatable = $request->get('isidatatable');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($idreturpembelian)) {

            $idreturpembelian = $this->model->createID();
            $totalretur = 0;

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idreturpembelian' => $idreturpembelian,
                    'idbarang' => $isidatatable[$i]['idbarang'],
                    'jumlahretur' => untitik($isidatatable[$i]['jumlahretur']),
                    'hargaretur' => untitik($isidatatable[$i]['hargaretur']),
                    'subtotalretur' => untitik($isidatatable[$i]['subtotalretur']),
                );
                $hargaretur = untitik($isidatatable[$i]['hargaretur']) * untitik($isidatatable[$i]['jumlahretur']);
                $totalretur += $hargaretur;
            }

            $data = array(
                'idreturpembelian' => $idreturpembelian,
                'idpembelian' => $idpembelian,
                'tglpengajuan' => $tglpengajuan,
                'totalretur' => $totalretur,
                'keterangan' => $keterangan,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'carabayar' => $carabayar,
                'idbank' => $idbank,
                'statusretur' => 'Proses',
            );
            $simpan = $this->model->simpanData($data, $dataDetail, $idreturpembelian);
        } else {
            return response()->json(array('msg' => 'Proses update tidak diperbolehkan untuk form ini!'));
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }


    public function simpanubahstatus(Request $request)
    {
        $idreturpembelian = $request->get('idreturpembelian');
        $tglretur = $request->get('tglretur');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $updated_date = date('Y-m-d H:i:s');
        $statusretur = $request->get('statusretur');

        $rsRetur = Returpembelian::findOrFail($idreturpembelian);
        if ($rsRetur->statusretur == 'Selesai') {
            return response()->json(array("msg" => "Data sudah selesai di proses, tidak boleh diubah!"));
        }


        if (App::isPosting($tglretur)) {
            $bulan = bulan(date('m', strtotime($tglretur)));
            $tahun = date('Y', strtotime($tglretur));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer') {
            $idbank = null;
        }

        $data = array(
            'idreturpembelian' => $idreturpembelian,
            'tglretur' => $tglretur,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
            'carabayar' => $carabayar,
            'idbank' => $idbank,
            'statusretur' => $statusretur,
        );

        $simpan = $this->model->updateData($data, $idreturpembelian);


        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idreturpembelian)
    {
        $idreturpembelian = Crypt::decrypt($idreturpembelian);
        try {
            $rsRetur = Returpembelian::findOrFail($idreturpembelian);
        } catch (ModelNotFoundException $e) {
            return redirect('/returpembelian')->with('other', 'Data tidak ditemukan!');
        }

        $tglretur = $rsRetur->tglretur;
        if (App::isPosting($tglretur)) {
            $bulan = bulan(date('m', strtotime($tglretur)));
            $tahun = date('Y', strtotime($tglretur));
            return redirect('/returpembelian')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $hapus = $this->model->hapusData($idreturpembelian, $rsRetur);
        if ($hapus['status'] == 'success') {
            return redirect('/returpembelian')->with('success', $hapus['message']);
        } else {
            return redirect('/returpembelian')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idreturpembelian = $request->input('idreturpembelian');
        $rsRetur = Returpembelian::find($idreturpembelian);

        $rsDetail = $this->model->getDetail($idreturpembelian);
        return response()->json(array('rsRetur' => $rsRetur, 'rsDetail' => $rsDetail));
    }

    public function searchPembelian(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Pembelian::where('idpembelian', 'LIKE', "%{$search}%")
            ->orWhere('nofaktur', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpembelian,
                'text' => $item->idpembelian . ' - ' . tgldmy($item->tglfaktur),
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function getPembelian(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        $rsPembelian = Pembelian::find($idpembelian);
        return response()->json($rsPembelian);
    }

    public function searchBarangRetur(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian
        $idpembelian = $request->input('idpembelian');

        // Query pencarian
        $results = $this->model->searchBarangRetur($search, $idpembelian);


        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idbarang,
                'text' => $item->namabarang,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function getDetailPembelian(Request $request)
    {
        $idpembelian = $request->idpembelian;
        $idbarang = $request->idbarang;
        $rowBarang = $this->model->getDetailPembelian($idpembelian, $idbarang);
        return response()->json($rowBarang);
    }
}
