<?php

namespace App\Http\Controllers;

use App\Models\Uploads;
use App\Models\Pengguna;
use App\Models\Otorisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenggunaController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Pengguna;
        $this->isLogin();
    }

    public function index()
    {
        $pengguna = Pengguna::all();
        $data['pengguna'] = $pengguna;
        $data['menu'] = 'pengguna';
        return view('pengguna.index', $data);
    }

    public function tambah()
    {
        $data['menu'] = 'pengguna';
        $data['idpengguna'] = "";
        return view('pengguna.form', $data);
    }

    public function edit($idpengguna)
    {
        try {
            $idpengguna = Crypt::decrypt($idpengguna);
            $rsPengguna = Pengguna::findOrFail($idpengguna);
        } catch (ModelNotFoundException $e) {
            return redirect('/pengguna')->with('other', 'Data tidak ditemukan!');
        }
        $data['menu'] = 'pengguna';
        $data['idpengguna'] = $idpengguna;
        return view('pengguna.form', $data);
    }


    public function listdata(Request $request)
    {
        // Query dasar
        $query = Pengguna::select(['idpengguna', 'namapengguna', 'namaotorisasi', 'lastlogin', 'statusaktif', 'jeniskelamin', 'notelppengguna', 'emailpengguna', 'fotopengguna', 'username']);

        if ($request->has('statusFilter') && $request->input('statusFilter') != 'Semua') {
            $status = $request->input('statusFilter');
            $query->where('statusaktif', $status);
        }

        // Cek apakah ada pencarian
        if ($request->has('search') && !empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where('idpengguna', 'LIKE', "%{$search}%")
                ->orWhere('namapengguna', 'LIKE', "%{$search}%");
        }

        // Sorting berdasarkan kolom yang diklik
        if ($request->has('order')) {
            $orderColumn = $request->input('order.0.column'); // Index kolom yang di-sort
            $orderDirection = $request->input('order.0.dir'); // Arah sorting (asc/desc)

            // Daftar kolom yang bisa di-sort
            $columns = [null, 'idpengguna', 'namapengguna', null, null];

            // Pastikan index kolom valid
            if (isset($columns[$orderColumn])) {
                $query->orderBy($columns[$orderColumn], $orderDirection);
            } else {
                $query->orderBy('namapengguna', 'Asc');
            }
        } else {
            $query->orderBy('namapengguna', 'Asc');
        }


        // Hitung total data tanpa filter
        $totalData = Pengguna::count();

        // Hitung total data setelah filter (jika ada pencarian)
        $totalFiltered = $query->count();

        // Ambil parameter 'length' dan 'start' dari DataTables
        $limit = $request->input('length', 10);
        $start = $request->input('start', 0);

        // Ambil data dengan limit dan offset
        $rsData = $query->offset($start)
            ->limit($limit)
            ->get();

        // Format data untuk DataTables
        $data = [];
        $no = 1;
        foreach ($rsData as $row) {
            if ($row->statusaktif == 'Aktif') {
                $statusaktif = '<span class="badge badge-success">' . $row->statusaktif . '</span>';
            } else {
                $statusaktif = '<span class="badge badge-danger">' . $row->statusaktif . '</span>';
            }

            if (!empty($row->fotopengguna)) {
                $fotopengguna = url('uploads/pengguna/' . $row->fotopengguna);
            } else {
                $fotopengguna = url('images/profil1.png');
            }

            $data[] = [
                'no' => $no++,
                'fotopengguna' => '<img src="' . $fotopengguna . '" alt="" style="width: 80%;">',
                'idpengguna' => $row->idpengguna,
                'namapengguna' => $row->namapengguna,
                'namaotorisasi' => $row->namaotorisasi,
                'lastlogin' => since($row->lastlogin),
                'statusaktif' => $statusaktif,
                'action' => '<div class="btn-group btn-block">
                                <div class="btn-group dropleft" role="group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropleft</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="' . url('pengguna/hapus/' . Crypt::encrypt($row->idpengguna)) . '" class="dropdown-item" id="btnHapus">Hapus</a>
                                    </div>
                                </div>
                                <a href="' . url('pengguna/edit/' . Crypt::encrypt($row->idpengguna)) . '" class="btn btn-warning">Edit</a>                                
                            </div>',

            ];
        }


        // Response untuk DataTables
        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function simpanData(Request $request)
    {
        $idpengguna = $request->get('idpengguna');
        $namapengguna = $request->get('namapengguna');
        $jeniskelamin = $request->get('jeniskelamin');
        $notelppengguna = $request->get('notelppengguna');
        $emailpengguna = $request->get('emailpengguna');
        $idotorisasi = $request->get('idotorisasi');
        $username = $request->get('username');
        $password = $request->get('password');
        $password2 = $request->get('password2');
        $fotopengguna = $request->file('fotopengguna');
        $fotopengguna_lama = $request->get('fotopengguna_lama');
        $inserted_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $statusaktif = $request->get('statusaktif');

        $uploads = Uploads::startUpload('uploads/pengguna', $fotopengguna, $fotopengguna_lama, 200);
        if ($uploads['status'] == 'success') {
            $file_name = $uploads['file_name'];
        } else {
            return redirect('/pengguna')->with('fail', 'Data gagal disimpan! Error: ' . $uploads['message']);
        }
        if (empty($emailpengguna)) {
            $emailpengguna = null;
        }

        if (empty($idpengguna)) {

            if ($password != $password2) {
                return redirect('/pengguna')->with('other', 'Ulangi password tidak sama');
            }

            $idpengguna = $this->model->createID($namapengguna);

            $data = array(
                'idpengguna' => $idpengguna,
                'namapengguna' => $namapengguna,
                'jeniskelamin' => $jeniskelamin,
                'notelppengguna' => $notelppengguna,
                'emailpengguna' => $emailpengguna,
                'fotopengguna' => $file_name,
                'username' => $username,
                'password' => bcrypt($password),
                'idotorisasi' => $idotorisasi,
                'inserted_date' => $inserted_date,
                'updated_date' => $updated_date,
                'statusaktif' => 'Aktif',
            );
            // dd($data);
            $simpan = $this->model->simpanData($data);
        } else {

            if ($password != '') {

                if ($password != $password2) {
                    return redirect('/pengguna')->with('other', 'Ulangi password tidak sama');
                }

                $data = array(
                    'idpengguna' => $idpengguna,
                    'namapengguna' => $namapengguna,
                    'jeniskelamin' => $jeniskelamin,
                    'notelppengguna' => $notelppengguna,
                    'emailpengguna' => $emailpengguna,
                    'fotopengguna' => $file_name,
                    'username' => $username,
                    'password' => bcrypt($password),
                    'idotorisasi' => $idotorisasi,
                    'updated_date' => $updated_date,
                    'statusaktif' => $statusaktif,
                );
            } else {
                $data = array(
                    'idpengguna' => $idpengguna,
                    'namapengguna' => $namapengguna,
                    'jeniskelamin' => $jeniskelamin,
                    'notelppengguna' => $notelppengguna,
                    'emailpengguna' => $emailpengguna,
                    'fotopengguna' => $file_name,
                    'username' => $username,
                    'idotorisasi' => $idotorisasi,
                    'updated_date' => $updated_date,
                    'statusaktif' => $statusaktif,
                );
            }
            // dd($data);

            $simpan = $this->model->updateData($data, $idpengguna);
        }

        // dd(htmlspecialchars($simpan['message']));
        if ($simpan['status'] == 'success') {
            return redirect('/pengguna')->with('success', $simpan['message']);
        } else {
            return redirect('/pengguna')->with('fail', 'Data gagal disimpan! Error: ' . $simpan['message']);
        }
    }



    public function hapus($idpengguna)
    {
        $idpengguna = Crypt::decrypt($idpengguna);
        try {
            $rsPengguna = Pengguna::findOrFail($idpengguna);
        } catch (ModelNotFoundException $e) {
            return redirect('/pengguna')->with('other', 'Data tidak ditemukan!');
        }

        $hapus = $this->model->hapusData($idpengguna, $rsPengguna);
        if ($hapus['status'] == 'success') {
            return redirect('/pengguna')->with('success', $hapus['message']);
        } else {
            return redirect('/pengguna')->with('fail', 'Data gagal dihapus! Error: ' . $hapus['message']);
        }
    }

    public function getDataID(Request $request)
    {
        $idpengguna = $request->input('idpengguna');
        $rsPengguna = Pengguna::find($idpengguna);
        return response()->json($rsPengguna);
    }

    public function searchOtorisasi(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Otorisasi::where('namaotorisasi', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idotorisasi,
                'text' => $item->idotorisasi . ' - ' . $item->namaotorisasi,
            ];
        });

        return response()->json(['results' => $formattedResults]);
    }


    public function searchKasir(Request $request)
    {
        $search = $request->input('q'); // Ambil parameter pencarian

        // Query pencarian
        $results = Pengguna::where('idotorisasi', IDOTORISASIKASIR)
            ->where(function ($query) use ($search) {
                $query->where('idpengguna', 'LIKE', "%{$search}%")
                    ->orWhere('namapengguna', 'LIKE', "%{$search}%");
            })
            ->limit(50)
            ->get();

        // Format data untuk Select2
        $formattedResults = $results->map(function ($item) {
            return [
                'id' => $item->idpengguna,
                'text' => $item->namapengguna,
            ];
        });
        return response()->json(['results' => $formattedResults]);
    }
}
