<?php

use App\Http\Controllers\Akun1Controller;
use App\Http\Controllers\Akun2Controller;
use App\Http\Controllers\Akun3Controller;
use App\Http\Controllers\Akun4Controller;
use App\Http\Controllers\BankController;
use App\Http\Controllers\PengaturanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\KategoribarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BonussalesController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\HutangekspedisiController;
use App\Http\Controllers\JenisbarangController;
use App\Http\Controllers\JenisekspedisiController;
use App\Http\Controllers\JenispiutangController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\LapbonussalesController;
use App\Http\Controllers\LapbukubesarController;
use App\Http\Controllers\LapbukuhutangController;
use App\Http\Controllers\LapbukupiutangController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LapjurnalController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaplabarugiController;
use App\Http\Controllers\LappembelianController;
use App\Http\Controllers\LappenjualanController;
use App\Http\Controllers\LappersediaanController;
use App\Http\Controllers\LapneracasaldoController;
use App\Http\Controllers\LappenagihansalesController;
use App\Http\Controllers\LappenerimaanController;
use App\Http\Controllers\LappengeluaranController;
use App\Http\Controllers\LaprekaphutangController;
use App\Http\Controllers\LaprekappiutangController;
use App\Http\Controllers\LapreturpembelianController;
use App\Http\Controllers\LapreturpenjualanController;
use App\Http\Controllers\LaputangekspedisiController;
use App\Http\Controllers\PembelianpenerimaanController;
use App\Http\Controllers\PenagihanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\PostingjurnalController;
use App\Http\Controllers\ReturpembelianController;
use App\Http\Controllers\ReturpenjualanController;
use App\Http\Controllers\SaldoawalController;
use App\Http\Controllers\SaldopiutangController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockopnameController;
use App\Http\Controllers\SuratjalanController;
use App\Http\Controllers\WilayahController;
use App\Models\Kategoribarang;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home/getInfoBox', [HomeController::class, 'getInfoBox']);
Route::get('home/getInfoGrafikPenjualan', [HomeController::class, 'getInfoGrafikPenjualan']);


Route::get('pengguna', [PenggunaController::class, 'index']);
Route::get('pengguna/tambah', [PenggunaController::class, 'tambah']);
Route::get('pengguna/edit/{PenggunaID}', [PenggunaController::class, 'edit']);
Route::get('pengguna/getDataID', [PenggunaController::class, 'getDataID']);
Route::get('pengguna/hapus/{id}', [PenggunaController::class, 'hapus']);
Route::post('pengguna/simpanData', [PenggunaController::class, 'simpanData']);
Route::get('pengguna/listdata', [PenggunaController::class, 'listdata'])->name('pengguna.listdata');
Route::get('pengguna/searchOtorisasi', [PenggunaController::class, 'searchOtorisasi'])->name('pengguna.searchOtorisasi');
Route::get('pengguna/searchKasir', [PenggunaController::class, 'searchKasir'])->name('pengguna.searchKasir');

Route::get('wilayah', [WilayahController::class, 'index']);
Route::get('wilayah/tambah', [WilayahController::class, 'tambah']);
Route::get('wilayah/edit/{PenggunaID}', [WilayahController::class, 'edit']);
Route::get('wilayah/getDataID', [WilayahController::class, 'getDataID']);
Route::get('wilayah/hapus/{id}', [WilayahController::class, 'hapus']);
Route::post('wilayah/simpanData', [WilayahController::class, 'simpanData']);
Route::get('wilayah/listdata', [WilayahController::class, 'listdata'])->name('wilayah.listdata');
Route::get('wilayah/searchWilayah', [WilayahController::class, 'searchWilayah'])->name('wilayah.searchWilayah');


Route::get('konsumen', [KonsumenController::class, 'index']);
Route::get('konsumen/tambah', [KonsumenController::class, 'tambah']);
Route::get('konsumen/edit/{PenggunaID}', [KonsumenController::class, 'edit']);
Route::get('konsumen/getDataID', [KonsumenController::class, 'getDataID']);
Route::get('konsumen/hapus/{id}', [KonsumenController::class, 'hapus']);
Route::post('konsumen/simpanData', [KonsumenController::class, 'simpanData']);
Route::get('konsumen/listdata', [KonsumenController::class, 'listdata'])->name('konsumen.listdata');
Route::get('konsumen/searchWilayah', [KonsumenController::class, 'searchWilayah'])->name('konsumen.searchWilayah');
Route::get('konsumen/searchKonsumen', [KonsumenController::class, 'searchKonsumen'])->name('konsumen.searchKonsumen');

