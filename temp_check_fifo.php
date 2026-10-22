<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$id = 'B001000749';
$rw = DB::table('riwayatstok')->where('idbarang', $id)->orderBy('idriwayat', 'desc')->first();
$fifo = DB::table('stokfifo')->where('idbarang', $id)->sum('jumlahsisa');
echo "ID: $id\n";
echo "Riwayat stok akhir: " . ($rw ? $rw->stokakhir : 0) . "\n";
echo "Stok FIFO total sisa: $fifo\n\n";

// Cek keseluruhan selisih database
$sub = DB::table('riwayatstok as r1')
    ->select('r1.idbarang', 'r1.stokakhir')
    ->join(DB::raw('(SELECT idbarang, MAX(idriwayat) as max_id FROM riwayatstok GROUP BY idbarang) as r2'), function($j) {
        $j->on('r1.idbarang', '=', 'r2.idbarang')->on('r1.idriwayat', '=', 'r2.max_id');
    });

$fifoSub = DB::table('stokfifo')
    ->select('idbarang', DB::raw('SUM(jumlahsisa) as total_fifo'))
    ->groupBy('idbarang');

$discrepancies = DB::table(DB::raw("({$sub->toSql()}) as r"))
    ->mergeBindings($sub)
    ->leftJoin(DB::raw("({$fifoSub->toSql()}) as f"), 'r.idbarang', '=', 'f.idbarang')
    ->mergeBindings($fifoSub)
    ->select('r.idbarang', 'r.stokakhir', DB::raw('COALESCE(f.total_fifo, 0) as total_fifo'))
    ->whereRaw('r.stokakhir != COALESCE(f.total_fifo, 0)')
    ->get();

echo "Total barang selisih: " . $discrepancies->count() . "\n";
foreach ($discrepancies->take(10) as $disc) {
    echo "Discrepancy: {$disc->idbarang} | riwayat: {$disc->stokakhir} | fifo: {$disc->total_fifo}\n";
}
