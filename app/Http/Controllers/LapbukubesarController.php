<?php

namespace App\Http\Controllers;

use App\Models\Lapbukubesar;
use App\Models\Akun4;
use Illuminate\Http\Request;
use TCPDF;


class LapbukubesarController extends Controller
{
    var $model;
    var $konsumen;
    var $pengguna;

    public function __construct()
    {
        $this->model = new Lapbukubesar;;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapbukubesar';
        return view('lapbukubesar.index', $data);
    }


    public function cetak($jenisCetakan, $tglawal, $tglakhir, $kdakun)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        $data['saldoNormal'] = get_saldo_normal($kdakun);
        $data['saldoAwal'] = $this->model->getSaldoAwal($tglawal, $kdakun);
        $data['saldoAkhir'] = $this->model->getSaldoAkhir($tglakhir, $kdakun);
        $data['rsBukuBesar'] = $this->model->getJurnal($tglawal, $tglakhir, $kdakun);
        $data['rowAkun'] = Akun4::where('kdakun', $kdakun)->first();
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $view = view('lapbukubesar.cetak', $data);


        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=laporan_jurnal.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Jurnal');
            $pdf->SetSubject('Laporan Jurnal');
            $pdf->SetKeywords('TCPDF, PDF, laporan, jurnal');
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
            $pdf->Output('laporan_jurnal.pdf', 'I');
        }
    }
}
