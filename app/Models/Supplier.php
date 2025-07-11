<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'v_supplier';
    protected $primaryKey = 'idsupplier';
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
            DB::table('supplier')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'supplier', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idsupplier)
    {
        try {

            DB::table('supplier')
                ->where('idsupplier', $idsupplier)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'supplier', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idsupplier, $rssupplier)
    {
        try {

            DB::table('supplier')
                ->where('idsupplier', $idsupplier)
                ->delete();

            $this->App->riwayatAktifitas($rssupplier, 'supplier', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($namasupplier)
    {
        return DB::select("SELECT create_idsupplier('$namasupplier') AS id")[0]->id;
    }
}
