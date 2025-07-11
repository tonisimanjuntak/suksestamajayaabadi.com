<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Akun;


class Postingjurnal extends Model
{
    use HasFactory;
    protected $table = 'v_postingjurnal';
    protected $primaryKey = 'idposting';
    protected $keyType = 'char';

    public $timestamps = false; // Menonaktifkan timestamps
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [];
    protected $hidden = [];

    var $App;

    public function __construct()
    {
        $this->App = new App;
    }

    public function sudahPosting($bulan, $tahun)
    {
        $jumlahPosting = DB::table('postingjurnal')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->count();
        if ($jumlahPosting > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function mulaiPosting($bulan, $tahun)
    {
        try {
            DB::beginTransaction();

            $akun_barang_dagang = session('akun_barang_dagang');
            $akun_pendapatan_penjualan = session('akun_pendapatan_penjualan');
            $akun_utang_ppn = session('akun_utang_ppn');
            $akun_beban_transportasi = session('akun_beban_transportasi');
            $akun_pembelian = session('akun_pembelian');

            DB::table('jurnaldetail')
                ->whereIn('idjurnal', function ($query) use ($bulan, $tahun) {
                    $query->select('idjurnal')
                        ->from('jurnal')
                        ->whereRaw("jenis <> 'Jurnal Penyesuaian' and jenis <> 'Saldo Awal'")
                        ->whereMonth('tgljurnal', $bulan)
                        ->whereYear('tgljurnal', $tahun);
                })
                ->delete();

            DB::table('jurnal')
                ->whereRaw("jenis <> 'Jurnal Penyesuaian' and jenis <> 'Saldo Awal'")
                ->whereMonth('tgljurnal', $bulan)
                ->whereYear('tgljurnal', $tahun)
                ->delete();

            //insert Posting
            $idposting = trim($bulan) . trim($tahun);
            $dataPosting = array(
                'idposting' => $idposting,
                'bulan' => trim($bulan),
                'tahun' => trim($tahun),
                'jumlahdebet' => 0,
                'jumlahkredit' => 0,
                'inserted_date' => date('Y-m-d H:i:s'),
                'idpengguna' => session('idpengguna'),
            );
            DB::table('postingjurnal')->insert($dataPosting);
            $this->App->riwayatAktifitas($dataPosting, 'postingjurnal', 'simpanData');

            $inserted_date = date('Y-m-d H:i:s');
            $updated_date = date('Y-m-d H:i:s');
            $dataJurnal = array();
            $dataJurnalDetail = array();
            $idjurnal = trim($tahun) . trim($bulan) . '000000000'; //dimulai dari nol
            $referensi_old = '';


            /*
                Penerimaan Tunai & Transfer
            */
            $rsPenerimaan = DB::table('v_penerimaandetail_laporan')
                ->whereMonth('tglpenerimaan', $bulan)
                ->whereYear('tglpenerimaan', $tahun)
                ->get();
            if (count($rsPenerimaan) > 0) {
                $urut = 1;
                foreach ($rsPenerimaan as $row) {
                    if ($referensi_old != $row->idpenerimaan) {
                        $urut = 1;
                        $idjurnal++;
                        $dataJurnal[] = array(
                            'idjurnal' => $idjurnal,
                            'tgljurnal' => $row->tglpenerimaan,
                            'keterangan' => $row->keterangan,
                            'totaldebet' => $row->totalpenerimaan,
                            'totalkredit' => $row->totalpenerimaan,
                            'referensi' => $row->idpenerimaan,
                            'jenis' => 'Penerimaan',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => session('idpengguna'),
                            'idposting' => $idposting,
                        );

                        $dataJurnalDetail[] = array(
                            'idjurnal' => $idjurnal,
                            'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : $row->kdakunbank,
                            'debet' => $row->totalpenerimaan,
                            'kredit' => 0,
                            'urut' => $urut++,
                        );
                    }

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => $row->kdakun,
                        'debet' => 0,
                        'kredit' => $row->jumlahpenerimaan,
                        'urut' => $urut++,
                    );

                    $referensi_old = $row->idpenerimaan;
                }
            }


            /*
                Penjualan
            */
            $rsPenjualan = DB::table('v_penjualan')
                ->whereMonth('tglinvoice', $bulan)
                ->whereYear('tglinvoice', $tahun)
                ->orderBy('tglinvoice', 'ASC')
                ->get();
            if (count($rsPenjualan) > 0) {
                $urut = 1;
                foreach ($rsPenjualan as $row) {


                    $urut = 1;
                    $idjurnal++;



                    $dataJurnal[] = array(
                        'idjurnal' => $idjurnal,
                        'tgljurnal' => $row->tglinvoice,
                        'keterangan' => $row->keterangan,
                        'totaldebet' => $row->totalinvoice,
                        'totalkredit' => $row->totalinvoice,
                        'referensi' => $row->idpenjualan,
                        'jenis' => 'Penjualan',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => session('idpengguna'),
                        'idposting' => $idposting,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : (($row->carabayar == 'Transfer') ? $row->kdakunbank : session('akun_piutang_usaha')),
                        'debet' => $row->totalinvoice,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    if ($row->totalppn > 0) {
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $idjurnal,
                            'kdakun' => $akun_utang_ppn,
                            'debet' => 0,
                            'kredit' => $row->totalppn,
                            'urut' => $urut++,
                        );
                    }

                    if ($row->biayapengiriman > 0) {
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $idjurnal,
                            'kdakun' => $akun_beban_transportasi,
                            'debet' => 0,
                            'kredit' => $row->biayapengiriman,
                            'urut' => $urut++,
                        );
                    }

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => $akun_pendapatan_penjualan,
                        'debet' => 0,
                        'kredit' => $row->totalinvoice - $row->totalppn - $row->biayapengiriman,
                        'urut' => $urut++,
                    );

                    $referensi_old = $row->idpenjualan;
                }
            }


            /*
                Pembayaran Piutang
            */
            $rsPiutang = DB::table('v_piutangdetail_bahanjurnal')
                ->whereMonth('tglpiutang', $bulan)
                ->whereYear('tglpiutang', $tahun)
                ->orderBy('tglpiutang', 'ASC')
                ->get();
            if (count($rsPiutang) > 0) {
                $urut = 1;
                foreach ($rsPiutang as $row) {

                    if ($referensi_old != $row->idpiutangdetail) {
                        $urut = 1;
                        $idjurnal++;
                        $dataJurnal[] = array(
                            'idjurnal' => $idjurnal,
                            'tgljurnal' => $row->tglpiutang,
                            'keterangan' => 'Pembayaran Invoice: ' . $row->noinvoice . ', Tgl Invoice: ' . tgldmy($row->tglinvoice),
                            'totaldebet' => $row->kredit,
                            'totalkredit' => $row->kredit,
                            'referensi' => $row->idpiutangdetail,
                            'jenis' => 'Piutang',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => session('idpengguna'),
                            'idposting' => $idposting,
                        );

                        $dataJurnalDetail[] = array(
                            'idjurnal' => $idjurnal,
                            'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : $row->kdakunbank,
                            'debet' => $row->kredit,
                            'kredit' => 0,
                            'urut' => $urut++,
                        );
                    }

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => session('akun_piutang_usaha'),
                        'debet' => 0,
                        'kredit' => $row->kredit,
                        'urut' => $urut++,
                    );

                    $referensi_old = $row->idpiutangdetail;
                }
            }


