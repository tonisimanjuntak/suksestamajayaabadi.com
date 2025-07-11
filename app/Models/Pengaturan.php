<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $primaryKey = 'prefix';
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

    public function simpanData($data)
    {
        try {
            DB::table('settings')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'settings', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $prefix)
    {
        try {

            DB::table('settings')
                ->where('prefix', $prefix)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'settings', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($prefix, $rsKategori)
    {
        try {

            DB::table('settings')
                ->where('prefix', $prefix)
                ->delete();

            $this->App->riwayatAktifitas($rsKategori, 'settings', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public static function getValues($prefix = '')
    {
        $values = '';
        try {
            if (!empty($prefix)) {
                $rsTemp = DB::table('settings')
                    ->where('prefix', $prefix)
                    ->first();
                $values = $rsTemp->values;
            }

            return $values;
        } catch (\Throwable $th) {

            return $values;
        }
    }
}
