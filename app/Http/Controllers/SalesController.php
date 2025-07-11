<?php

namespace App\Http\Controllers;

use App\Models\Uploads;
use App\Models\Sales;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use App\Models\App;
use App\Models\Konsumen;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SalesController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Sales;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $sales = Sales::all();
        $data['sales'] = $sales;
        $data['menu'] = 'sales';
        return view('sales.index', $data);
    }

    public function tambah()
    {
        $rsWilayah = Wilayah::all();
        $data['menu'] = 'sales';
        $data['idsales'] = "";
        $data['rsWilayah'] = $rsWilayah;
        return view('sales.form', $data);
    }

    public function edit($idsales)
    {
        try {
            $idsales = Crypt::decrypt($idsales);
            $rsSales = Sales::findOrFail($idsales);
        } catch (ModelNotFoundException $e) {
            return redirect('/sales')->with('other', 'Data tidak ditemukan!');
        }
        $rsWilayah = Wilayah::all();
        $data['menu'] = 'sales';
        $data['idsales'] = $idsales;
        $data['rsWilayah'] = $rsWilayah;
        return view('sales.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Sales::select(['idsales', 'namasales', 'npwp', 'tempatlahir', 'tgllahir', 'email', 'nowa', 'statusaktif']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idsales', 'LIKE', "%{$search}%")
                ->orWhere('namasales', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idsales', 'namasales', 'npwp', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namasales', 'Asc');
            }
        } else {
            $query->orderBy('namasales', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Sales::count();

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
                'idsales' => $row->idsales,
                'namasales' => $row->namasales,
                'npwp' => $row->npwp,
                'tempatlahir' => $row->tempatlahir . '<br>' . $row->tgllahir,
                'email' => $row->email . '<br>' . $row->nowa,
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('sales/hapus/' . Crypt::encrypt($row->idsales)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('sales/edit/' . Crypt::encrypt($row->idsales)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }

        // 'action' => '<a href="' . url('sales/edit/' . Crypt::encrypt($row->idsales)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('sales/hapus/' . Crypt::encrypt($row->idsales)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

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
        $idsales = $request->get('idsales');
        $nik = $request->get('nik');
        $namasales = $request->get('namasales');
        $tempatlahir = $request->get('tempatlahir');
        $tgllahir = tglymd($request->get('tgllahir'));
        $jeniskelamin = $request->get('jeniskelamin');
        $agama = $request->get('agama');
        $statusperkawinan = $request->get('statusperkawinan');
        $alamatktp = $request->get('alamatktp');
        $tglkontrak = $request->get('tglkontrak');
        $nowa = $request->get('nowa');
        $email = $request->get('email');
        $alamattinggal = $request->get('alamattinggal');
        $statusaktif = $request->get('statusaktif');
        $idwilayah = $request->get('idwilayah');
        $npwp = $request->get('npwp');
        $targetpenjualan = untitik($request->get('targetpenjualan'));

        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        $filekontrak = $request->file('filekontrak');
        $filekontrak_lama = $request->get('filekontrak_lama');

        if (empty($tglkontrak)) {
            $tglkontrak = 'NULL';
        } else {
            $tglkontrak = tglymd($tglkontrak);
        }

        if (empty($email)) {
            $email = 'NULL';
        }

        $filekontrak_name = '';
        $uploads = Uploads::startUpload('uploads/sales/kontrak', $filekontrak, $filekontrak_lama, 200);
        if ($uploads['status'] == 'success') {
            $filekontrak_name = $uploads['file_name'];
        } else {
            return redirect('/sales')->with('fail', 'Data gagal disimpan! Error: ' . $uploads['message']);
        }



        if (empty($idsales)) {
            $idsales = $this->model->createID($namasales);

            $salesWilayah = array();
            for ($i = 0; $i < count($idwilayah); $i++) {

                $salesWilayah[] = array(
                    'idsales' => $idsales,
                    'idwilayah' => $idwilayah[$i],
                );
            }

            $data = array(
                'idsales' => $idsales,
                'namasales' => $namasales,
                'jeniskelamin' => $jeniskelamin,
                'nik' => $nik,
                'tempatlahir' => $tempatlahir,
                'tgllahir' => $tgllahir,
                'agama' => $agama,
                'alamatktp' => $alamatktp,
                'alamattinggal' => $alamattinggal,
                'statusperkawinan' => $statusperkawinan,
                'nowa' => $nowa,
                'email' => $email,
                'npwp' => $npwp,
                'tglkontrak' => $tglkontrak,
                'filekontrak' => $filekontrak_name,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
                'targetpenjualan' => $targetpenjualan,
            );
            $simpan = $this->model->simpanData($data, $salesWilayah);
        } else {

            $salesWilayah = array();
            for ($i = 0; $i < count($idwilayah); $i++) {

                $salesWilayah[] = array(
                    'idsales' => $idsales,
                    'idwilayah' => $idwilayah[$i],
                );
            }

            $data = array(
                'idsales' => $idsales,
                'namasales' => $namasales,
                'jeniskelamin' => $jeniskelamin,
                'nik' => $nik,
                'tempatlahir' => $tempatlahir,
                'tgllahir' => $tgllahir,
                'agama' => $agama,
                'alamatktp' => $alamatktp,
                'alamattinggal' => $alamattinggal,
                'statusperkawinan' => $statusperkawinan,
                'nowa' => $nowa,
                'email' => $email,
                'npwp' => $npwp,
                'tglkontrak' => $tglkontrak,
                'filekontrak' => $filekontrak_name,
                'updated_date' => $updated_date,
                'statusaktif' => $statusaktif,
                'targetpenjualan' => $targetpenjualan,
            );
            $simpan = $this->model->updateData($data, $idsales, $salesWilayah);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/sales')->with('success', $simpan['message']);
        } else {
            return redirect('/sales')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idsales)
    {
        $idsales = Crypt::decrypt($idsales);
        try {
            $rsSales = Sales::findOrFail($idsales);
        } catch (ModelNotFoundException $e) {
            return redirect('/sales')->with('other', 'Data tidak ditemukan!');
        }
        $filekontrak = $rsSales->filekontrak;


        $hapus = $this->model->hapusData($idsales, $rsSales);
        if ($hapus['status'] == 'success') {
            Uploads::hapusFile('uploads/sales/kontrak', $filekontrak);
            return redirect('/sales')->with('success', $hapus['message']);
        } else {
            return redirect('/sales')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idsales = $request->input('idsales');
        $rsSales = Sales::find($idsales);
        $rsWilayah = $this->model->getWilayahSales($idsales);
        $dataWilayah = array();

        if ($rsWilayah) {
            foreach ($rsWilayah as $rowWilayah) {
                // $dataWilayah[] = array(
                //     'id' => $rowWilayah->idwilayah,
                //     'text' => $rowWilayah->namawilayah,
                // );
                $dataWilayah[] = $rowWilayah->idwilayah;
            }
        }


        return response()->json(array('rsSales' => $rsSales, 'dataWilayah' => $dataWilayah));
    }

    public function searchSales(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Sales::where('namasales', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idsales,
                'text' => $item->namasales . ' (NPWP: ' . $item->npwp . ')',
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function getSalesByKonsumen(Request $request)
    {
        $idkonsumen = $request->idkonsumen;
        $rsKonsumen = Konsumen::find($idkonsumen);
        $idwilayahkonsumen = $rsKonsumen->idwilayah;
        $idsales = '';
        if (!empty($idwilayahkonsumen)) {
            $rsSales = $this->model->getSalesByWilayah($idwilayahkonsumen);
            if ($rsSales) {
                $idsales = $rsSales->idsales;
            }
        }
        return response()->json($idsales);
    }
}
