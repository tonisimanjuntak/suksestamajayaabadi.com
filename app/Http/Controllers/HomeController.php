<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->isLogin();
        $this->model = new Home;
    }

    public function index()
    {
        $data['menu'] = 'home';
        return view('home', $data);
    }

    public function getInfoBox(Request $request)
    {
        $data = array(
            'totalPembelian' => $this->model->getTotalPembelian(),
            'totalPenjualan' => $this->model->getTotalPenjualan(),
            'totalUtang' => $this->model->getTotalUtang(),
            'totalPiutang' => $this->model->getTotalPiutang(),
        );
        return response()->json($data);
    }

    public function getInfoGrafikPenjualan()
    {
        $rsGrafikPenjualan = $this->model->getInfoGrafikPenjualan();
        $rsGrafikPembelian = $this->model->getInfoGrafikPembelian();

        $arrDeskripsi = array('JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS', 'SEP', 'OKT', 'NOV', 'DES');

        $arrTotalPenjualan = array(
            $rsGrafikPenjualan[0]->bulan01,
            $rsGrafikPenjualan[0]->bulan02,
            $rsGrafikPenjualan[0]->bulan03,
            $rsGrafikPenjualan[0]->bulan04,
            $rsGrafikPenjualan[0]->bulan05,
            $rsGrafikPenjualan[0]->bulan06,
            $rsGrafikPenjualan[0]->bulan07,
            $rsGrafikPenjualan[0]->bulan08,
            $rsGrafikPenjualan[0]->bulan09,
            $rsGrafikPenjualan[0]->bulan10,
            $rsGrafikPenjualan[0]->bulan11,
            $rsGrafikPenjualan[0]->bulan12,
        );

        $totalSemuaPenjualan = $rsGrafikPenjualan[0]->bulan01 + $rsGrafikPenjualan[0]->bulan02 + $rsGrafikPenjualan[0]->bulan03 + $rsGrafikPenjualan[0]->bulan04 + $rsGrafikPenjualan[0]->bulan05 + $rsGrafikPenjualan[0]->bulan06 + $rsGrafikPenjualan[0]->bulan07 + $rsGrafikPenjualan[0]->bulan08 + $rsGrafikPenjualan[0]->bulan09 + $rsGrafikPenjualan[0]->bulan10 + $rsGrafikPenjualan[0]->bulan11 + $rsGrafikPenjualan[0]->bulan12;


        $arrTotalPembelian = array(
            $rsGrafikPembelian[0]->bulan01,
            $rsGrafikPembelian[0]->bulan02,
            $rsGrafikPembelian[0]->bulan03,
            $rsGrafikPembelian[0]->bulan04,
            $rsGrafikPembelian[0]->bulan05,
            $rsGrafikPembelian[0]->bulan06,
            $rsGrafikPembelian[0]->bulan07,
            $rsGrafikPembelian[0]->bulan08,
            $rsGrafikPembelian[0]->bulan09,
            $rsGrafikPembelian[0]->bulan10,
            $rsGrafikPembelian[0]->bulan11,
            $rsGrafikPembelian[0]->bulan12,
        );

        $totalSemuaPembelian = $rsGrafikPembelian[0]->bulan01 + $rsGrafikPembelian[0]->bulan02 + $rsGrafikPembelian[0]->bulan03 + $rsGrafikPembelian[0]->bulan04 + $rsGrafikPembelian[0]->bulan05 + $rsGrafikPembelian[0]->bulan06 + $rsGrafikPembelian[0]->bulan07 + $rsGrafikPembelian[0]->bulan08 + $rsGrafikPembelian[0]->bulan09 + $rsGrafikPembelian[0]->bulan10 + $rsGrafikPembelian[0]->bulan11 + $rsGrafikPembelian[0]->bulan12;

        return response()->json(array('arrDeskripsi' => $arrDeskripsi, 'arrTotalPenjualan' => $arrTotalPenjualan, 'totalSemuaPenjualan' => $totalSemuaPenjualan, 'arrTotalPembelian' => $arrTotalPembelian, 'totalSemuaPembelian' => $totalSemuaPembelian));
    }
}
