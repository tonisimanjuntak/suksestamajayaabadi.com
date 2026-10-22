<?php

namespace App\Http\Controllers;

use App\Models\Lapneracasaldo;
use Illuminate\Http\Request;
use TCPDF;

class LapneracasaldoController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Lapneracasaldo;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapneracasaldo';
        return view('lapneracasaldo.index', $data);
    }

    public function cetak($jenisCetakan, $tglawal, $tglakhir)
    {
        $rsSaldoJurnal = $this->model->getSaldoJurnal($tglawal, $tglakhir);

        $dataRows = [];
        $totalDebet = 0;
        $totalKredit = 0;

        foreach ($rsSaldoJurnal as $row) {
            $posisi = get_saldo_normal($row->kdakun);

            if ($posisi == 'D') {
                $saldoAwal = floatval($row->debet_awal) - floatval($row->kredit_awal);
                $saldoAkhir = $saldoAwal + (floatval($row->debet_mutasi) - floatval($row->kredit_mutasi));
                if ($saldoAkhir >= 0) {
                    $debet = $saldoAkhir;
                    $kredit = 0;
                } else {
                    $debet = 0;
                    $kredit = abs($saldoAkhir);
                }
            } else {
                $saldoAwal = floatval($row->kredit_awal) - floatval($row->debet_awal);
                $saldoAkhir = $saldoAwal + (floatval($row->kredit_mutasi) - floatval($row->debet_mutasi));
                if ($saldoAkhir >= 0) {
                    $debet = 0;
                    $kredit = $saldoAkhir;
                } else {
                    $debet = abs($saldoAkhir);
                    $kredit = 0;
                }
            }

            $row->posisi = $posisi;
            $row->saldo_awal = $saldoAwal;
            $row->saldo_akhir = $saldoAkhir;
            $row->debet = $debet;
            $row->kredit = $kredit;

            $totalDebet += $debet;
            $totalKredit += $kredit;

            $dataRows[] = $row;
        }

        $isBalance = (round($totalDebet, 2) == round($totalKredit, 2));

        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['rsSaldoJurnal'] = $dataRows;
        $data['totalDebet'] = $totalDebet;
        $data['totalKredit'] = $totalKredit;
        $data['isBalance'] = $isBalance;

        $view = view('lapneracasaldo.cetak', $data)->render();

        if ($jenisCetakan == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=laporan_neraca_saldo.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $view;
        } else {
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Neraca Saldo');
            $pdf->SetSubject('Laporan Neraca Saldo');
            $pdf->SetKeywords('TCPDF, PDF, laporan, neracasaldo');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            $pdf->AddPage('P');
            $pdf->writeHTML($view, true, false, true, false, '');
            $pdf->Output('laporan_neraca_saldo.pdf', 'I');
        }
    }
}

