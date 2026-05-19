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
}