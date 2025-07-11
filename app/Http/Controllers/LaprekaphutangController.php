<?php

namespace App\Http\Controllers;

use App\Models\Laprekaphutang;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Supplier;
use TCPDF;

class LaprekaphutangController extends Controller
{
    var $model;
    var $supplier;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Laprekaphutang;
        $this->supplier = new Supplier;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'laprekaphutang';
        return view('laprekaphutang.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $idsupplier = $request->input('idsupplier');
        $statusLunasOption = $request->input('statusLunasOption');
        $idpembelian = $request->input('idpembelian');


        $data['rsLaporan'] = $this->model->getLaporan($statusLunasOption, $idsupplier, $idpembelian);
        $view = view('laprekaphutang.cetak', $data);


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
            $pdf->AddPage('L');

            // Tulis konten HTML ke dalam PDF
            $pdf->writeHTML($view, true, false, true, false, '');

            // Output PDF
            $pdf->Output('buku_hutang.pdf', 'I');
        }
    }
}
