<?php  

namespace App\Http\Controllers;

use App\Models\Ajax;
use App\Models\Barang;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getBarangId(Request $request)
    {
        $idbarang = $request->input('idbarang');
        $rsBarang = Barang::find($idbarang);
        return response()->json($rsBarang);
    }
}