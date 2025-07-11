<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Lappersediaan;
use TCPDF;
use Illuminate\Support\Facades\Crypt;

class LappersediaanController extends Controller
{
    var $model;
    var $Barang;

    public function __construct()
    {
        $this->model = new Lappersediaan;
        $this->Barang = new Barang;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lappersediaan';
        return view('lappersediaan.index', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Barang::select(['idbarang', 'namabarang', 'namakategori', 'hargabeli', 'hargajualdiskon', 'stok']);

        $query->where('statusaktif', 'Aktif');
        $idkategori = $request->input('idkategori');

        if ($idkategori != '' && $idkategori != null) {
            $query->where('idkategori', $idkategori);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idbarang', 'LIKE', "%{$search}%")
                ->orWhere('namabarang', 'LIKE', "%{$search}%")
                ->orWhere('namakategori', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idbarang', 'namabarang', 'namakategori', null, null, null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namabarang', 'Asc');
            }
        } else {
            $query->orderBy('namabarang', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Barang::count();

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
                'idbarang' => $row->idbarang,
                'namabarang' => $row->namabarang,
                'namakategori' => $row->namakategori,
                'hargabeli' => format_rupiah($row->hargabeli),
                'hargajualdiskon' => format_rupiah($row->hargajualdiskon),
                'stok' => $row->stok,
            ];
        }

        // 'action' => '<a href="' . url('barang/edit/' . Crypt::encrypt($row->idbarang)) . '" class="btn btn-sm btn-warning"><i class="fa fa-edit mr-1"></i>Edit</a> <a href="' . url('barang/hapus/' . Crypt::encrypt($row->idbarang)) . '" class="btn btn-sm btn-danger" id="btnHapus"><i class="fa fa-trash mr-1"></i>Delete</a>',

        // Response untuk DataTables
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function getDataID(Request $request)
    {
        $idbarang = $request->input('idbarang');
        $rsbarang = Barang::find($idbarang);
        return response()->json($rsbarang);
    }

    public function cetak($jenisCetakan, $idkategori)
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $rsBarang = $this->model->getPersediaan($idkategori);

        $data['rsBarang'] = $rsBarang;
        $view = view('lappersediaan.cetak', $data);

        if ($jenisCetakan == 'excel') {
            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Persediaan.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {
            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Laporan Persediaan Barang');
            $pdf->SetSubject('Laporan Persediaan Barang');
            $pdf->SetKeywords('TCPDF, PDF, laporan, persediaan');
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
            $pdf->Output('laporan_persediaan.pdf', 'I');
        }
    }
}
