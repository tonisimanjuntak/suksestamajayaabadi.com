<?php

namespace App\Http\Controllers;

use App\Models\Hutangekspedisi;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use TCPDF;

class HutangekspedisiController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Hutangekspedisi;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'hutangekspedisi';
        return view('hutangekspedisi.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'hutangekspedisi';
        $data['idhutangekspedisi'] = "";
        return view('hutangekspedisi.form', $data);
    }

    public function edit($idhutangekspedisi)
    {
        try {
            $idhutangekspedisi = Crypt::decrypt($idhutangekspedisi);
            $rsHutang = Hutangekspedisi::findOrFail($idhutangekspedisi);
        } catch (ModelNotFoundException $e) {
            return redirect('/hutangekspedisi')->with('other', 'Data tidak ditemukan!');
        }

        $tglhutang = $rsHutang->tglhutang;
        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return redirect('/hutangekspedisi')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $data['menu'] = 'hutangekspedisi';
        $data['idhutangekspedisi'] = $idhutangekspedisi;
        return view('hutangekspedisi.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Hutangekspedisi::select('*');

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idekspedisi = $request->input('idekspedisi');

        $query->whereBetween("tglhutang", [$tglawal, $tglakhir]);
        if ($idekspedisi != '' && $idekspedisi != null) {
            $query->where('idekspedisi', $idekspedisi);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idhutangekspedisi', 'LIKE', "%{$search}%")
                    ->orWhere('namaekspedisi', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'tglhutang', 'idhutangekspedisi', 'namaekspedisi', 'kredit', 'debet', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglhutang', 'Desc');
                $query->orderBy('idhutangekspedisi', 'Desc');
            }
        } else {
            $query->orderBy('tglhutang', 'Desc');
            $query->orderBy('idhutangekspedisi', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Hutangekspedisi::count();

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

            $btnAksi = '';
            if ($row->jenis == 'Pembayaran') {
                $btnAksi = '<div class="btn-group btn-block">
                                    <div class="btn-group dropleft" role="group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropleft</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="' . url('hutangekspedisi/hapus/' . Crypt::encrypt($row->idhutangekspedisi)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                        </div>
                                    </div>
                                    <a href="' . url('hutangekspedisi/edit/' . Crypt::encrypt($row->idhutangekspedisi)) . '" class="btn btn-warning">Edit</a>                                
                                </div>';
            }

            $data[] = [
                'no' => $no++,
                'tglhutang' => tgldmy($row->tglhutang),
                'idhutangekspedisi' => $row->idhutangekspedisi,
                'namaekspedisi' => $row->namaekspedisi,
                'kredit' => format_rupiah($row->kredit),
                'debet' => format_rupiah($row->debet),
                'action' => $btnAksi,
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

    public function simpanPembayaran(Request $request)
    {
        $idhutangekspedisi = $request->get('idhutangekspedisi');
        $tglhutang = $request->get('tglhutang');
        $idekspedisi = $request->get('idekspedisi');
        $keterangan = $request->get('keterangan');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $nobilyetgiro = $request->get('nobilyetgiro');
        $debet = untitik($request->get('debet'));
        $hargadpp = untitik($request->get('hargadpp'));
        $persenppn = format_decimal($request->get('persenppn'), 2);
        $jumlahppn = untitik($request->get('jumlahppn'));
        $persenpph23 = format_decimal($request->get('persenpph23'), 2);
        $jumlahpph23 = untitik($request->get('jumlahpph23'));

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return redirect('/hutangekspedisi')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        if ($carabayar != 'Transfer' && $carabayar != 'Giro') {
            $idbank = null;
        }
        if ($carabayar != 'Giro') {
            $nobilyetgiro = null;
        }

        if (empty($idhutangekspedisi)) {
            $idhutangekspedisi = $this->model->createID();

            $data = array(
                'idhutangekspedisi' => $idhutangekspedisi,
                'tglhutang' => $tglhutang,
                'idekspedisi' => $idekspedisi,
                'debet' => $debet,
                'kredit' => 0,
                'jenissumber' => 'Pembayaran',
                'jenis' => 'Pembayaran',
                'keterangan' => $keterangan,
                'carabayar' => $carabayar,
                'idbank' => $idbank,
                'nobilyetgiro' => $nobilyetgiro,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'hargadpp' => $hargadpp,
                'persenppn' => $persenppn,
                'jumlahppn' => $jumlahppn,
                'persenpph23' => $persenpph23,
                'jumlahpph23' => $jumlahpph23,
            );

            $simpan = $this->model->simpanPembayaran($data, $idhutangekspedisi);
        } else {
            $data = array(
                'idhutangekspedisi' => $idhutangekspedisi,
                'tglhutang' => $tglhutang,
                'idekspedisi' => $idekspedisi,
                'debet' => $debet,
                'kredit' => 0,
                'jenissumber' => 'Pembayaran',
                'jenis' => 'Pembayaran',
                'keterangan' => $keterangan,
                'carabayar' => $carabayar,
                'idbank' => $idbank,
                'nobilyetgiro' => $nobilyetgiro,
                'updated_date' => $updated_date,
                'hargadpp' => $hargadpp,
                'persenppn' => $persenppn,
                'jumlahppn' => $jumlahppn,
                'persenpph23' => $persenpph23,
                'jumlahpph23' => $jumlahpph23,
            );

            $simpan = $this->model->updatePembayaran($data, $idhutangekspedisi);
        }

        if ($simpan['status'] == 'success') {
            return redirect('/hutangekspedisi')->with('success', $simpan['message']);
        } else {
            return redirect('/hutangekspedisi')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }


    public function hapus($idhutangekspedisi)
    {
        $idhutangekspedisi = Crypt::decrypt($idhutangekspedisi);
        try {
            $rsHutang = Hutangekspedisi::findOrFail($idhutangekspedisi);
        } catch (ModelNotFoundException $e) {
            return redirect('/hutangekspedisi')->with('other', 'Data tidak ditemukan!');
        }

        $jenissumber = $rsHutang->jenissumber;
        if ($jenissumber == 'Pembelian' || $jenissumber == 'Penjualan') {
            return redirect('/hutangekspedisi')->with('other', 'Hutangekspedisi ini berasal dari Pembelian atau Penjualan, tidak bisa dihapus!');
        };

        $tglhutang = $rsHutang->tglhutang;
        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return redirect('/hutangekspedisi')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $hapus = $this->model->hapus($idhutangekspedisi, $rsHutang);
        if ($hapus['status'] == 'success') {
            return redirect('/hutangekspedisi')->with('success', $hapus['message']);
        } else {
            return redirect('/hutangekspedisi')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idhutangekspedisi = $request->input('idhutangekspedisi');
        $rsHutang = Hutangekspedisi::find($idhutangekspedisi);
        return response()->json(array('rsHutang' => $rsHutang));
    }
}