Route::get('ekspedisi', [EkspedisiController::class, 'index']);
Route::get('ekspedisi/tambah', [EkspedisiController::class, 'tambah']);
Route::get('ekspedisi/edit/{PenggunaID}', [EkspedisiController::class, 'edit']);
Route::get('ekspedisi/getDataID', [EkspedisiController::class, 'getDataID']);
Route::get('ekspedisi/hapus/{id}', [EkspedisiController::class, 'hapus']);
Route::post('ekspedisi/simpanData', [EkspedisiController::class, 'simpanData']);
Route::get('ekspedisi/listdata', [EkspedisiController::class, 'listdata'])->name('ekspedisi.listdata');
Route::get('ekspedisi/searchEkspedisi', [EkspedisiController::class, 'searchEkspedisi'])->name('ekspedisi.searchEkspedisi');

Route::get('jenisekspedisi/searchJenisEkspedisi', [JenisekspedisiController::class, 'searchJenisEkspedisi'])->name('jenisekspedisi.searchJenisEkspedisi');


Route::get('sales', [SalesController::class, 'index']);
Route::get('sales/tambah', [SalesController::class, 'tambah']);
Route::get('sales/edit/{PenggunaID}', [SalesController::class, 'edit']);
Route::get('sales/getDataID', [SalesController::class, 'getDataID']);
Route::get('sales/hapus/{id}', [SalesController::class, 'hapus']);
Route::post('sales/simpanData', [SalesController::class, 'simpanData']);
Route::get('sales/listdata', [SalesController::class, 'listdata'])->name('sales.listdata');
Route::get('sales/searchSales', [SalesController::class, 'searchSales'])->name('sales.searchSales');
Route::get('sales/getSalesByKonsumen', [SalesController::class, 'getSalesByKonsumen']);


Route::get('penagihan', [PenagihanController::class, 'index']);
Route::get('penagihan/tambah', [PenagihanController::class, 'tambah']);
Route::get('penagihan/edit/{idsuratjalan}', [PenagihanController::class, 'edit']);
Route::get('penagihan/detail/{idpiutang}', [PenagihanController::class, 'detail']);
Route::get('penagihan/getDataID', [PenagihanController::class, 'getDataID']);
Route::get('penagihan/hapus/{id}', [PenagihanController::class, 'hapus']);
Route::post('penagihan/simpanData', [PenagihanController::class, 'simpanData']);
Route::get('penagihan/listdata', [PenagihanController::class, 'listdata'])->name('penagihan.listdata');
Route::get('penagihan/getPiutangBelumLunas', [PenagihanController::class, 'getPiutangBelumLunas'])->name('penagihan.getPiutangBelumLunas');
Route::get('penagihan/getPiutangID', [PenagihanController::class, 'getPiutangID']);
Route::get('penagihan/cetak/{idpenagihan}', [PenagihanController::class, 'cetak']);


Route::get('bonussales', [BonussalesController::class, 'index']);
Route::get('bonussales/tambah', [BonussalesController::class, 'tambah']);
Route::get('bonussales/edit/{PenggunaID}', [BonussalesController::class, 'edit']);
Route::get('bonussales/getDataID', [BonussalesController::class, 'getDataID']);
Route::get('bonussales/hapus/{id}', [BonussalesController::class, 'hapus']);
Route::post('bonussales/simpanData', [BonussalesController::class, 'simpanData']);
Route::get('bonussales/listdata', [BonussalesController::class, 'listdata'])->name('bonussales.listdata');
Route::get('bonussales/searchSales', [BonussalesController::class, 'searchSales'])->name('bonussales.searchSales');
Route::get('bonussales/getSalesByKonsumen', [BonussalesController::class, 'getSalesByKonsumen']);
Route::get('bonussales/getBonus', [BonussalesController::class, 'getBonus']);
Route::get('bonussales/cetak/{idbonus}', [BonussalesController::class, 'cetak']);


