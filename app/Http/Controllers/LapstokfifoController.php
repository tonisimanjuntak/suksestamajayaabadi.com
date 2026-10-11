<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lapstokfifo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCPDF;

class LapstokfifoController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Lapstokfifo();
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lapstokfifo';
        return view('lapstokfifo.index', $data);
    }

    public function listdata(Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idbarang = $request->input('idbarang');

        $query = $this->model->getStokFifoQuery($tglawal, $tglakhir, $idbarang);

        // Pencarian DataTables
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('sf.idstokfifo', 'LIKE', "%{$search}%")
                    ->orWhere('sf.idtransaksi', 'LIKE', "%{$search}%")
                    ->orWhere('b.kdbarang', 'LIKE', "%{$search}%")
                    ->orWhere('b.namabarang', 'LIKE', "%{$search}%")
                    ->orWhere('sf.jenistransaksi', 'LIKE', "%{$search}%")
                    ->orWhere('sf.keterangan', 'LIKE', "%{$search}%");
            });
        }

        // Pengurutan kolom
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');

            $columns = [
                null,
                'sf.idstokfifo',
                'sf.tglmasuk',
                'sf.idtransaksi',
                'sf.jenistransaksi',
                'b.namabarang',
                's.namasatuan',
                'sf.jumlahmasuk',
                'jumlahterpakai',
                'sf.jumlahsisa',
                'sf.nilaihpp',
                'totalsisa',
                'sf.keterangan',
            ];

            if (isset($columns[$orderColumn]) && $columns[$orderColumn] !== null) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('sf.tglmasuk', 'desc')->orderBy('sf.idstokfifo', 'desc');
            }
        } else {
            $query->orderBy('sf.tglmasuk', 'desc')->orderBy('sf.idstokfifo', 'desc');
        }

        $totalData = DB::table('stokfifo')->count();
        $totalFiltered = $query->count();

        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        $rsData = $query->offset($start)
            ->limit($limit)
            ->get();

        $data = [];
        $no = $start + 1;
        foreach ($rsData as $row) {
            $data[] = [
                'no'             => $no++,
                'idstokfifo'     => $row->idstokfifo,
                'tglmasuk'       => tgldmy($row->tglmasuk),
                'idtransaksi'    => $row->idtransaksi,
                'jenistransaksi' => $row->jenistransaksi,
                'kdbarang'       => $row->kdbarang,
                'namabarang'     => $row->namabarang,
                'namasatuan'     => $row->namasatuan ?? '-',
                'jumlahmasuk'    => format_decimal($row->jumlahmasuk, 0),
                'jumlahterpakai' => format_decimal($row->jumlahterpakai, 0),
                'jumlahsisa'     => format_decimal($row->jumlahsisa, 0),
                'hargasatuan'    => format_rupiah($row->hargasatuan),
                'nilaihpp'       => format_rupiah($row->nilaihpp),
                'totalsisa'      => format_rupiah($row->totalsisa),
                'keterangan'     => $row->keterangan ?? '-',
            ];
        }

        return response()->json([
            'draw'            => intval($request->input('draw')),
            'recordsTotal'    => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data'            => $data,
        ]);
    }

    public function cetak($jenisCetakan, Request $request)
    {
        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idbarang = $request->input('idbarang');

        $query = $this->model->getStokFifoQuery($tglawal, $tglakhir, $idbarang);
        $rsData = $query->orderBy('sf.tglmasuk', 'asc')
            ->orderBy('sf.idstokfifo', 'asc')
            ->get();

        $rowBarang = null;
        if (!empty($idbarang) && $idbarang != '-') {
            $rowBarang = Barang::find($idbarang);
        }

        $data = [
            'rsData'       => $rsData,
            'tglawal'      => $tglawal ? tgldmy($tglawal) : '',
            'tglakhir'     => $tglakhir ? tgldmy($tglakhir) : '',
            'rowBarang'    => $rowBarang,
            'jenisCetakan' => $jenisCetakan,
        ];

        $view = view('lapstokfifo.cetak', $data);

        if ($jenisCetakan == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Stok_FIFO.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            $pdf = new TCPDF();

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Stok FIFO');
            $pdf->SetSubject('Laporan Stok FIFO');
            $pdf->SetKeywords('TCPDF, PDF, laporan, stokfifo');
            $pdf->SetFont('times', '', 9);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            $pdf->AddPage('L');

            $pdf->writeHTML($view, true, false, true, false, '');

            $pdf->Output('Laporan_Stok_FIFO.pdf', 'I');
        }
    }
}
