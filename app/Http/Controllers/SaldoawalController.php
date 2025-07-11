<?php

namespace App\Http\Controllers;

use App\Models\Saldoawal;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class SaldoawalController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Saldoawal;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'saldoawal';
        return view('saldoawal.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'saldoawal';
        $data['idsaldoawal'] = "";
        return view('saldoawal.form', $data);
    }

    public function edit($idsaldoawal)
    {
        try {
            $idsaldoawal = Crypt::decrypt($idsaldoawal);
            $rsSaldoAwal = Saldoawal::findOrFail($idsaldoawal);
        } catch (ModelNotFoundException $e) {
            return redirect('/saldoawal')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'saldoawal';
        $data['idsaldoawal'] = $idsaldoawal;
        return view('saldoawal.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Saldoawal::select(['idsaldoawal', 'tahun', 'totaldebet', 'totalkredit']);

        $tahun = $request->input('tahun');

        $query->where('tahun', $tahun);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('tahun', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'tahun', null, null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tahun', 'Desc');
            }
        } else {
            $query->orderBy('tahun', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Saldoawal::count();

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
                'tahun' => $row->tahun,
                'totaldebet' => format_rupiah($row->totaldebet),
                'totalkredit' => format_rupiah($row->totalkredit),
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('saldoawal/hapus/' . Crypt::encrypt($row->idsaldoawal)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('saldoawal/edit/' . Crypt::encrypt($row->idsaldoawal)) . '" class="btn btn-warning">Edit</a>                                
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
        $idsaldoawal = $request->get('idsaldoawal');
        $tahun = $request->get('tahun');
        $totaldebet = untitik($request->get('totaldebet'));
        $totalkredit = untitik($request->get('totalkredit'));
        $isidatatable = $request->get('isidatatable');

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (empty($idsaldoawal)) {

            $idjurnal = $tahun . '0101SA00000';

            $idsaldoawal = $tahun;
            $dataDetailSaldoAwal = array();
            $dataDetailJurnal = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetailSaldoAwal[] = array(
                    'idsaldoawal' => $idsaldoawal,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'debet' => untitik($isidatatable[$i]['debet']),
                    'kredit' => untitik($isidatatable[$i]['kredit']),
                );
                $dataDetailJurnal[] = array(
                    'idjurnal' => $idjurnal,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'debet' => untitik($isidatatable[$i]['debet']),
                    'kredit' => untitik($isidatatable[$i]['kredit']),
                );
            }

            $dataSaldoAwal = array(
                'idsaldoawal' => $idsaldoawal,
                'tahun' => $tahun,
                'totaldebet' => $totaldebet,
                'totalkredit' => $totalkredit,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
            );

            $dataJurnal = array(
                'idjurnal' => $idjurnal,
                'tgljurnal' => $tahun . '-01-01',
                'keterangan' => 'Saldo Awal Tahun ' . $tahun,
                'totaldebet' => $totaldebet,
                'totalkredit' => $totalkredit,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'jenis' => 'Saldo Awal',
            );
            $simpan = $this->model->simpanData($dataSaldoAwal, $dataJurnal, $dataDetailSaldoAwal, $dataDetailJurnal, $idsaldoawal);
        } else {

            $tahun = $idsaldoawal; //idsaldoawal = tahun

            $idjurnal = $tahun . '0101SA00000';

            $dataDetailSaldoAwal = array();
            $dataDetailJurnal = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetailSaldoAwal[] = array(
                    'idsaldoawal' => $idsaldoawal,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'debet' => untitik($isidatatable[$i]['debet']),
                    'kredit' => untitik($isidatatable[$i]['kredit']),
                );
                $dataDetailJurnal[] = array(
                    'idjurnal' => $idjurnal,
                    'kdakun' => $isidatatable[$i]['kdakun'],
                    'debet' => untitik($isidatatable[$i]['debet']),
                    'kredit' => untitik($isidatatable[$i]['kredit']),
                );
            }

            $dataSaldoAwal = array(
                'idsaldoawal' => $idsaldoawal,
                'tahun' => $tahun,
                'totaldebet' => $totaldebet,
                'totalkredit' => $totalkredit,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
            );

            $dataJurnal = array(
                'idjurnal' => $idjurnal,
                'tgljurnal' => $tahun . '-01-01',
                'keterangan' => 'Saldo Awal Tahun ' . $tahun,
                'totaldebet' => $totaldebet,
                'totalkredit' => $totalkredit,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'jenis' => 'Saldo Awal',
            );

            $simpan = $this->model->updateData($dataSaldoAwal, $dataJurnal, $dataDetailSaldoAwal, $dataDetailJurnal, $idsaldoawal, $idjurnal);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }



    public function hapus($idsaldoawal)
    {
        $idsaldoawal = Crypt::decrypt($idsaldoawal);
        try {
            $rsSaldoAwal = Saldoawal::findOrFail($idsaldoawal);
        } catch (ModelNotFoundException $e) {
            return redirect('/saldoawal')->with('other', 'Data tidak ditemukan!');
        }

        $tahun = $rsSaldoAwal->tahun;
        if (App::isPosting($tahun)) {
            $bulan = bulan(date('m', strtotime($tahun)));
            $tahun = date('Y', strtotime($tahun));
            return redirect('/saldoawal')->with('fail', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        $hapus = $this->model->hapusData($idsaldoawal, $rsSaldoAwal);
        if ($hapus['status'] == 'success') {
            return redirect('/saldoawal')->with('success', $hapus['message']);
        } else {
            return redirect('/saldoawal')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idsaldoawal = $request->input('idsaldoawal');
        $rsSaldoAwal = Saldoawal::find($idsaldoawal);

        $rsDetail = $this->model->getDetail($idsaldoawal);
        return response()->json(array('rsSaldoAwal' => $rsSaldoAwal, 'rsDetail' => $rsDetail));
    }
}
