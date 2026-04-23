<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Kartustokbarang;
use TCPDF;
use Illuminate\Support\Facades\Crypt;

class KartustokbarangController extends Controller
{
    var $Kartustokbarang;
    var $Barang;

    public function __construct()
    {
        $this->Kartustokbarang = new Kartustokbarang;
        $this->Barang = new Barang;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'kartustokbarang';
        return view('kartustokbarang.index', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Kartustokbarang::select('*');

        $query->where('idbarang', $request->input('idbarang'));
        //where tglriwayat >= $tglawal and tglriwayat <= $tglakhir
        $query->whereRaw("CAST(tglriwayat AS DATE) BETWEEN ? AND ?", [$request->input('tglawal'), $request->input('tglakhir')]);

        

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('kdbarang', 'LIKE', "%{$search}%")
                ->orWhere('namabarang', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan wajib tglriwayat
        $query->orderBy('tglriwayat', 'Asc');


        // Hitung total data tanpa filter
        $totalData = Kartustokbarang::count();

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
                'tglriwayat' => tgldatetime($row->tglriwayat),
                'kdbarang' => $row->kdbarang,
                'namabarang' => $row->namabarang,
                'stokawal' => format_decimal($row->stokawal, 0),
                'stokmasuk' => format_decimal($row->stokmasuk, 0),
                'stokkeluar' => format_decimal($row->stokkeluar, 0),
                'stokakhir' => format_decimal($row->stokakhir, 0),
                'deskripsi' => $row->deskripsi,
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

    public function cetak($jenisCetakan, $idbarang, $tglawal, $tglakhir)
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $rsKartuStok = $this->Kartustokbarang->getKartuStok($idbarang, $tglawal, $tglakhir);
        // dd($rsKartuStok);

        $data['tglawal'] = tgldmy($tglawal);
        $data['tglakhir'] = tgldmy($tglakhir);
        $data['rowBarang'] = Barang::find($idbarang);
        $data['rsKartuStok'] = $rsKartuStok;
        $view = view('kartustokbarang.cetak', $data);

        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=kartu_stok.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Kartu Stok Barang');
            $pdf->SetSubject('Kartu Stok Barang');
            $pdf->SetKeywords('TCPDF, PDF, laporan, kartustokbarang');
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
            $pdf->Output('kartu_stok.pdf', 'I');
        }
    }
}
