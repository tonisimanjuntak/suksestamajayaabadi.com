<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Konsumen;
use App\Models\Lapneracasaldo;
use Illuminate\Http\Request;
use TCPDF;

class LapneracasaldoController extends Controller
{
    var $model;
    var $konsumen;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Lapneracasaldo;
        $this->konsumen = new Konsumen;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['rsKonsumen'] = $this->konsumen->all();
        $data['rsPengguna'] = $this->pengguna->getPetugasGudang();
        $data['menu'] = 'lapneracasaldo';
        return view('lapneracasaldo.index', $data);
    }


    public function cetak($jenisCetakan, $tglawal, $tglakhir)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $rsSaldoJurnal = $this->model->getSaldoJurnal($tglawal, $tglakhir);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['rsSaldoJurnal'] = $rsSaldoJurnal;
        $view = view('lapneracasaldo.cetak', $data);

        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=laporan_neraca_saldo.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Laporan Neraca Saldo');
            $pdf->SetSubject('Laporan Neraca Saldo');
            $pdf->SetKeywords('TCPDF, PDF, laporan, neracasaldo');
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
            $pdf->Output('laporan_neraca_saldo.pdf', 'I');
        }
    }
}
