<?php

namespace App\Http\Controllers;

use App\Models\Lapneraca;
use TCPDF;

class LapneracaController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new Lapneraca;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapneraca';
        return view('lapneraca.index', $data);
    }

    public function cetak($jenisCetakan, $tglakhir)
    {
        $rsNeraca = $this->model->getSaldoNeraca($tglakhir);
        $labaBersih = $this->model->getLabaRugiSampaiDengan($tglakhir);

        $aset     = [];
        $liabilitas = [];
        $modal    = [];

        $totalAset      = 0;
        $totalLiabilitas = 0;
        $totalModal     = 0;

        foreach ($rsNeraca as $row) {
            $prefix = substr($row->kdakun, 0, 1);

            if ($prefix === '1') {
                // Akun normal debet: saldo = debet - kredit
                $row->saldo = (float) $row->debet - (float) $row->kredit;
                $totalAset += $row->saldo;
                $aset[] = $row;
            } elseif ($prefix === '2') {
                // Akun normal kredit: saldo = kredit - debet
                $row->saldo = (float) $row->kredit - (float) $row->debet;
                $totalLiabilitas += $row->saldo;
                $liabilitas[] = $row;
            } elseif ($prefix === '3') {
                // Akun normal kredit (modal): saldo = kredit - debet
                $row->saldo = (float) $row->kredit - (float) $row->debet;
                $totalModal += $row->saldo;
                $modal[] = $row;
            }
        }

        // Laba/Rugi Berjalan ditampilkan sebagai bagian Ekuitas
        $totalPasiva = $totalLiabilitas + $totalModal + $labaBersih;
        $isBalance   = (round($totalAset, 2) === round($totalPasiva, 2));

        $data['tglakhir']        = $tglakhir;
        $data['aset']            = $aset;
        $data['liabilitas']      = $liabilitas;
        $data['modal']           = $modal;
        $data['totalAset']       = $totalAset;
        $data['totalLiabilitas'] = $totalLiabilitas;
        $data['totalModal']      = $totalModal;
        $data['labaBersih']      = $labaBersih;
        $data['totalPasiva']     = $totalPasiva;
        $data['isBalance']       = $isBalance;

        $view = view('lapneraca.cetak', $data)->render();

        if ($jenisCetakan === 'excel') {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename=laporan_neraca.xls');
            header('Pragma: no-cache');
            header('Expires: 0');
            echo $view;
        } else {
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Neraca');
            $pdf->SetSubject('Laporan Neraca');
            $pdf->SetKeywords('TCPDF, PDF, laporan, neraca');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            $pdf->AddPage('P');
            $pdf->writeHTML($view, true, false, true, false, '');
            $pdf->Output('laporan_neraca.pdf', 'I');
        }
    }
}
