<?php

namespace App\Http\Controllers;

use App\Models\Lappengeluaran;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use TCPDF;

class LappengeluaranController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Lappengeluaran();
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lappengeluaran';
        return view('lappengeluaran.index', $data);
    }

    public function cetak($jenisCetakan, $tglawal, $tglakhir, $carabayar)
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $data['rsPengeluaran'] = $this->model->getPengeluaran($tglawal, $tglakhir, $carabayar);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $view = view('lappengeluaran.cetak', $data)->render();


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
