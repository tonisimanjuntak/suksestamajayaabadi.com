<?php

namespace App\Http\Controllers;

use App\Models\Stockopname;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use Illuminate\Support\Facades\DB;
use TCPDF;

class StockopnameController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Stockopname;
        $this->isLogin();
    }

    public function index()
    {
        $stockopname = $this->model->allView();
        $data['stockopname'] = $stockopname;
        $data['menu'] = 'stockopname';
        return view('stockopname.index', $data);
    }

    public function tambah()
    {
        $data['rsBarang'] = Barang::getStatusAktif();
        $data['menu'] = 'stockopname';
        $data['idstockopname'] = "";
        return view('stockopname.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Stockopname::select(['idstockopname', 'tglstockopname', 'keterangan', 'namapengguna']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $query->whereBetween(DB::raw("DATE(tglstockopname)"), [$tglawal, $tglakhir]);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idstockopname', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idstockopname', 'tglstockopname', 'keterangan', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglstockopname', 'Desc');
                $query->orderBy('idstockopname', 'Desc');
            }
        } else {
            $query->orderBy('tglstockopname', 'Desc');
            $query->orderBy('idstockopname', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Stockopname::count();

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
                'idstockopname' => $row->idstockopname,
                'tglstockopname' => $row->tglstockopname,
                'keterangan' => $row->keterangan,
                'namapengguna' => $row->namapengguna,
                'action' => '<a href="' . url('stockopname/cetakSO/' . Crypt::encrypt($row->idstockopname)) . '" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"></i></a>',
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
        $idstockopname = $request->get('idstockopname');
        $tglstockopname = date('Y-m-d H:i:s');
        $keterangan = $request->get('keterangan');
        $detailStockOpname = $request->get('detailStockOpname');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglstockopname)) {
            $bulan = bulan(date('m', strtotime($tglstockopname)));
            $tahun = date('Y', strtotime($tglstockopname));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }


        $idstockopname = $this->model->createID();

        $totalsebelumdiskon = 0;
        $totalsetelahdiskon = 0;

        $dataDetail = array();
        for ($i = 0; $i < count($detailStockOpname); $i++) {
            $dataDetail[] = array(
                'idstockopname' => $idstockopname,
                'idbarang' => $detailStockOpname[$i]['idbarang'],
                'stocksystem' => $detailStockOpname[$i]['stok'],
                'stockopname' => $detailStockOpname[$i]['nilaiinput'],
                'keterangandetail' => $detailStockOpname[$i]['keterangandetail'],
            );
        }

        $data = array(
            'idstockopname' => $idstockopname,
            'tglstockopname' => $tglstockopname,
            'keterangan' => $keterangan,
            'inserted_date' => $inserted_date,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
        );

        // return response()->json($dataDetail);


        $simpan = $this->model->simpanData($data, $dataDetail, $idstockopname);


        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }

    public function getDataID(Request $request)
    {
        $idstockopname = $request->input('idstockopname');
        $rsStockopname = Stockopname::find($idstockopname);

        $rsDetail = $this->model->getDetail($idstockopname);
        return response()->json(array('rsStockopname$rsStockopname' => $rsStockopname, 'rsDetail' => $rsDetail));
    }


    public function cetakform()
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $rsBarang = Barang::getStatusAktif();

        $data['rsBarang'] = $rsBarang;
        $view = view('stockopname.cetakform', $data);

        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Form Stok Opname');
        $pdf->SetSubject('Laporan Form Stok Opname');
        $pdf->SetKeywords('TCPDF, PDF, laporan, persediaan');
        $pdf->SetFont('times', '', 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set margin halaman
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetTopMargin(5);
        // Tambahkan halaman
        $pdf->AddPage('P');

        // Tulis konten HTML ke dalam PDF
        $pdf->writeHTML($view, true, false, true, false, '');

        // Output PDF
        $pdf->Output('form_stok_opname.pdf', 'I');
    }

    public function cetakSO($idstockopname)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $idstockopname = Crypt::decrypt($idstockopname);
        $rsSO = Stockopname::find($idstockopname);
        $rsSoDetail = $this->model->getDetail($idstockopname);

        $data['rsSO'] = $rsSO;
        $data['rsSoDetail'] = $rsSoDetail;
        $view = view('stockopname.cetakSO', $data);

        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Form Stok Opname');
        $pdf->SetSubject('Laporan Form Stok Opname');
        $pdf->SetKeywords('TCPDF, PDF, laporan, persediaan');
        $pdf->SetFont('times', '', 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set margin halaman
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetTopMargin(5);
        // Tambahkan halaman
        $pdf->AddPage('P');

        // Tulis konten HTML ke dalam PDF
        $pdf->writeHTML($view, true, false, true, false, '');

        // Output PDF
        $pdf->Output('form_stok_opname.pdf', 'I');
    }
}
