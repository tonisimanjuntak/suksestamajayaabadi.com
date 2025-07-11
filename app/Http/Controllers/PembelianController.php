<?php

namespace App\Http\Controllers;

use App\Models\Uploads;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\Hutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class PembelianController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Pembelian;
        $this->isLogin();
    }

    public function index()
    {
        $pembelian = $this->model->allView();
        $data['pembelian'] = $pembelian;
        $data['menu'] = 'pembelian';
        return view('pembelian.index', $data);
    }

    public function tambah()
    {
        $data['rsBarang'] = Barang::all();
        $data['menu'] = 'pembelian';
        $data['idpembelian'] = "";
        return view('pembelian.form', $data);
    }

    public function edit($idpembelian)
    {
        try {
            $idpembelian = Crypt::decrypt($idpembelian);
            $rsPembelian = Pembelian::findOrFail($idpembelian);
        } catch (ModelNotFoundException $e) {
            return redirect('/pembelian')->with('other', 'Data tidak ditemukan!');
        }

        if ($rsPembelian->statuspenerimaan == 'Sudah Diterima') {
            return redirect('/pembelian')->with('other', 'Tidak boleh diubah karena order ini sudah ada penerimaan barang nya.!');
        }

        $tgl_po = $rsPembelian->tgl_po;
        if (App::isPosting($tgl_po)) {
            $bulan = bulan(date('m', strtotime($tgl_po)));
            $tahun = date('Y', strtotime($tgl_po));
            return redirect('/pembelian')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $data['rsBarang'] = Barang::all();
        $data['rsSupplier'] = Supplier::all();
        $data['menu'] = 'pembelian';
        $data['idpembelian'] = $idpembelian;
        return view('pembelian.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Pembelian::select(['idpembelian', 'tgl_po', 'namasupplier', 'keterangan_po', 'totalfaktur_po', 'nofaktur']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsupplier = $request->input('idsupplier');

        $query->whereBetween("tgl_po", [$tglawal, $tglakhir]);
        if ($idsupplier != '' && $idsupplier != null) {
            $query->where('idsupplier', $idsupplier);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpembelian', 'LIKE', "%{$search}%")
                    ->orWhere('namasupplier', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'tgl_po', 'namasupplier', 'keterangan', 'totalfaktur_po', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tgl_po', 'Desc');
                $query->orderBy('idpembelian', 'Desc');
            }
        } else {
            $query->orderBy('tgl_po', 'Desc');
            $query->orderBy('idpembelian', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Pembelian::count();

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

            if (!empty($row->nofaktur)) {
                $nofaktur = '<i class="fa fa-check-circle text-success"></i> ' . $row->nofaktur;
            } else {
                $nofaktur = '-';
            }

            $data[] = [
                'no' => $no++,
                'tgl_po' => tgldmy($row->tgl_po) . '<br>' . $row->idpembelian,
                'namasupplier' => $row->namasupplier,
                'keterangan_po' => $row->keterangan_po,
                'totalfaktur_po' => format_rupiah($row->totalfaktur_po),
                'nofaktur' => $nofaktur,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pembelian/hapus/' . Crypt::encrypt($row->idpembelian)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pembelian/edit/' . Crypt::encrypt($row->idpembelian)) . '" class="btn btn-warning">Edit</a>                                
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
        $idpembelian = $request->get('idpembelian');
        $tgl_po = $request->get('tgl_po');
        $idsupplier = $request->get('idsupplier');
        $keterangan = $request->get('keterangan');

        $totaldpp = untitik($request->get('totaldpp'));
        $totaldiskon = untitik($request->get('totaldiskon'));
        $ppnpersen = untitik($request->get('ppnpersen'));
        $totalppn = untitik($request->get('totalppn'));
        $totalfaktur = untitik($request->get('totalfaktur'));

        $isidatatable = $request->get('isidatatable');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tgl_po)) {
            $bulan = bulan(date('m', strtotime($tgl_po)));
            $tahun = date('Y', strtotime($tgl_po));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if (empty($idpembelian)) {

            $idpembelian = $this->model->createID();

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpembelian' => $idpembelian,
                    'idbarang' => $isidatatable[$i]['idbarang'],
                    'jumlahbeli_po' => untitik($isidatatable[$i]['jumlahbeli']),
                    'hargasatuan_po' => untitik($isidatatable[$i]['hargasatuan']),
                    'hargadpp_po' => untitik($isidatatable[$i]['hargadpp']),
                    'jumlahppn_po' => untitik($isidatatable[$i]['jumlahppn']),
                    'subtotalbeli_po' => untitik($isidatatable[$i]['subtotalbeli']),
                );
            }

            $data = array(
                'idpembelian' => $idpembelian,
                'idsupplier' => $idsupplier,
                'ppnpersen' => $ppnpersen,
                'tgl_po' => $tgl_po,
                'keterangan_po' => $keterangan,
                'totaldpp_po' => $totaldpp,
                'totalppn_po' => $totalppn,
                'totalfaktur_po' => $totalfaktur,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna_po' => session('idpengguna'),
            );
            $simpan = $this->model->simpanData($data, $dataDetail, $idpembelian);
        } else {

            //cek jika sudah dilakukan pembayaran hutang
            if (Hutang::hutangSudahDibayar($idpembelian)) {
                return response()->json(array('msg' => 'Hutang untuk faktur ini sudah dilakukan pembayaran sehingga tidak dapat diubah lagi!'));
            }

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpembelian' => $idpembelian,
                    'idbarang' => $isidatatable[$i]['idbarang'],
                    'jumlahbeli_po' => untitik($isidatatable[$i]['jumlahbeli']),
                    'hargasatuan_po' => untitik($isidatatable[$i]['hargasatuan']),
                    'hargadpp_po' => untitik($isidatatable[$i]['hargadpp']),
                    'jumlahppn_po' => untitik($isidatatable[$i]['jumlahppn']),
                    'subtotalbeli_po' => untitik($isidatatable[$i]['subtotalbeli']),
                );
            }

            $data = array(
                'idpembelian' => $idpembelian,
                'idsupplier' => $idsupplier,
                'ppnpersen' => $ppnpersen,
                'tgl_po' => $tgl_po,
                'keterangan_po' => $keterangan,
                'totaldpp_po' => $totaldpp,
                'totalppn_po' => $totalppn,
                'totalfaktur_po' => $totalfaktur,
                'updated_date' => $updated_date,
                'idpengguna_po' => session('idpengguna'),
            );

            $simpan = $this->model->updateData($data, $dataDetail, $idpembelian);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idpembelian)
    {
        $idpembelian = Crypt::decrypt($idpembelian);
        try {
            $rsPembelian = Pembelian::findOrFail($idpembelian);
        } catch (ModelNotFoundException $e) {
            return redirect('/pembelian')->with('other', 'Data tidak ditemukan!');
        }

        if ($rsPembelian->statuspenerimaan == 'Sudah Diterima') {
            return redirect('/pembelian')->with('other', 'Tidak boleh dihapus karena order ini sudah ada penerimaan barang nya.!');
        }

        $tgl_po = $rsPembelian->tgl_po;
        if (App::isPosting($tgl_po)) {
            $bulan = bulan(date('m', strtotime($tgl_po)));
            $tahun = date('Y', strtotime($tgl_po));
            return redirect('/pembelian')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran hutang
        if (Hutang::hutangSudahDibayar($idpembelian)) {
            return redirect('/pembelian')->with('fail', 'Data gagal dihapus! Hutang untuk faktur ini sudah dilakukan pembayaran sehingga tidak dapat dihapus lagi!');
        }

        $hapus = $this->model->hapusData($idpembelian, $rsPembelian);
        if ($hapus['status'] == 'success') {
            return redirect('/pembelian')->with('success', $hapus['message']);
        } else {
            return redirect('/pembelian')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        $rsPembelian = Pembelian::find($idpembelian);

        $rsDetail = $this->model->getDetail($idpembelian);
        return response()->json(array('rsPembelian' => $rsPembelian, 'rsDetail' => $rsDetail));
    }

    public function searchFaktur(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Pembelian::where('nofaktur', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpembelian,
                'text' => $item->tgl_po . ' || No Faktur: ' . $item->nofaktur,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchFakturHutang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Pembelian::where('nofaktur', 'LIKE', "%{$search}%")
            ->where('carabayar', 'Hutang')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpembelian,
                'text' => $item->tgl_po . ' || No Faktur: ' . $item->nofaktur,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
