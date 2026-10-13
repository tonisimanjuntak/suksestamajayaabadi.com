<?php

namespace App\Models;

use App\Models\App;
use App\Helpers\PpnHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Lapstokfifo extends Model
{
    use HasFactory;

    protected $table = 'stokfifo';
    protected $primaryKey = 'idstokfifo';
    public $incrementing = false;
    protected $keyType = 'char';
    public $timestamps = false;

    /**
     * Query data stok FIFO dengan relasi barang dan satuan
     */
    public function getStokFifoQuery($tglawal = null, $tglakhir = null, $idbarang = null)
    {
        $query = DB::table('stokfifo as sf')
            ->leftJoin('barang as b', 'sf.idbarang', '=', 'b.idbarang')
            ->leftJoin('satuan as s', 'b.idsatuan', '=', 's.idsatuan')
            ->select([
                'sf.idstokfifo',
                'sf.idtransaksi',
                'sf.tglmasuk',
                'sf.idbarang',
                'sf.jumlahmasuk',
                'sf.jumlahsisa',
                DB::raw('(sf.jumlahmasuk - sf.jumlahsisa) as jumlahterpakai'),
                'sf.hargasatuan',
                'sf.hargadpp',
                'sf.jumlahppn',
                'sf.jumlahdiskon',
                'sf.nilaihpp',
                DB::raw('(sf.jumlahsisa * sf.nilaihpp) as totalsisa'),
                'sf.keterangan',
                'sf.jenistransaksi',
                'sf.inserted_date',
                'b.kdbarang',
                'namabarang',
                's.namasatuan',
            ]);

        if (!empty($tglawal) && !empty($tglakhir)) {
            $query->whereBetween('sf.tglmasuk', [$tglawal, $tglakhir]);
        } elseif (!empty($tglawal)) {
            $query->where('sf.tglmasuk', '>=', $tglawal);
        } elseif (!empty($tglakhir)) {
            $query->where('sf.tglmasuk', '<=', $tglakhir);
        }

        if (!empty($idbarang) && $idbarang != '-') {
            $query->where('sf.idbarang', $idbarang);
        }

        return $query;
    }

    /**
     * Reset seluruh data stok FIFO dan hitung ulang dari transaksi yang ada
     */
    public function resetStokFifo()
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        try {
            DB::beginTransaction();

            $barangList = DB::table('barang')->select('idbarang', 'hargabeli', 'hpp')->get()->keyBy('idbarang');
            $events = [];

            // 1. Pembelian (Penerimaan PO yang Sudah Diterima)
            $pembelian = DB::table('pembelian')
                ->leftJoin('supplier', 'pembelian.idsupplier', '=', 'supplier.idsupplier')
                ->where('statuspenerimaan', 'Sudah Diterima')
                ->select('pembelian.*', 'supplier.namasupplier')
                ->get();

            foreach ($pembelian as $p) {
                $tgl = $p->tglfaktur ?? $p->tglditerima ?? $p->tgl_po ?? date('Y-m-d', strtotime($p->inserted_date));
                $tgl = date('Y-m-d', strtotime($tgl));
                $details = DB::table('pembeliandetail')->where('idpembelian', $p->idpembelian)->get();

                $totalSubTotalBeliDetail = $details->sum(function ($item) {
                    return (float)$item->subtotalbeli;
                });

                $totalppn = (float)$p->totalppn;
                $runningTotalPpn = 0;
                $count = count($details);

                for ($i = 0; $i < $count; $i++) {
                    $d = $details[$i];
                    $jumlahBeli = (float)$d->jumlahbeli;
                    if ($jumlahBeli <= 0) {
                        continue;
                    }

                    $subTotalBeli = (float)$d->subtotalbeli;
                    $hargaSatuan = (float)$d->hargasatuan;
                    $jumlahDiskon = (float)$d->jumlahdiskon;

                    if ($totalppn > 0) {
                        // Proporsional Per 1 Item Barang
                        $rasioProporsi = ($totalSubTotalBeliDetail > 0) ? ($subTotalBeli / $totalSubTotalBeliDetail) : 0;

                        // Jika item terakhir, gunakan sisa PPN untuk hindari selisih pembulatan
                        if ($i == $count - 1) {
                            $jumlahPpnItem = $totalppn - $runningTotalPpn;
                        } else {
                            $jumlahPpnItem = PpnHelper::roundPPN($rasioProporsi * $totalppn);
                            $runningTotalPpn += $jumlahPpnItem;
                        }

                        $jumlahPpnSatuan = ($jumlahBeli > 0) ? PpnHelper::roundPPN($jumlahPpnItem / $jumlahBeli) : 0;
                        $hargaDppSatuan = $hargaSatuan - $jumlahDiskon - $jumlahPpnSatuan;
                    } else {
                        $jumlahPpnSatuan = 0;
                        $hargaDppSatuan = $hargaSatuan - $jumlahDiskon;
                    }

                    // Sinkronkan ke pembeliandetail jika nilai di database masih kosong/0
                    if ((float)$d->hargadpp == 0 && (float)$d->jumlahppn == 0) {
                        DB::table('pembeliandetail')
                            ->where('id', $d->id)
                            ->update([
                                'hargadpp'  => $hargaDppSatuan,
                                'jumlahppn' => $jumlahPpnSatuan,
                            ]);
                    }

                    // Nilai HPP FIFO menggunakan DPP setelah diskon & PPN
                    $hpp = $hargaDppSatuan > 0 ? $hargaDppSatuan : $hargaSatuan;

                    $events[] = [
                        'tanggal'        => $tgl,
                        'tipe'           => 'MASUK',
                        'jenistransaksi' => 'Pembelian',
                        'idtransaksi'    => $p->idpembelian,
                        'idbarang'       => $d->idbarang,
                        'jumlah'         => $jumlahBeli,
                        'hargasatuan'    => $hargaSatuan,
                        'hargadpp'       => $hargaDppSatuan,
                        'jumlahppn'      => $jumlahPpnSatuan,
                        'jumlahdiskon'   => $jumlahDiskon,
                        'nilaihpp'       => $hpp,
                        'keterangan'     => 'Penerimaan PO dengan No Faktur ' . ($p->nofaktur ?? '-') . ' dan nama supplier ' . ($p->namasupplier ?? '-'),
                    ];
                }
            }

            // 2. Retur Penjualan (Barang Masuk)
            $returjual = DB::table('returpenjualan')->get();
            foreach ($returjual as $rj) {
                $tgl = date('Y-m-d', strtotime($rj->tglretur));
                $details = DB::table('returpenjualandetail')->where('idreturpenjualan', $rj->idreturpenjualan)->get();

                foreach ($details as $d) {
                    if ((float)$d->jumlahretur <= 0) {
                        continue;
                    }
                    $events[] = [
                        'tanggal'        => $tgl,
                        'tipe'           => 'MASUK',
                        'jenistransaksi' => 'Retur Penjualan',
                        'idtransaksi'    => $rj->idreturpenjualan,
                        'idbarang'       => $d->idbarang,
                        'jumlah'         => (float)$d->jumlahretur,
                        'hargasatuan'    => (float)$d->hargaretur,
                        'hargadpp'       => 0,
                        'jumlahppn'      => 0,
                        'jumlahdiskon'   => 0,
                        'nilaihpp'       => (float)$d->hargaretur,
                        'keterangan'     => 'Retur Penjualan ' . $rj->idreturpenjualan,
                    ];
                }
            }

            // 3. Stock Opname (Surplus Masuk, Defisit Keluar, Stok Awal Masuk)
            $stockopname = DB::table('stockopname')->orderBy('tglstockopname')->get();
            foreach ($stockopname as $so) {
                $tgl = date('Y-m-d', strtotime($so->tglstockopname));
                $isStokAwal = ($so->idstockopname === '260305SO0000001' || stripos($so->keterangan, 'Stok Awal') !== false);
                $details = DB::table('stockopnamedetail')->where('idstockopname', $so->idstockopname)->get();

                foreach ($details as $d) {
                    if ($isStokAwal) {
                        if ((float)$d->stockopname > 0) {
                            $b = $barangList->get($d->idbarang);
                            $hpp = $b ? ((float)$b->hpp > 0 ? (float)$b->hpp : (float)$b->hargabeli) : 0;
                            $events[] = [
                                'tanggal'        => $tgl,
                                'tipe'           => 'MASUK',
                                'jenistransaksi' => 'Stok Opname',
                                'idtransaksi'    => $so->idstockopname,
                                'idbarang'       => $d->idbarang,
                                'jumlah'         => (float)$d->stockopname,
                                'hargasatuan'    => $hpp,
                                'hargadpp'       => 0,
                                'jumlahppn'      => 0,
                                'jumlahdiskon'   => 0,
                                'nilaihpp'       => $hpp,
                                'keterangan'     => 'Stok Awal (Stock Opname) ' . $so->idstockopname,
                            ];
                        }
                    } else {
                        $selisih = (float)$d->stockopname - (float)$d->stocksystem;
                        if ($selisih > 0) {
                            $b = $barangList->get($d->idbarang);
                            $hpp = $b ? ((float)$b->hpp > 0 ? (float)$b->hpp : (float)$b->hargabeli) : 0;
                            $events[] = [
                                'tanggal'        => $tgl,
                                'tipe'           => 'MASUK',
                                'jenistransaksi' => 'Stok Opname',
                                'idtransaksi'    => $so->idstockopname,
                                'idbarang'       => $d->idbarang,
                                'jumlah'         => $selisih,
                                'hargasatuan'    => $hpp,
                                'hargadpp'       => 0,
                                'jumlahppn'      => 0,
                                'jumlahdiskon'   => 0,
                                'nilaihpp'       => $hpp,
                                'keterangan'     => 'Stok Opname (Surplus) ' . $so->idstockopname,
                            ];
                        } elseif ($selisih < 0) {
                            $events[] = [
                                'tanggal'        => $tgl,
                                'tipe'           => 'KELUAR',
                                'jenistransaksi' => 'Stok Opname',
                                'idtransaksi'    => $so->idstockopname,
                                'idbarang'       => $d->idbarang,
                                'jumlah'         => abs($selisih),
                                'hargasatuan'    => 0,
                                'hargadpp'       => 0,
                                'jumlahppn'      => 0,
                                'jumlahdiskon'   => 0,
                                'nilaihpp'       => 0,
                                'keterangan'     => 'Stok Opname (Defisit) ' . $so->idstockopname,
                            ];
                        }
                    }
                }
            }

            // 4. Surat Jalan (Penjualan Keluar)
            $suratjalan = DB::table('suratjalan')->get();
            foreach ($suratjalan as $sj) {
                $tgl = date('Y-m-d', strtotime($sj->tglsuratjalan));
                $details = DB::table('suratjalandetail')
                    ->join('penjualandetail', 'suratjalandetail.idpenjualan', '=', 'penjualandetail.idpenjualan')
                    ->where('suratjalandetail.idsuratjalan', $sj->idsuratjalan)
                    ->select('penjualandetail.idbarang', 'penjualandetail.jumlahjual')
                    ->get();

                foreach ($details as $d) {
                    if ((float)$d->jumlahjual <= 0) {
                        continue;
                    }
                    $events[] = [
                        'tanggal'        => $tgl,
                        'tipe'           => 'KELUAR',
                        'jenistransaksi' => 'Penjualan',
                        'idtransaksi'    => $sj->idsuratjalan,
                        'idbarang'       => $d->idbarang,
                        'jumlah'         => (float)$d->jumlahjual,
                        'hargasatuan'    => 0,
                        'hargadpp'       => 0,
                        'jumlahppn'      => 0,
                        'jumlahdiskon'   => 0,
                        'nilaihpp'       => 0,
                        'keterangan'     => 'Surat Jalan ' . $sj->idsuratjalan,
                    ];
                }
            }

            // 5. Retur Pembelian (Barang Keluar)
            $returbeli = DB::table('returpembelian')->get();
            foreach ($returbeli as $rb) {
                $tgl = date('Y-m-d', strtotime($rb->tglretur ?? $rb->tglpengajuan));
                $details = DB::table('returpembeliandetail')->where('idreturpembelian', $rb->idreturpembelian)->get();

                foreach ($details as $d) {
                    if ((float)$d->jumlahretur <= 0) {
                        continue;
                    }
                    $events[] = [
                        'tanggal'        => $tgl,
                        'tipe'           => 'KELUAR',
                        'jenistransaksi' => 'Retur Pembelian',
                        'idtransaksi'    => $rb->idreturpembelian,
                        'idbarang'       => $d->idbarang,
                        'jumlah'         => (float)$d->jumlahretur,
                        'hargasatuan'    => 0,
                        'hargadpp'       => 0,
                        'jumlahppn'      => 0,
                        'jumlahdiskon'   => 0,
                        'nilaihpp'       => 0,
                        'keterangan'     => 'Retur Pembelian ' . $rb->idreturpembelian,
                    ];
                }
            }

            // 6. Konversi Stok (Asal Keluar, Tujuan Masuk)
            $konversi = DB::table('konversistok')->get();
            foreach ($konversi as $ks) {
                $tgl = date('Y-m-d', strtotime($ks->tglkonversi));
                if ((float)$ks->jlhbarangasal > 0) {
                    $events[] = [
                        'tanggal'          => $tgl,
                        'tipe'             => 'KELUAR',
                        'jenistransaksi'   => 'Konversi Stok',
                        'idtransaksi'      => $ks->idkonversi,
                        'idbarang'         => $ks->idbarangasal,
                        'jumlah'           => (float)$ks->jlhbarangasal,
                        'hargasatuan'      => 0,
                        'hargadpp'         => 0,
                        'jumlahppn'        => 0,
                        'jumlahdiskon'     => 0,
                        'nilaihpp'         => 0,
                        'keterangan'       => 'Konversi Stok Asal ' . $ks->idkonversi,
                        'is_konversi_asal' => true,
                        'konversi_obj'     => $ks,
                    ];
                }
            }

            // Urutkan berdasarkan tanggal transaksi
            usort($events, function ($a, $b) {
                $cmp = strcmp($a['tanggal'], $b['tanggal']);
                if ($cmp !== 0) {
                    return $cmp;
                }

                if ($a['tipe'] === 'MASUK' && $b['tipe'] === 'KELUAR') {
                    return -1;
                }
                if ($a['tipe'] === 'KELUAR' && $b['tipe'] === 'MASUK') {
                    return 1;
                }

                return strcmp($a['idtransaksi'], $b['idtransaksi']);
            });

            // Generator ID FIFO per tanggal prefix (YYMMDD + 4 digit counter)
            $idCounters = [];
            $generateId = function ($tgl) use (&$idCounters) {
                $prefix = date('ymd', strtotime($tgl));
                if (!isset($idCounters[$prefix])) {
                    $idCounters[$prefix] = 1;
                } else {
                    $idCounters[$prefix]++;
                }
                return sprintf('%s%04d', $prefix, $idCounters[$prefix]);
            };

            $stokFifoInserts = [];
            $stokFifoDetailInserts = [];
            $activeLayers = [];

            foreach ($events as $ev) {
                $idbarang = $ev['idbarang'];

                if ($ev['tipe'] === 'MASUK') {
                    $idstokfifo = $generateId($ev['tanggal']);
                    $layer = [
                        'idstokfifo'     => $idstokfifo,
                        'idtransaksi'    => $ev['idtransaksi'],
                        'tglmasuk'       => $ev['tanggal'],
                        'idbarang'       => $idbarang,
                        'jumlahmasuk'    => $ev['jumlah'],
                        'jumlahsisa'     => $ev['jumlah'],
                        'hargasatuan'    => $ev['hargasatuan'],
                        'hargadpp'       => $ev['hargadpp'],
                        'jumlahppn'      => $ev['jumlahppn'],
                        'jumlahdiskon'   => $ev['jumlahdiskon'],
                        'nilaihpp'       => $ev['nilaihpp'],
                        'keterangan'     => $ev['keterangan'],
                        'jenistransaksi' => $ev['jenistransaksi'],
                        'inserted_date'  => now(),
                        'updated_date'   => now(),
                    ];
                    $stokFifoInserts[$idstokfifo] = $layer;
                    $activeLayers[$idbarang][] = [
                        'idstokfifo' => $idstokfifo,
                        'jumlahsisa' => $ev['jumlah'],
                        'nilaihpp'   => $ev['nilaihpp'],
                        'tglmasuk'   => $ev['tanggal'],
                    ];
                } else {
                    // KELUAR
                    $sisaKebutuhan = $ev['jumlah'];
                    $totalKeluarCost = 0;

                    if (isset($activeLayers[$idbarang])) {
                        foreach ($activeLayers[$idbarang] as &$layerRef) {
                            if ($sisaKebutuhan <= 0) {
                                break;
                            }
                            if ($layerRef['jumlahsisa'] <= 0) {
                                continue;
                            }

                            $ambil = min($layerRef['jumlahsisa'], $sisaKebutuhan);
                            $subtotal = $ambil * $layerRef['nilaihpp'];
                            $totalKeluarCost += $subtotal;

                            $layerRef['jumlahsisa'] -= $ambil;
                            $stokFifoInserts[$layerRef['idstokfifo']]['jumlahsisa'] -= $ambil;

                            $stokFifoDetailInserts[] = [
                                'idstokfifo'     => $layerRef['idstokfifo'],
                                'tglkeluar'      => $ev['tanggal'],
                                'idtransaksi'    => $ev['idtransaksi'],
                                'jenistransaksi' => $ev['jenistransaksi'],
                                'jumlahkeluar'   => $ambil,
                                'hargasatuan'    => $layerRef['nilaihpp'],
                                'subtotal'       => $subtotal,
                                'inserted_date'  => now(),
                            ];

                            $sisaKebutuhan -= $ambil;
                        }
                        unset($layerRef);
                    }

                    // Jika stok layer habis / kurang dari kebutuhan keluar, buat penyesuaian otomatis
                    if ($sisaKebutuhan > 0) {
                        $b = $barangList->get($idbarang);
                        $fallbackHpp = $b ? ((float)$b->hpp > 0 ? (float)$b->hpp : (float)$b->hargabeli) : 0;
                        $adjId = $generateId($ev['tanggal']);

                        $adjLayer = [
                            'idstokfifo'     => $adjId,
                            'idtransaksi'    => $ev['idtransaksi'],
                            'tglmasuk'       => $ev['tanggal'],
                            'idbarang'       => $idbarang,
                            'jumlahmasuk'    => $sisaKebutuhan,
                            'jumlahsisa'     => 0,
                            'hargasatuan'    => $fallbackHpp,
                            'hargadpp'       => 0,
                            'jumlahppn'      => 0,
                            'jumlahdiskon'   => 0,
                            'nilaihpp'       => $fallbackHpp,
                            'keterangan'     => 'Penyesuaian Stok FIFO (Sistem)',
                            'jenistransaksi' => 'Stok Opname',
                            'inserted_date'  => now(),
                            'updated_date'   => now(),
                        ];
                        $stokFifoInserts[$adjId] = $adjLayer;

                        $subtotal = $sisaKebutuhan * $fallbackHpp;
                        $totalKeluarCost += $subtotal;

                        $stokFifoDetailInserts[] = [
                            'idstokfifo'     => $adjId,
                            'tglkeluar'      => $ev['tanggal'],
                            'idtransaksi'    => $ev['idtransaksi'],
                            'jenistransaksi' => $ev['jenistransaksi'],
                            'jumlahkeluar'   => $sisaKebutuhan,
                            'hargasatuan'    => $fallbackHpp,
                            'subtotal'       => $subtotal,
                            'inserted_date'  => now(),
                        ];
                    }

                    // Jika ini konversi stok barang asal, masukkan layer baru ke barang tujuan
                    if (!empty($ev['is_konversi_asal'])) {
                        $ks = $ev['konversi_obj'];
                        $hppTujuan = (float)$ks->jlhbarangtujuan > 0 ? ($totalKeluarCost / (float)$ks->jlhbarangtujuan) : 0;
                        $idstokfifoTujuan = $generateId($ks->tglkonversi);

                        $tujuanLayer = [
                            'idstokfifo'     => $idstokfifoTujuan,
                            'idtransaksi'    => $ks->idkonversi,
                            'tglmasuk'       => $ks->tglkonversi,
                            'idbarang'       => $ks->idbarangtujuan,
                            'jumlahmasuk'    => (float)$ks->jlhbarangtujuan,
                            'jumlahsisa'     => (float)$ks->jlhbarangtujuan,
                            'hargasatuan'    => $hppTujuan,
                            'hargadpp'       => 0,
                            'jumlahppn'      => 0,
                            'jumlahdiskon'   => 0,
                            'nilaihpp'       => $hppTujuan,
                            'keterangan'     => 'Konversi Stok Barang ' . $ks->idkonversi,
                            'jenistransaksi' => 'Konversi Stok',
                            'inserted_date'  => now(),
                            'updated_date'   => now(),
                        ];
                        $stokFifoInserts[$idstokfifoTujuan] = $tujuanLayer;
                        $activeLayers[$ks->idbarangtujuan][] = [
                            'idstokfifo' => $idstokfifoTujuan,
                            'jumlahsisa' => (float)$ks->jlhbarangtujuan,
                            'nilaihpp'   => $hppTujuan,
                            'tglmasuk'   => $ks->tglkonversi,
                        ];
                    }
                }
            }

            // Hapus isi tabel stokfifodetail lalu stokfifo
            DB::table('stokfifodetail')->delete();
            DB::table('stokfifo')->delete();

            // Insert ulang stokfifo (chunk 500)
            $chunksFifo = array_chunk(array_values($stokFifoInserts), 500);
            foreach ($chunksFifo as $chunk) {
                DB::table('stokfifo')->insert($chunk);
            }

            // Insert ulang stokfifodetail (chunk 500)
            $chunksDetail = array_chunk($stokFifoDetailInserts, 500);
            foreach ($chunksDetail as $chunk) {
                DB::table('stokfifodetail')->insert($chunk);
            }

            // Catat riwayat aktifitas
            (new App)->riwayatAktifitas([
                'jumlah_stokfifo'       => count($stokFifoInserts),
                'jumlah_stokfifodetail' => count($stokFifoDetailInserts),
                'pesan'                 => 'Reset stok FIFO berhasil'
            ], 'stokfifo', 'resetStokFifo');

            DB::commit();

            return [
                'status'  => 'success',
                'message' => 'Reset stok FIFO berhasil. ' . count($stokFifoInserts) . ' data stok FIFO dan ' . count($stokFifoDetailInserts) . ' detail transaksi berhasil dihitung ulang.'
            ];

        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Query error: ' . $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }
}
