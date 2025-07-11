<?php

namespace App\Http\Controllers;

use App\Models\Lapreturpenjualan;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Konsumen;
use TCPDF;

class LapreturpenjualanController extends Controller
{
    var $model;
    var $konsumen;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Lapreturpenjualan();
        $this->konsumen = new Konsumen;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapreturpenjualan';
        return view('lapreturpenjualan.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idkonsumen = $request->input('idkonsumen');
        $carabayar = $request->input('carabayar');
        $idsales = $request->input('idsales');
        $idwilayah = $request->input('idwilayah');
        $idpenjualan = $request->input('idpenjualan');


        /*
            composer require tecnickcom/tcpdf
        */
        $data['rsRetur'] = $this->model->getRetur($tglawal, $tglakhir, $idkonsumen, $carabayar, $idsales, $idwilayah, $idpenjualan);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['idkonsumen'] = $idkonsumen;
        $data['carabayar'] = $carabayar;
        $view = view('lapreturpenjualan.cetak', $data);


        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Retur_Penjualan.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Retur Penjualan');
            $pdf->SetSubject('Laporan Retur Penjualan');
            $pdf->SetKeywords('TCPDF, PDF, laporan, returpenjualan');
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
            $pdf->Output('Laporan_Retur_Penjualan.pdf', 'I');
        }
    }
}
