<?php

namespace App\Http\Controllers;

use App\Models\Riwayataktifitas;
use Illuminate\Http\Request;
use App\Models\Home;
use TCPDF;

class HomeController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->isLogin();
        $this->model = new Home;
    }

    public function index()
    {

        // dd(session('user_menus'));

        $data['menu'] = 'home';
        return view('home', $data);
    }

    public function lihatRiwayatAktifitas()
    {
        $data['menu'] = 'home';
        return view('lihatriwayataktifitas', $data);
    }

    public function listdatariwayataktifitas(Request $request)
    {
        // Query dasar
        $query = Riwayataktifitas::select('*');
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idpengguna = $request->input('idpengguna');

        if (!empty($idpengguna)) {
            $query->where('idpengguna', $idpengguna);
        }

        // $query->whereBetween("inserted_date", [$tglawal, $tglakhir]);
        $query->whereRaw("CAST(inserted_date AS DATE) BETWEEN ? AND ?", [$tglawal, $tglakhir]);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('namapengguna', 'LIKE', "%{$search}%")
                ->orWhere('namatabel', 'LIKE', "%{$search}%")
                ->orWhere('namafunction', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'inserted_date', null, 'namafunction', 'namatabel', 'namapengguna'];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('inserted_date', 'Desc');
            }
        } else {
            $query->orderBy('inserted_date', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Riwayataktifitas::count();

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
                'inserted_date' => $row->inserted_date,
                'deskripsi' => $row->deskripsi,
                'namafunction' => $row->namafunction,
                'namatabel' => $row->namatabel,
                'namapengguna' => $row->namapengguna,
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


    public function getInfoBox(Request $request)
    {
        $data = array(
            'totalPembelian' => $this->model->getTotalPembelian(),
            'totalPenjualan' => $this->model->getTotalPenjualan(),
            'totalUtang' => $this->model->getTotalUtang(),
            'totalPiutang' => $this->model->getTotalPiutang(),
        );
        return response()->json($data);
    }

    public function getInfoGrafikPenjualan()
    {
        $rsGrafikPenjualan = $this->model->getInfoGrafikPenjualan();
        $rsGrafikPembelian = $this->model->getInfoGrafikPembelian();

        $arrDeskripsi = array('JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOV', 'DES');

        $arrTotalPenjualan = array(
            $rsGrafikPenjualan[0]->bulan01,
            $rsGrafikPenjualan[0]->bulan02,
            $rsGrafikPenjualan[0]->bulan03,
            $rsGrafikPenjualan[0]->bulan04,
            $rsGrafikPenjualan[0]->bulan05,
            $rsGrafikPenjualan[0]->bulan06,
            $rsGrafikPenjualan[0]->bulan07,
            $rsGrafikPenjualan[0]->bulan08,
            $rsGrafikPenjualan[0]->bulan09,
            $rsGrafikPenjualan[0]->bulan10,
            $rsGrafikPenjualan[0]->bulan11,
            $rsGrafikPenjualan[0]->bulan12,
        );

        $totalSemuaPenjualan = $rsGrafikPenjualan[0]->bulan01 + $rsGrafikPenjualan[0]->bulan02 + $rsGrafikPenjualan[0]->bulan03 + $rsGrafikPenjualan[0]->bulan04 + $rsGrafikPenjualan[0]->bulan05 + $rsGrafikPenjualan[0]->bulan06 + $rsGrafikPenjualan[0]->bulan07 + $rsGrafikPenjualan[0]->bulan08 + $rsGrafikPenjualan[0]->bulan09 + $rsGrafikPenjualan[0]->bulan10 + $rsGrafikPenjualan[0]->bulan11 + $rsGrafikPenjualan[0]->bulan12;


        $arrTotalPembelian = array(
            $rsGrafikPembelian[0]->bulan01,
            $rsGrafikPembelian[0]->bulan02,
            $rsGrafikPembelian[0]->bulan03,
            $rsGrafikPembelian[0]->bulan04,
            $rsGrafikPembelian[0]->bulan05,
            $rsGrafikPembelian[0]->bulan06,
            $rsGrafikPembelian[0]->bulan07,
            $rsGrafikPembelian[0]->bulan08,
            $rsGrafikPembelian[0]->bulan09,
            $rsGrafikPembelian[0]->bulan10,
            $rsGrafikPembelian[0]->bulan11,
            $rsGrafikPembelian[0]->bulan12,
        );

        $totalSemuaPembelian = $rsGrafikPembelian[0]->bulan01 + $rsGrafikPembelian[0]->bulan02 + $rsGrafikPembelian[0]->bulan03 + $rsGrafikPembelian[0]->bulan04 + $rsGrafikPembelian[0]->bulan05 + $rsGrafikPembelian[0]->bulan06 + $rsGrafikPembelian[0]->bulan07 + $rsGrafikPembelian[0]->bulan08 + $rsGrafikPembelian[0]->bulan09 + $rsGrafikPembelian[0]->bulan10 + $rsGrafikPembelian[0]->bulan11 + $rsGrafikPembelian[0]->bulan12;

        return response()->json(array('arrDeskripsi' => $arrDeskripsi, 'arrTotalPenjualan' => $arrTotalPenjualan, 'totalSemuaPenjualan' => $totalSemuaPenjualan, 'arrTotalPembelian' => $arrTotalPembelian, 'totalSemuaPembelian' => $totalSemuaPembelian));
    }

    public function loadRiwayatAktifitas(Request $request)
    {
        $tglLoadRiwayat = $request->input('tglLoadRiwayat');
        if (empty($tglLoadRiwayat)) {      
            $rsRiwayat = $this->model->loadRiwayatAktifitasAwal();            
        }else{
            $rsRiwayat = $this->model->loadRiwayatAktifitas($tglLoadRiwayat);            
        }
        return response()->json($rsRiwayat);
    }


    public function cetakriwayataktifitas($tglawal, $tglakhir, $idpengguna)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $query = Riwayataktifitas::select('*')->whereRaw("CAST(inserted_date AS DATE) BETWEEN ? AND ?", [$tglawal, $tglakhir]);
        if ($idpengguna != "-") {
            $query = $query->where('idpengguna', $idpengguna);
        }
        $data['rsRiwayat'] = $query->get();
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $view = view('cetakriwayataktifitas', $data);

        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Riwayat Aktifitas');
        $pdf->SetSubject('Laporan Riwayat Aktifitas');
        $pdf->SetKeywords('TCPDF, PDF, laporan, riwayataktifitas');
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
        $pdf->Output('laporan_riwayataktifitas.pdf', 'I');
            
    }


}
