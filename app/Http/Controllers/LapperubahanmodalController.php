<?php

namespace App\Http\Controllers;

use App\Models\Lapperubahanmodal;
use TCPDF;

class LapperubahanmodalController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new Lapperubahanmodal;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapperubahanmodal';

        return view('lapperubahanmodal.index', $data);
    }

    public function cetak($jenisCetakan, $tglawal, $tglakhir)
    {
        $data = $this->model->getDataPerubahanModal($tglawal, $tglakhir);

        $view = view('lapperubahanmodal.cetak', $data)->render();

        if ($jenisCetakan == 'excel') {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename=laporan_perubahan_modal.xls');
            header('Pragma: no-cache');
            header('Expires: 0');
            echo $view;
        } else {
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Perubahan Modal');
            $pdf->SetSubject('Laporan Perubahan Modal');
            $pdf->SetKeywords('TCPDF, PDF, laporan, perubahanmodal, ekuitas');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            $pdf->AddPage('P');
            $pdf->writeHTML($view, true, false, true, false, '');
            $pdf->Output('laporan_perubahan_modal.pdf', 'I');
        }
    }
}
