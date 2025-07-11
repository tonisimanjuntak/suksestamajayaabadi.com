<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    var $PenggunaModel;

    public function __construct()
    {
        $this->PenggunaModel = new Pengguna;
    }

    public function showLoginForm()
    {

        $usaha_nama = Pengaturan::getValues('usaha_nama');
        $usaha_logo = Pengaturan::getValues('usaha_logo');
        $usaha_nama_singkat = Pengaturan::getValues('usaha_nama_singkat');
        $data['usaha_nama'] = $usaha_nama;
        $data['usaha_logo'] = $usaha_logo;
        $data['usaha_nama_singkat'] = $usaha_nama_singkat;
        return view('login', $data);
    }

    public function login(Request $request)
    {
        $user = Pengguna::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('idpengguna', $user->idpengguna);
            Session::put('namapengguna', $user->namapengguna);
            Session::put('idotorisasi', $user->idotorisasi);
            Session::put('username', $user->username);

            if (!empty($user->fotopengguna)) {
                $fotopengguna = asset('uploads/pengguna/' . $user->fotopengguna);
                Session::put('fotopengguna', $fotopengguna);
            } else {
                $fotopengguna = asset('images/profil1.png');
                Session::put('fotopengguna', $fotopengguna);
            }

            $rsPengaturan = Pengaturan::all();
            foreach ($rsPengaturan as $rowPengaturan) {
                Session::put($rowPengaturan->prefix, $rowPengaturan->values);
            }

            $dataLogin = array(
                'lastlogin' => date('Y-m-d H:i:s'),
            );
            $this->PenggunaModel->updateData($dataLogin, $user->idpengguna);

            return redirect()->intended('/');
        } else {
            return back()->with(['message' => 'Username atau password salah']);
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
