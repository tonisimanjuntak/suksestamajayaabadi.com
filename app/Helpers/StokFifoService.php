<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class StokFifoService
{
    /**
     * Simpan barang masuk sebagai layer baru
     */
    public function barangMasuk($idstokfifo, $idbarang, $idtransaksi, $tgltransaksi, $jenistransaksi, $jumlah, $hargasatuan, $hargadpp = 0, $jumlahppn = 0, $jumlahdiskon = 0, $keterangan = null)
    {
        // nilaihpp = hargadpp (cost after discount & PPN)
        $nilaihpp = $hargadpp;
        $arrData = [
            'idstokfifo'     => $idstokfifo,
            'idbarang'       => $idbarang,
            'tglmasuk'       => $tgltransaksi,
            'idtransaksi'    => $idtransaksi,
            'jenistransaksi' => $jenistransaksi,
            'jumlahmasuk'    => $jumlah,
            'jumlahsisa'     => $jumlah,
            'hargasatuan'    => $hargasatuan,
            'hargadpp'       => $hargadpp,
            'nilaihpp'       => $nilaihpp,
            'jumlahppn'      => $jumlahppn,
            'jumlahdiskon'   => $jumlahdiskon,
            'keterangan'     => $keterangan,
            'inserted_date'  => now(),
            'updated_date'   => now(),
        ];

        return DB::table('stokfifo')
            ->insert($arrData);
    }

    /**
     * Proses barang keluar dengan FIFO
     * @return array HPP detail [{idstokfifo, jumlahkeluar, hargasatuan, subtotal}]
     */
    public function barangKeluar($idbarang, $idtransaksi, $jenistransaksi, $jumlahKeluar)
    {
        $sisaKebutuhan = $jumlahKeluar;
        $hasilHPP = [];

        DB::transaction(function () use (
            $idbarang,
            $idtransaksi,
            $jenistransaksi,
            $jumlahKeluar,
            &$sisaKebutuhan,
            &$hasilHPP
        ) {
            // Ambil layer FIFO yang masih memiliki sisa, urut berdasarkan tglmasuk
            $layers = DB::table('stokfifo')
                ->where('idbarang', $idbarang)
                ->where('jumlahsisa', '>', 0)
                ->orderBy('tglmasuk', 'asc')
                ->orderBy('idstokfifo', 'asc')
                ->lockForUpdate()
                ->get();

            foreach ($layers as $layer) {
                if ($sisaKebutuhan <= 0) {
                    break;
                }

                $ambil    = min($layer->jumlahsisa, $sisaKebutuhan);
                $subtotal = $ambil * $layer->nilaihpp;

                // Update sisa layer
                DB::table('stokfifo')
                    ->where('idstokfifo', $layer->idstokfifo)
                    ->update([
                        'jumlahsisa'   => $layer->jumlahsisa - $ambil,
                        'updated_date' => now(),
                    ]);

                // Catat detail pemakaian
                DB::table('stokfifodetail')->insert([
                    'idstokfifo'     => $layer->idstokfifo,
                    'tglkeluar'      => now(),
                    'idtransaksi'    => $idtransaksi,
                    'jenistransaksi' => $jenistransaksi,
                    'jumlahkeluar'   => $ambil,
                    'hargasatuan'    => $layer->nilaihpp,
                    'subtotal'       => $subtotal,
                    'inserted_date'  => now(),
                ]);

                $hasilHPP[] = [
                    'idstokfifo'   => $layer->idstokfifo,
                    'jumlahkeluar' => $ambil,
                    'hargasatuan'  => $layer->nilaihpp,
                    'subtotal'     => $subtotal,
                ];

                $sisaKebutuhan -= $ambil;
            }

            if ($sisaKebutuhan > 0) {
                throw new \Exception("Stok tidak cukup! Kurang {$sisaKebutuhan} unit untuk barang {$idbarang}.");
            }
        });

        return $hasilHPP;
    }

    /**
     * Batalkan/hapus barang keluar (mengembalikan jumlahsisa ke layer fifo)
     */
    public function batalBarangKeluar($idtransaksi, $jenistransaksi)
    {
        $details = DB::table('stokfifodetail')
            ->where('idtransaksi', $idtransaksi)
            ->where('jenistransaksi', $jenistransaksi)
            ->get();

        foreach ($details as $detail) {
            // Kembalikan jumlahsisa ke stokfifo
            $layer = DB::table('stokfifo')->where('idstokfifo', $detail->idstokfifo)->first();
            if ($layer) {
                DB::table('stokfifo')
                    ->where('idstokfifo', $detail->idstokfifo)
                    ->update([
                        'jumlahsisa'   => $layer->jumlahsisa + $detail->jumlahkeluar,
                        'updated_date' => now(),
                    ]);
            }
        }

        DB::table('stokfifodetail')
            ->where('idtransaksi', $idtransaksi)
            ->where('jenistransaksi', $jenistransaksi)
            ->delete();
    }

    /**
     * Hapus barang masuk (layer fifo) jika belum terpakai
     */
    public function hapusBarangMasuk($idtransaksi, $jenistransaksi)
    {
        $layers = DB::table('stokfifo')
            ->where('idtransaksi', $idtransaksi)
            ->where('jenistransaksi', $jenistransaksi)
            ->get();

        foreach ($layers as $layer) {
            $cekKeluar = DB::table('stokfifodetail')
                ->where('idstokfifo', $layer->idstokfifo)
                ->count();

            if ($cekKeluar > 0 || $layer->jumlahsisa < $layer->jumlahmasuk) {
                throw new \Exception("Data tidak dapat dihapus karena stok dari transaksi ini sudah ada yang keluar/terpakai!");
            }

            DB::table('stokfifo')
                ->where('idstokfifo', $layer->idstokfifo)
                ->delete();
        }
    }
}