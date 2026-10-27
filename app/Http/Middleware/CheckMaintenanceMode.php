<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Hanya berlaku untuk sesi yang sudah login
        if (! Session::has('idpengguna')) {
            return $next($request);
        }

        // Developer (idpengguna == '9999999999') tetap bisa akses
        if (Session::get('idpengguna') === '9999999999') {
            return $next($request);
        }

        // Rute logout tetap diizinkan agar pengguna dapat keluar
        if ($request->is('logout')) {
            return $next($request);
        }

        // Periksa status pemeliharaan sistem
        $maintenanceStatus = DB::table('settings')
            ->where('prefix', 'maintenance_status')
            ->value('values');

        if ($maintenanceStatus === '1') {
            $estimatedFinished = DB::table('settings')
                ->where('prefix', 'maintenance_estimated_finished')
                ->value('values') ?? '';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'maintenance',
                    'message' => 'Sistem sedang dalam pemeliharaan.',
                    'estimated_finished' => $estimatedFinished,
                ], 503);
            }

            $usahaNama = Session::get('usaha_nama', DB::table('settings')->where('prefix', 'usaha_nama')->value('values') ?? 'Sistem ERP');
            $usahaNamaSingkat = Session::get('usaha_nama_singkat', DB::table('settings')->where('prefix', 'usaha_nama_singkat')->value('values') ?? 'ERP');
            $usahaLogo = Session::get('usaha_logo', DB::table('settings')->where('prefix', 'usaha_logo')->value('values') ?? 'logo.jpg');

            return response()->view('maintenance', [
                'estimated_finished' => $estimatedFinished,
                'usaha_nama' => $usahaNama,
                'usaha_nama_singkat' => $usahaNamaSingkat,
                'usaha_logo' => $usahaLogo,
            ], 503);
        }

        return $next($request);
    }
}
