<?php

namespace App\Http\Controllers;

use App\Models\Laplabarugi;
use Illuminate\Http\Request;
use TCPDF;

class LaplabarugiController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Laplabarugi;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'laplabarugi';
        return view('laplabarugi.index', $data);
    }

    public function cetak($jenisCetakan, $tglawal, $tglakhir)
    {
        $rsLabaRugi = $this->model->getLaporanLabaRugi($tglawal, $tglakhir);

        // Kelompokkan data per level hierarki
        $pendapatan = []; // prefix 4
        $hpp        = []; // prefix 6
        $beban      = []; // prefix 5

        foreach ($rsLabaRugi as $row) {
            $prefix = substr($row->kdakun, 0, 1);
            // Hitung saldo: Pendapatan=kredit-debet, HPP & Beban=debet-kredit
            if ($prefix == '4') {
                $row->saldo = $row->kredit - $row->debet;
                $pendapatan[] = $row;
            } elseif ($prefix == '6') {
                $row->saldo = $row->debet - $row->kredit;
                $hpp[] = $row;
            } elseif ($prefix == '5') {
                $row->saldo = $row->debet - $row->kredit;
                $beban[] = $row;
            }
        }

        // Hitung total per kelompok
        $totalPendapatan = array_sum(array_column($pendapatan, 'saldo'));
        $totalHPP        = array_sum(array_column($hpp, 'saldo'));
        $totalBeban      = array_sum(array_column($beban, 'saldo'));
        $labaKotor       = $totalPendapatan - $totalHPP;
        $labaBersih      = $labaKotor - $totalBeban;

        $data['tglawal']         = $tglawal;
        $data['tglakhir']        = $tglakhir;
        $data['pendapatan']      = $pendapatan;
        $data['hpp']             = $hpp;
        $data['beban']           = $beban;
        $data['totalPendapatan'] = $totalPendapatan;
        $data['totalHPP']        = $totalHPP;
        $data['totalBeban']      = $totalBeban;
        $data['labaKotor']       = $labaKotor;
        $data['labaBersih']      = $labaBersih;

        $view = view('laplabarugi.cetak', $data)->render();

        if ($jenisCetakan == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=laporan_laba_rugi.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $view;
        } else {
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Laba Rugi');
            $pdf->SetSubject('Laporan Laba Rugi');
            $pdf->SetKeywords('TCPDF, PDF, laporan, labarugi');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            $pdf->AddPage('P');
            $pdf->writeHTML($view, true, false, true, false, '');
            $pdf->Output('laporan_laba_rugi.pdf', 'I');
        }
    }
}
