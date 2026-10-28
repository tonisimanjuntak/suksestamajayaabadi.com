<?php

namespace App\Http\Controllers;

use App\Models\Riwayataktifitas;
use Illuminate\Http\Request;
use App\Models\Home;
use TCPDF;

class HomeController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->isLogin();
        $this->model = new Home;
    }

    /**
     * Format deskripsi JSON array menjadi HTML rapi untuk tampilan web / DataTables.
     */
    private function formatDeskripsiHtml($deskripsi)
    {
        if (is_string($deskripsi)) {
            $decoded = json_decode($deskripsi, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $deskripsi = $decoded;
            }
        }

        if (!is_array($deskripsi) || empty($deskripsi)) {
            return is_array($deskripsi) ? '-' : e($deskripsi ?? '-');
        }

        // Cek jika indexed array (array of items)
        $isIndexed = array_keys($deskripsi) === range(0, count($deskripsi) - 1);
        if ($isIndexed) {
            $itemsHtml = [];
            foreach ($deskripsi as $i => $item) {
                $num = $i + 1;
                if (is_array($item)) {
                    $sub = [];
                    foreach ($item as $k => $v) {
                        $sub[] = '<b>' . e(ucwords(str_replace('_', ' ', $k))) . ':</b> ' . e(is_array($v) ? json_encode($v) : ($v ?? '-'));
                    }
                    $itemsHtml[] = '<div><span class="badge badge-secondary mr-1">#' . $num . '</span> ' . implode(', ', $sub) . '</div>';
                } else {
                    $itemsHtml[] = '<div><span class="badge badge-secondary mr-1">#' . $num . '</span> ' . e($item ?? '-') . '</div>';
                }
            }
            return implode('', $itemsHtml);
        }

        $html = '<table class="table table-sm table-borderless m-0" style="font-size:12px; line-height:1.4;">';
        foreach ($deskripsi as $key => $value) {
            $label = ucwords(str_replace('_', ' ', $key));
            $val = is_array($value) ? json_encode($value) : ($value ?? '-');
            $html .= '<tr>'
                . '<td style="padding:1px 4px; font-weight:600; white-space:nowrap; width:1%; color:#555;">' . e($label) . '</td>'
                . '<td style="padding:1px 4px; width:1%;">:</td>'
                . '<td style="padding:1px 4px;">' . e($val) . '</td>'
                . '</tr>';
        }
        $html .= '</table>';

        return $html;
    }

    /**
     * Format deskripsi JSON array menjadi HTML sederhana untuk TCPDF (cetak PDF).
     */
    private function formatDeskripsiCetak($deskripsi)
    {
        if (is_string($deskripsi)) {
            $decoded = json_decode($deskripsi, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $deskripsi = $decoded;
            }
        }

        if (!is_array($deskripsi) || empty($deskripsi)) {
            return is_array($deskripsi) ? '-' : e($deskripsi ?? '-');
        }

        // Cek jika indexed array (array of items)
        $isIndexed = array_keys($deskripsi) === range(0, count($deskripsi) - 1);
        if ($isIndexed) {
            $rows = [];
            foreach ($deskripsi as $i => $item) {
                $num = $i + 1;
                if (is_array($item)) {
                    $sub = [];
                    foreach ($item as $k => $v) {
                        $sub[] = '<b>' . e(ucwords(str_replace('_', ' ', $k))) . ':</b> ' . e(is_array($v) ? json_encode($v) : ($v ?? '-'));
                    }
                    $rows[] = '[#' . $num . '] ' . implode(', ', $sub);
                } else {
                    $rows[] = '[#' . $num . '] ' . e($item ?? '-');
                }
            }
            return implode('<br/>', $rows);
        }

        $lines = [];
        foreach ($deskripsi as $key => $value) {
            $label = ucwords(str_replace('_', ' ', $key));
            $val = is_array($value) ? json_encode($value) : ($value ?? '-');
            $lines[] = '<b>' . e($label) . '</b>: ' . e($val);
        }

        return implode('<br/>', $lines);
    }

    public function index()
    {

        // dd(session('user_menus'));

        $data['menu'] = 'home';

        $halamandashboard = session('halamandashboard', 'Dashboard Kosong');

        switch ($halamandashboard) {
            case 'Dashboard Admin':
                return view('home', $data);
            case 'Dashboard Sales':
                return view('homesales', $data);
            default:
                return view('homekosong', $data);
        }
    }

    public function lihatRiwayatAktifitas()
    {
        $data['menu'] = 'home';
        return view('lihatriwayataktifitas', $data);
    }

    public function listdatariwayataktifitas(Request $request)
    {
        // Query dasar
        $query = Riwayataktifitas::select('*');
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idpengguna = $request->input('idpengguna');

        if (!empty($idpengguna)) {
            $query->where('idpengguna', $idpengguna);
        }

        // $query->whereBetween("inserted_date", [$tglawal, $tglakhir]);
        $query->whereRaw("CAST(inserted_date AS DATE) BETWEEN ? AND ?", [$tglawal, $tglakhir]);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('namapengguna', 'LIKE', "%{$search}%")
                    ->orWhere('namatabel', 'LIKE', "%{$search}%")
                    ->orWhere('namafunction', 'LIKE', "%{$search}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'inserted_date', null, 'namafunction', 'namatabel', 'namapengguna'];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('inserted_date', 'Desc');
            }
        } else {
            $query->orderBy('inserted_date', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Riwayataktifitas::count();

        // Hitung total data setelah filter (jika ada pencarian)
        $totalFiltered = $query->count();

        // Ambil parameter 'length' dan 'start' dari DataTables
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Ambil data dengan limit dan offset
        $rsData = $query->offset($start)
            ->limit($limit)
            ->get();

        // Format data untuk DataTables
        $data = [];
        $no = 1;
        foreach ($rsData as $row) {
            
            $data[] = [
                'no' => $no++,
                'inserted_date' => $row->inserted_date,
                'deskripsi' => $this->formatDeskripsiHtml($row->deskripsi),
                'namafunction' => $row->namafunction,
                'namatabel' => $row->namatabel,
                'namapengguna' => $row->namapengguna,
            ];
        }

        // Response untuk DataTables
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }


    public function getInfoBox(Request $request)
    {
        $ringkasan = $this->model->getRingkasanInfoBox();
        $data = array(
            'totalPembelian' => $ringkasan['pembelian_hari_ini_total'],
            'totalPenjualan' => $ringkasan['penjualan_hari_ini_total'],
            'totalUtang'     => $ringkasan['hutang_sisa'],
            'totalPiutang'   => $ringkasan['piutang_sisa'],
            'detail'         => $ringkasan,
        );
        return response()->json($data);
    }

    public function getInfoGrafikPenjualan()
    {
        $rsGrafikPenjualan = $this->model->getInfoGrafikPenjualan();
        $rsGrafikPembelian = $this->model->getInfoGrafikPembelian();

        $arrDeskripsi = array('JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOV', 'DES');

        $arrTotalPenjualan = array(
            $rsGrafikPenjualan[0]->bulan01,
            $rsGrafikPenjualan[0]->bulan02,
            $rsGrafikPenjualan[0]->bulan03,
            $rsGrafikPenjualan[0]->bulan04,
            $rsGrafikPenjualan[0]->bulan05,
            $rsGrafikPenjualan[0]->bulan06,
            $rsGrafikPenjualan[0]->bulan07,
            $rsGrafikPenjualan[0]->bulan08,
            $rsGrafikPenjualan[0]->bulan09,
            $rsGrafikPenjualan[0]->bulan10,
            $rsGrafikPenjualan[0]->bulan11,
            $rsGrafikPenjualan[0]->bulan12,
        );

        $totalSemuaPenjualan = $rsGrafikPenjualan[0]->bulan01 + $rsGrafikPenjualan[0]->bulan02 + $rsGrafikPenjualan[0]->bulan03 + $rsGrafikPenjualan[0]->bulan04 + $rsGrafikPenjualan[0]->bulan05 + $rsGrafikPenjualan[0]->bulan06 + $rsGrafikPenjualan[0]->bulan07 + $rsGrafikPenjualan[0]->bulan08 + $rsGrafikPenjualan[0]->bulan09 + $rsGrafikPenjualan[0]->bulan10 + $rsGrafikPenjualan[0]->bulan11 + $rsGrafikPenjualan[0]->bulan12;


        $arrTotalPembelian = array(
            $rsGrafikPembelian[0]->bulan01,
            $rsGrafikPembelian[0]->bulan02,
            $rsGrafikPembelian[0]->bulan03,
            $rsGrafikPembelian[0]->bulan04,
            $rsGrafikPembelian[0]->bulan05,
            $rsGrafikPembelian[0]->bulan06,
            $rsGrafikPembelian[0]->bulan07,
            $rsGrafikPembelian[0]->bulan08,
            $rsGrafikPembelian[0]->bulan09,
            $rsGrafikPembelian[0]->bulan10,
            $rsGrafikPembelian[0]->bulan11,
            $rsGrafikPembelian[0]->bulan12,
        );

        $totalSemuaPembelian = $rsGrafikPembelian[0]->bulan01 + $rsGrafikPembelian[0]->bulan02 + $rsGrafikPembelian[0]->bulan03 + $rsGrafikPembelian[0]->bulan04 + $rsGrafikPembelian[0]->bulan05 + $rsGrafikPembelian[0]->bulan06 + $rsGrafikPembelian[0]->bulan07 + $rsGrafikPembelian[0]->bulan08 + $rsGrafikPembelian[0]->bulan09 + $rsGrafikPembelian[0]->bulan10 + $rsGrafikPembelian[0]->bulan11 + $rsGrafikPembelian[0]->bulan12;

        $rsCaraBayar = $this->model->getInfoCaraBayar();
        $arrCaraBayarLabels = [];
        $arrCaraBayarData = [];
        $arrCaraBayarTotal = [];
        foreach ($rsCaraBayar as $cb) {
            $arrCaraBayarLabels[] = $cb->carabayar;
            $arrCaraBayarData[] = (int) $cb->jml;
            $arrCaraBayarTotal[] = (float) $cb->total;
        }

        return response()->json(array(
            'arrDeskripsi'        => $arrDeskripsi,
            'arrTotalPenjualan'   => $arrTotalPenjualan,
            'totalSemuaPenjualan' => $totalSemuaPenjualan,
            'arrTotalPembelian'   => $arrTotalPembelian,
            'totalSemuaPembelian' => $totalSemuaPembelian,
            'caraBayarLabels'     => $arrCaraBayarLabels,
            'caraBayarData'       => $arrCaraBayarData,
            'caraBayarTotal'      => $arrCaraBayarTotal,
        ));
    }

    public function getWidgetData()
    {
        $stokKritis = $this->model->getStokKritis(5);
        $piutangJatuhTempo = $this->model->getPiutangJatuhTempo(5);
        $topKonsumen = $this->model->getTopKonsumen(5);

        return response()->json([
            'stokKritis'        => $stokKritis,
            'piutangJatuhTempo' => $piutangJatuhTempo,
            'topKonsumen'       => $topKonsumen,
        ]);
    }

    public function getSalesData(Request $request)
    {
        $penagihanTerbaru = \Illuminate\Support\Facades\DB::table('v_penagihan')
            ->orderBy('tglpenagihan', 'desc')
            ->limit(5)
            ->get();

        $namaBulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $now = \Carbon\Carbon::now();
        $bulanIni = (int) $now->format('m');
        $tahunIni = (int) $now->format('Y');

        $subMonth = (clone $now)->subMonth();
        $bulanKemarin = (int) $subMonth->format('m');
        $tahunKemarin = (int) $subMonth->format('Y');

        $topSalesBulanIni = $this->getTopSalesBobot($bulanIni, $tahunIni, 5);
        $topSalesBulanKemarin = $this->getTopSalesBobot($bulanKemarin, $tahunKemarin, 5);
        $topSalesTahunIni = $this->getTopSalesBobot(null, $tahunIni, 5);

        $topKonsumenJatuhTempo = $this->getTopKonsumenPiutangJatuhTempo(5);

        return response()->json([
            'penagihanTerbaru'      => $penagihanTerbaru,
            'topSalesBulanIni'      => $topSalesBulanIni,
            'topSalesBulanKemarin'  => $topSalesBulanKemarin,
            'topSalesTahunIni'      => $topSalesTahunIni,
            'topKonsumenJatuhTempo' => $topKonsumenJatuhTempo,
            'periodeBulanIni'       => $namaBulanIndo[$bulanIni] . ' ' . $tahunIni,
            'periodeBulanKemarin'   => $namaBulanIndo[$bulanKemarin] . ' ' . $tahunKemarin,
            'periodeTahunIni'       => 'Tahun ' . $tahunIni,
        ]);
    }

    private function getTopKonsumenPiutangJatuhTempo($limit = 5)
    {
        $totalOverdue = (float) \Illuminate\Support\Facades\DB::table('piutang')
            ->whereNull('tgllunas')
            ->whereRaw('(totaldebet - totalkredit) > 0')
            ->whereRaw('tgljatuhtempo < CURDATE()')
            ->selectRaw('SUM(totaldebet - totalkredit) as total')
            ->value('total');

        $items = \Illuminate\Support\Facades\DB::table('piutang as p')
            ->leftJoin('konsumen as k', 'p.idkonsumen', '=', 'k.idkonsumen')
            ->whereNull('p.tgllunas')
            ->whereRaw('(p.totaldebet - p.totalkredit) > 0')
            ->whereRaw('p.tgljatuhtempo < CURDATE()')
            ->selectRaw("
                p.idkonsumen,
                COALESCE(k.namakonsumen, p.idkonsumen) as namakonsumen,
                COALESCE(SUM(p.totaldebet - p.totalkredit), 0) as sisa_piutang,
                COUNT(*) as jml_nota
            ")
            ->groupBy('p.idkonsumen', 'k.namakonsumen')
            ->orderByDesc('sisa_piutang')
            ->limit($limit)
            ->get();

        return $items->map(function ($item, $index) use ($totalOverdue) {
            $persen = $totalOverdue > 0 ? round(($item->sisa_piutang / $totalOverdue) * 100, 1) : 0;
            return [
                'ranking'          => $index + 1,
                'idkonsumen'       => $item->idkonsumen,
                'namakonsumen'     => $item->namakonsumen,
                'persen'           => $persen,
                'persen_label'     => number_format($persen, 1, ',', '.') . '%',
                'jml_nota'         => $item->jml_nota,
            ];
        });
    }

    private function getTopSalesBobot($bulan = null, $tahun = null, $limit = 5)
    {
        $queryTotal = \Illuminate\Support\Facades\DB::table('v_penjualan');
        if ($tahun) {
            $queryTotal->whereYear('tglinvoice', $tahun);
        }
        if ($bulan) {
            $queryTotal->whereMonth('tglinvoice', $bulan);
        }
        $grandTotal = (float) $queryTotal->sum('totalinvoice');

        $query = \Illuminate\Support\Facades\DB::table('v_penjualan')
            ->selectRaw("
                idsales,
                COALESCE(namasales, 'Tanpa Sales') as namasales,
                COALESCE(SUM(totalinvoice), 0) as total,
                COUNT(*) as jumlah_transaksi
            ");

        if ($tahun) {
            $query->whereYear('tglinvoice', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tglinvoice', $bulan);
        }

        $sales = $query->groupBy('idsales', 'namasales')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();

        return $sales->map(function ($item, $index) use ($grandTotal) {
            $persen = $grandTotal > 0 ? round(($item->total / $grandTotal) * 100, 1) : 0;
            return [
                'ranking'          => $index + 1,
                'idsales'          => $item->idsales,
                'namasales'        => $item->namasales,
                'persen'           => $persen,
                'persen_label'     => number_format($persen, 1, ',', '.') . '%',
                'jumlah_transaksi' => $item->jumlah_transaksi,
            ];
        });
    }

    public function loadRiwayatAktifitas(Request $request)
    {
        $tglLoadRiwayat = $request->input('tglLoadRiwayat');
        if (empty($tglLoadRiwayat)) {      
            $rsRiwayat = $this->model->loadRiwayatAktifitasAwal();            
        }else{
            $rsRiwayat = $this->model->loadRiwayatAktifitas($tglLoadRiwayat);            
        }
        return response()->json($rsRiwayat);
    }


    public function cetakriwayataktifitas($tglawal, $tglakhir, $idpengguna)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        ini_set('memory_limit', '512M');
        set_time_limit(300);

        $query = Riwayataktifitas::select('*')->whereRaw("CAST(inserted_date AS DATE) BETWEEN ? AND ?", [$tglawal, $tglakhir]);
        if ($idpengguna != "-") {
            $query = $query->where('idpengguna', $idpengguna);
        }
        $rsRiwayat = $query->get();
        foreach ($rsRiwayat as $r) {
            $r->deskripsi_formatted = $this->formatDeskripsiCetak($r->deskripsi);
        }
        $data['rsRiwayat'] = $rsRiwayat;
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $view = view('cetakriwayataktifitas', $data);

        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Riwayat Aktifitas');
        $pdf->SetSubject('Laporan Riwayat Aktifitas');
        $pdf->SetKeywords('TCPDF, PDF, laporan, riwayataktifitas');
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
        $pdf->Output('laporan_riwayataktifitas.pdf', 'I');
            
    }


}
