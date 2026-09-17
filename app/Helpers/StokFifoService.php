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
            'jumlahppn'      => $jumlahppn,
            'jumlahdiskon'   => $jumlahdiskon,
            'keterangan'     => $keterangan,
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
                $subtotal = $ambil * $layer->hargasatuan;

                // Update sisa layer
                DB::table('stokfifo')
                    ->where('idstokfifo', $layer->idstokfifo)
                    ->update([
                        'jumlahsisa' => $layer->jumlahsisa - $ambil,
                        'updated_at' => now(),
                    ]);

                // Catat detail pemakaian
                DB::table('stokfifo_detail')->insert([
                    'idstokfifo'     => $layer->idstokfifo,
                    'tglkeluar'      => now(),
                    'idtransaksi'    => $idtransaksi,
                    'jenistransaksi' => $jenistransaksi,
                    'jumlahkeluar'   => $ambil,
                    'hargasatuan'    => $layer->hargasatuan,
                    'subtotal'       => $subtotal,
                    'created_at'     => now(),
                ]);

                $hasilHPP[] = [
                    'idstokfifo'   => $layer->idstokfifo,
                    'jumlahkeluar' => $ambil,
                    'hargasatuan'  => $layer->hargasatuan,
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
}