Route::get('supplier', [SupplierController::class, 'index']);
Route::get('supplier/tambah', [SupplierController::class, 'tambah']);
Route::get('supplier/edit/{PenggunaID}', [SupplierController::class, 'edit']);
Route::get('supplier/getDataID', [SupplierController::class, 'getDataID']);
Route::get('supplier/hapus/{id}', [SupplierController::class, 'hapus']);
Route::post('supplier/simpanData', [SupplierController::class, 'simpanData']);
Route::get('supplier/listdata', [SupplierController::class, 'listdata'])->name('supplier.listdata');
Route::get('supplier/searchSupplier', [SupplierController::class, 'searchSupplier'])->name('supplier.searchSupplier');


Route::get('jenispiutang/searchJenisPiutang', [JenispiutangController::class, 'searchJenisPiutang'])->name('jenispiutang.searchJenisPiutang');

Route::get('bank', [BankController::class, 'index']);
Route::get('bank/tambah', [BankController::class, 'tambah']);
Route::get('bank/edit/{PenggunaID}', [BankController::class, 'edit']);
Route::get('bank/getDataID', [BankController::class, 'getDataID']);
Route::get('bank/hapus/{id}', [BankController::class, 'hapus']);
Route::post('bank/simpanData', [BankController::class, 'simpanData']);
Route::get('bank/listdata', [BankController::class, 'listdata'])->name('bank.listdata');
Route::get('bank/searchBank', [BankController::class, 'searchBank'])->name('bank.searchBank');

Route::get('pembelian', [PembelianController::class, 'index']);
Route::get('pembelian/tambah', [PembelianController::class, 'tambah']);
Route::get('pembelian/edit/{PenggunaID}', [PembelianController::class, 'edit']);
Route::get('pembelian/getDataID', [PembelianController::class, 'getDataID']);
Route::get('pembelian/hapus/{id}', [PembelianController::class, 'hapus']);
Route::post('pembelian/simpanData', [PembelianController::class, 'simpanData']);
Route::get('pembelian/listdata', [PembelianController::class, 'listdata'])->name('pembelian.listdata');
Route::get('pembelian/searchFaktur', [PembelianController::class, 'searchFaktur'])->name('pembelian.searchFaktur');
Route::get('pembelian/searchFakturHutang', [PembelianController::class, 'searchFakturHutang'])->name('pembelian.searchFakturHutang');


Route::get('pembelianpenerimaan', [PembelianpenerimaanController::class, 'index']);
Route::get('pembelianpenerimaan/tambah', [PembelianpenerimaanController::class, 'tambah']);
Route::get('pembelianpenerimaan/edit/{PenggunaID}', [PembelianpenerimaanController::class, 'edit']);
Route::get('pembelianpenerimaan/getDataID', [PembelianpenerimaanController::class, 'getDataID']);
Route::get('pembelianpenerimaan/hapus/{id}', [PembelianpenerimaanController::class, 'hapus']);
Route::post('pembelianpenerimaan/simpanData', [PembelianpenerimaanController::class, 'simpanData']);
Route::get('pembelianpenerimaan/listdata', [PembelianpenerimaanController::class, 'listdata'])->name('pembelianpenerimaan.listdata');
Route::get('pembelianpenerimaan/searchFaktur', [PembelianpenerimaanController::class, 'searchFaktur'])->name('pembelianpenerimaan.searchFaktur');
Route::get('pembelianpenerimaan/searchFakturHutang', [PembelianpenerimaanController::class, 'searchFakturHutang'])
    ->name('pembelianpenerimaan.searchFakturHutang');
Route::get('pembelianpenerimaan/searchPO', [PembelianpenerimaanController::class, 'searchPO'])->name('pembelianpenerimaan.searchPO');
Route::get('pembelianpenerimaan/getPurchaseOrder', [PembelianpenerimaanController::class, 'getPurchaseOrder'])->name('pembelianpenerimaan.getPurchaseOrder');
Route::get('pembelianpenerimaan/getDetailId', [PembelianpenerimaanController::class, 'getDetailId']);
Route::get('pembelianpenerimaan/getModalInfo', [PembelianpenerimaanController::class, 'getModalInfo']);


