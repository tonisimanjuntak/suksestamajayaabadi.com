<?php

namespace App\Http\Controllers;

use App\Models\Postingjurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;


class PostingjurnalController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Postingjurnal;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'postingjurnal';
        return view('postingjurnal.index', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Postingjurnal::select(['idposting', 'bulan', 'tahun', 'jumlahdebet', 'jumlahkredit', 'namapengguna', 'inserted_date']);

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('bulan', 'LIKE', "%{$search}%")
                ->orWhere('tahun', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'bulan', 'tahun', null, null, null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tahun', 'Desc');
                $query->orderBy('bulan', 'Desc');
            }
        } else {
            $query->orderBy('tahun', 'Desc');
            $query->orderBy('bulan', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Postingjurnal::count();

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
                'bulan' => $row->bulan,
                'tahun' => $row->tahun,
                'jumlahdebet' => format_rupiah($row->jumlahdebet),
                'jumlahkredit' => format_rupiah($row->jumlahkredit),
                'namapengguna' => $row->namapengguna . '<br>' . tgldatetime($row->inserted_date),
                'action' => '<a href="' . url('postingjurnal/hapus/' . Crypt::encrypt($row->idposting)) . '" class="btn btn-danger btn-sm" id="btnHapus"><i class="fa fa-trash"></i></a>',

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

    public function mulaiPosting(Request $request)
    {
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        if ($this->model->sudahPosting($bulan, $tahun)) {
            return redirect('/postingjurnal')->with('other', "Jurnal bulan " . bulan($bulan) . " $tahun sudah di posting!");
        }

        $posting = $this->model->mulaiPosting($bulan, $tahun);

        if ($posting['status'] == 'success') {
            return redirect('/postingjurnal')->with('success', $posting['message']);
        } else {
            return redirect('/postingjurnal')->with('fail', 'Data gagal diposting! Error: ' . $posting['message']);
        }
    }

    public function hapus($idposting)
    {
        $idposting = Crypt::decrypt($idposting);
        try {
            $rsPosting = Postingjurnal::findOrFail($idposting);
        } catch (ModelNotFoundException $e) {
            return redirect('/postingjurnal')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idposting, $rsPosting);
        if ($hapus['status'] == 'success') {
            return redirect('/postingjurnal')->with('success', $hapus['message']);
        } else {
            return redirect('/postingjurnal')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }
}
