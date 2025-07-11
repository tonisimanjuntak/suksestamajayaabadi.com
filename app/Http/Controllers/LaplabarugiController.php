<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Konsumen;
use App\Models\Laplabarugi;
use Illuminate\Http\Request;
use TCPDF;

class LaplabarugiController extends Controller
{
    var $model;
    var $konsumen;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Laplabarugi;
        $this->konsumen = new Konsumen;
        $this->pengguna = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $data['rsKonsumen'] = $this->konsumen->all();
        $data['rsPengguna'] = $this->pengguna->getPetugasGudang();
        $data['menu'] = 'laplabarugi';
        return view('laplabarugi.index', $data);
    }


    public function cetak($tglawal, $tglakhir)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $totalPembelian = $this->model->getTotalPembelian($tglawal, $tglakhir);
        $totalStockAdjustment = $this->model->getTotalStockAdjustment($tglawal, $tglakhir);


        $rsTemp = $this->model->getJurnalPenjualanByNamaJurnal($tglawal, $tglakhir, 'Penjualan');
        $penjualan = $rsTemp[0]->kredit - $rsTemp[0]->debet;


        $rsTemp = $this->model->getJurnalPenjualanByNamaJurnal($tglawal, $tglakhir, 'Discount');
        $penjualan_discount =  $rsTemp[0]->kredit - $rsTemp[0]->debet;

        $rsTemp = $this->model->getJurnalAdjustmentByNamaJurnal($tglawal, $tglakhir, 'Stok Adjustment (Retur Penjualan)');
        $penjualan_retur =  $rsTemp[0]->debet - $rsTemp[0]->kredit;

        $rsTemp = $this->model->getJurnalPembelianByNamaJurnal($tglawal, $tglakhir, 'Pembelian');
        $pembelian =  $rsTemp[0]->debet - $rsTemp[0]->kredit;

        $rsTemp = $this->model->getJurnalPembelianByNamaJurnal($tglawal, $tglakhir, 'Discount');
        $pembelian_discount =  $rsTemp[0]->debet - $rsTemp[0]->kredit;

        $rsTemp = $this->model->getJurnalAdjustmentByNamaJurnal($tglawal, $tglakhir, 'Stok Adjustment (Retur Pembelian)');
        $pembelian_retur =  $rsTemp[0]->debet - $rsTemp[0]->kredit;

        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $data['penjualan'] = $penjualan;
        $data['penjualan_discount'] = $penjualan_discount;
        $data['penjualan_retur'] = $penjualan_retur;
        $data['pembelian'] = $pembelian;
        $data['pembelian_discount'] = $pembelian_discount;
        $data['pembelian_retur'] = $pembelian_retur;
        $data['totalStockAdjustment'] = $totalStockAdjustment;
        $view = view('laplabarugi.cetak', $data);


        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Laporan Laba Rugi');
        $pdf->SetSubject('Laporan Laba Rugi');
        $pdf->SetKeywords('TCPDF, PDF, laporan, labarugi');
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
        $pdf->Output('laporan_labarugi.pdf', 'I');
    }
}
