<?php

namespace App\Http\Controllers;

use App\Models\Lappenagihansales;
use Illuminate\Http\Request;
use TCPDF;

class LappenagihansalesController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Lappenagihansales;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lappenagihansales';
        return view('lappenagihansales.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        $idsales = $request->input('idsales');

        /*
            composer require tecnickcom/tcpdf
        */

        $data['rsPenagihan'] = $this->model->getPenagihan($idsales);
        $view = view('lappenagihansales.cetak', $data)->render();


        if ($jenisCetakan == 'excel') {

            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Penagihan.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {

            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Penagihan');
            $pdf->SetSubject('Laporan Penagihan');
            $pdf->SetKeywords('TCPDF, PDF, laporan, Penagihan');
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
            $pdf->Output('laporan_Penagihan.pdf', 'I');
        }
    }
}