Route::get('returpembelian', [ReturpembelianController::class, 'index']);
Route::get('returpembelian/tambah', [ReturpembelianController::class, 'tambah']);
Route::get('returpembelian/getDataID', [ReturpembelianController::class, 'getDataID']);
Route::get('returpembelian/hapus/{id}', [ReturpembelianController::class, 'hapus']);
Route::post('returpembelian/simpanData', [ReturpembelianController::class, 'simpanData']);
Route::get('returpembelian/listdata', [ReturpembelianController::class, 'listdata'])->name('returpembelian.listdata');
Route::get('returpembelian/searchPembelian', [ReturpembelianController::class, 'searchPembelian'])->name('returpembelian.searchPembelian');
Route::get('returpembelian/searchBarangRetur', [ReturpembelianController::class, 'searchBarangRetur'])->name('returpembelian.searchBarangRetur');
Route::get('returpembelian/getPembelian', [ReturpembelianController::class, 'getPembelian']);
Route::get('returpembelian/getDetailPembelian', [ReturpembelianController::class, 'getDetailPembelian']);
Route::get('returpembelian/ubahstatus/{idreturpembelian}', [ReturpembelianController::class, 'ubahstatus']);
Route::post('returpembelian/simpanubahstatus', [ReturpembelianController::class, 'simpanubahstatus']);

Route::get('returpenjualan', [ReturpenjualanController::class, 'index']);
Route::get('returpenjualan/tambah', [ReturpenjualanController::class, 'tambah']);
Route::get('returpenjualan/lihat/{PenggunaID}', [ReturpenjualanController::class, 'lihat']);
Route::get('returpenjualan/getDataID', [ReturpenjualanController::class, 'getDataID']);
Route::get('returpenjualan/hapus/{id}', [ReturpenjualanController::class, 'hapus']);
Route::post('returpenjualan/simpanData', [ReturpenjualanController::class, 'simpanData']);
Route::get('returpenjualan/listdata', [ReturpenjualanController::class, 'listdata'])->name('returpenjualan.listdata');
Route::get('returpenjualan/searchPenjualan', [ReturpenjualanController::class, 'searchPenjualan'])->name('returpenjualan.searchPenjualan');
Route::get('returpenjualan/searchBarangRetur', [ReturpenjualanController::class, 'searchBarangRetur'])->name('returpenjualan.searchBarangRetur');
Route::get('returpenjualan/getPenjualan', [ReturpenjualanController::class, 'getPenjualan']);
Route::get('returpenjualan/getDetailPenjualan', [ReturpenjualanController::class, 'getDetailPenjualan']);


Route::get('penjualan', [PenjualanController::class, 'index']);
Route::get('penjualan/tambah', [PenjualanController::class, 'tambah']);
Route::get('penjualan/edit/{PenggunaID}', [PenjualanController::class, 'edit']);
Route::get('penjualan/getDataID', [PenjualanController::class, 'getDataID']);
Route::get('penjualan/hapus/{id}', [PenjualanController::class, 'hapus']);
Route::post('penjualan/simpanData', [PenjualanController::class, 'simpanData']);
Route::get('penjualan/listdata', [PenjualanController::class, 'listdata'])->name('penjualan.listdata');
Route::get('penjualan/cetakInvoice/{id}', [PenjualanController::class, 'cetakInvoice']);
Route::get('penjualan/cetakKwitansi/{id}', [PenjualanController::class, 'cetakKwitansi']);
Route::get('penjualan/searchInvoice', [PenjualanController::class, 'searchInvoice'])->name('penjualan.searchInvoice');
Route::get('penjualan/searchInvoicePiutang', [PenjualanController::class, 'searchInvoicePiutang'])->name('penjualan.searchInvoicePiutang');

Route::get('hutang', [HutangController::class, 'index']);
Route::get('hutang/tambah', [HutangController::class, 'tambah']);
Route::get('hutang/edit/{idhutang}', [HutangController::class, 'edit']);
Route::get('hutang/detail/{idhutang}', [HutangController::class, 'detail']);
Route::get('hutang/getDataID', [HutangController::class, 'getDataID']);
Route::get('hutang/hapus/{id}', [HutangController::class, 'hapus']);
Route::get('hutang/hapusDetailPembayaran/{id}', [HutangController::class, 'hapusDetailPembayaran']);
Route::post('hutang/simpanData', [HutangController::class, 'simpanData']);
Route::post('hutang/simpanTambahPiutang', [HutangController::class, 'simpanTambahPiutang']);
Route::get('hutang/listdata', [HutangController::class, 'listdata'])->name('hutang.listdata');
Route::get('hutang/cetakBukuHutang/{id}', [HutangController::class, 'cetakBukuHutang']);

