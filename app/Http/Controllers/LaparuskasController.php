<?php

namespace App\Http\Controllers;

use App\Models\Laparuskas;
use Illuminate\Http\Request;
use TCPDF;

class LaparuskasController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Laparuskas;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'laparuskas';
        return view('laparuskas.index', $data);
    }

    public function cetak($jenisCetakan, $tglawal, $tglakhir)
    {
        $arusKasRaw = $this->model->getArusKas($tglawal, $tglakhir);

        // Saldo awal & akhir per akun kas/bank
        $rincianKas = \Illuminate\Support\Facades\DB::select("
            SELECT
                a.kdakun,
                a.namaakun,
                COALESCE(sa.debet, 0) - COALESCE(sa.kredit, 0)  AS saldo_awal,
                COALESCE(mut.debet, 0)  AS debet_mutasi,
                COALESCE(mut.kredit, 0) AS kredit_mutasi,
                (COALESCE(sa.debet, 0) - COALESCE(sa.kredit, 0))
                    + COALESCE(mut.debet, 0)
                    - COALESCE(mut.kredit, 0) AS saldo_akhir
            FROM akun a
            LEFT JOIN (
                SELECT jd.kdakun, SUM(jd.debet) AS debet, SUM(jd.kredit) AS kredit
                FROM jurnaldetail jd
                JOIN jurnal j ON j.idjurnal = jd.idjurnal
                WHERE j.tgljurnal < ?
                GROUP BY jd.kdakun
            ) sa ON sa.kdakun = a.kdakun
            LEFT JOIN (
                SELECT jd.kdakun, SUM(jd.debet) AS debet, SUM(jd.kredit) AS kredit
                FROM jurnaldetail jd
                JOIN jurnal j ON j.idjurnal = jd.idjurnal
                WHERE j.tgljurnal BETWEEN ? AND ?
                GROUP BY jd.kdakun
            ) mut ON mut.kdakun = a.kdakun
            WHERE a.kdparent = '1.1.01'
            ORDER BY a.kdakun
        ", [$tglawal, $tglawal, $tglakhir]);

        $totalSaldoAwal  = array_sum(array_column($rincianKas, 'saldo_awal'));
        $totalSaldoAkhir = array_sum(array_column($rincianKas, 'saldo_akhir'));

        // Kelompokkan arus kas per kategori (operasi, investasi, pendanaan)
        $operasi   = [];
        $investasi = [];
        $pendanaan = [];

        foreach ($arusKasRaw as $row) {
            $kategori = Laparuskas::klasifikasiAkun($row->kdakun_lawan);
            // Net arus: kas masuk = positif, kas keluar = negatif
            $net = floatval($row->kas_debet) - floatval($row->kas_kredit);

            $entry = [
                'tgljurnal'    => $row->tgljurnal,
                'jenis'        => $row->jenis,
                'keterangan'   => $row->keterangan,
                'namaakun_kas' => $row->namaakun_kas,
                'namaakun_lawan' => $row->namaakun_lawan,
                'net'          => $net,
            ];

            if ($kategori === 'investasi') {
                $investasi[] = $entry;
            } elseif ($kategori === 'pendanaan') {
                $pendanaan[] = $entry;
            } else {
                $operasi[] = $entry;
            }
        }

        $totalOperasi   = array_sum(array_column($operasi, 'net'));
        $totalInvestasi = array_sum(array_column($investasi, 'net'));
        $totalPendanaan = array_sum(array_column($pendanaan, 'net'));
        $totalMutasi    = $totalOperasi + $totalInvestasi + $totalPendanaan;

        $data['tglawal']        = $tglawal;
        $data['tglakhir']       = $tglakhir;
        $data['rincianKas']     = $rincianKas;
        $data['totalSaldoAwal'] = $totalSaldoAwal;
        $data['totalSaldoAkhir']= $totalSaldoAkhir;
        $data['operasi']        = $operasi;
        $data['investasi']      = $investasi;
        $data['pendanaan']      = $pendanaan;
        $data['totalOperasi']   = $totalOperasi;
        $data['totalInvestasi'] = $totalInvestasi;
        $data['totalPendanaan'] = $totalPendanaan;
        $data['totalMutasi']    = $totalMutasi;

        $view = view('laparuskas.cetak', $data)->render();

        if ($jenisCetakan == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=laporan_arus_kas.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            echo $view;
        } else {
            $pdf = new TCPDF();
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Arus Kas');
            $pdf->SetSubject('Laporan Arus Kas');
            $pdf->SetKeywords('TCPDF, PDF, laporan, aruskas');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            $pdf->AddPage('P');
            $pdf->writeHTML($view, true, false, true, false, '');
            $pdf->Output('laporan_arus_kas.pdf', 'I');
        }
    }
}
