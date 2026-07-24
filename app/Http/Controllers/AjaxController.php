<?php  

namespace App\Http\Controllers;

use App\Models\Ajax;
use App\Models\Barang;
use App\Models\Riwayataktifitas;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getBarangId(Request $request)
    {
        $idbarang = $request->input('idbarang');
        $rsBarang = Barang::find($idbarang);
        return response()->json($rsBarang);
    }

    public function getRiwayatAkivitas(Request $request)
    {
        $riwayattable = $request->input('riwayattable');
        $rsRiwayat = Riwayataktifitas::where('namatabel', $riwayattable)
                    ->limit(100)
                    ->orderBy('inserted_date', 'desc')
                    ->get();

        return response()->json($rsRiwayat);
    }

    public function cekRiwayatUpdate() {
        $filePath = public_path('logupdate.txt');
        $content = file_exists($filePath) ? file_get_contents($filePath) : '';
        $lines = explode("\n", trim($content));
        $lastLine = !empty($lines) ? end($lines) : '';
        return response()->json(['lastLine' => $lastLine]);
    }

    public function cekSessionLogin()
    {
        // Cek apakah ada session idpengguna
        if (session()->has('idpengguna')) {
            return response()->json([
                'status' => 'active',
                'idpengguna' => session('idpengguna'),
                'nama' => session('nama') // jika ada
            ]);
        } else {
            return response()->json([
                'status' => 'inactive',
                'message' => 'Session tidak ditemukan'
            ]);
        }
    }
}