Route::get('hutangekspedisi', [HutangekspedisiController::class, 'index']);
Route::get('hutangekspedisi/tambah', [HutangekspedisiController::class, 'tambah']);
Route::get('hutangekspedisi/edit/{idhutang}', [HutangekspedisiController::class, 'edit']);
Route::get('hutangekspedisi/detail/{idhutang}', [HutangekspedisiController::class, 'detail']);
Route::get('hutangekspedisi/getDataID', [HutangekspedisiController::class, 'getDataID']);
Route::get('hutangekspedisi/hapus/{id}', [HutangekspedisiController::class, 'hapus']);
Route::post('hutangekspedisi/simpanPembayaran', [HutangekspedisiController::class, 'simpanPembayaran']);
Route::get('hutangekspedisi/listdata', [HutangekspedisiController::class, 'listdata'])->name('hutangekspedisi.listdata');
Route::get('hutangekspedisi/cetakBukuHutang/{id}', [HutangekspedisiController::class, 'cetakBukuHutang']);


Route::get('piutang', [PiutangController::class, 'index']);
Route::get('piutang/tambah', [PiutangController::class, 'tambah']);
Route::get('piutang/edit/{idpiutang}', [PiutangController::class, 'edit']);
Route::get('piutang/detail/{idpiutang}', [PiutangController::class, 'detail']);
Route::get('piutang/getDataID', [PiutangController::class, 'getDataID']);
Route::get('piutang/hapus/{id}', [PiutangController::class, 'hapus']);
Route::get('piutang/hapusList/{id}', [PiutangController::class, 'hapusList']);
Route::post('piutang/simpanData', [PiutangController::class, 'simpanData']);
Route::post('piutang/simpanTambahPiutang', [PiutangController::class, 'simpanTambahPiutang']);
Route::get('piutang/listdata', [PiutangController::class, 'listdata'])->name('piutang.listdata');

Route::get('suratjalan', [SuratjalanController::class, 'index']);
Route::get('suratjalan/tambah', [SuratjalanController::class, 'tambah']);
Route::get('suratjalan/edit/{idsuratjalan}', [SuratjalanController::class, 'edit']);
Route::get('suratjalan/detail/{idpiutang}', [SuratjalanController::class, 'detail']);
Route::get('suratjalan/getDataID', [SuratjalanController::class, 'getDataID']);
Route::get('suratjalan/hapus/{id}', [SuratjalanController::class, 'hapus']);
Route::post('suratjalan/simpanData', [SuratjalanController::class, 'simpanData']);
Route::get('suratjalan/listdata', [SuratjalanController::class, 'listdata'])->name('suratjalan.listdata');
Route::get('suratjalan/searchInvoice', [SuratjalanController::class, 'searchInvoice'])->name('suratjalan.searchInvoice');
Route::get('suratjalan/cetaksuratjalan/{id}', [SuratjalanController::class, 'cetaksuratjalan']);


Route::get('pengeluaran', [PengeluaranController::class, 'index']);
Route::get('pengeluaran/tambah', [PengeluaranController::class, 'tambah']);
Route::get('pengeluaran/edit/{PenggunaID}', [PengeluaranController::class, 'edit']);
Route::get('pengeluaran/getDataID', [PengeluaranController::class, 'getDataID']);
Route::get('pengeluaran/hapus/{id}', [PengeluaranController::class, 'hapus']);
Route::post('pengeluaran/simpanData', [PengeluaranController::class, 'simpanData']);
Route::get('pengeluaran/listdata', [PengeluaranController::class, 'listdata'])->name('pengeluaran.listdata');

Route::get('penerimaan', [PenerimaanController::class, 'index']);
Route::get('penerimaan/tambah', [PenerimaanController::class, 'tambah']);
Route::get('penerimaan/edit/{PenggunaID}', [PenerimaanController::class, 'edit']);
Route::get('penerimaan/getDataID', [PenerimaanController::class, 'getDataID']);
Route::get('penerimaan/hapus/{id}', [PenerimaanController::class, 'hapus']);
Route::post('penerimaan/simpanData', [PenerimaanController::class, 'simpanData']);
Route::get('penerimaan/listdata', [PenerimaanController::class, 'listdata'])->name('penerimaan.listdata');


