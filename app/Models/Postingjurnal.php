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
    protected $akunSettings = [];

    public function __construct()
    {
        $this->App = new App;
    }

    public function getKodeAkun($prefix, $default = null)
    {
        if (empty($this->akunSettings)) {
            $settings = DB::table('settings')->where('prefix', 'like', 'akun_%')->get();
            foreach ($settings as $s) {
                $this->akunSettings[$s->prefix] = $s->values;
            }
        }

        if (session()->has($prefix) && !empty(session($prefix))) {
            return session($prefix);
        }

        if (isset($this->akunSettings[$prefix]) && !empty($this->akunSettings[$prefix])) {
            return $this->akunSettings[$prefix];
        }

        return $default;
    }

    protected function getAkunKasBank($carabayar, $kdakunbank, $akunKasTunai, $akunDefaultNonKas = null)
    {
        if ($carabayar === 'Tunai') {
            return $akunKasTunai;
        }
        if (!empty($kdakunbank)) {
            return $kdakunbank;
        }
        if (!empty($akunDefaultNonKas)) {
            return $akunDefaultNonKas;
        }
        return $akunKasTunai;
    }

    public function sudahPosting($bulan, $tahun)
    {
        $bulan = sprintf("%02d", (int)$bulan);
        $tahun = sprintf("%04d", (int)$tahun);

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

            $bulan = sprintf("%02d", (int)$bulan);
            $tahun = sprintf("%04d", (int)$tahun);
            $idposting = $bulan . $tahun;

            $akun_kas_tunai = $this->getKodeAkun('akun_kas_tunai', '1.1.01.01');
            $akun_piutang_usaha = $this->getKodeAkun('akun_piutang_usaha', '1.1.03.01');
            $akun_ppn_masukan = $this->getKodeAkun('akun_ppn_masukan', '1.1.04.01');
            $akun_utang_ppn = $this->getKodeAkun('akun_utang_ppn', '2.2.01.02');
            $akun_utang_usaha = $this->getKodeAkun('akun_utang_usaha', '2.2.01.01');
            $akun_pendapatan_penjualan = $this->getKodeAkun('akun_pendapatan_penjualan', '4.1.01.01');
            $akun_retur_penjualan = $this->getKodeAkun('akun_retur_penjualan', '4.1.02.01');
            $akun_beban_transportasi = $this->getKodeAkun('akun_beban_transportasi', '5.4.01.01');
            $akun_pembelian = $this->getKodeAkun('akun_pembelian', '6.1.01.01');
            $akun_retur_pembelian = $this->getKodeAkun('akun_retur_pembelian', '6.1.01.02');

            DB::table('jurnaldetail')
                ->whereIn('idjurnal', function ($query) use ($idposting, $bulan, $tahun) {
                    $query->select('idjurnal')
                        ->from('jurnal')
                        ->where('idposting', $idposting)
                        ->orWhere(function ($q) use ($bulan, $tahun) {
                            $q->whereMonth('tgljurnal', $bulan)
                                ->whereYear('tgljurnal', $tahun)
                                ->whereRaw("jenis <> 'Jurnal Penyesuaian' and jenis <> 'Saldo Awal'");
                        });
                })
                ->delete();

            DB::table('jurnal')
                ->where('idposting', $idposting)
                ->orWhere(function ($q) use ($bulan, $tahun) {
                    $q->whereMonth('tgljurnal', $bulan)
                        ->whereYear('tgljurnal', $tahun)
                        ->whereRaw("jenis <> 'Jurnal Penyesuaian' and jenis <> 'Saldo Awal'");
                })
                ->delete();

            DB::table('postingjurnal')
                ->where('idposting', $idposting)
                ->delete();

            $idpengguna = session('idpengguna');
            if (empty($idpengguna)) {
                $idpengguna = DB::table('pengguna')->value('idpengguna') ?? 'USRASO0001';
            }

            //insert Posting
            $dataPosting = array(
                'idposting' => $idposting,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'jumlahdebet' => 0,
                'jumlahkredit' => 0,
                'inserted_date' => date('Y-m-d H:i:s'),
                'idpengguna' => $idpengguna,
            );
            DB::table('postingjurnal')->insert($dataPosting);
            $this->App->riwayatAktifitas($dataPosting, 'postingjurnal', 'simpanData');

            $inserted_date = date('Y-m-d H:i:s');
            $updated_date = date('Y-m-d H:i:s');
            $dataJurnal = array();
            $dataJurnalDetail = array();

            $maxId = DB::table('jurnal')
                ->where('idjurnal', 'like', $tahun . $bulan . '%')
                ->max('idjurnal');
            $counterJurnal = 0;
            if ($maxId && strlen($maxId) == 15) {
                $counterJurnal = (int)substr($maxId, 6);
            }
            $referensi_old = '';


            /*
                Penerimaan Tunai & Transfer
            */
            $rsPenerimaan = DB::table('v_penerimaandetail_laporan')
                ->whereMonth('tglpenerimaan', $bulan)
                ->whereYear('tglpenerimaan', $tahun)
                ->orderBy('tglpenerimaan', 'ASC')
                ->orderBy('idpenerimaan', 'ASC')
                ->get();
            if (count($rsPenerimaan) > 0) {
                $urut = 1;
                $currentIdJurnal = '';
                foreach ($rsPenerimaan as $row) {
                    if ($referensi_old != $row->idpenerimaan) {
                        $urut = 1;
                        $counterJurnal++;
                        $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);
                        $dataJurnal[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'tgljurnal' => $row->tglpenerimaan,
                            'keterangan' => $row->keterangan ?? 'Penerimaan Kas/Bank',
                            'totaldebet' => $row->totalpenerimaan,
                            'totalkredit' => $row->totalpenerimaan,
                            'referensi' => $row->idpenerimaan,
                            'jenis' => 'Penerimaan',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => $idpengguna,
                            'idposting' => $idposting,
                        );

                        $akunKasBank = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai);
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akunKasBank,
                            'debet' => $row->totalpenerimaan,
                            'kredit' => 0,
                            'urut' => $urut++,
                        );
                    }

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => !empty($row->kdakun) ? $row->kdakun : $akun_kas_tunai,
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
                ->orderBy('idpenjualan', 'ASC')
                ->get();
            if (count($rsPenjualan) > 0) {
                foreach ($rsPenjualan as $row) {
                    $urut = 1;
                    $counterJurnal++;
                    $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);

                    $dataJurnal[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'tgljurnal' => $row->tglinvoice,
                        'keterangan' => !empty($row->keterangan) ? $row->keterangan : ('Penjualan No Invoice: ' . $row->noinvoice),
                        'totaldebet' => $row->totalinvoice,
                        'totalkredit' => $row->totalinvoice,
                        'referensi' => $row->idpenjualan,
                        'jenis' => 'Penjualan',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => $idpengguna,
                        'idposting' => $idposting,
                    );

                    $akunDebetPenjualan = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai, $akun_piutang_usaha);
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akunDebetPenjualan,
                        'debet' => $row->totalinvoice,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    if ($row->totalppn > 0) {
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akun_utang_ppn,
                            'debet' => 0,
                            'kredit' => $row->totalppn,
                            'urut' => $urut++,
                        );
                    }

                    if ($row->biayapengiriman > 0) {
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akun_beban_transportasi,
                            'debet' => 0,
                            'kredit' => $row->biayapengiriman,
                            'urut' => $urut++,
                        );
                    }

                    $pendapatanNetto = $row->totalinvoice - $row->totalppn - $row->biayapengiriman;
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akun_pendapatan_penjualan,
                        'debet' => 0,
                        'kredit' => $pendapatanNetto,
                        'urut' => $urut++,
                    );
                }
            }


            /*
                Pembayaran Piutang
            */
            $rsPiutang = DB::table('v_piutangdetail_bahanjurnal')
                ->whereMonth('tglpiutang', $bulan)
                ->whereYear('tglpiutang', $tahun)
                ->orderBy('tglpiutang', 'ASC')
                ->orderBy('idpiutangdetail', 'ASC')
                ->get();
            if (count($rsPiutang) > 0) {
                foreach ($rsPiutang as $row) {
                    $urut = 1;
                    $counterJurnal++;
                    $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);

                    $dataJurnal[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'tgljurnal' => $row->tglpiutang,
                        'keterangan' => 'Pembayaran Invoice: ' . $row->noinvoice . ', Tgl Invoice: ' . tgldmy($row->tglinvoice),
                        'totaldebet' => $row->kredit,
                        'totalkredit' => $row->kredit,
                        'referensi' => $row->idpiutangdetail,
                        'jenis' => 'Piutang',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => $idpengguna,
                        'idposting' => $idposting,
                    );

                    $akunKasBank = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai);
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akunKasBank,
                        'debet' => $row->kredit,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akun_piutang_usaha,
                        'debet' => 0,
                        'kredit' => $row->kredit,
                        'urut' => $urut++,
                    );
                }
            }


            /*
                Retur Penjualan
            */
            $rsReturPenjualan = DB::table('v_returpenjualan')
                ->whereMonth('tglretur', $bulan)
                ->whereYear('tglretur', $tahun)
                ->orderBy('tglretur', 'ASC')
                ->orderBy('idreturpenjualan', 'ASC')
                ->get();
            if (count($rsReturPenjualan) > 0) {
                foreach ($rsReturPenjualan as $row) {
                    $urut = 1;
                    $counterJurnal++;
                    $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);

                    $dataJurnal[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'tgljurnal' => $row->tglretur,
                        'keterangan' => 'Retur Penjualan No.Invoice: ' . $row->noinvoice . ', Tgl.Invoice: ' . tgldmy($row->tglinvoice),
                        'totaldebet' => $row->totalretur,
                        'totalkredit' => $row->totalretur,
                        'referensi' => $row->idreturpenjualan,
                        'jenis' => 'Retur Penjualan',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => $idpengguna,
                        'idposting' => $idposting,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akun_retur_penjualan,
                        'debet' => $row->totalretur,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $akunKreditRetur = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai, $akun_piutang_usaha);
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akunKreditRetur,
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
                ->orderBy('idpembelian', 'ASC')
                ->get();
            if (count($rsPembelian) > 0) {
                foreach ($rsPembelian as $row) {
                    $urut = 1;
                    $counterJurnal++;
                    $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);

                    $dataJurnal[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'tgljurnal' => $row->tglfaktur,
                        'keterangan' => !empty($row->keterangan) ? $row->keterangan : ('Pembelian No Faktur: ' . $row->nofaktur),
                        'totaldebet' => $row->totalfaktur,
                        'totalkredit' => $row->totalfaktur,
                        'referensi' => $row->idpembelian,
                        'jenis' => 'Pembelian',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => $idpengguna,
                        'idposting' => $idposting,
                    );

                    $pembelianDpp = $row->totalfaktur - $row->totalppn - $row->biayapengiriman;
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akun_pembelian,
                        'debet' => $pembelianDpp,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    if ($row->totalppn > 0) {
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akun_ppn_masukan,
                            'debet' => $row->totalppn,
                            'kredit' => 0,
                            'urut' => $urut++,
                        );
                    }

                    if ($row->biayapengiriman > 0) {
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akun_beban_transportasi,
                            'debet' => $row->biayapengiriman,
                            'kredit' => 0,
                            'urut' => $urut++,
                        );
                    }

                    $akunKreditPembelian = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai, $akun_utang_usaha);
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akunKreditPembelian,
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
                ->orderBy('idreturpembelian', 'ASC')
                ->get();
            if (count($rsRetur) > 0) {
                foreach ($rsRetur as $row) {
                    $urut = 1;
                    $counterJurnal++;
                    $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);

                    $dataJurnal[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'tgljurnal' => $row->tglretur,
                        'keterangan' => 'Retur Pembelian No.Faktur: ' . $row->nofaktur . ', Tgl.Invoice: ' . tgldmy($row->tglfaktur),
                        'totaldebet' => $row->totalretur,
                        'totalkredit' => $row->totalretur,
                        'referensi' => $row->idreturpembelian,
                        'jenis' => 'Retur Pembelian',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => $idpengguna,
                        'idposting' => $idposting,
                    );

                    $akunDebetReturBeli = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai, $akun_utang_usaha);
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akunDebetReturBeli,
                        'debet' => $row->totalretur,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akun_retur_pembelian,
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
            $rsHutangNonPembelian = DB::table('v_hutangdetail_bahanjurnal_nonpembelian')
                ->whereMonth('tglhutang', $bulan)
                ->whereYear('tglhutang', $tahun)
                ->orderBy('tglhutang', 'ASC')
                ->orderBy('idhutangdetail', 'ASC')
                ->get();
            if (count($rsHutangNonPembelian) > 0) {
                foreach ($rsHutangNonPembelian as $row) {
                    $urut = 1;
                    $counterJurnal++;
                    $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);

                    if ($row->kredit != 0) { //utang bertambah
                        $dataJurnal[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'tgljurnal' => $row->tglhutang,
                            'keterangan' => !empty($row->keterangan) ? $row->keterangan : ('Penambahan Hutang Id: ' . $row->idhutang),
                            'totaldebet' => $row->kredit,
                            'totalkredit' => $row->kredit,
                            'referensi' => $row->idhutangdetail,
                            'jenis' => 'Hutang',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => $idpengguna,
                            'idposting' => $idposting,
                        );

                        $akunKasBank = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai);
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akunKasBank,
                            'debet' => $row->kredit,
                            'kredit' => 0,
                            'urut' => $urut++,
                        );

                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akun_utang_usaha,
                            'debet' => 0,
                            'kredit' => $row->kredit,
                            'urut' => 99,
                        );
                    } else { //pembayaran utang
                        $dataJurnal[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'tgljurnal' => $row->tglhutang,
                            'keterangan' => 'Pembayaran hutang Id: ' . $row->idhutang,
                            'totaldebet' => $row->debet,
                            'totalkredit' => $row->debet,
                            'referensi' => $row->idhutangdetail,
                            'jenis' => 'Hutang',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => $idpengguna,
                            'idposting' => $idposting,
                        );

                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akun_utang_usaha,
                            'debet' => $row->debet,
                            'kredit' => 0,
                            'urut' => $urut++,
                        );

                        $akunKasBank = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai);
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akunKasBank,
                            'debet' => 0,
                            'kredit' => $row->debet,
                            'urut' => 99,
                        );
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
                ->orderBy('idhutangdetail', 'ASC')
                ->get();
            if (count($rsHutang) > 0) {
                foreach ($rsHutang as $row) {
                    $urut = 1;
                    $counterJurnal++;
                    $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);

                    $dataJurnal[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'tgljurnal' => $row->tglhutang,
                        'keterangan' => 'Pembayaran Faktur: ' . $row->nofaktur . ', Tgl Faktur: ' . tgldmy($row->tglfaktur),
                        'totaldebet' => $row->debet,
                        'totalkredit' => $row->debet,
                        'referensi' => $row->idhutangdetail,
                        'jenis' => 'Hutang',
                        'inserted_date' => $inserted_date,
                        'updated_date' => $updated_date,
                        'idpengguna' => $idpengguna,
                        'idposting' => $idposting,
                    );

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akun_utang_usaha,
                        'debet' => $row->debet,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $akunKasBank = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai);
                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => $akunKasBank,
                        'debet' => 0,
                        'kredit' => $row->debet,
                        'urut' => 99,
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
                ->orderBy('tglpengeluaran', 'ASC')
                ->orderBy('idpengeluaran', 'ASC')
                ->get();
            if (count($rsPengeluaran) > 0) {
                $referensi_old = '';
                $currentIdJurnal = '';
                $urut = 1;
                foreach ($rsPengeluaran as $row) {
                    if ($referensi_old != $row->idpengeluaran) {
                        $urut = 1;
                        $counterJurnal++;
                        $currentIdJurnal = sprintf("%s%s%09d", $tahun, $bulan, $counterJurnal);
                        $dataJurnal[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'tgljurnal' => $row->tglpengeluaran,
                            'keterangan' => !empty($row->keterangan) ? $row->keterangan : 'Pengeluaran Kas/Bank',
                            'totaldebet' => $row->totalpengeluaran,
                            'totalkredit' => $row->totalpengeluaran,
                            'referensi' => $row->idpengeluaran,
                            'jenis' => 'Pengeluaran',
                            'inserted_date' => $inserted_date,
                            'updated_date' => $updated_date,
                            'idpengguna' => $idpengguna,
                            'idposting' => $idposting,
                        );

                        $akunKasBank = $this->getAkunKasBank($row->carabayar, $row->kdakunbank, $akun_kas_tunai);
                        $dataJurnalDetail[] = array(
                            'idjurnal' => $currentIdJurnal,
                            'kdakun' => $akunKasBank,
                            'debet' => 0,
                            'kredit' => $row->totalpengeluaran,
                            'urut' => 99,
                        );
                    }

                    $dataJurnalDetail[] = array(
                        'idjurnal' => $currentIdJurnal,
                        'kdakun' => !empty($row->kdakun) ? $row->kdakun : $akun_kas_tunai,
                        'debet' => $row->jumlahpengeluaran,
                        'kredit' => 0,
                        'urut' => $urut++,
                    );

                    $referensi_old = $row->idpengeluaran;
                }
            }

            if (!empty($dataJurnal)) {
                foreach (array_chunk($dataJurnal, 500) as $chunkJurnal) {
                    DB::table('jurnal')->insert($chunkJurnal);
                }
            }

            if (!empty($dataJurnalDetail)) {
                foreach (array_chunk($dataJurnalDetail, 500) as $chunkDetail) {
                    DB::table('jurnaldetail')->insert($chunkDetail);
                }
            }

            // Hitung total debet & kredit dari jurnal posting ini
            $totalDebet = 0;
            $totalKredit = 0;
            foreach ($dataJurnal as $dj) {
                $totalDebet += $dj['totaldebet'];
                $totalKredit += $dj['totalkredit'];
            }

            DB::table('postingjurnal')
                ->where('idposting', $idposting)
                ->update(array(
                    'jumlahdebet' => $totalDebet,
                    'jumlahkredit' => $totalKredit,
                ));

            DB::commit();

            return ['status' => 'success', 'message' => "Posting jurnal bulan " . bulan($bulan) . " $tahun berhasil. Total transaksi diposting: " . count($dataJurnal)];
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
            DB::beginTransaction();

            DB::table('jurnaldetail')
                ->whereIn('idjurnal', function ($query) use ($idposting) {
                    $query->select('idjurnal')
                        ->from('jurnal')
                        ->where('idposting', $idposting);
                })
                ->delete();

            DB::table('jurnal')
                ->where('idposting', $idposting)
                ->delete();

            DB::table('postingjurnal')
                ->where('idposting', $idposting)
                ->delete();

            $this->App->riwayatAktifitas($rsPosting, 'postingjurnal', 'hapusData');

            DB::commit();

            return ['status' => 'success', 'message' => "Data posting jurnal berhasil dihapus"];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }
}
