<?php

namespace App\Http\Controllers;

use App\Models\Uploads;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pembelianpenerimaan;
use App\Models\Pembelian;
use App\Models\Hutang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class PembelianpenerimaanController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Pembelianpenerimaan;
        $this->isLogin();
    }

    public function index()
    {
        $pembelian = $this->model->allView();
        $data['pembelianpenerimaan'] = $pembelian;
        $data['menu'] = 'pembelianpenerimaan';
        return view('pembelianpenerimaan.index', $data);
    }

    public function tambah()
    {
        $data['rsBarang'] = Barang::all();
        $data['menu'] = 'pembelianpenerimaan';
        $data['idpembelian'] = "";

        return view('pembelianpenerimaan.form', $data);
    }

    public function lihat($idpembelian)
    {
        try {
            $idpembelian = Crypt::decrypt($idpembelian);
            $rsPembelian = Pembelianpenerimaan::findOrFail($idpembelian);
        } catch (ModelNotFoundException $e) {
            return redirect('/pembelianpenerimaan')->with('other', 'Data tidak ditemukan!');
        }
        $data['rsBarang'] = Barang::all();
        $data['rsSupplier'] = Supplier::all();
        $data['menu'] = 'pembelianpenerimaan';
        $data['idpembelian'] = $idpembelian;
        return view('pembelianpenerimaan.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Pembelianpenerimaan::select(['idpembelian', 'tglfaktur', 'namasupplier', 'carabayar', 'keterangan', 'totalfaktur', 'namapengguna', 'nofaktur']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsupplier = $request->input('idsupplier');
        $carabayar = $request->input('carabayar');

        $query->whereBetween("tglfaktur", [$tglawal, $tglakhir]);
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
                $groupwhere->where('idpembelian', 'LIKE', "%{$search}%")
                    ->orWhere('nofaktur', 'LIKE', "%{$search}%")
                    ->orWhere('namasupplier', 'LIKE', "%{$search}%")
                    ->orWhere('namapengguna', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpembelian', 'tglfaktur', 'namasupplier', 'carabayar', 'keterangan', 'totalfaktur', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglfaktur', 'Desc');
                $query->orderBy('idpembelian', 'Desc');
            }
        } else {
            $query->orderBy('tglfaktur', 'Desc');
            $query->orderBy('idpembelian', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Pembelianpenerimaan::count();

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
                'idpembelian' => $row->idpembelian,
                'tglfaktur' => $row->tglfaktur . '<br>' . $row->nofaktur,
                'namasupplier' => $row->namasupplier,
                'keterangan' => $row->keterangan,
                'carabayar' => $row->carabayar,
                'totalfaktur' => format_rupiah($row->totalfaktur),
                'namapengguna' => $row->namapengguna,

                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pembelianpenerimaan/hapus/' . Crypt::encrypt($row->idpembelian)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-info" data-idpembelian="' . $row->idpembelian . '" id="btnLihatPenerimaan">Lihat</a>
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
        $nofaktur = $request->get('nofaktur');
        $tglfaktur = $request->get('tglfaktur');
        $tglditerima = $request->get('tglditerima');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $idsupplier = $request->get('idsupplier');
        $idekspedisi = $request->get('idekspedisi');
        $keterangan = $request->get('keterangan');
        $nobilyetgiro = $request->get('nobilyetgiro');
        $tglbilyetgiro = $request->get('tglbilyetgiro');

        $totaldpp = untitik($request->get('totaldpp'));

        $totaldiskon = untitik($request->get('totaldiskon'));
        $ppnpersen = untitik($request->get('ppnpersen'));
        $totalppn = untitik($request->get('totalppn'));
        $totalpotongan = untitik($request->get('totalpotongan'));
        $totalfaktur = untitik($request->get('totalfaktur'));
        $biayapengiriman = untitik($request->get('biayapengiriman'));

        $biayapengiriman = empty($biayapengiriman) ? 0 : $biayapengiriman;

        $isidatatable = $request->get('isidatatable');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglfaktur)) {
            $bulan = bulan(date('m', strtotime($tglfaktur)));
            $tahun = date('Y', strtotime($tglfaktur));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        if ($carabayar != 'Transfer' && $carabayar != 'Giro') {
            $idbank = null;
        }

        if ($carabayar != 'Giro') {
            $nobilyetgiro = null;
        }

        if ($totalpotongan == "") {
            $totalpotongan = 0;
        }

        if ($biayapengiriman == "") {
            $biayapengiriman = 0;
        }

        //cek jika sudah dilakukan pembayaran hutang
        if (Hutang::hutangSudahDibayar($idpembelian)) {
            return response()->json(array('msg' => 'Hutang untuk faktur ini sudah dilakukan pembayaran sehingga tidak dapat diubah lagi!'));
        }

        $dataDetail = array();
        for ($i = 0; $i < count($isidatatable); $i++) {
            $dataDetail[] = array(
                'idpembelian' => $idpembelian,
                'iddetail' => $isidatatable[$i]['iddetail'],
                'idbarang' => $isidatatable[$i]['idbarang'],
                'jumlahbeli' => untitik($isidatatable[$i]['jumlahbeli']),
                'hargasatuan' => untitik($isidatatable[$i]['hargasatuan']),
                'hargadpp' => untitik($isidatatable[$i]['hargadpp']),
                'jumlahppn' => untitik($isidatatable[$i]['jumlahppn']),
                'jumlahdiskon' => $isidatatable[$i]['jumlahdiskon'],
                'subtotalbeli' => untitik($isidatatable[$i]['subtotalbeli']),
                'jenisdiskon' => $isidatatable[$i]['jenisdiskon'],
                'diskonpersen1' => $isidatatable[$i]['diskonpersen1'],
                'diskonpersen2' => $isidatatable[$i]['diskonpersen2'],
                'diskonpersen3' => $isidatatable[$i]['diskonpersen3']
            );
        }

        $data = array(
            'idpembelian' => $idpembelian,
            'nofaktur' => $nofaktur,
            'tglfaktur' => $tglfaktur,
            'tglditerima' => $tglditerima,
            'idsupplier' => $idsupplier,
            'idekspedisi' => $idekspedisi,
            'keterangan' => $keterangan,
            'totaldpp' => $totaldpp,
            'totaldiskon' => $totaldiskon,
            'ppnpersen' => $ppnpersen,
            'totalppn' => $totalppn,
            'totalpotongan' => $totalpotongan,
            'totalfaktur' => $totalfaktur,
            'biayapengiriman' => $biayapengiriman,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
            'carabayar' => $carabayar,
            'idbank' => $idbank,
            'nobilyetgiro' => $nobilyetgiro,
            'tglbilyetgiro' => $tglbilyetgiro,
            'statuspenerimaan' => 'Sudah Diterima',
        );

        $simpan = $this->model->updateData($data, $dataDetail, $idpembelian);

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
            $rsPembelian = Pembelianpenerimaan::findOrFail($idpembelian);
        } catch (ModelNotFoundException $e) {
            return redirect('/pembelianpenerimaan')->with('other', 'Data tidak ditemukan!');
        }

        $tglfaktur = $rsPembelian->tglfaktur;
        if (App::isPosting($tglfaktur)) {
            $bulan = bulan(date('m', strtotime($tglfaktur)));
            $tahun = date('Y', strtotime($tglfaktur));
            return redirect('/pembelianpenerimaan')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran hutang
        if (Hutang::hutangSudahDibayar($idpembelian)) {
            return redirect('/pembelianpenerimaan')->with('fail', 'Data gagal dihapus! Hutang untuk faktur ini sudah dilakukan pembayaran sehingga tidak dapat dihapus lagi!');
        }

        $hapus = $this->model->hapusData($idpembelian, $rsPembelian);
        if ($hapus['status'] == 'success') {
            return redirect('/pembelianpenerimaan')->with('success', $hapus['message']);
        } else {
            return redirect('/pembelianpenerimaan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        $rsPembelian = Pembelianpenerimaan::find($idpembelian);

        $rsDetail = $this->model->getDetail($idpembelian);
        return response()->json(array('rsPembelian' => $rsPembelian, 'rsDetail' => $rsDetail));
    }

    public function searchFaktur(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian
        $idsupplier = $request->input('idsupplier'); // Ambil parameter pencarian

        // Query pencarian
        $results = Pembelianpenerimaan::where('nofaktur', 'LIKE', "%{$search}%")
            ->where('idsupplier', $idsupplier)
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpembelian,
                'text' => $item->tglfaktur . ' || No Faktur: ' . $item->nofaktur,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchFakturHutang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Pembelianpenerimaan::where('nofaktur', 'LIKE', "%{$search}%")
            ->where('carabayar', 'Hutang')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpembelian,
                'text' => $item->tglfaktur . ' || No Faktur: ' . $item->nofaktur,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function searchPO(Request $request)
    {
        $idsupplier = $request->input('idsupplier'); // Ambil parameter pencarian
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Pembelian::where('statuspenerimaan', 'Belum Diterima')
            ->where('idsupplier', $idsupplier)
            ->where('idpembelian', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpembelian,
                'text' => $item->idpembelian . ' || Tgl PO: ' . tgldmy($item->tgl_po),
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function getPurchaseOrder(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        $rsPembelian = Pembelian::find($idpembelian);
        $rsPembelianDetail = Pembelian::getDetail($idpembelian);

        return response()->json(['rsPembelian' => $rsPembelian, 'rsPembelianDetail' => $rsPembelianDetail]);
    }

    public function getDetailId(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        $idbarang = $request->input('idbarang');
        $rowDetail = $this->model->getDetailId($idpembelian, $idbarang);
        return response()->json(['rowDetail' => $rowDetail]);
    }

    public function getModalInfo(Request $request)
    {
        $idpembelian = $request->input('idpembelian');
        $rsPembelian = Pembelianpenerimaan::find($idpembelian);
        $rsPembelianDetail = $this->model->getDetail($idpembelian);
        return response()->json(['rsPembelian' => $rsPembelian, 'rsPembelianDetail' => $rsPembelianDetail]);
    }
}
