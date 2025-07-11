<?php

namespace App\Http\Controllers;

use App\Models\Lapreturpembelian;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\Supplier;
use TCPDF;

class LapreturpembelianController extends Controller
{
    var $model;
    var $supplier;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Lapreturpembelian();
        $this->supplier = new Supplier;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapreturpembelian';
        return view('lapreturpembelian.index', $data);
    }


    public function cetak($jenisCetakan, Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsupplier = $request->input('idsupplier');
        $carabayar = $request->input('carabayar');
        $idpembelian = $request->input('idpembelian');
        $statusretur = $request->input('statusretur');

        // Validasi input
        if (empty($tglawal) || empty($tglakhir)) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }


        /*
            composer require tecnickcom/tcpdf
        */
        $data['rsRetur'] = $this->model->getRetur($tglawal, $tglakhir, $idsupplier, $carabayar, $idpembelian, $statusretur);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['idsupplier'] = $idsupplier;
        $data['carabayar'] = $carabayar;
        $view = view('lapreturpembelian.cetak', $data);


        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Retur_Pembelian.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Retur Pembelian');
            $pdf->SetSubject('Laporan Retur Pembelian');
            $pdf->SetKeywords('TCPDF, PDF, laporan, returpembelian');
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
            $pdf->Output('Laporan_Retur_Pembelian.pdf', 'I');
        }
    }
}
