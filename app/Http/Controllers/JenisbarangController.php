<?php

namespace App\Http\Controllers;

use App\Models\Jenisbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class JenisbarangController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Jenisbarang;
        $this->App = new App;
        $this->isLogin();
    }

    public function searchJenisBarang(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Jenisbarang::where('jenisbarang', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idjenisbarang,
                'text' => $item->jenisbarang . ' (' . $item->persenbonustarget . '%)',
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
