<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

class RiwayatupdateController extends Controller
{
    
    public function __construct()
    {
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'riwayatupdate';
        return view('riwayatupdate', $data);
    }


}
