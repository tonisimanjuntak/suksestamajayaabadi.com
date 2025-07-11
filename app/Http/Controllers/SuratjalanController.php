<?php

namespace App\Http\Controllers;

use App\Models\Suratjalan;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use App\Models\Bank;
use App\Models\Konsumen;
use App\Models\Sales;
use TCPDF;

class SuratjalanController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Suratjalan;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'suratjalan';
        return view('suratjalan.index', $data);
    }

    public function tambah()
    {
        $data['idsuratjalan'] = '';
        $data['menu'] = 'suratjalan';
        return view('suratjalan.form', $data);
    }

    public function edit($idsuratjalan)
    {
        try {
            $idsuratjalan = Crypt::decrypt($idsuratjalan);
            $rsPenjualan = Suratjalan::findOrFail($idsuratjalan);
        } catch (ModelNotFoundException $e) {
            return redirect('/suratjalan')->with('other', 'Data tidak ditemukan!');
        }

        if ($this->model->sudahAdaPenagihan($idsuratjalan)) {
            return redirect('/suratjalan')->with('other', 'Tidak bisa diubah lagi! Karena sudah ada penagihan sales!');
        }

        $data['menu'] = 'suratjalan';
        $data['idsuratjalan'] = $idsuratjalan;
        return view('suratjalan.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Suratjalan::select(['idsuratjalan', 'tglsuratjalan', 'idkonsumen', 'namakonsumen', 'idjenisekspedisi', 'namajenisekspedisi', 'idekspedisi', 'namaekspedisi', 'identitasekspedisi', 'biayapengiriman', 'daftarnoinvoice']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idkonsumen = $request->input('idkonsumen');


        $query->whereBetween("tglsuratjalan", [$tglawal, $tglakhir]);
        if ($idkonsumen != '' && $idkonsumen != null) {
            $query->where('idkonsumen', $idkonsumen);
        }


        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idsuratjalan', 'LIKE', "%{$search}%")
                    ->orWhere('namakonsumen', 'LIKE', "%{$search}%")
                    ->orWhere('namaekspedisi', 'LIKE', "%{$search}%")
                    ->orWhere('daftarnoinvoice', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'tglsuratjalan', 'namaekspedisi', 'identitasekspedisi', 'namakonsumen', 'daftarnoinvoice', 'biayapengiriman', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglsuratjalan', 'Desc');
                $query->orderBy('idsuratjalan', 'Desc');
            }
        } else {
            $query->orderBy('tglsuratjalan', 'Desc');
            $query->orderBy('idsuratjalan', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Suratjalan::count();

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
                'tglsuratjalan' => tgldmy($row->tglsuratjalan) . '<br>' . $row->idsuratjalan,
                'namaekspedisi' => $row->namaekspedisi . '<br>(' . $row->namajenisekspedisi . ')',
                'identitasekspedisi' => $row->identitasekspedisi,
                'namakonsumen' => $row->namakonsumen,
                'daftarnoinvoice' => $row->daftarnoinvoice,
                'biayapengiriman' => format_rupiah($row->biayapengiriman),
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('suratjalan/cetaksuratjalan/' . Crypt::encrypt($row->idsuratjalan)) . '" class="dropdown-item" target="_blank">Cetak Surat Jalan</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="' . url('suratjalan/hapus/' . Crypt::encrypt($row->idsuratjalan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('suratjalan/edit/' . Crypt::encrypt($row->idsuratjalan)) . '" class="btn btn-warning">Edit</a>                                
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
        $idsuratjalan = $request->get('idsuratjalan');
        $tglsuratjalan = $request->get('tglsuratjalan');
        $idkonsumen = $request->get('idkonsumen');
        $idekspedisi = $request->get('idekspedisi');
        $idjenisekspedisi = $request->get('idjenisekspedisi');
        $biayapengiriman = untitik($request->get('biayapengiriman'));
        $identitasekspedisi = $request->get('identitasekspedisi');
        $total = untitik($request->get('total'));
        $isidatatable = $request->get('isidatatable');
        $isidatatableRincian = $request->get('isidatatableRincian');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        //periksa stok barang jika tidak mencukupi
        $periksaStok = $this->model->checkStokBarang($isidatatable);
        if (!$periksaStok['lanjut']) {
            return response()->json(array('msg' => $periksaStok['message']));
        }

        if ($biayapengiriman == "") {
            $biayapengiriman = 0;
        }

        if (empty($idsuratjalan)) {

            $idsuratjalan = $this->model->createID();

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idsuratjalan' => $idsuratjalan,
                    'idpenjualan' => $isidatatable[$i]['idpenjualan'],
                );
            }

            $dataDetailRincian = array();
            for ($i = 0; $i < count($isidatatableRincian); $i++) {
                $dataDetailRincian[] = array(
                    'idsuratjalan' => $idsuratjalan,
                    'qty' => $isidatatableRincian[$i]['qty'],
                    'satuan' => $isidatatableRincian[$i]['satuan'],
                    'keterangan' => $isidatatableRincian[$i]['keterangan'],
                );
            }

            $data = array(
                'idsuratjalan' => $idsuratjalan,
                'tglsuratjalan' => $tglsuratjalan,
                'idkonsumen' => $idkonsumen,
                'idekspedisi' => $idekspedisi,
                'idjenisekspedisi' => $idjenisekspedisi,
                'biayapengiriman' => $biayapengiriman,
                'identitasekspedisi' => $identitasekspedisi,
                'totaltagihan' => $total,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
            );

            $simpan = $this->model->simpanData($data, $dataDetail, $dataDetailRincian, $idsuratjalan);
        } else {

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idsuratjalan' => $idsuratjalan,
                    'idpenjualan' => $isidatatable[$i]['idpenjualan'],
                );
            }

            $dataDetailRincian = array();
            for ($i = 0; $i < count($isidatatableRincian); $i++) {
                $dataDetailRincian[] = array(
                    'idsuratjalan' => $idsuratjalan,
                    'qty' => $isidatatableRincian[$i]['qty'],
                    'satuan' => $isidatatableRincian[$i]['satuan'],
                    'keterangan' => $isidatatableRincian[$i]['keterangan'],
                );
            }

            $data = array(
                'idsuratjalan' => $idsuratjalan,
                'tglsuratjalan' => $tglsuratjalan,
                'idekspedisi' => $idekspedisi,
                'idjenisekspedisi' => $idjenisekspedisi,
                'biayapengiriman' => $biayapengiriman,
                'identitasekspedisi' => $identitasekspedisi,
                'totaltagihan' => $total,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
            );

            $simpan = $this->model->updateData($data, $dataDetail, $dataDetailRincian, $idsuratjalan);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }

    public function hapus($idsuratjalan)
    {
        $idsuratjalan = Crypt::decrypt($idsuratjalan);
        try {
            $rsSuratJalan = Suratjalan::findOrFail($idsuratjalan);
        } catch (ModelNotFoundException $e) {
            return redirect('/suratjalan')->with('other', 'Data tidak ditemukan!');
        }

        if ($this->model->sudahAdaPenagihan($idsuratjalan)) {
            return redirect('/suratjalan')->with('other', 'Tidak bisa dihapus lagi! Karena sudah ada penagihan sales!');
        }

        $hapus = $this->model->hapusData($idsuratjalan, $rsSuratJalan);
        if ($hapus['status'] == 'success') {
            return redirect('/suratjalan')->with('success', $hapus['message']);
        } else {
            return redirect('/suratjalan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idsuratjalan = $request->input('idsuratjalan');
        $rsSuratJalan = $this->model->getSuratJalanID($idsuratjalan);

        $rsDetail = $this->model->getDetail($idsuratjalan);
        $rsDetailRincian = $this->model->getDetailRincian($idsuratjalan);

        return response()->json(array('rsSuratJalan' => $rsSuratJalan, 'rsDetail' => $rsDetail, 'rsDetailRincian' => $rsDetailRincian));
    }

    public function searchInvoice(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian
        $idkonsumen = $request->input('idkonsumen');

        // Query pencarian
        $results = $this->model->get_penjualan_belumada_suratjalan($search, $idkonsumen);

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpenjualan,
                'text' => $item->tglinvoice . ' || No Invoice: ' . $item->noinvoice,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }

    public function cetaksuratjalan_temp($idsuratjalan)
    {
        $idsuratjalan = Crypt::decrypt($idsuratjalan);

        $rsSuratJalan = Suratjalan::findOrFail($idsuratjalan);
        $rsDetail = $this->model->getDetail($idsuratjalan);

        if ($rsDetail->isEmpty()) {
            return redirect('/suratjalan')->with('fail', 'Data tidak ditemukan!');
        }

        $data['idsuratjalan'] = $idsuratjalan;
        $data['rsSuratJalan'] = $rsSuratJalan;
        $data['rsDetail'] = $rsDetail;
        return view('suratjalan.cetaksuratjalan', $data);
    }

    public function cetaksuratjalan($idsuratjalan)
    {
        $idsuratjalan = Crypt::decrypt($idsuratjalan);
        $rsSuratJalan = Suratjalan::findOrFail($idsuratjalan);
        $rsRincian = $this->model->getDetailRincian($idsuratjalan);

        $rowKonsumen = Konsumen::find($rsSuratJalan->idkonsumen);

        $data['idsuratjalan'] = $idsuratjalan;
        $data['rowSuratJalan'] = $rsSuratJalan;
        $data['rsRincian'] = $rsRincian;
        $data['rowKonsumen'] = $rowKonsumen;
        return view('suratjalan.cetaksuratjalan', $data);
    }
}
