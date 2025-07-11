<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;

class Kategoribarang extends Model
{
    use HasFactory;

    protected $table = 'kategoribarang';
    protected $primaryKey = 'idkategori';
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
            DB::table('kategoribarang')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'kategoribarang', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idkategori)
    {
        try {

            DB::table('kategoribarang')
                ->where('idkategori', $idkategori)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'kategoribarang', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idkategori, $rsKategori)
    {
        try {

            DB::table('kategoribarang')
                ->where('idkategori', $idkategori)
                ->delete();

            $this->App->riwayatAktifitas($rsKategori, 'kategoribarang', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($namakategori)
    {
        return DB::select("SELECT create_idkategori('$namakategori') AS id")[0]->id;
    }
}
