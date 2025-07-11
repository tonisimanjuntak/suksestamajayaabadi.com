<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $primaryKey = 'idsales';
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

    public function simpanData($data, $salesWilayah)
    {
        try {
            DB::table('sales')
                ->insert($data);

            DB::table('saleswilayah')->insert($salesWilayah);

            $this->App->riwayatAktifitas($data, 'sales', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idsales, $salesWilayah)
    {
        try {

            DB::table('sales')
                ->where('idsales', $idsales)
                ->update($data);

            DB::table('saleswilayah')
                ->where('idsales', $idsales)
                ->delete();
            DB::table('saleswilayah')->insert($salesWilayah);


            $this->App->riwayatAktifitas($data, 'sales', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idsales, $rsKategori)
    {
        try {

            DB::table('sales')
                ->where('idsales', $idsales)
                ->delete();

            $this->App->riwayatAktifitas($rsKategori, 'sales', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($namasales)
    {
        return DB::select("SELECT create_idsales('$namasales') AS id")[0]->id;
    }

    public function getWilayahSales($idsales)
    {
        $rsWilayah = DB::table('v_saleswilayah')
            ->where('idsales', $idsales)
            ->get();
        return $rsWilayah;
    }

    public function getSalesByWilayah($idwilayah)
    {
        $rsSales = DB::table('v_saleswilayah')
            ->where('idwilayah', $idwilayah)
            ->first();
        return $rsSales;
    }

    public static function getSalesAktif()
    {
        return DB::table('sales')
            ->where('statusaktif', 'Aktif')
            ->get();
    }
}
