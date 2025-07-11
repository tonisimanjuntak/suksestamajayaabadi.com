<?php

namespace App\Http\Controllers;

use App\Models\Lappenerimaan;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use TCPDF;

class LappenerimaanController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Lappenerimaan;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lappenerimaan';
        return view('lappenerimaan.index', $data);
    }

    public function cetak($jenisCetakan, $tglawal, $tglakhir, $carabayar)
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $data['rsPenerimaan'] = $this->model->getPenerimaan($tglawal, $tglakhir, $carabayar);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $view = view('lappenerimaan.cetak', $data)->render();


        if ($jenisCetakan == 'excel') {

            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_penerimaan.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {

            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Penerimaan');
            $pdf->SetSubject('Laporan Penerimaan');
            $pdf->SetKeywords('TCPDF, PDF, laporan, penerimaan');
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
            $pdf->Output('laporan_penerimaan.pdf', 'I');
        }
    }
}
