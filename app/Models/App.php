<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class App extends Model
{
    use HasFactory;

    public function riwayatAktifitas($data, $namatabel, $namafunction)
    {
        $dataRiwayat = array(
            'deskripsi' => json_encode($data),
            'namapengguna' => session()->get('namapengguna'),
            'inserted_date' => date('Y-m-d H:i:s'),
            'namatabel' => $namatabel,
            'namafunction' => $namafunction,
        );
        DB::table('riwayataktifitas')
            ->insert($dataRiwayat);
        return true;
    }

    public static function isPosting($tanggal)
    {
        $bulan = date('m', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
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

    public static function createTglJatuhTempo($idjenispiutang, $tglinvoice)
    {
        $rowJenisPiutang = DB::table('jenispiutang')
            ->where('idjenispiutang', $idjenispiutang)
            ->first();

        $jatuhTempoHari = $rowJenisPiutang->jatuhtempo;
        $jatuhTempoTanggal = date('Y-m-d', strtotime($tglinvoice . ' +' . $jatuhTempoHari . ' days'));
        return $jatuhTempoTanggal;
    }

    public static function adaTurunanAkun($kdakun)
    {
        $jumlahTurunan = DB::table('akun')
            ->where('kdparent', $kdakun)
            ->count();
        if ($jumlahTurunan > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getKreditKonsumen($idkonsumen)
    {
        $rowKonsumen = DB::table('konsumen')
            ->where('idkonsumen', $idkonsumen)
            ->first();
        $dataKredit = array(
            'idkonsumen' => $rowKonsumen->idkonsumen,
            'namakonsumen' => $rowKonsumen->namakonsumen,
            'limitkredit' => $rowKonsumen->limitkredit,
            'jumlahpiutang' => $rowKonsumen->jumlahpiutang,
            'sisakredit' => $rowKonsumen->limitkredit - $rowKonsumen->jumlahpiutang,
        );
        return $dataKredit;
    }
}
