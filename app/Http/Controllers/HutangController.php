<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;
use TCPDF;

class HutangController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Hutang;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'hutang';
        return view('hutang.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'hutang';
        $data['idhutang'] = "";
        return view('hutang.form', $data);
    }

    public function edit($idhutang)
    {
        try {
            $idhutang = Crypt::decrypt($idhutang);
            $rsHutang = Hutang::findOrFail($idhutang);
        } catch (ModelNotFoundException $e) {
            return redirect('/hutang')->with('other', 'Data tidak ditemukan!');
        }

        $tglhutang = $rsHutang->tglhutang;
        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return redirect('/hutang')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran hutang
        if (Hutang::hutangSudahDibayarByIdHutang($idhutang)) {
            return redirect('/hutang')->with('other', 'Hutang ini sudah dilakukan pembayaran sehingga tidak dapat dirubah lagi!');
        }

        $data['menu'] = 'hutang';
        $data['idhutang'] = $idhutang;
        return view('hutang.form', $data);
    }


    public function detail($idhutang)
    {
        try {
            $idhutang = Crypt::decrypt($idhutang);
            $rsHutang = Hutang::findOrFail($idhutang);
        } catch (ModelNotFoundException $e) {
            return redirect('/hutang')->with('other', 'Data tidak ditemukan!');
        }
        $rsHutangDetail = $this->model->getDetailPembayaran($idhutang);

        $sisaHutang = $rsHutang->totalkredit - $rsHutang->totaldebet;

        $data['menu'] = 'hutang';
        $data['idhutang'] = $idhutang;
        $data['rsHutang'] = $rsHutang;
        $data['rsHutangDetail'] = $rsHutangDetail;
        $data['sisaHutang'] = $sisaHutang;
        return view('hutang.detail', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Hutang::select(['idhutang', 'tglhutang', 'namasupplier', 'totaldebet', 'totalkredit', 'nofaktur', 'statuslunas', 'keterangan', 'jenissumber']);

        $tglawal = $request->input('tglawal');
        $tglakhir = $request->input('tglakhir');
        $idsupplier = $request->input('idsupplier');
        $statuslunas = $request->input('statuslunas');

        $query->whereBetween("tglhutang", [$tglawal, $tglakhir]);
        if ($idsupplier != '' && $idsupplier != null) {
            $query->where('idsupplier', $idsupplier);
        }

        if (!empty($statuslunas)) {
            $query->where('statuslunas', $statuslunas);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($groupwhere) use ($search) {
                $groupwhere->where('idhutang', 'LIKE', "%{$search}%")
                    ->orWhere('nofaktur', 'LIKE', "%{$search}%")
                    ->orWhere('namasupplier', 'LIKE', "%{$search}%");
            });
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idhutang', 'nofaktur', 'namasupplier', 'totaldebet', 'totalkredit', 'statuslunas', null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('tglhutang', 'Desc');
                $query->orderBy('idhutang', 'Desc');
            }
        } else {
            $query->orderBy('tglhutang', 'Desc');
            $query->orderBy('idhutang', 'Desc');
        }


        // Hitung total data tanpa filter
        $totalData = Hutang::count();

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
            $statuslunas = '';
            if ($row->statuslunas == 'Lunas') {
                $statuslunas = '<span class="badge badge-success">Lunas</span>';
            } else {
                $statuslunas = '<span class="badge badge-danger">Belum Lunas</span>';
            }

            if ($row->jenissumber == 'Pembelian') {
                $btnAksi = '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('hutang/cetakBukuHutang/' . Crypt::encrypt($row->idhutang)) . '" class="dropdown-item" target="_blank">Cetak Buku Hutang</a>
                                    </div>
                                </div>
                                <a href="' . url('hutang/detail/' . Crypt::encrypt($row->idhutang)) . '" class="btn btn-primary">Bayar</a>                                
                            </div>';
            } else {
                $btnAksi = '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('hutang/cetakBukuHutang/' . Crypt::encrypt($row->idhutang)) . '" class="dropdown-item" target="_blank">Cetak Buku Hutang</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="' . url('hutang/edit/' . Crypt::encrypt($row->idhutang)) . '" class="dropdown-item">Edit</a>
                                        <a href="' . url('hutang/hapus/' . Crypt::encrypt($row->idhutang)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('hutang/detail/' . Crypt::encrypt($row->idhutang)) . '" class="btn btn-primary">Bayar</a>                                
                            </div>';
            }

            $data[] = [
                'no' => $no++,
                'idhutang' => $row->idhutang . '<br>' . tgldmy($row->tglhutang),
                'nofaktur' => !empty($row->nofaktur) ? $row->nofaktur : '-',
                'namasupplier' => $row->namasupplier . '<br><i>' . $row->keterangan . '</i>',
                'totalkredit' => format_rupiah($row->totalkredit),
                'totaldebet' => format_rupiah($row->totaldebet),
                'statuslunas' => $statuslunas,
                'action' => $btnAksi,
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

    public function simpanTambahPiutang(Request $request)
    {
        $idhutang = $request->get('idhutang');
        $tglhutang = $request->get('tglhutang');
        $idsupplier = $request->get('idsupplier');
        $keterangan = $request->get('keterangan');
        $totalkredit = untitik($request->get('totalkredit'));
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');

        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return redirect('/hutang')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }


        if (empty($idhutang)) {
            $idhutang = $this->model->createID();
            $idhutangdetail = $this->model->createIDDetail($idhutang);

            $data = array(
                'idhutang' => $idhutang,
                'tglhutang' => $tglhutang,
                'idsupplier' => $idsupplier,
                'totaldebet' => 0,
                'totalkredit' => $totalkredit,
                'jenissumber' => 'Non Pembelian',
                'keterangan' => $keterangan,
            );


            $dataDetail = array(
                'idhutangdetail' => $idhutangdetail,
                'idhutang' => $idhutang,
                'tglhutang' => $tglhutang,
                'debet' => 0,
                'kredit' => $totalkredit,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'jenis' => 'Hutang',
            );

            $simpan = $this->model->simpanTambahPiutang($data, $dataDetail, $idhutang);
        } else {
            $idhutangdetail = $this->model->createIDDetail($idhutang);

            $data = array(
                'idhutang' => $idhutang,
                'tglhutang' => $tglhutang,
                'idsupplier' => $idsupplier,
                'totaldebet' => 0,
                'totalkredit' => $totalkredit,
                'jenissumber' => 'Non Pembelian',
                'keterangan' => $keterangan,
            );


            $dataDetail = array(
                'idhutangdetail' => $idhutangdetail,
                'idhutang' => $idhutang,
                'tglhutang' => $tglhutang,
                'debet' => 0,
                'kredit' => $totalkredit,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'idpengguna' => session('idpengguna'),
                'jenis' => 'Hutang',
            );

            $simpan = $this->model->updateTambahPiutang($data, $dataDetail, $idhutang);
        }

        if ($simpan['status'] == 'success') {
            return redirect('/hutang')->with('success', $simpan['message']);
        } else {
            return redirect('/hutang')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }


    public function simpanData(Request $request)
    {
        $idhutang = $request->get('modalidhutang');
        $idhutangdetail = $request->get('idhutangdetail');
        $tglhutang = $request->get('tglhutang');
        $carabayar = $request->get('carabayar');
        $idbank = $request->get('idbank');
        $nobilyetgiro = $request->get('nobilyetgiro');
        $debet = untitik($request->get('debet'));
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return redirect('/hutang/detail/' . Crypt::encrypt($idhutang))->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        if ($carabayar != 'Transfer' && $carabayar != 'Giro') {
            $idbank = null;
        }

        if ($carabayar != 'Giro') {
            $nobilyetgiro = null;
        }


        $idhutangdetail = $this->model->createIDDetail($idhutang);

        $data = array(
            'idhutangdetail' => $idhutangdetail,
            'idhutang' => $idhutang,
            'tglhutang' => $tglhutang,
            'debet' => $debet,
            'kredit' => 0,
            'inserted_date' => $inserted_date,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
            'carabayar' => $carabayar,
            'idbank' => $idbank,
            'nobilyetgiro' => $nobilyetgiro,
            'jenis' => 'Pembayaran Hutang',
        );
        $simpan = $this->model->simpanPembayaran($data, $idhutang);

        if ($simpan['status'] == 'success') {
            return redirect('/hutang/detail/' . Crypt::encrypt($idhutang))->with('success', $simpan['message']);
        } else {
            return redirect('/hutang/detail/' . Crypt::encrypt($idhutang))->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }

    public function hapus($idhutang)
    {
        $idhutang = Crypt::decrypt($idhutang);
        try {
            $rsHutang = Hutang::findOrFail($idhutang);
        } catch (ModelNotFoundException $e) {
            return redirect('/hutang')->with('other', 'Data tidak ditemukan!');
        }

        $jenissumber = $rsHutang->jenissumber;
        if ($jenissumber == 'Pembelian') {
            return redirect('/hutang')->with('other', 'Hutang ini berasal dari Pembelian, tidak bisa dihapus!');
        };

        $tglhutang = $rsHutang->tglhutang;
        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return redirect('/hutang')->with('other', "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!");
        }

        //cek jika sudah dilakukan pembayaran hutang
        if (Hutang::hutangSudahDibayarByIdHutang($idhutang)) {
            return redirect('/hutang')->with('other', 'Hutang ini sudah dilakukan pembayaran sehingga tidak dapat dihapus lagi!');
        }

        $hapus = $this->model->hapus($idhutang, $rsHutang);
        if ($hapus['status'] == 'success') {
            return redirect('/hutang')->with('success', $hapus['message']);
        } else {
            return redirect('/hutang')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function hapusDetailPembayaran($idhutangdetail)
    {
        $idhutangdetail = Crypt::decrypt($idhutangdetail);
        try {
            $rsHutangDetail = $this->model->getDetailID($idhutangdetail);
        } catch (ModelNotFoundException $e) {
            return redirect('/hutang')->with('other', 'Data tidak ditemukan!');
        }

        $idhutang = $rsHutangDetail->idhutang;
        $tglhutang = $rsHutangDetail->tglhutang;
        if (App::isPosting($tglhutang)) {
            $bulan = bulan(date('m', strtotime($tglhutang)));
            $tahun = date('Y', strtotime($tglhutang));
            return response()->json(array("msg" => "Jurnal bulan $bulan $tahun sudah di posting! tidak boleh merubah jurnal di periode ini lagi!"));
        }

        $hapus = $this->model->hapusDetail($idhutang, $idhutangdetail, $rsHutangDetail);
        if ($hapus['status'] == 'success') {
            return redirect('/hutang/detail/' . Crypt::encrypt($idhutang))->with('success', $hapus['message']);
        } else {
            return redirect('/hutang/detail/' . Crypt::encrypt($idhutang))->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idhutang = $request->input('idhutang');
        $rsHutang = Hutang::find($idhutang);

        $rsDetail = $this->model->getDetail($idhutang);
        return response()->json(array('rsHutang' => $rsHutang, 'rsDetail' => $rsDetail));
    }

    public function cetakBukuHutang($idhutang)
    {
        /*
            composer require tecnickcom/tcpdf
        */
        try {
            $idhutang = Crypt::decrypt($idhutang);
            $rsHutang = Hutang::findOrFail($idhutang);
        } catch (ModelNotFoundException $e) {
            echo "Data tidak ditemukan!";
        }
        $idsupplier = $rsHutang->idsupplier;
        $rsSupplier = Supplier::find($idsupplier);

        $data['rsDetail'] = $this->model->getDetail($idhutang);
        $data['rsHutang'] = $rsHutang;
        $data['rsSupplier'] = $rsSupplier;
        $view = view('hutang.cetakBukuHutang', $data);


        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Buku Hutang');
        $pdf->SetSubject('Buku Hutang');
        $pdf->SetKeywords('TCPDF, PDF, laporan, bukuhutang');
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
        $pdf->Output('buku_hutang.pdf', 'I');
    }
}
