<?php

namespace App\Http\Controllers;

use App\Models\Penagihan;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use App\Models\Bank;
use App\Models\Konsumen;
use App\Models\Sales;
use TCPDF;
use Carbon\Carbon;

class PenagihanController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Penagihan;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'penagihan';
        return view('penagihan.index', $data);
    }

    public function tambah()
    {
        $nextSunday = Carbon::now()->next(Carbon::SUNDAY)->addWeek(); // Hari Minggu minggu depan
        $nextSundayFormatted = $nextSunday->format('Y-m-d'); // Format tanggal menjadi Y-m-d

        $data['tgltagihanakhir'] = $nextSundayFormatted;
        $data['idpenagihan'] = '';
        $data['menu'] = 'penagihan';
        return view('penagihan.form', $data);
    }

    public function edit($idpenagihan)
    {
        try {
            $idpenagihan = Crypt::decrypt($idpenagihan);
            $rsPenjualan = Penagihan::findOrFail($idpenagihan);
        } catch (ModelNotFoundException $e) {
            return redirect('/penagihan')->with('other', 'Data tidak ditemukan!');
        }

        $data['menu'] = 'penagihan';
        $data['idpenagihan'] = $idpenagihan;
        return view('penagihan.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Penagihan::select('*');

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsales = $request->input('idsales');


        $query->whereBetween("tglpenagihan", [$tglawal, $tglakhir]);
        if ($idsales != '' && $idsales != null) {
            $query->where('idsales', $idsales);
        }


        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idpenagihan', 'LIKE', "%{$search}%")
                    ->orWhere('namasales', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'tglpenagihan', 'namasales', 'totaltagihan', 'statuscetak', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglpenagihan', 'Desc');
                $query->orderBy('idpenagihan', 'Desc');
            }
        } else {
            $query->orderBy('tglpenagihan', 'Desc');
            $query->orderBy('idpenagihan', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Penagihan::count();

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

            if ($row->statuscetak == 'Sudah Cetak') {
                $statuscetak = '<span class="badge badge-success">Sudah Cetak</span>';
            } else {
                $statuscetak = '<span class="badge badge-danger">Belum Cetak</span>';
            }

            $data[] = [
                'no' => $no++,
                'tglpenagihan' => tgldmy($row->tglpenagihan) . '<br>' . $row->idpenagihan,
                'namasales' => $row->namasales . '<br><small>NPWP : ' . $row->npwpsales . '</small>',
                'totaltagihan' => format_rupiah($row->totaltagihan),
                'statuscetak' => $statuscetak,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('penagihan/cetak/' . Crypt::encrypt($row->idpenagihan)) . '" class="dropdown-item" target="_blank">Cetak Surat Penagihan</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="' . url('penagihan/hapus/' . Crypt::encrypt($row->idpenagihan)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('penagihan/edit/' . Crypt::encrypt($row->idpenagihan)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',
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

    public function simpanData(Request $request)
    {
        $idpenagihan = $request->get('idpenagihan');
        $tglpenagihan = $request->get('tglpenagihan');
        $tgltagihanakhir = $request->get('tgltagihanakhir');
        $idsales = $request->get('idsales');
        $total = untitik($request->get('total'));
        $isidatatable = $request->get('isidatatable');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (empty($idpenagihan)) {
            $idpenagihan = $this->model->createID();

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpenagihan' => $idpenagihan,
                    'idpiutang' => $isidatatable[$i]['idpiutang'],
                    'idsalesbonus' => $isidatatable[$i]['idsalesbonus'],
                    'jumlahtagihan' => untitik($isidatatable[$i]['jumlahtagihan']),
                );
            }

            $data = array(
                'idpenagihan' => $idpenagihan,
                'tglpenagihan' => $tglpenagihan,
                'tgltagihanakhir' => $tgltagihanakhir,
                'idsales' => $idsales,
                'totaltagihan' => $total,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'statuscetak' => 'Belum Cetak',
            );

            $simpan = $this->model->simpanData($data, $dataDetail, $idpenagihan);
        } else {

            $dataDetail = array();
            for ($i = 0; $i < count($isidatatable); $i++) {
                $dataDetail[] = array(
                    'idpenagihan' => $idpenagihan,
                    'idpiutang' => $isidatatable[$i]['idpiutang'],
                    'idsalesbonus' => $isidatatable[$i]['idsalesbonus'],
                    'jumlahtagihan' => untitik($isidatatable[$i]['jumlahtagihan']),
                );
            }

            $data = array(
                'idpenagihan' => $idpenagihan,
                'totaltagihan' => $total,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
            );

            $simpan = $this->model->updateData($data, $dataDetail, $idpenagihan);
        }

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }

    public function hapus($idpenagihan)
    {
        $idpenagihan = Crypt::decrypt($idpenagihan);
        try {
            $rsPenagihan = Penagihan::findOrFail($idpenagihan);
        } catch (ModelNotFoundException $e) {
            return redirect('/penagihan')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idpenagihan, $rsPenagihan);
        if ($hapus['status'] == 'success') {
            return redirect('/penagihan')->with('success', $hapus['message']);
        } else {
            return redirect('/penagihan')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpenagihan = $request->input('idpenagihan');
        $rsPenagihan = Penagihan::find($idpenagihan);

        $rsDetail = $this->model->getDetail($idpenagihan);

        return response()->json(array('rsPenagihan' => $rsPenagihan, 'rsDetail' => $rsDetail));
    }

    public function getPiutangID(Request $request)
    {
        $idpiutang = $request->input('idpiutang');
        $rsPiutang = $this->model->getPiutangID($idpiutang);
        return response()->json(array('rsPiutang' => $rsPiutang));
    }

    public function getPiutangBelumLunas(Request $request)
    {
        $idsales = $request->input('idsales');
        $tgltagihanakhir = $request->input('tgltagihanakhir');

        // Query pencarian
        $results = $this->model->getPiutangBelumLunas($idsales, $tgltagihanakhir);


        return response()->json(['results' => $results]);
    }

    public function cetak($idpenagihan)
    {
        $idpenagihan = Crypt::decrypt($idpenagihan);
        try {
            $rsPenagihan = Penagihan::findOrFail($idpenagihan);
        } catch (ModelNotFoundException $e) {
            return redirect('/bonussales')->with('other', 'Data tidak ditemukan!');
        }
        $idsales = $rsPenagihan->idsales;
        $rsSales = Sales::find($idsales);
        $rsDetail = $this->model->getDetail($idpenagihan);

        $this->model->updatestatuscetak($idpenagihan);

        $data['rsSales'] = $rsSales;
        $data['rsDetail'] = $rsDetail;
        $data['rsPenagihan'] = $rsPenagihan;
        $view = view('penagihan.cetak', $data)->render();


        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Penagihan');
        $pdf->SetSubject('Laporan Penagihan');
        $pdf->SetKeywords('TCPDF, PDF, laporan, penagihan');
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
        $pdf->Output('laporan_penagihan.pdf', 'I');
    }
}
