<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Login extends Model
{
    use HasFactory;

    public function getMenus($idpengguna)
    {
        // 1. Ambil semua menu aktif dan simpan dalam array asosiatif berdasarkan idmenus
        $allMenus = DB::table('menus')
            ->where('statusaktif', 'Aktif')
            ->orderBy('urut')
            ->get()
            ->keyBy('idmenus'); // sangat penting: agar pencarian parent cepat

        // 2. Ambil menu yang diizinkan untuk pengguna
        if ($idpengguna == '9999999999') {
            //Administrator boleh semua menu
            $userMenus = DB::table('menus')
                ->where('event_exist', '!=', '')
                ->select('menus.*', 'menus.event_exist as hakaksi')
                ->get();
        }else{
            $userMenus = DB::table('menus')
                ->join('pengguna_menus', 'pengguna_menus.idmenus', '=', 'menus.idmenus')
                ->where('pengguna_menus.idpengguna', $idpengguna)
                ->select('menus.*', 'pengguna_menus.hakaksi')
                ->get();
        }

        // 3. Set untuk menyimpan id menu yang harus ditampilkan (unik)
        $includedMenuIds = [];

        // 4. Fungsi rekursif untuk tambahkan menu dan semua parent-nya
        $addMenuAndParents = function ($menuId) use (&$addMenuAndParents, &$includedMenuIds, $allMenus) {
            // Jika sudah dimasukkan, skip
            if (isset($includedMenuIds[$menuId]) || !$menuId) {
                return;
            }

            // Ambil menu dari koleksi allMenus
            if (isset($allMenus[$menuId])) {
                $menu = $allMenus[$menuId];
                $includedMenuIds[$menuId] = [
                    'idmenus'     => $menu->idmenus,
                    'menus'       => $menu->menus,
                    'parent'      => $menu->parent,
                    'urlmenus'    => $menu->urlmenus,
                    'iconmenus'   => $menu->iconmenus,
                    'urut'        => $menu->urut,
                    'levels'      => $menu->levels,
                    'hakaksi'     => null, // akan diisi nanti untuk menu anak
                ];

                // Rekursif ke parent
                if ($menu->parent) {
                    $addMenuAndParents($menu->parent);
                }
            }
        };

        // 5. Proses setiap menu yang diakses pengguna
        foreach ($userMenus as $userMenu) {
            $addMenuAndParents($userMenu->idmenus);

            // Isi hak akses hanya untuk menu yang langsung diakses
            $includedMenuIds[$userMenu->idmenus]['hakaksi'] = $userMenu->hakaksi;
        }

        // 6. Urutkan hasil berdasarkan urut (urut menu)
        $finalMenus = collect($includedMenuIds)->sortBy('urut')->values()->all();

        $tree = [];
        $lookup = [];

        foreach ($finalMenus as $menu) {
            $lookup[$menu['idmenus']] = $menu;
            $lookup[$menu['idmenus']]['children'] = [];
        }

        foreach ($lookup as $id => $menu) {
            if ($menu['parent'] && isset($lookup[$menu['parent']])) {
                $lookup[$menu['parent']]['children'][] = &$lookup[$id];
            } else {
                $tree[] = &$lookup[$id];
            }
        }

        return $tree;
    }
}