Route::get('stockopname', [StockopnameController::class, 'index']);
Route::get('stockopname/tambah', [StockopnameController::class, 'tambah']);
Route::get('stockopname/edit/{PenggunaID}', [StockopnameController::class, 'edit']);
Route::get('stockopname/getDataID', [StockopnameController::class, 'getDataID']);
Route::get('stockopname/hapus/{id}', [StockopnameController::class, 'hapus']);
Route::post('stockopname/simpanData', [StockopnameController::class, 'simpanData']);
Route::get('stockopname/listdata', [StockopnameController::class, 'listdata'])->name('stockopname.listdata');
Route::get('stockopname/cetakform', [StockopnameController::class, 'cetakform']);
Route::get('stockopname/cetakSO/{idstockopname}', [StockopnameController::class, 'cetakSO']);

Route::get('saldoawal', [SaldoawalController::class, 'index']);
Route::get('saldoawal/tambah', [SaldoawalController::class, 'tambah']);
Route::get('saldoawal/edit/{PenggunaID}', [SaldoawalController::class, 'edit']);
Route::get('saldoawal/getDataID', [SaldoawalController::class, 'getDataID']);
Route::get('saldoawal/hapus/{id}', [SaldoawalController::class, 'hapus']);
Route::post('saldoawal/simpanData', [SaldoawalController::class, 'simpanData']);
Route::get('saldoawal/listdata', [SaldoawalController::class, 'listdata'])->name('saldoawal.listdata');

Route::get('jurnal', [JurnalController::class, 'index']);
Route::get('jurnal/tambah', [JurnalController::class, 'tambah']);
Route::get('jurnal/edit/{PenggunaID}', [JurnalController::class, 'edit']);
Route::get('jurnal/getDataID', [JurnalController::class, 'getDataID']);
Route::get('jurnal/hapus/{id}', [JurnalController::class, 'hapus']);
Route::post('jurnal/simpanData', [JurnalController::class, 'simpanData']);
Route::get('jurnal/listdata', [JurnalController::class, 'listdata'])->name('jurnal.listdata');

Route::get('postingjurnal', [PostingjurnalController::class, 'index']);
Route::get('postingjurnal/getDataID', [PostingjurnalController::class, 'getDataID']);
Route::get('postingjurnal/hapus/{id}', [PostingjurnalController::class, 'hapus']);
Route::post('postingjurnal/mulaiPosting', [PostingjurnalController::class, 'mulaiPosting']);
Route::get('postingjurnal/listdata', [PostingjurnalController::class, 'listdata'])->name('postingjurnal.listdata');




Route::get('kategoribarang', [KategoribarangController::class, 'index']);
Route::get('kategoribarang/tambah', [KategoribarangController::class, 'tambah']);
Route::get('kategoribarang/edit/{PenggunaID}', [KategoribarangController::class, 'edit']);
Route::get('kategoribarang/getDataID', [KategoribarangController::class, 'getDataID']);
Route::get('kategoribarang/hapus/{id}', [KategoribarangController::class, 'hapus']);
Route::post('kategoribarang/simpanData', [KategoribarangController::class, 'simpanData']);
Route::get('kategoribarang/listdata', [KategoribarangController::class, 'listdata'])->name('kategoribarang.listdata');
Route::get('kategoribarang/searchKategori', [KategoribarangController::class, 'searchKategori'])->name('kategoribarang.searchKategori');


Route::get('jenisbarang/searchJenisBarang', [JenisbarangController::class, 'searchJenisBarang'])->name('jenisbarang.searchJenisBarang');

Route::get('barang', [BarangController::class, 'index']);
Route::get('barang/tambah', [BarangController::class, 'tambah']);
Route::get('barang/edit/{PenggunaID}', [BarangController::class, 'edit']);
Route::get('barang/getDataID', [BarangController::class, 'getDataID']);
Route::get('barang/hapus/{id}', [BarangController::class, 'hapus']);
Route::post('barang/simpanData', [BarangController::class, 'simpanData']);
Route::get('barang/listdata', [BarangController::class, 'listdata'])->name('barang.listdata');
Route::get('barang/searchKategoriBarang', [BarangController::class, 'searchKategoriBarang'])->name('barang.searchKategoriBarang');
Route::get('barang/searchAkunBarang', [BarangController::class, 'searchAkunBarang'])->name('barang.searchAkunBarang');
Route::get('barang/searchBarang', [BarangController::class, 'searchBarang'])->name('barang.searchBarang');




