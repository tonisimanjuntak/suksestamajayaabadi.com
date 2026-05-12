<?php

namespace App\Http\Controllers;

use App\Models\Penyesuaianstok;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use Illuminate\Support\Facades\DB;
use TCPDF;

class PenyesuaianstokController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Penyesuaianstok;
        $this->isLogin();
    }

    public function index()
    {
        $penyesuaianstok = $this->model->allView();
        $data['penyesuaianstok'] = $penyesuaianstok;
        $data['menu'] = 'penyesuaianstok';
        return view('penyesuaianstok.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'penyesuaianstok';
        $data['idpenyesuaianstok'] = "";
        return view('penyesuaianstok.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Penyesuaianstok::select(['idpenyesuaianstok', 'tglpenyesuaianstok', 'keterangan', 'namapengguna']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');

        $query->whereBetween(DB::raw("DATE(tglpenyesuaianstok)"), [$tglawal, $tglakhir]);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpenyesuaianstok', 'LIKE', "%{$search}%")
                    ->orWhere('keterangan', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpenyesuaianstok', 'tglpenyesuaianstok', 'keterangan', 'namapengguna', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglpenyesuaianstok', 'Desc');
                $query->orderBy('idpenyesuaianstok', 'Desc');
            }
        } else {
            $query->orderBy('tglpenyesuaianstok', 'Desc');
            $query->orderBy('idpenyesuaianstok', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Penyesuaianstok::count();

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
                'idpenyesuaianstok' => $row->idpenyesuaianstok,
                'tglpenyesuaianstok' => $row->tglpenyesuaianstok,
                'keterangan' => $row->keterangan,
                'namapengguna' => $row->namapengguna,
                'action' => '<a href="' . url('penyesuaianstok/cetak/' . Crypt::encrypt($row->idpenyesuaianstok)) . '" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"></i></a>',
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
        $idpenyesuaianstok = $request->get('idpenyesuaianstok');
        $tglpenyesuaianstok = date('Y-m-d H:i:s');
        $keterangan = $request->get('keterangan');
        $detailPenyesuaianStok = $request->get('detailPenyesuaianStok');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglpenyesuaianstok)) {
            $bulan = bulan(date('m', strtotime($tglpenyesuaianstok)));
            $tahun = date('Y', strtotime($tglpenyesuaianstok));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }


        $idpenyesuaianstok = $this->model->createID();

        $totalsebelumdiskon = 0;
        $totalsetelahdiskon = 0;

        $dataDetail = array();
        for ($i = 0; $i < count($detailPenyesuaianStok); $i++) {
            $dataDetail[] = array(
                'idpenyesuaianstok' => $idpenyesuaianstok,
                'idbarang' => $detailPenyesuaianStok[$i][1],
                'stocksystem' => $detailPenyesuaianStok[$i][3],
                'penyesuaianstok' => $detailPenyesuaianStok[$i][4],
                'keterangandetail' => $detailPenyesuaianStok[$i][6],
            );
        }

        $data = array(
            'idpenyesuaianstok' => $idpenyesuaianstok,
            'tglpenyesuaianstok' => $tglpenyesuaianstok,
            'keterangan' => $keterangan,
            'inserted_date' => $inserted_date,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
        );

        $simpan = $this->model->simpanData($data, $dataDetail, $idpenyesuaianstok);
        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }

    public function getDataID(Request $request)
    {
        $idpenyesuaianstok = $request->input('idpenyesuaianstok');
        $rsPenyesuaianStok = Penyesuaianstok::find($idpenyesuaianstok);

        $rsDetail = $this->model->getDetail($idpenyesuaianstok);
        return response()->json(array('$rsPenyesuaianStok' => $rsPenyesuaianStok, 'rsDetail' => $rsDetail));
    }

    public function cetak($idpenyesuaianstok)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $idpenyesuaianstok = Crypt::decrypt($idpenyesuaianstok);
        $rsSO = Penyesuaianstok::find($idpenyesuaianstok);
        $rsSoDetail = $this->model->getDetail($idpenyesuaianstok);

        $data['rsSO'] = $rsSO;
        $data['rsSoDetail'] = $rsSoDetail;
        $view = view('penyesuaianstok.cetak', $data);

        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Form Penyesuaian Stok');
        $pdf->SetSubject('Laporan Form Penyesuaian Stok');
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
        $pdf->Output('form_penyesuaian_stok.pdf', 'I');
    }
}
