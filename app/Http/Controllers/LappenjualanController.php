<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Konsumen;
use App\Models\Lappenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use TCPDF;

class LappenjualanController extends Controller
{
    var $model;
    var $konsumen;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Lappenjualan;
        $this->konsumen = new Konsumen;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['rsKonsumen'] = $this->konsumen->all();
        $data['rsPengguna'] = $this->pengguna->getPetugasKasir();
        $data['menu'] = 'lappenjualan';
        return view('lappenjualan.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idkonsumen = $request->input('idkonsumen');
        $idpengguna = $request->input('idpengguna');
        $carabayar = $request->input('carabayar');
        $idsales = $request->input('idsales');
        $idwilayah = $request->input('idwilayah');
        $idpenjualan = $request->input('idpenjualan');


        /*
            composer require tecnickcom/tcpdf
        */

        $data['rsPenjualan'] = $this->model->getPenjualan($tglawal, $tglakhir, $idkonsumen, $idpengguna, $carabayar, $idsales, $idwilayah, $idpenjualan);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['idkonsumen'] = $idkonsumen;
        $data['idpengguna'] = $idpengguna;
        $view = view('lappenjualan.cetak', $data)->render();


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
