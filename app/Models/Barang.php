<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'v_barang';
    protected $primaryKey = 'idbarang';
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
            DB::table('barang')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'barang', 'simpanDataBarang');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idbarang)
    {
        try {

            DB::table('barang')
                ->where('idbarang', $idbarang)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'barang', 'updateDataBarang');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idbarang, $rsKategori)
    {
        try {

            DB::table('barang')
                ->where('idbarang', $idbarang)
                ->delete();

            $this->App->riwayatAktifitas($rsKategori, 'barang', 'hapusDataBarang');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($idkategori)
    {
        return DB::select("SELECT create_idbarang('$idkategori') AS id")[0]->id;
    }

    public static function getRiwayatStokAkhir($idbarang)
    {
        // Jalankan query dan ambil nilai stokakhir (limit 1 otomatis ditambahkan oleh laravel)
        $stokAkhir = DB::table('riwayatstok')
            ->where('idbarang', $idbarang)
            ->orderBy('idriwayat', 'desc')
            ->value('stokakhir');

        // Jika tidak ada data, kembalikan 0 atau nilai default lainnya
        return $stokAkhir ?? 0;
    }

    public static function getStatusAktif()
    {
        return DB::table('v_barang')
            ->where('statusaktif', 'Aktif')
            ->orderBy('namakategori', 'ASC')
            ->orderBy('namabarang', 'ASC')
            ->get();
    }
}
