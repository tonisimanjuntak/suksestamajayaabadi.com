<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Jenispiutang;

class JenispiutangController extends Controller
{

    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Jenispiutang();
    }

    public function searchJenisPiutang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Jenispiutang::where('namajenispiutang', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idjenispiutang,
                'text' => $item->namajenispiutang . ' (' . $item->jatuhtempo . ' hari)',
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