Route::get('akun1', [Akun1Controller::class, 'index']);
Route::get('akun1/tambah', [Akun1Controller::class, 'tambah']);
Route::get('akun1/edit/{KdAkun}', [Akun1Controller::class, 'edit']);
Route::get('akun1/getDataID', [Akun1Controller::class, 'getDataID']);
Route::get('akun1/hapus/{KdAkun}', [Akun1Controller::class, 'hapus']);
Route::post('akun1/simpanData', [Akun1Controller::class, 'simpanData']);
Route::get('akun1/listdata', [Akun1Controller::class, 'listdata'])->name('akun1.listdata');

Route::get('akun2', [Akun2Controller::class, 'index']);
Route::get('akun2/tambah', [Akun2Controller::class, 'tambah']);
Route::get('akun2/edit/{KdAkun}', [Akun2Controller::class, 'edit']);
Route::get('akun2/getDataID', [Akun2Controller::class, 'getDataID']);
Route::get('akun2/hapus/{KdAkun}', [Akun2Controller::class, 'hapus']);
Route::post('akun2/simpanData', [Akun2Controller::class, 'simpanData']);
Route::get('akun2/listdata', [Akun2Controller::class, 'listdata'])->name('akun2.listdata');
Route::get('akun2/searchParentAkun', [Akun2Controller::class, 'searchParentAkun'])->name('akun2.searchParentAkun');

Route::get('akun3', [Akun3Controller::class, 'index']);
Route::get('akun3/tambah', [Akun3Controller::class, 'tambah']);
Route::get('akun3/edit/{KdAkun}', [Akun3Controller::class, 'edit']);
Route::get('akun3/getDataID', [Akun3Controller::class, 'getDataID']);
Route::get('akun3/hapus/{KdAkun}', [Akun3Controller::class, 'hapus']);
Route::post('akun3/simpanData', [Akun3Controller::class, 'simpanData']);
Route::get('akun3/listdata', [Akun3Controller::class, 'listdata'])->name('akun3.listdata');
Route::get('akun3/searchParentAkun', [Akun3Controller::class, 'searchParentAkun'])->name('akun3.searchParentAkun');

Route::get('akun4', [Akun4Controller::class, 'index']);
Route::get('akun4/tambah', [Akun4Controller::class, 'tambah']);
Route::get('akun4/edit/{KdAkun}', [Akun4Controller::class, 'edit']);
Route::get('akun4/getDataID', [Akun4Controller::class, 'getDataID']);
Route::get('akun4/hapus/{KdAkun}', [Akun4Controller::class, 'hapus']);
Route::post('akun4/simpanData', [Akun4Controller::class, 'simpanData']);
Route::get('akun4/listdata', [Akun4Controller::class, 'listdata'])->name('akun4.listdata');
Route::get('akun4/searchParentAkun', [Akun4Controller::class, 'searchParentAkun'])->name('akun4.searchParentAkun');
Route::get('akun4/searchAkunAll', [Akun4Controller::class, 'searchAkunAll'])->name('akun4.searchAkunAll');
Route::get('akun4/searchAkunKas', [Akun4Controller::class, 'searchAkunKas'])->name('akun4.searchAkunKas');
Route::get('akun4/searchAkunPengeluaran', [Akun4Controller::class, 'searchAkunPengeluaran'])->name('akun4.searchAkunPengeluaran');
Route::get('akun4/searchAkunPenerimaan', [Akun4Controller::class, 'searchAkunPenerimaan'])->name('akun4.searchAkunPenerimaan');
Route::get('akun4/searchAkunPiutangKonsumen', [Akun4Controller::class, 'searchAkunPiutangKonsumen'])->name('akun4.searchAkunPiutangKonsumen');
Route::get('akun4/searchAkunUtangSupplier', [Akun4Controller::class, 'searchAkunUtangSupplier'])->name('akun4.searchAkunUtangSupplier');
Route::get('akun4/searchAkunUtangEkspedisi', [Akun4Controller::class, 'searchAkunUtangEkspedisi'])->name('akun4.searchAkunUtangEkspedisi');


