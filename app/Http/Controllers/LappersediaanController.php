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
        

        $where = " Where b.statusaktif = 'Aktif'";

        
        $idkategori = $request->input('idkategori');
        if ($idkategori != '' && $idkategori != null) {
            $where = $where . " AND b.idkategori = '$idkategori'";
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $where = $where . " AND (b.idbarang LIKE '%{$search}%' OR b.namabarang LIKE '%{$search}%' OR k.namakategori LIKE '%{$search}%')";
        }

        // Sorting berdasarkan kolom yang diklik
        $orderby = "";
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idbarang', 'namabarang', 'namakategori', null, null, null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                // $query->orderBy($columns[$orderColumn], $orderDirection);
                $orderby = " Order by " . $columns[$orderColumn] . " " . $orderDirection;
            } else {
                $orderby = " Order by namabarang ASC";
            }
        } else {
            $orderby = " Order by namabarang ASC";
        }


        // Ambil parameter 'length' dan 'start' dari DataTables
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Buat query untuk mengambil data
        $rsData = $this->model->getPersediaanByTanggal($request->input('tglriwayat'), $where, $orderby, $limit, $start);

        // Hitung total data tanpa filter
        // $totalData = count($rsData);
        $totalData = $this->model->getTotalBarangAktif();

        // Hitung total data setelah filter (jika ada pencarian)
        // $totalFiltered = count($rsData);   
        $totalFiltered = $this->model->getTotalFiltered($request->input('tglriwayat'), $where);     

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

    public function cetak($jenisCetakan, $tglriwayat, $idkategori)
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $where = "WHERE b.statusaktif = 'Aktif'";
    
        // Tambahkan filter kategori jika ada
        if (!empty($idkategori) && $idkategori != "-") {
            // Pastikan nilai $idkategori aman (misal integer atau string pendek)
            $where .= " AND b.idkategori = '" . addslashes($idkategori) . "'";
        }
        
        $orderby = "ORDER BY b.namabarang ASC";
        
        // Untuk cetakan, kita tidak pakai limit dan start
        $limit = null;
        $start = null;

        // Ambil data semua barang (tanpa paginasi)
        $rsBarang = $this->model->getPersediaanByTanggal($tglriwayat, $where, $orderby, $limit, $start);


        $data['rsBarang'] = $rsBarang;
        $data['tglriwayat'] = $tglriwayat;
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
