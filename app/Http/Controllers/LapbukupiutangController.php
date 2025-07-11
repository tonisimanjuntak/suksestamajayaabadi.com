<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use App\Models\Lapbukupiutang;
use Illuminate\Http\Request;
use TCPDF;

class LapbukupiutangController extends Controller
{
    var $model;
    var $konsumen;


    public function __construct()
    {
        $this->model = new Lapbukupiutang();
        $this->konsumen = new Konsumen;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapbukupiutang';
        return view('lapbukupiutang.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $statusLunasOption = $request->input('statusLunasOption');
        $idkonsumen = $request->input('idkonsumen');
        $idsales = $request->input('idsales');
        $idwilayah = $request->input('idwilayah');
        $idpenjualan = $request->input('idpenjualan');

        $data['rsDetail'] = $this->model->getHutangDetail($statusLunasOption, $idkonsumen, $idsales, $idwilayah, $idpenjualan);


        $view = view('lapbukupiutang.cetak', $data);


        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=buku_hutang.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Buku Hutang');
            $pdf->SetSubject('Buku Hutang');
            $pdf->SetKeywords('TCPDF, PDF, laporan, bukuhutang');
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
            $pdf->Output('buku_hutang.pdf', 'I');
        }
    }
}