Route::get('pengaturan', [PengaturanController::class, 'index']);
Route::get('pengaturan/tambah', [PengaturanController::class, 'tambah']);
Route::get('pengaturan/edit/{PenggunaID}', [PengaturanController::class, 'edit']);
Route::get('pengaturan/getDataID', [PengaturanController::class, 'getDataID']);
Route::get('pengaturan/hapus/{id}', [PengaturanController::class, 'hapus']);
Route::post('pengaturan/simpanData', [PengaturanController::class, 'simpanData']);
Route::get('pengaturan/listdata', [PengaturanController::class, 'listdata'])->name('pengaturan.listdata');

Route::get('lappembelian', [LappembelianController::class, 'index']);
Route::get('/lappembelian/cetak/{jenisCetakan}', [LappembelianController::class, 'cetak']);


Route::get('lapreturpembelian', [LapreturpembelianController::class, 'index']);
Route::get('lapreturpembelian/cetak/{jenisCetakan}', [LapreturpembelianController::class, 'cetak']);

Route::get('lapbukuhutang', [LapbukuhutangController::class, 'index']);
Route::get('lapbukuhutang/cetak/{jenisCetakan}', [LapbukuhutangController::class, 'cetak']);

Route::get('laprekaphutang', [LaprekaphutangController::class, 'index']);
Route::get('laprekaphutang/cetak/{jenisCetakan}', [LaprekaphutangController::class, 'cetak']);


Route::get('laputangekspedisi', [LaputangekspedisiController::class, 'index']);
Route::get('laputangekspedisi/cetak/{jenisCetakan}', [LaputangekspedisiController::class, 'cetak']);

Route::get('lappenjualan', [LappenjualanController::class, 'index']);
Route::get('lappenjualan/cetak/{jenisCetakan}', [LappenjualanController::class, 'cetak']);

Route::get('lapbonussales', [LapbonussalesController::class, 'index']);
Route::get('lapbonussales/cetak/{jenisCetakan}', [LapbonussalesController::class, 'cetak']);

Route::get('lappenagihansales', [LappenagihansalesController::class, 'index']);
Route::get('lappenagihansales/cetak/{jenisCetakan}', [LappenagihansalesController::class, 'cetak']);

Route::get('lapbukupiutang', [LapbukupiutangController::class, 'index']);
Route::get('lapbukupiutang/cetak/{jenisCetakan}', [LapbukupiutangController::class, 'cetak']);

Route::get('laprekappiutang', [LaprekappiutangController::class, 'index']);
Route::get('laprekappiutang/cetak/{jenisCetakan}', [LaprekappiutangController::class, 'cetak']);

Route::get('lapreturpenjualan', [LapreturpenjualanController::class, 'index']);
Route::get('lapreturpenjualan/cetak/{jenisCetakan}', [LapreturpenjualanController::class, 'cetak']);


Route::get('lappersediaan', [LappersediaanController::class, 'index']);
Route::get('lappersediaan/getDataID', [LappersediaanController::class, 'getDataID']);
Route::get('lappersediaan/cetak/{jenisCetakan}/{idkategori}', [LappersediaanController::class, 'cetak']);
Route::get('lappersediaan/listdata', [LappersediaanController::class, 'listdata'])->name('lappersediaan.listdata');

Route::get('lappengeluaran', [LappengeluaranController::class, 'index']);
Route::get('lappengeluaran/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{carabayar}', [LappengeluaranController::class, 'cetak']);


Route::get('lappenerimaan', [LappenerimaanController::class, 'index']);
Route::get('lappenerimaan/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{carabayar}', [LappenerimaanController::class, 'cetak']);

Route::get('lapbukubesar', [LapbukubesarController::class, 'index']);
Route::get('lapbukubesar/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{kdakun}', [LapbukubesarController::class, 'cetak']);

Route::get('lapjurnal', [LapjurnalController::class, 'index']);
Route::get('lapjurnal/cetak/{jenisCetakan}/{tglawal}/{tglakhir}', [LapjurnalController::class, 'cetak']);

Route::get('lapneracasaldo', [LapneracasaldoController::class, 'index']);
Route::get('lapneracasaldo/cetak/{jenisCetakan}/{tglawal}/{tglakhir}', [LapneracasaldoController::class, 'cetak']);

Route::get('laplabarugi', [LaplabarugiController::class, 'index']);
Route::get('laplabarugi/cetak/{tglawal}/{tglakhir}', [LaplabarugiController::class, 'cetak']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