            /*
                Retur Penjualan
            */
            $rsRetur = DB::table('v_returpenjualan')
                ->whereMonth('tglretur', $bulan)
                ->whereYear('tglretur', $tahun)
                ->orderBy('tglretur', 'ASC')
                ->get();
            if (count($rsRetur) > 0) {
                $urut = 1;
                foreach ($rsRetur as $row) {

                    $urut = 1;
                    $idjurnal++;
                    $dataJurnal[] = array(
                        'idjurnal' => $idjurnal,
                        'tgljurnal' => $row->tglretur,
                        'keterangan' => 'Retur Penjualan No.Invoice: ' . $row->noinvoice . ', Tgl.Invoice: ' . tgldmy($row->tglinvoice),
                        'totaldebet' => $row->totalretur,
                        'totalkredit' => $row->totalretur,
                        'referensi' => $row->idreturpenjualan,
                        'jenis' => 'Retur Penjualan',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => session('idpengguna'),
                        'idposting' => $idposting,
                    );




                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => $akun_pendapatan_penjualan,
                        'debet' => $row->totalretur,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : $row->kdakunbank,
                        'debet' => 0,
                        'kredit' => $row->totalretur,
                        'urut' => $urut++,
                    );

                    $referensi_old = $row->idreturpenjualan;
                }
            }



            /*
                Pembelian
            */

            $rsPembelian = DB::table('v_pembelian')
                ->whereMonth('tglfaktur', $bulan)
                ->whereYear('tglfaktur', $tahun)
                ->orderBy('tglfaktur', 'ASC')
                ->get();
            if (count($rsPembelian) > 0) {
                $urut = 1;
                foreach ($rsPembelian as $row) {

                    $urut = 1;
                    $idjurnal++;
                    $dataJurnal[] = array(
                        'idjurnal' => $idjurnal,
                        'tgljurnal' => $row->tglfaktur,
                        'keterangan' => $row->keterangan,
                        'totaldebet' => $row->totalfaktur,
                        'totalkredit' => $row->totalfaktur,
                        'referensi' => $row->idpembelian,
                        'jenis' => 'Pembelian',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => session('idpengguna'),
                        'idposting' => $idposting,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => $akun_pembelian,
                        'debet' => $row->totalfaktur,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : (($row->carabayar == 'Transfer') ? $row->kdakunbank : session('akun_utang_usaha')),
                        'debet' => 0,
                        'kredit' => $row->totalfaktur,
                        'urut' => 99,
                    );

                    $referensi_old = $row->idpembelian;
                }
            }


            /*
                Retur Pembelian
            */
            $rsRetur = DB::table('v_returpembelian')
                ->where('statusretur', 'Selesai')
                ->whereMonth('tglretur', $bulan)
                ->whereYear('tglretur', $tahun)
                ->orderBy('tglretur', 'ASC')
                ->get();
            if (count($rsRetur) > 0) {
                $urut = 1;
                foreach ($rsRetur as $row) {

                    $urut = 1;
                    $idjurnal++;
                    $dataJurnal[] = array(
                        'idjurnal' => $idjurnal,
                        'tgljurnal' => $row->tglretur,
                        'keterangan' => 'Retur Pembelian No.Faktur: ' . $row->nofaktur . ', Tgl.Invoice: ' . tgldmy($row->tglfaktur),
                        'totaldebet' => $row->totalretur,
                        'totalkredit' => $row->totalretur,
                        'referensi' => $row->idreturpembelian,
                        'jenis' => 'Retur Pembelian',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => session('idpengguna'),
                        'idposting' => $idposting,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : $row->kdakunbank,
                        'debet' => $row->totalretur,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => $akun_pembelian,
                        'debet' => 0,
                        'kredit' => $row->totalretur,
                        'urut' => $urut++,
                    );
                    $referensi_old = $row->idreturpembelian;
                }
            }



            /*
                Utang Non Pembelian
            */
            $rsHutang = DB::table('v_hutangdetail_bahanjurnal_nonpembelian')
                ->whereMonth('tglhutang', $bulan)
                ->whereYear('tglhutang', $tahun)
                ->orderBy('tglhutang', 'ASC')
                ->get();
            if (count($rsHutang) > 0) {
                $urut = 1;
                foreach ($rsHutang as $row) {

                    if ($referensi_old != $row->idhutangdetail) {
                        $urut = 1;
                        $idjurnal++;

                        if ($row->kredit != 0) { //utang bertambah

                            $dataJurnal[] = array(
                                'idjurnal' => $idjurnal,
                                'tgljurnal' => $row->tglhutang,
                                'keterangan' => $row->keterangan,
                                'totaldebet' => $row->kredit,
                                'totalkredit' => $row->kredit,
                                'referensi' => $row->idhutangdetail,
                                'jenis' => 'Hutang',
                                'inserted_date' => $inserted_date,
                                'updated_date' => $updated_date,
                                'idpengguna' => session('idpengguna'),
                                'idposting' => $idposting,
                            );

                            $dataJurnalDetail[] = array(
                                'idjurnal' => $idjurnal,
                                'kdakun' => session('akun_kas_tunai'),
                                'debet' => $row->kredit,
                                'kredit' => 0,
                                'urut' => $urut++,
                            );

                            $dataJurnalDetail[] = array(
                                'idjurnal' => $idjurnal,
                                'kdakun' => session('akun_utang_usaha'),
                                'debet' => 0,
                                'kredit' => $row->kredit,
                                'urut' => 99,
                            );
                        } else { //pembayaran utang

                            $dataJurnal[] = array(
                                'idjurnal' => $idjurnal,
                                'tgljurnal' => $row->tglhutang,
                                'keterangan' => 'Pembayaran hutang Id : ' . $row->idhutang,
                                'totaldebet' => $row->debet,
                                'totalkredit' => $row->debet,
                                'referensi' => $row->idhutangdetail,
                                'jenis' => 'Hutang',
                                'inserted_date' => $inserted_date,
                                'updated_date' => $updated_date,
                                'idpengguna' => session('idpengguna'),
                                'idposting' => $idposting,
                            );

                            $dataJurnalDetail[] = array(
                                'idjurnal' => $idjurnal,
                                'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : $row->kdakunbank,
                                'debet' => 0,
                                'kredit' => $row->debet,
                                'urut' => 99,
                            );

                            $dataJurnalDetail[] = array(
                                'idjurnal' => $idjurnal,
                                'kdakun' => session('akun_utang_usaha'),
                                'debet' => $row->debet,
                                'kredit' => 0,
                                'urut' => $urut++,
                            );
                        }
                    }


                    $referensi_old = $row->idhutangdetail;
                }
            }


            /*
                Pembayaran Utang Pembelian
            */
            $rsHutang = DB::table('v_hutangdetail_bahanjurnal')
                ->whereMonth('tglhutang', $bulan)
                ->whereYear('tglhutang', $tahun)
                ->orderBy('tglhutang', 'ASC')
                ->get();
            if (count($rsHutang) > 0) {
                $urut = 1;
                foreach ($rsHutang as $row) {

                    if ($referensi_old != $row->idhutangdetail) {
                        $urut = 1;
                        $idjurnal++;
                        $dataJurnal[] = array(
                            'idjurnal' => $idjurnal,
                            'tgljurnal' => $row->tglhutang,
                            'keterangan' => 'Pembayaran Faktur: ' . $row->nofaktur . ', Tgl Faktur: ' . tgldmy($row->tglfaktur),
                            'totaldebet' => $row->debet,
                            'totalkredit' => $row->debet,
                            'referensi' => $row->idhutangdetail,
                            'jenis' => 'Hutang',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => session('idpengguna'),
                            'idposting' => $idposting,
                        );

                        $dataJurnalDetail[] = array(
                            'idjurnal' => $idjurnal,
                            'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : $row->kdakunbank,
                            'debet' => 0,
                            'kredit' => $row->debet,
                            'urut' => 99,
                        );
                    }

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => session('akun_utang_usaha'),
                        'debet' => $row->debet,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $referensi_old = $row->idhutangdetail;
                }
            }




            /*
                Pengeluaran Tunai & Transfer
            */
            $rsPengeluaran = DB::table('v_pengeluarandetail_bahanjurnal')
                ->whereMonth('tglpengeluaran', $bulan)
                ->whereYear('tglpengeluaran', $tahun)
                ->get();
            if (count($rsPengeluaran) > 0) {
                $urut = 1;
                foreach ($rsPengeluaran as $row) {
                    if ($referensi_old != $row->idpengeluaran) {
                        $urut = 1;
                        $idjurnal++;
                        $dataJurnal[] = array(
                            'idjurnal' => $idjurnal,
                            'tgljurnal' => $row->tglpengeluaran,
                            'keterangan' => $row->keterangan,
                            'totaldebet' => $row->totalpengeluaran,
                            'totalkredit' => $row->totalpengeluaran,
                            'referensi' => $row->idpengeluaran,
                            'jenis' => 'Pengeluaran',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => session('idpengguna'),
                            'idposting' => $idposting,
                        );

                        $dataJurnalDetail[] = array(
                            'idjurnal' => $idjurnal,
                            'kdakun' => ($row->carabayar == 'Tunai') ? session('akun_kas_tunai') : $row->kdakunbank,
                            'debet' => 0,
                            'kredit' => $row->totalpengeluaran,
                            'urut' => 99,
                        );
                    }

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $idjurnal,
                        'kdakun' => $row->kdakun,
                        'debet' => $row->jumlahpengeluaran,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $referensi_old = $row->idpengeluaran;
                }
            }

            DB::table('jurnal')->insert($dataJurnal);
            DB::table('jurnaldetail')->insert($dataJurnalDetail);


            //update total posting
            $total = DB::table('v_jurnaldetail')
                ->selectRaw('SUM(debet) as debet, SUM(kredit) as kredit')
                ->where('jenis', '<>', 'Jurnal Penyesuaian')
                ->whereMonth('tgljurnal', $bulan)
                ->whereYear('tgljurnal', $tahun)
                ->first();
            $totalDebet = (!empty($total->debet)) ? $total->debet : 0;
            $totalKredit = (!empty($total->kredit)) ? $total->kredit : 0;
            $dataPosting = array(
                'jumlahdebet' => $totalDebet,
                'jumlahkredit' => $totalKredit,
            );
            DB::table('postingjurnal')
                ->where('idposting', $idposting)
                ->update($dataPosting);

            DB::commit();

            return ['status' => 'success', 'message' => 'Data berhasil disimpan'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }


    public function hapusData($idposting, $rsPosting)
    {
        try {
            $bulan = $rsPosting->bulan;
            $tahun = $rsPosting->tahun;

            DB::table('jurnaldetail')
                ->whereIn('idjurnal', function ($query) use ($bulan, $tahun) {
                    $query->select('idjurnal')
                        ->from('jurnal')
                        ->whereMonth('tgljurnal', $bulan)
                        ->whereYear('tgljurnal', $tahun);
                })
                ->delete();

            DB::table('jurnal')
                ->whereMonth('tgljurnal', $bulan)
                ->whereYear('tgljurnal', $tahun)
                ->delete();


            DB::table('postingjurnal')
                ->where('idposting', $idposting)
                ->delete();

            $this->App->riwayatAktifitas($rsPosting, 'sales', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }
}
