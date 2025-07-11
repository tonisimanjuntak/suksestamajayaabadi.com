<?php

namespace App\Http\Controllers;

use App\Models\Jenisekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\App;

class JenisekspedisiController extends Controller
{
    var $model;
    var $App;

    public function __construct()
    {
        $this->model = new Jenisekspedisi;
        $this->App = new App;
    }

    public function searchJenisEkspedisi(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Jenisekspedisi::where('namajenisekspedisi', 'LIKE', "%{$search}%")
            ->where('statusaktif', 'Aktif')
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idjenisekspedisi,
                'text' => $item->namajenisekspedisi,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }
}
