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
        $data['maintenanceInfo'] = $this->pemeliharaanModel->getMaintenanceInfo();

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

    /**
     * Eksekusi force logout semua pengguna lain via AJAX
     */
    public function logoutSemuaPengguna(Request $request)
    {
        $this->checkDev();

        $currentSessionId = session()->getId();
        $result = $this->pemeliharaanModel->logoutSemuaPengguna($currentSessionId);
        $result['statistik'] = $this->pemeliharaanModel->getStatistikGlobal($currentSessionId);

        return response()->json($result);
    }

    /**
     * Eksekusi mulai maintenance sistem via AJAX
     */
    public function mulaiMaintenance(Request $request)
    {
        $this->checkDev();

        $durasi = $request->input('durasi', 60);
        $result = $this->pemeliharaanModel->mulaiMaintenance($durasi);

        return response()->json($result);
    }

    /**
     * Eksekusi selesai maintenance sistem via AJAX
     */
    public function selesaiMaintenance(Request $request)
    {
        $this->checkDev();

        $result = $this->pemeliharaanModel->selesaiMaintenance();

        return response()->json($result);
    }
}
