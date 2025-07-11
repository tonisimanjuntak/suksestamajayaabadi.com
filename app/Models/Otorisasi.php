<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;

class Otorisasi extends Model
{
    use HasFactory;

    protected $table = 'otorisasi';
    protected $primaryKey = 'idotorisasi';
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
            DB::table('otorisasi')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'otorisasi', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idotorisasi)
    {
        try {

            DB::table('otorisasi')
                ->where('idotorisasi', $idotorisasi)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'otorisasi', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idotorisasi, $rsOtorisasi)
    {
        try {

            DB::table('otorisasi')
                ->where('idotorisasi', $idotorisasi)
                ->delete();

            $this->App->riwayatAktifitas($rsOtorisasi, 'otorisasi', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($namaotorisasi)
    {
        return DB::select("SELECT create_idotorisasi('$namaotorisasi') AS id")[0]->id;
    }
}
