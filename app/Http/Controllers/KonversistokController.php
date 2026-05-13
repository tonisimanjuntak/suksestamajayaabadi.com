<?php

namespace App\Http\Controllers;

use App\Models\Konversistok;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use Illuminate\Support\Facades\DB;
use TCPDF;

class KonversistokController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Konversistok;
        $this->isLogin();
    }

    public function index()
    {
        $konversistok = $this->model->allView();
        $data['konversistok'] = $konversistok;
        $data['menu'] = 'konversistok';
        return view('konversistok.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'konversistok';
        $data['idkonversi'] = "";
        return view('konversistok.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Konversistok::select('*');

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $query->whereBetween(DB::raw("DATE(tglkonversi)"), [$tglawal, $tglakhir]);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idkonversi', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%")
                    ->orWhere('namabarangasal', 'LIKE', "%{$search}%")
                    ->orWhere('namabarangtujuan', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idkonversi', 'tglkonversi', 'keterangan', 'namabarangasal', 'namabarangtujuan', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglkonversi', 'Desc');
                $query->orderBy('idkonversi', 'Desc');
            }
        } else {
            $query->orderBy('tglkonversi', 'Desc');
            $query->orderBy('idkonversi', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Konversistok::count();

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
                'idkonversi' => $row->idkonversi,
                'tglkonversi' => $row->tglkonversi,
                'keterangan' => $row->keterangan . '<br>Operator: ' . $row->namapengguna,
                'namabarangasal' => '<strong>(' . $row->jlhbarangasal.' '.$row->namasatuanasal . ')</strong> '. $row->namabarangasal,
                'namabarangtujuan' => '<strong>(' . $row->jlhbarangtujuan.' '.$row->namasatuantujuan . ')</strong> ' .$row->namabarangtujuan,
                'action' => '<a href="' . url('konversistok/hapus/' . Crypt::encrypt($row->idkonversi)) . '" class="btn btn-danger btn-sm" id="btnHapus"><i class="fa fa-trash"></i></a>',
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
        $idkonversi = $request->get('idkonversi');
        $tglkonversi = date('Y-m-d H:i:s');
        $keterangan = $request->get('keterangan');
        $idbarangasal   = $request->get('idbarangasal');
        $idsatuanasal   = $request->get('idsatuanasal');
        $jumlahbarangasal   = $request->get('jumlahbarangasal');
        $idbarangtujuan   = $request->get('idbarangtujuan');
        $idsatuantujuan   = $request->get('idsatuantujuan');
        $jumlahbarangtujuan   = $request->get('jumlahbarangtujuan');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (App::isPosting($tglkonversi)) {
            $bulan = bulan(date('m', strtotime($tglkonversi)));
            $tahun = date('Y', strtotime($tglkonversi));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        $idkonversi = $this->model->createID();

        $data = array(
            'idkonversi' => $idkonversi,
            'tglkonversi' => $tglkonversi,
            'keterangan' => $keterangan,
            'idbarangasal' => $idbarangasal,
            'idsatuanasal' => $idsatuanasal,
            'jlhbarangasal' => $jumlahbarangasal,
            'idbarangtujuan' => $idbarangtujuan,
            'idsatuantujuan' => $idsatuantujuan,
            'jlhbarangtujuan' => $jumlahbarangtujuan,
            'inserted_date' => $inserted_date,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
        );

        $simpan = $this->model->simpanData($data);
        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }

    public function getDataID(Request $request)
    {
        $idkonversi = $request->input('idkonversi');
        $rsKonversi = Konversistok::find($idkonversi);
        return response()->json(array('$rsKonversi' => $rsKonversiStok));
    }



    public function hapus($idkonversi)
    {
        $idkonversi = Crypt::decrypt($idkonversi);
        try {
            $rsKonversi = Konversistok::findOrFail($idkonversi);
        } catch (ModelNotFoundException $e) {
            return redirect('/konversistok')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idkonversi, $rsKonversi);
        if ($hapus['status'] == 'success') {
            return redirect('/konversistok')->with('success', $hapus['message']);
        } else {
            return redirect('/konversistok')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }
    
}
