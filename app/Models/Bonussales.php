<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;

class Bonussales extends Model
{
    use HasFactory;

    protected $table = 'v_bonus';
    protected $primaryKey = 'idbonus';
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

    public function simpanData($data, $dataBonusPenjualan, $dataPenjualanDetail, $dataBonusPenagihan, $dataPenjualanDetailPenagihan, $dataBonusTarget, $dataPenjualanDetailTarget)
    {
        try {
            DB::beginTransaction();

            DB::table('bonus')
                ->insert($data);

            DB::table('bonuspenjualan')
                ->insert($dataBonusPenjualan);

            DB::table('bonuspenagihan')
                ->insert($dataBonusPenagihan);

            DB::table('bonustarget')
                ->insert($dataBonusTarget);


            //update tabel penjualan untuk bonus penjulan
            foreach ($dataPenjualanDetail as $dataDetail) {
                DB::table('penjualandetail')
                    ->where('id', $dataDetail['id'])
                    ->update([
                        'jenisbonuspenjualan' => $dataDetail['jenisbonuspenjualan'],
                        'persenbonuspenjualan' => $dataDetail['persenbonuspenjualan'],
                        'jumlahbonuspenjualan' => $dataDetail['jumlahbonuspenjualan'],
                        'subtotalbonuspenjualan' => $dataDetail['subtotalbonuspenjualan'],
                    ]);
            }

            //update tabel penjualan untuk bonus penagihan
            foreach ($dataPenjualanDetailPenagihan as $dataDetail) {
                DB::table('penjualandetail')
                    ->where('id', $dataDetail['id'])
                    ->update([
                        'jenisbonustagihan' => $dataDetail['jenisbonustagihan'],
                        'persenbonustagihan' => $dataDetail['persenbonustagihan'],
                        'jumlahbonustagihan' => $dataDetail['jumlahbonustagihan'],
                        'subtotalbonustagihan' => $dataDetail['subtotalbonustagihan'],
                    ]);
            }

            //update tabel penjualan untuk bonus penjulan
            foreach ($dataPenjualanDetailTarget as $dataDetail) {
                DB::table('penjualandetail')
                    ->where('id', $dataDetail['id'])
                    ->update([
                        'idjenisbarang' => $dataDetail['idjenisbarang'],
                        'persenbonustarget' => $dataDetail['persenbonustarget'],
                        'subtotalbonustarget' => $dataDetail['subtotalbonustarget'],
                    ]);
            }

            $this->App->riwayatAktifitas($data, 'bonus', 'simpanData');
            $this->App->riwayatAktifitas($dataBonusPenjualan, 'bonuspenjualan', 'simpanData');
            $this->App->riwayatAktifitas($dataBonusPenagihan, 'bonuspenagihan', 'simpanData');
            $this->App->riwayatAktifitas($dataBonusTarget, 'bonustarget', 'simpanData');

            DB::commit();
            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idbonus, $rsBonus)
    {
        try {
            DB::beginTransaction();

            $rsBonusPenjualan = DB::table('bonuspenjualan')
                ->where('idbonus', $idbonus)
                ->get();
            $rsBonusPenagihan = DB::table('bonuspenagihan')
                ->where('idbonus', $idbonus)
                ->get();
            $rsBonusTarget = DB::table('bonustarget')
                ->where('idbonus', $idbonus)
                ->get();

            if ($rsBonusPenjualan->isNotEmpty()) {
                foreach ($rsBonusPenjualan as $row) {
                    DB::table('penjualandetail')
                        ->where('idpenjualan', $row->idpenjualan)
                        ->update([
                            'jenisbonuspenjualan' => null,
                            'persenbonuspenjualan' => null,
                            'jumlahbonuspenjualan' => null,
                            'subtotalbonuspenjualan' => null,
                        ]);
                }
            }


            if ($rsBonusPenagihan->isNotEmpty()) {
                foreach ($rsBonusPenagihan as $row) {
                    DB::table('penjualandetail')
                        ->where('idpenjualan', $row->idpenjualan)
                        ->update([
                            'jenisbonustagihan' => null,
                            'persenbonustagihan' => null,
                            'jumlahbonustagihan' => null,
                            'subtotalbonustagihan' => null,
                        ]);
                }
            }

            if ($rsBonusTarget->isNotEmpty()) {
                foreach ($rsBonusTarget as $row) {
                    DB::table('penjualandetail')
                        ->where('idpenjualan', $row->idpenjualan)
                        ->update([
                            'idjenisbarang' => null,
                            'persenbonustarget' => null,
                            'subtotalbonustarget' => null,
                        ]);
                }
            }

            DB::table('bonuspenjualan')
                ->where('idbonus', $idbonus)
                ->delete();

            DB::table('bonuspenagihan')
                ->where('idbonus', $idbonus)
                ->delete();

            DB::table('bonustarget')
                ->where('idbonus', $idbonus)
                ->delete();

            DB::table('bonus')
                ->where('idbonus', $idbonus)
                ->delete();

            $this->App->riwayatAktifitas($rsBonus, 'bonus', 'hapusDataBonus');

            DB::commit();

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID()
    {
        return DB::select("SELECT create_idbonus() AS id")[0]->id;
    }

    public function getPerhitunganBonusPenjualan($idsales)
    {
        /*
            ambil penjualan yang sudah ada suratjalan
            dan belum dibuatkan bonus nya
        */
        return DB::table('v_dasar_bonus_penjualan')
            ->where('idsales', $idsales)
            ->whereRaw('idsuratjalan is not null')
            ->whereRaw('idbonus is null')
            ->get();
    }

    public function getPerhitunganBonusPenagihan($idsales)
    {
        /*
            Request 11-07-2025
            pembayaran penagihan yang cicil bonus nya tetap dibagi, 
            sehingga pembagian bonus nya dengan cara proporsional
        */

        $totalPembayaran = DB::table('v_penagihan_yang_dibayar')
            ->where('idsalesbonus', $idsales)
            ->where('bonuspenagihansudahdibayar', 0)
            ->whereRaw('tglpiutang <= tgljatuhtempo')
            ->sum('kredit');


        //bagikan berdasarkan jenis bonus nya yang persen terlebih dahulu baru kemudian jenis nya nominal seperti seng;

        $detailPembayaran = DB::table('v_penagihan_yang_dibayar_detail')
            ->where('idsalesbonus', $idsales)
            ->where('bonuspenagihansudahdibayar', 0)
            ->whereRaw('tglpiutang <= tgljatuhtempo')
            ->get();

        //Pembagian proporsional bonus yang berdasarkan total pembayaran dan penjualan
        $rincianBarang = array();
        $jumlahRow = $detailPembayaran->count();
        $no = 1;
        foreach ($detailPembayaran as $row) {
            $totalpembayaran = $row->kredit;
            $totalpenjualan = $row->totaldpp - $row->totaldiskon;
            $persenProporsional = round(($totalpembayaran / $totalpenjualan), 2);

            $hargaBarangProporsional = ($row->jumlahjual * ($row->hargadpp - $row->jumlahdiskon)) * $persenProporsional;

            if ($row->jenisbonustagihan == 'Nominal') {
                $bonusNominal = ($row->jumlahbonustagihan * $row->jumlahjual); //biasanya untuk seng
                $jumlahbonuspenagihan = $bonusNominal * $persenProporsional;
            } else {
                $jumlahbonuspenagihan = (int)($hargaBarangProporsional * ($row->persenbonustagihan / 100));
            }

            array_push($rincianBarang, array(
                'idpenjualan' => $row->idpenjualan,
                'idpenjualandetail' => $row->idpenjualandetail,
                'idpiutang' => $row->idpiutang,
                'idpiutangdetail' => $row->idpiutangdetail,
                'noinvoice' => $row->noinvoice,
                'tglinvoice' => $row->tglinvoice,
                'tglpiutang' => $row->tglpiutang,
                'tgljatuhtempo' => $row->tgljatuhtempo,
                'idbarang' => $row->idbarang,
                'namabarang' => $row->namabarang,
                'jumlahjual' => $row->jumlahjual,
                'hargasatuan' => $row->hargasatuan,
                'hargadpp' => $row->hargadpp,
                'jumlahppn' => $row->jumlahppn,
                'jumlahdiskon' => $row->jumlahdiskon,
                'subtotaljual' => $row->subtotaljual,
                'jenisbonustagihan' => $row->jenisbonustagihan,
                'persenbonustagihan' => $row->persenbonustagihan,
                'jumlahbonustagihan' => $row->jumlahbonustagihan,
                'subtotalbonustagihan' => $jumlahbonuspenagihan,
            ));
        }
        $dataPenagihan = array('totalPembayaran' => $totalPembayaran, 'detailPenagihan' => $rincianBarang);
        return $dataPenagihan;
    }

    public function getPerhitunganBonusTarget($idsales)
    {
        /*
            ambil penjualan yang sudah ada penagihan dan piutang nya sudah lunas
            dan belum dibuatkan bonus nya
        */
        return DB::table('v_dasar_bonus_target')
            ->where('idsales', $idsales)
            ->whereRaw('idbonus is null')
            ->get();
    }

    public function getTargetPenjualanSales($idsales)
    {
        return DB::table('sales')
            ->where('idsales', '=', $idsales)
            ->value('targetpenjualan');
    }

    public function getPencapaianPenjualanSales($idsales)
    {
        return DB::table('v_dasar_bonus_target')
            ->where('idsales', '=', $idsales)
            ->whereRaw('idbonus is null')
            ->sum('subtotaljual');
    }
}
