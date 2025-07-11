<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Supplier;
use App\Models\Lappembelian;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use TCPDF;

class LappembelianController extends Controller
{
    var $model;
    var $supplier;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Lappembelian;
        $this->supplier = new Supplier;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['rsSupplier'] = $this->supplier->all();
        $data['rsPengguna'] = $this->pengguna->getPetugasGudang();
        $data['menu'] = 'lappembelian';
        return view('lappembelian.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsupplier = $request->input('idsupplier');
        $carabayar = $request->input('carabayar');
        $idpembelian = $request->input('idpembelian');


        $data['rsPembelian'] = $this->model->getPembelian($tglawal, $tglakhir, $idsupplier, $carabayar, $idpembelian);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['idsupplier'] = $idsupplier;
        $data['carabayar'] = $carabayar;
        $view = view('lappembelian.cetak', $data);


        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Pembelian.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Pembelian');
            $pdf->SetSubject('Laporan Pembelian');
            $pdf->SetKeywords('TCPDF, PDF, laporan, pembelian');
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
            $pdf->Output('laporan_pembelian.pdf', 'I');
        }
    }
}
