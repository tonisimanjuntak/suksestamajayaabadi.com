<?php

namespace App\Http\Controllers;

use App\Models\Pemeliharaansystem;
use Illuminate\Http\Request;

class PemeliharaansystemController extends Controller
{
    protected $pemeliharaanModel;

    public function __construct()
    {
        $this->isLogin();
        $this->pemeliharaanModel = new Pemeliharaansystem();
    }

    /**
     * Proteksi: hanya pengguna dengan idpengguna 9999999999 (developer) yang boleh mengakses
     */
    private function checkDev()
    {
        if (session('idpengguna') !== '9999999999') {
            abort(403, 'Akses ditolak. Menu ini hanya dapat diakses oleh Developer.');
        }
    }

    /**
     * Halaman Utama Menu Pemeliharaan System
     */
    public function index()
    {
        $this->checkDev();

        $data['menu'] = 'pemeliharaansystem';
        $data['statistik'] = $this->pemeliharaanModel->getStatistikGlobal();
        $data['periodeList'] = $this->pemeliharaanModel->getPeriodeList();
        $data['periodeAktif'] = '1';

        return view('pemeliharaansystem.index', $data);
    }

    /**
     * Cek status data riwayat aktifitas untuk periode tertentu via AJAX
     */
    public function cekStatus(Request $request)
    {
        $this->checkDev();

        $periode = $request->input('periode', '1');

        $statusPeriode = $this->pemeliharaanModel->cekStatusPeriode($periode);
        $statistikGlobal = $this->pemeliharaanModel->getStatistikGlobal();

        return response()->json([
            'status' => 'success',
            'data' => $statusPeriode,
            'statistik' => $statistikGlobal,
        ]);
    }

    /**
     * Eksekusi pemindahan data riwayat aktifitas ke arsip via AJAX
     */
    public function archiveRiwayatAktifitas(Request $request)
    {
        $this->checkDev();

        $periode = $request->input('periode', '1');

        $result = $this->pemeliharaanModel->archiveRiwayatAktifitas($periode);
        $result['statistik'] = $this->pemeliharaanModel->getStatistikGlobal();
        $result['status_periode'] = $this->pemeliharaanModel->cekStatusPeriode($periode);

        return response()->json($result);
    }
}
