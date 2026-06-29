<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;


class Pembayaranpiutang extends Model
{
    use HasFactory;

    protected $table = 'v_piutang';
    protected $primaryKey = 'idpiutang';
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

    public function allView()
    {
        return DB::table('v_piutang')
            ->orderBy('idpiutang', 'desc')
            ->get();
    }

    public function simpanData($dataDetail, $idpiutang, $rsPiutang, $nokwitansi)
    {
        try {
            DB::beginTransaction();
            DB::table('piutangdetail')->insert($dataDetail);
            $this->App->riwayatAktifitas($dataDetail, 'piutangdetail', 'simpanData');

            $idpenjualan = $rsPiutang->idpenjualan;
            if (!empty($idpenjualan) && $idpenjualan != null) {
                $rsPenjualan = Penjualan::find($idpenjualan);            
                $jumlahsudahbayar = DB::table('penjualankwitansi')
                    ->where('idpenjualan', $rsPenjualan->idpenjualan)
                    ->sum('jumlahbayar');
    
                //create kwitansi
                $dataKwitansi = array(
                    'nokwitansi' => $dataDetail['nokwitansi'],
                    'tglkwitansi' => $dataDetail['tglpiutang'],
                    'idpenjualan' => $rsPenjualan->idpenjualan,
                    'totalplusppn' => $rsPenjualan->totalinvoice,
                    'jumlahsudahbayar' => $jumlahsudahbayar,
                    'jumlahbayar' => $dataDetail['kredit'],
                    'inserted_date' => $dataDetail['inserted_date'],
                    'updated_date' => $dataDetail['updated_date'],
                    'idpengguna' => $dataDetail['idpengguna'],
                    'carabayar' => $dataDetail['carabayar'],
                    'idbank' => $dataDetail['idbank'],
                );
                DB::table('penjualankwitansi')->insert($dataKwitansi);
            }



            

            $totalkredit = DB::table('piutangdetail')
                ->where('idpiutang', $idpiutang)
                ->sum('kredit');

            if (!empty($totalkredit)) {
                DB::table('piutang')
                    ->where('idpiutang', $idpiutang)
                    ->update([
                        'totalkredit' => $totalkredit,
                        'tgllunas' => DB::raw("
                                                case when totaldebet <= $totalkredit 
                                                    then '" . $dataDetail['tglpiutang'] . "'
                                                    else NULL
                                                end
                                            "),

                    ]);
            }

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

    public function hapusData($idpiutang, $idpiutangdetail, $rspiutangdetail)
    {
        try {

            DB::beginTransaction();

            //hapus kwitansi pembayaran
            $nokwitansi_old = $rspiutangdetail->nokwitansi;
            if (!empty($nokwitansi_old)) {
                DB::table('penjualankwitansi')
                    ->where('nokwitansi', $nokwitansi_old)
                    ->delete();
            }


            DB::table('piutangdetail')
                ->where('idpiutangdetail', $idpiutangdetail)
                ->delete();

            $this->App->riwayatAktifitas($rspiutangdetail, 'piutangdetail', 'hapusData');


            $totalkredit = DB::table('piutangdetail')
                ->where('idpiutang', $idpiutang)
                ->sum('kredit');

            DB::table('piutang')
                ->where('idpiutang', $idpiutang)
                ->update([
                    'totalkredit' => $totalkredit,
                    'tgllunas' => null
                ]);


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
        return DB::select('SELECT create_idpiutang() AS id')[0]->id;
    }

    public function createIDDetail($idpiutang)
    {
        return DB::select("SELECT create_idpiutangdetail('$idpiutang') AS id")[0]->id;
    }

    public function getDetail($idpiutang)
    {
        return DB::table('v_piutangdetail')
            ->where('idpiutang', $idpiutang)
            ->get();
    }

    public function getDetailID($idpiutangdetail)
    {
        return DB::table('v_piutangdetail')
            ->where('idpiutangdetail', $idpiutangdetail)
            ->first();
    }

}
