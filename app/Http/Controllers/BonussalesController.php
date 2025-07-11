<?php

namespace App\Http\Controllers;

use App\Models\Bonussales;
use Illuminate\Http\Request;
use App\Models\Uploads;
use App\Models\Sales;
use App\Models\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TCPDF;

class BonussalesController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Bonussales;
        $this->App = new App;
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'bonussales';
        return view('bonussales.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'bonussales';
        $data['idbonus'] = "";
        return view('bonussales.form', $data);
    }

    public function listdata(Request $request)
    {
        // Query dasar
        $query = Bonussales::select('*');

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idbonus', 'LIKE', "%{$search}%")
                ->orWhere('namasales', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'tglbonus', 'namasales', null, null, null, null, null, null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namasales', 'Asc');
            }
        } else {
            $query->orderBy('namasales', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Bonussales::count();

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

            $totalbonussemua = $row->totalbonustarget + $row->totalbonuspenjualan + $row->totalbonuspenagihan;

            $data[] = [
                'no' => $no++,
                'tglbonus' => $row->tglbonus,
                'namasales' => $row->namasales,
                'totalpenjualan' => format_rupiah($row->totalpenjualan),
                'totalpenagihan' => format_rupiah($row->totalpenagihan),
                'totalbonuspenjualan' => format_rupiah($row->totalbonuspenjualan),
                'totalbonuspenagihan' => format_rupiah($row->totalbonuspenagihan),
                'totalbonustarget' => format_rupiah($row->totalbonustarget),
                'totalbonussemua' => format_rupiah($totalbonussemua),
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('bonussales/hapus/' . Crypt::encrypt($row->idbonus)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('bonussales/cetak/' . Crypt::encrypt($row->idbonus)) . '" class="btn btn-primary" target="_blank">Cetak</a>                                
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
        $tglbonus = $request->get('tglbonus');
        $idsales = $request->get('idsales');
        $keterangan = $request->get('keterangan');
        $totalpenjualan = untitik($request->get('totalpenjualan'));
        $totalbonuspenjualan = untitik($request->get('totalbonuspenjualan'));
        $totalpenagihan = untitik($request->get('totalpenagihan'));
        $totalbonuspenagihan = untitik($request->get('totalbonuspenagihan'));
        $targetpenjualan = untitik($request->get('targetpenjualan'));
        $pencapaiantarget = untitik($request->get('pencapaiantarget'));
        $totalbonustarget = untitik($request->get('totalbonustarget'));
        $tablePenjualan = $request->get('tablePenjualan');
        $tablePenagihan = $request->get('tablePenagihan');
        $tableTarget = $request->get('tableTarget');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');


        $idbonus = $this->model->createID();

        // ============================================= BONUS PENJUALAN ==============
        $arrBonusPenjualan = [];
        $dataPenjualanDetail = [];
        foreach ($tablePenjualan as $penjualan) {
            $idpenjualan = $penjualan['idpenjualan'];

            //array untuk update tabel detail penjualan
            array_push($dataPenjualanDetail, array(
                'id' => $penjualan['idpenjualandetail'],
                'jenisbonuspenjualan' => $penjualan['jenisbonuspenjualan'],
                'persenbonuspenjualan' => $penjualan['persenbonuspenjualan'],
                'jumlahbonuspenjualan' => untitik($penjualan['jumlahbonuspenjualan']),
                'subtotalbonuspenjualan' => untitik($penjualan['totalbonus']),
            ));

            //membuat total berdasarkan idpenjualan, atau grouping
            if (isset($arrBonusPenjualan[$idpenjualan])) {
                $arrBonusPenjualan[$idpenjualan]['totalinvoice'] += untitik($penjualan['subtotal']);
                $arrBonusPenjualan[$idpenjualan]['totalbonus'] += untitik($penjualan['totalbonus']);
            } else {
                $arrBonusPenjualan[$idpenjualan] = [
                    'idbonus' => $idbonus,
                    'idpenjualan' => $idpenjualan,
                    'iddetailsuratjalan' => $penjualan['iddetailsuratjalan'],
                    'totalinvoice' => untitik($penjualan['subtotal']),
                    'totalbonus' => untitik($penjualan['totalbonus']),
                ];
            }
        }
        $dataBonusPenjualan = array();
        foreach ($arrBonusPenjualan as $row) {
            array_push(
                $dataBonusPenjualan,
                array(
                    'idpenjualan' => $row['idpenjualan'],
                    'idbonus' => $row['idbonus'],
                    'iddetailsuratjalan' => $row['iddetailsuratjalan'],
                    'totalinvoice' => $row['totalinvoice'],
                    'totalbonus' => $row['totalbonus'],
                )
            );
        }



        // ============================================= BONUS PENAGIHAN ==============
        $arrBonusPenagihan = [];
        $dataPenjualanDetailPenagihan = [];
        foreach ($tablePenagihan as $penagihan) {
            $idpiutang = $penagihan['idpiutang'];

            //array untuk update tabel detail penjualan
            array_push($dataPenjualanDetailPenagihan, array(
                'id' => $penagihan['idpenjualandetail'],
                'jenisbonustagihan' => $penagihan['jenisbonustagihan'],
                'persenbonustagihan' => $penagihan['persenbonustagihan'],
                'jumlahbonustagihan' => untitik($penagihan['jumlahbonustagihan']),
                'subtotalbonustagihan' => untitik($penagihan['totalbonus']),
            ));

            //membuat total berdasarkan idpenjualan, atau grouping
            if (isset($arrBonusPenagihan[$idpiutang])) {
                $arrBonusPenagihan[$idpiutang]['totaltagihan'] += untitik($penagihan['subtotal']);
                $arrBonusPenagihan[$idpiutang]['totalbonus'] += untitik($penagihan['totalbonus']);
            } else {
                $arrBonusPenagihan[$idpiutang] = [
                    'idbonus' => $idbonus,
                    'idpiutang' => $idpiutang,
                    'idpenjualan' => $penagihan['idpenjualan'],
                    'totaltagihan' => untitik($penagihan['subtotal']),
                    'totalbonus' => untitik($penagihan['totalbonus']),
                ];
            }
        }

        $dataBonusPenagihan = array();
        foreach ($arrBonusPenagihan as $row) {
            array_push(
                $dataBonusPenagihan,
                array(
                    'idpiutang' => $row['idpiutang'],
                    'idpenjualan' => $row['idpenjualan'],
                    'idbonus' => $row['idbonus'],
                    'totaltagihan' => $row['totaltagihan'],
                    'totalbonus' => $row['totalbonus'],
                )
            );
        }



        // ============================================= BONUS TARGET ==============
        $arrBonusTarget = [];
        $dataPenjualanDetailTarget = [];
        foreach ($tableTarget as $target) {
            $idpenjualan = $target['idpenjualan'];

            //array untuk update tabel detail penjualan
            array_push($dataPenjualanDetailTarget, array(
                'id' => $target['idpenjualandetail'],
                'idjenisbarang' => $target['idjenisbarang'],
                'persenbonustarget' => $target['persenbonustarget'],
                'subtotalbonustarget' => untitik($target['totalbonus']),
            ));

            //membuat total berdasarkan idpenjualan, atau grouping
            if (isset($arrBonusTarget[$idpenjualan])) {
                $arrBonusTarget[$idpenjualan]['totalinvoice'] += untitik($target['subtotal']);
                $arrBonusTarget[$idpenjualan]['totalbonus'] += untitik($target['totalbonus']);
            } else {
                $arrBonusTarget[$idpenjualan] = [
                    'idbonus' => $idbonus,
                    'idpenjualan' => $idpenjualan,
                    'totalinvoice' => untitik($target['subtotal']),
                    'totalbonus' => untitik($target['totalbonus']),
                ];
            }
        }
        $dataBonusTarget = array();
        foreach ($arrBonusTarget as $row) {
            array_push(
                $dataBonusTarget,
                array(
                    'idpenjualan' => $row['idpenjualan'],
                    'idbonus' => $row['idbonus'],
                    'totalinvoice' => $row['totalinvoice'],
                    'totalbonus' => $row['totalbonus'],
                )
            );
        }



        $data = array(
            'idbonus' => $idbonus,
            'tglbonus' => $tglbonus,
            'idsales' => $idsales,
            'keterangan' => $keterangan,
            'totalpenjualan' => $totalpenjualan,
            'totalpenagihan' => $totalpenagihan,
            'totalbonuspenjualan' => $totalbonuspenjualan,
            'totalbonuspenagihan' => $totalbonuspenagihan,
            'targetpenjualan' => $targetpenjualan,
            'pencapaiantarget' => $pencapaiantarget,
            'totalbonustarget' => $totalbonustarget,
            'inserted_date' => $inserted_date,
            'updated_date' => $updated_date,
            'idpengguna' => session('idpengguna'),
        );
        $simpan = $this->model->simpanData($data, $dataBonusPenjualan, $dataPenjualanDetail, $dataBonusPenagihan, $dataPenjualanDetailPenagihan, $dataBonusTarget, $dataPenjualanDetailTarget);

        if ($simpan['status'] == 'success') {
            return response()->json(array('success' => true));
        } else {
            return response()->json(array('msg' => 'Data gagal disimpan! Error: ' . $simpan['message']));
        }
    }

    public function hapus($idbonus)
    {
        $idbonus = Crypt::decrypt($idbonus);
        try {
            $rsBonus = Bonussales::findOrFail($idbonus);
        } catch (ModelNotFoundException $e) {
            return redirect('/bonussales')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idbonus, $rsBonus);
        if ($hapus['status'] == 'success') {
            return redirect('/bonussales')->with('success', $hapus['message']);
        } else {
            return redirect('/bonussales')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idbonus = $request->input('idbonus');
        $rsBonus = Bonussales::find($idbonus);

        return response()->json(array('rsBonus' => $rsBonus));
    }

    public function getBonus(Request $request)
    {
        $idsales = $request->input('idsales');

        $rsHitungBonusPenjualan = $this->model->getPerhitunganBonusPenjualan($idsales);
        $rsHitungBonusPenagihan = $this->model->getPerhitunganBonusPenagihan($idsales);
        $rsHitungBonusTarget = $this->model->getPerhitunganBonusTarget($idsales);
        $TargetPenjualanSales = $this->model->getTargetPenjualanSales($idsales);
        $PencapaianPenjualan = $this->model->getPencapaianPenjualanSales($idsales);

        return response()->json(array(
            'rsHitungBonusPenjualan' => $rsHitungBonusPenjualan,
            'rsHitungBonusPenagihan' => $rsHitungBonusPenagihan,
            'rsHitungBonusTarget' => $rsHitungBonusTarget,
            'TargetPenjualanSales' => $TargetPenjualanSales,
            'PencapaianPenjualan' => $PencapaianPenjualan,
        ));
    }

    public function cetak($idbonus)
    {
        $idbonus = Crypt::decrypt($idbonus);
        try {
            $rsBonus = Bonussales::findOrFail($idbonus);
        } catch (ModelNotFoundException $e) {
            return redirect('/bonussales')->with('other', 'Data tidak ditemukan!');
        }
        $idsales = $rsBonus->idsales;
        $rsSales = Sales::find($idsales);

        $data['rsSales'] = $rsSales;
        $data['rsBonus'] = $rsBonus;
        $view = view('bonussales.cetak', $data)->render();


        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set properti dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Bunus');
        $pdf->SetSubject('Laporan Bunus');
        $pdf->SetKeywords('TCPDF, PDF, laporan, bonus');
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
        $pdf->Output('laporan_bonus.pdf', 'I');
    }
}
