<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'v_pengguna';
    protected $primaryKey = 'idpengguna';
    public $timestamps = false; // Menonaktifkan timestamps
    protected $keyType = 'char';

    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [];
    protected $hidden = [];
    var $App;

    public function __construct()
    {
        $this->App = new App;
    }

    public function getPetugasGudang()
    {
        return DB::table('pengguna')
            ->where('idotorisasi', 'Bagian Gudang')
            ->get();
    }

    public function getPetugasKasir()
    {
        return DB::table('pengguna')
            ->where('idotorisasi', 'Kasir')
            ->get();
    }

    public function getPetugasOwner()
    {
        return DB::table('pengguna')
            ->where('idotorisasi', 'Owner')
            ->get();
    }

    public function simpanData($data)
    {
        try {
            DB::table('pengguna')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'pengguna', 'simpanData');


            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idpengguna)
    {
        try {

            DB::table('pengguna')
                ->where('idpengguna', $idpengguna)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'pengguna', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idpengguna, $rsPengguna)
    {
        try {

            DB::table('pengguna')
                ->where('idpengguna', $idpengguna)
                ->delete();


            $this->App->riwayatAktifitas($rsPengguna, 'pengguna', 'hapusData');


            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($namapengguna)
    {
        return DB::select("SELECT create_idpengguna('$namapengguna') AS id")[0]->id;
    }
}
