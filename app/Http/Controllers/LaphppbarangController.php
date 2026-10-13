<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Laphppbarang;
use Illuminate\Http\Request;
use TCPDF;

class LaphppbarangController extends Controller
{
    var $model;
    var $Barang;

    public function __construct()
    {
        $this->model = new Laphppbarang();
        $this->Barang = new Barang();
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'laphppbarang';
        return view('laphppbarang.index', $data);
    }

    public function listdata(Request $request)
    {
        $where = " WHERE b.statusaktif = 'Aktif'";

        $idkategori = $request->input('idkategori');
        if (!empty($idkategori) && $idkategori != "-") {
            $where .= " AND b.idkategori = '" . addslashes($idkategori) . "'";
        }

        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = addslashes($request->input('search.value'));
            $where .= " AND (b.idbarang LIKE '%{$search}%' OR b.kdbarang LIKE '%{$search}%' OR b.namabarang LIKE '%{$search}%' OR k.namakategori LIKE '%{$search}%')";
        }

        $orderby = " ORDER BY b.namabarang ASC";
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir');

            $columns = [null, 'kdbarang', 'b.namabarang', 'kuantitas', 'totalbiaya', 'biayaratarata'];

            if (isset($columns[$orderColumn]) && $columns[$orderColumn] !== null) {
                $orderby = " ORDER BY " . $columns[$orderColumn] . " " . $orderDirection;
            }
        }

        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);
        $tglriwayat = $request->input('tglriwayat', date('Y-m-d'));

        $rsData = $this->model->getHppBarangByTanggal($tglriwayat, $where, $orderby, $limit, $start);
        $totalData = $this->model->getTotalBarangAktif();
        $totalFiltered = $this->model->getTotalFiltered($tglriwayat, $where);

        $data = [];
        $no = $start + 1;
        foreach ($rsData as $row) {
            $data[] = [
                'no' => $no++,
                'idbarang' => $row->idbarang,
                'kdbarang' => $row->kdbarang,
                'namabarang' => $row->namabarang,
                'namakategori' => $row->namakategori,
                'kuantitas' => number_format($row->kuantitas, 0, ',', '.'),
                'totalbiaya' => format_rupiah($row->totalbiaya),
                'biayaratarata' => format_rupiah($row->biayaratarata),
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function cetak($jenisCetakan, $tglriwayat, $idkategori)
    {
        $where = " WHERE b.statusaktif = 'Aktif'";

        if (!empty($idkategori) && $idkategori != "-") {
            $where .= " AND b.idkategori = '" . addslashes($idkategori) . "'";
        }

        $orderby = " ORDER BY b.namabarang ASC";
        $limit = null;
        $start = null;

        $rsBarang = $this->model->getHppBarangByTanggal($tglriwayat, $where, $orderby, $limit, $start);

        $data['rsBarang'] = $rsBarang;
        $data['tglriwayat'] = $tglriwayat;
        $view = view('laphppbarang.cetak', $data);

        if ($jenisCetakan == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_HPP_Barang.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            $pdf = new TCPDF();

            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan HPP Barang');
            $pdf->SetSubject('Laporan HPP Barang');
            $pdf->SetKeywords('TCPDF, PDF, laporan, hpp, barang');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            $pdf->AddPage('L');

            $pdf->writeHTML($view, true, false, true, false, '');

            $pdf->Output('laporan_hpp_barang.pdf', 'I');
        }
    }
}
