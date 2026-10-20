<?php

namespace App\Http\Controllers;

use App\Helpers\StokFifoService;
use App\Models\App as AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekonsiliasiStokController extends Controller
{
    public function __construct()
    {
        $this->isLogin();
    }

    /** Hanya bisa diakses oleh developer */
    private function checkDev()
    {
        if (session('idpengguna') !== '9999999999') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index()
    {
        $this->checkDev();
        $data['menu'] = 'rekonsiliasiStok';
        return view('rekonsiliasiStok.index', $data);
    }

    /**
     * Hitung selisih kuantitas riwayatstok (stokakhir terakhir) vs stokfifo (SUM jumlahsisa)
     * per idbarang. Hanya tampilkan barang yang benar-benar selisih.
     */
    public function hitungSelisih(Request $request)
    {
        $this->checkDev();

        $idbarang = $request->input('idbarang');
        $params = [];
        $whereBarang = "";
        if (!empty($idbarang)) {
            $whereBarang = "WHERE b.idbarang = ?";
            $params[] = $idbarang;
        }

        $rows = DB::select("
            SELECT
                b.idbarang,
                b.kdbarang,
                b.namabarang,
                COALESCE(rw.stokakhir, 0) AS stok_riwayat,
                COALESCE(sf.total_sisa, 0) AS stok_fifo,
                COALESCE(rw.stokakhir, 0) - COALESCE(sf.total_sisa, 0) AS selisih
            FROM barang b
            LEFT JOIN (
                SELECT rs1.idbarang, rs1.stokakhir
                FROM riwayatstok rs1
                INNER JOIN (
                    SELECT idbarang, MAX(idriwayat) AS max_id
                    FROM riwayatstok
                    GROUP BY idbarang
                ) rs2 ON rs1.idbarang = rs2.idbarang AND rs1.idriwayat = rs2.max_id
            ) rw ON b.idbarang = rw.idbarang
            LEFT JOIN (
                SELECT idbarang, SUM(jumlahsisa) AS total_sisa
                FROM stokfifo
                GROUP BY idbarang
            ) sf ON b.idbarang = sf.idbarang
            {$whereBarang}
            HAVING selisih <> 0
            ORDER BY ABS(selisih) DESC
        ", $params);

        $data = [];
        foreach ($rows as $row) {
            $data[] = [
                'idbarang'     => $row->idbarang,
                'kdbarang'     => $row->kdbarang,
                'namabarang'   => $row->namabarang,
                'stok_riwayat' => (float) $row->stok_riwayat,
                'stok_fifo'    => (float) $row->stok_fifo,
                'selisih'      => (float) $row->selisih,
            ];
        }

        return response()->json(['status' => 'success', 'data' => $data]);
    }

    /**
     * Identifikasi transaksi yang ada di riwayatstok tapi belum punya layer di stokfifo
     * dan transaksi stokfifo yang idtransaksinya tidak ada di riwayatstok — khusus per idbarang.
     */
    public function identifikasiTransaksi(Request $request)
    {
        $this->checkDev();
        $idbarang = $request->input('idbarang');

        if (empty($idbarang)) {
            return response()->json(['status' => 'error', 'message' => 'idbarang wajib diisi.'], 422);
        }

        // Transaksi MASUK di riwayatstok (stokmasuk > 0) yang tidak ada layer di stokfifo
        $masukRiwayat = DB::select("
            SELECT
                rs.idriwayat,
                rs.idtransaksi,
                rs.jenistransaksi,
                rs.tglriwayat,
                rs.tgltransaksi,
                rs.stokmasuk AS jumlah,
                rs.deskripsi
            FROM riwayatstok rs
            WHERE rs.idbarang = ?
              AND rs.stokmasuk > 0
              AND NOT EXISTS (
                  SELECT 1 FROM stokfifo sf
                  WHERE sf.idbarang = rs.idbarang
                    AND sf.idtransaksi = rs.idtransaksi
                    AND sf.jenistransaksi = rs.jenistransaksi
              )
            ORDER BY rs.idriwayat ASC
        ", [$idbarang]);

        // Transaksi KELUAR di riwayatstok (stokkeluar > 0) yang tidak ada detail di stokfifodetail
        $keluarRiwayat = DB::select("
            SELECT
                rs.idriwayat,
                rs.idtransaksi,
                rs.jenistransaksi,
                rs.tglriwayat,
                rs.tgltransaksi,
                rs.stokkeluar AS jumlah,
                rs.deskripsi
            FROM riwayatstok rs
            WHERE rs.idbarang = ?
              AND rs.stokkeluar > 0
              AND NOT EXISTS (
                  SELECT 1 FROM stokfifodetail sfd
                  INNER JOIN stokfifo sf ON sfd.idstokfifo = sf.idstokfifo
                  WHERE sf.idbarang = rs.idbarang
                    AND sfd.idtransaksi = rs.idtransaksi
                    AND sfd.jenistransaksi = rs.jenistransaksi
              )
            ORDER BY rs.idriwayat ASC
        ", [$idbarang]);

        // Layer stokfifo yang idtransaksinya tidak ada di riwayatstok (orphan FIFO)
        $orphanFifo = DB::select("
            SELECT
                sf.idstokfifo,
                sf.idtransaksi,
                sf.jenistransaksi,
                sf.tglmasuk,
                sf.jumlahmasuk,
                sf.jumlahsisa,
                sf.nilaihpp,
                sf.keterangan
            FROM stokfifo sf
            WHERE sf.idbarang = ?
              AND NOT EXISTS (
                  SELECT 1 FROM riwayatstok rs
                  WHERE rs.idbarang = sf.idbarang
                    AND rs.idtransaksi = sf.idtransaksi
                    AND rs.jenistransaksi = sf.jenistransaksi
              )
            ORDER BY sf.tglmasuk ASC
        ", [$idbarang]);

        return response()->json([
            'status'         => 'success',
            'masuk_riwayat'  => $masukRiwayat,    // bisa di-insert ke stokfifo
            'keluar_riwayat' => $keluarRiwayat,   // bisa di-proses barangKeluar di stokfifo
            'orphan_fifo'    => $orphanFifo,       // bisa dihapus dari stokfifo
        ]);
    }

    /**
     * Insert layer FIFO untuk transaksi MASUK yang hilang (dari riwayatstok).
     */
    public function insertLayerFifo(Request $request)
    {
        $this->checkDev();

        $idbarang      = $request->input('idbarang');
        $idtransaksi   = $request->input('idtransaksi');
        $jenistransaksi = $request->input('jenistransaksi');
        $tgl           = $request->input('tgl');
        $jumlah        = (float) $request->input('jumlah');

        if (empty($idbarang) || empty($idtransaksi) || empty($jenistransaksi) || $jumlah <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Parameter tidak lengkap.'], 422);
        }

        // Ambil harga dari riwayatstok
        $rw = DB::table('riwayatstok')
            ->where('idbarang', $idbarang)
            ->where('idtransaksi', $idtransaksi)
            ->where('jenistransaksi', $jenistransaksi)
            ->orderBy('idriwayat', 'desc')
            ->first();

        $hargasatuan  = $rw ? (float) $rw->hargasatuan  : 0;
        $hargadpp     = $rw ? (float) $rw->hargadpp      : 0;
        $jumlahppn    = $rw ? (float) $rw->jumlahppn     : 0;
        $jumlahdiskon = $rw ? (float) $rw->jumlahdiskon  : 0;
        $keterangan   = $rw ? ($rw->deskripsi ?? $jenistransaksi) : $jenistransaksi;

        // Buat idstokfifo unik berbasis tanggal
        $prefix = date('ymd', strtotime($tgl));
        $maxId  = DB::table('stokfifo')
            ->where('idstokfifo', 'like', $prefix . '%')
            ->orderBy('idstokfifo', 'desc')
            ->value('idstokfifo');
        $counter  = $maxId ? ((int) substr($maxId, 6) + 1) : 1;
        $idstokfifo = sprintf('%s%04d', $prefix, $counter);

        $service = new StokFifoService();

        try {
            $service->barangMasuk(
                $idstokfifo,
                $idbarang,
                $idtransaksi,
                $tgl,
                $jenistransaksi,
                $jumlah,
                $hargasatuan,
                $hargadpp,
                $jumlahppn,
                $jumlahdiskon,
                $keterangan
            );

            (new AppModel())->riwayatAktifitas([
                'idbarang'       => $idbarang,
                'idtransaksi'    => $idtransaksi,
                'jenistransaksi' => $jenistransaksi,
                'jumlah'         => $jumlah,
            ], 'stokfifo', 'rekonsiliasiInsertLayerFifo');

            return response()->json(['status' => 'success', 'message' => 'Layer FIFO berhasil ditambahkan.', 'idstokfifo' => $idstokfifo]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Proses barang keluar FIFO untuk transaksi KELUAR yang hilang (dari riwayatstok).
     */
    public function keluarLayerFifo(Request $request)
    {
        $this->checkDev();

        $idbarang       = $request->input('idbarang');
        $idtransaksi    = $request->input('idtransaksi');
        $jenistransaksi = $request->input('jenistransaksi');
        $jumlah         = (float) $request->input('jumlah');

        if (empty($idbarang) || empty($idtransaksi) || empty($jenistransaksi) || $jumlah <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Parameter tidak lengkap.'], 422);
        }

        $service = new StokFifoService();

        try {
            $hasil = $service->barangKeluar($idbarang, $idtransaksi, $jenistransaksi, $jumlah);

            (new AppModel())->riwayatAktifitas([
                'idbarang'       => $idbarang,
                'idtransaksi'    => $idtransaksi,
                'jenistransaksi' => $jenistransaksi,
                'jumlah'         => $jumlah,
            ], 'stokfifo', 'rekonsiliasiKeluarLayerFifo');

            return response()->json(['status' => 'success', 'message' => 'Barang keluar FIFO berhasil diproses.', 'detail' => $hasil]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Hapus layer FIFO orphan (ada di stokfifo tapi tidak ada di riwayatstok).
     */
    public function hapusLayerFifo(Request $request)
    {
        $this->checkDev();

        $idstokfifo = $request->input('idstokfifo');

        if (empty($idstokfifo)) {
            return response()->json(['status' => 'error', 'message' => 'idstokfifo wajib diisi.'], 422);
        }

        try {
            DB::beginTransaction();

            // Hapus detail dahulu
            DB::table('stokfifodetail')->where('idstokfifo', $idstokfifo)->delete();
            DB::table('stokfifo')->where('idstokfifo', $idstokfifo)->delete();

            (new AppModel())->riwayatAktifitas(
                ['idstokfifo' => $idstokfifo],
                'stokfifo',
                'rekonsiliasiHapusLayerFifo'
            );

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Layer FIFO berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
