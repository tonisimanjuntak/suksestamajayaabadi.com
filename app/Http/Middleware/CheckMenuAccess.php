<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // Untuk str_contains

class CheckMenuAccess
{
    public function handle(Request $request, Closure $next)
    {
        $userMenus = Session::get('user_menus', []);
        $currentController = $request->segment(1);
        $currentAction = strtolower($request->segment(2)); // tambah, edit, hapus, dll

        // Daftar route yang dikecualikan dari pengecekan
        $except = ['login', 'logout', 'home', '', 'api', 'storage', 'download', 'upload'];

        if (in_array($currentController, $except)) {
            return $next($request);
        }

        $allowedController = false;
        $allowedAction = true; // Default: jika tidak ada action (index), dianggap boleh

        foreach ($userMenus as $menu) {
            // Cek menu utama
            if ($menu['urlmenus'] === $currentController) {
                $allowedController = true;
                Session::put('hakaksi_aktif', $menu['hakaksi'] ?? '');

                // Cek action hanya jika bukan index
                if (in_array($currentAction, ['tambah', 'edit', 'hapus'])) {
                    $hakAksi = $menu['hakaksi'] ?? '';

                    if ($currentAction === 'tambah' && !str_contains(strtolower($hakAksi), 'tambah')) {
                        $allowedAction = false;
                    } elseif ($currentAction === 'edit' && !str_contains(strtolower($hakAksi), 'edit')) {
                        $allowedAction = false;
                    } elseif ($currentAction === 'hapus' && !str_contains(strtolower($hakAksi), 'hapus')) {
                        $allowedAction = false;
                    }
                }

                break;
            }

            // Cek menu anak (level 1)
            if (!empty($menu['children'])) {
                foreach ($menu['children'] as $child) {
                    if ($child['urlmenus'] === $currentController) {
                        $allowedController = true;
                        Session::put('hakaksi_aktif', $child['hakaksi'] ?? '');

                        // Cek hak aksi di menu anak
                        if (in_array($currentAction, ['tambah', 'edit', 'hapus'])) {
                            $hakAksi = $child['hakaksi'] ?? '';

                            if ($currentAction === 'tambah' && !str_contains(strtolower($hakAksi), 'tambah')) {
                                $allowedAction = false;
                            } elseif ($currentAction === 'edit' && !str_contains(strtolower($hakAksi), 'edit')) {
                                $allowedAction = false;
                            } elseif ($currentAction === 'hapus' && !str_contains(strtolower($hakAksi), 'hapus')) {
                                $allowedAction = false;
                            }
                        }

                        break 2; // keluar dari dua loop
                    }

                    // Cek menu anak (level 2) — misal: laporan di dalam "Laporan"
                    if (!empty($child['children'])) {
                        foreach ($child['children'] as $child2) {
                            if ($child2['urlmenus'] === $currentController) {
                                $allowedController = true;
                                Session::put('hakaksi_aktif', $child2['hakaksi'] ?? '');

                                if (in_array($currentAction, ['tambah', 'edit', 'hapus'])) {
                                    $hakAksi = $child2['hakaksi'] ?? '';

                                    if ($currentAction === 'tambah' && !str_contains(strtolower($hakAksi), 'tambah')) {
                                        $allowedAction = false;
                                    } elseif ($currentAction === 'edit' && !str_contains(strtolower($hakAksi), 'edit')) {
                                        $allowedAction = false;
                                    } elseif ($currentAction === 'hapus' && !str_contains(strtolower($hakAksi), 'hapus')) {
                                        $allowedAction = false;
                                    }
                                }

                                break 3;
                            }
                        }
                    }
                }
            }
        }

        // Jika tidak punya akses ke controller atau action
        if (!$allowedController) {
            return $this->forbiddenResponse($request, 'Anda tidak memiliki akses ke menu ini.');
        }

        if (!$allowedAction) {
            return $this->forbiddenResponse($request, 'Anda tidak memiliki hak akses untuk aksi ini.');
        }

        return $next($request);
    }

    /**
     * Helper: Return forbidden response (JSON or Redirect)
     */
    private function forbiddenResponse($request, $message)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message
            ], 403);
        }

        return redirect()->route('home')->with('error', $message);
    }
}