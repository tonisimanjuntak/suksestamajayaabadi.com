<?php

namespace App\Http\Controllers;

use App\Models\Lapbonussales;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Konsumen;
use App\Models\Lappenjualan;
use App\Models\Penjualan;
use TCPDF;

class LapbonussalesController extends Controller
{
    var $model;
    var $konsumen;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Lapbonussales;
        $this->konsumen = new Konsumen;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapbonussales';
        return view('lapbonussales.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsales = $request->input('idsales');

        /*
            composer require tecnickcom/tcpdf
        */

        $data['rsBonus'] = $this->model->getBonusSales($tglawal, $tglakhir, $idsales);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $view = view('lapbonussales.cetak', $data)->render();


        if ($jenisCetakan == 'excel') {

            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Penjualan.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {

            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Penjualan');
            $pdf->SetSubject('Laporan Penjualan');
            $pdf->SetKeywords('TCPDF, PDF, laporan, penjualan');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // Set margin halaman
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            // Tambahkan halaman
            $pdf->AddPage('L');

            // Tulis konten HTML ke dalam PDF
            $pdf->writeHTML($view, true, false, true, false, '');

            // Output PDF
            $pdf->Output('laporan_penjualan.pdf', 'I');
        }
    }
}
