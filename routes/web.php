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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('home/getInfoBox', 'getInfoBox');
    Route::get('home/getInfoGrafikPenjualan', 'getInfoGrafikPenjualan');    
});


Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('login/loadMenus', 'loadMenus');    
});


//chek hak akse menus di proses di middleware
Route::middleware(['check.menu.access'])->group(function () {
    
        Route::controller(PenggunaController::class)->group(function () {
            Route::get('pengguna', 'index');
            Route::get('pengguna/tambah', 'tambah');
            Route::get('pengguna/edit/{PenggunaID}', 'edit');
            Route::get('pengguna/otorisasi/{PenggunaID}', 'otorisasi');
            Route::get('pengguna/getDataID', 'getDataID');
            Route::get('pengguna/hapus/{id}', 'hapus');
            Route::post('pengguna/simpanData', 'simpanData');
            Route::post('pengguna/simpanotorisasi', 'simpanotorisasi');
            Route::get('pengguna/listdata', 'listdata')->name('pengguna.listdata');
            Route::get('pengguna/searchOtorisasi', 'searchOtorisasi')->name('pengguna.searchOtorisasi');
            Route::get('pengguna/searchKasir', 'searchKasir')->name('pengguna.searchKasir');
            Route::get('pengguna/getOtorisasi', 'getOtorisasi')->name('pengguna.getOtorisasi');
        });

    
        Route::controller(WilayahController::class)->group(function () {
            Route::get('wilayah', 'index');
            Route::get('wilayah/tambah', 'tambah');
            Route::get('wilayah/edit/{PenggunaID}', 'edit');
            Route::get('wilayah/getDataID', 'getDataID');
            Route::get('wilayah/hapus/{id}', 'hapus');
            Route::post('wilayah/simpanData', 'simpanData');
            Route::get('wilayah/listdata', 'listdata')->name('wilayah.listdata');
            Route::get('wilayah/searchWilayah', 'searchWilayah')->name('wilayah.searchWilayah');
        });

        Route::controller(KonsumenController::class)->group(function () {
            Route::get('konsumen', 'index');
            Route::get('konsumen/tambah', 'tambah');
            Route::get('konsumen/edit/{PenggunaID}', 'edit');
            Route::get('konsumen/getDataID', 'getDataID');
            Route::get('konsumen/hapus/{id}', 'hapus');
            Route::post('konsumen/simpanData', 'simpanData');
            Route::get('konsumen/listdata', 'listdata')->name('konsumen.listdata');
            Route::get('konsumen/searchWilayah', 'searchWilayah')->name('konsumen.searchWilayah');
            Route::get('konsumen/searchKonsumen', 'searchKonsumen')->name('konsumen.searchKonsumen');
        });


        Route::controller(EkspedisiController::class)->group(function () {
            Route::get('ekspedisi', 'index');
            Route::get('ekspedisi/tambah', 'tambah');
            Route::get('ekspedisi/edit/{PenggunaID}', 'edit');
            Route::get('ekspedisi/getDataID', 'getDataID');
            Route::get('ekspedisi/hapus/{id}', 'hapus');
            Route::post('ekspedisi/simpanData', 'simpanData');
            Route::get('ekspedisi/listdata', 'listdata')->name('ekspedisi.listdata');
            Route::get('ekspedisi/searchEkspedisi', 'searchEkspedisi')->name('ekspedisi.searchEkspedisi');
        });

        Route::controller(JenisekspedisiController::class)->group(function () {
            Route::get('jenisekspedisi/searchJenisEkspedisi', 'searchJenisEkspedisi')->name('jenisekspedisi.searchJenisEkspedisi');            
        });

        Route::controller(SalesController::class)->group(function () {
            Route::get('sales', 'index');
            Route::get('sales/tambah', 'tambah');
            Route::get('sales/edit/{PenggunaID}', 'edit');
            Route::get('sales/getDataID', 'getDataID');
            Route::get('sales/hapus/{id}', 'hapus');
            Route::post('sales/simpanData', 'simpanData');
            Route::get('sales/listdata', 'listdata')->name('sales.listdata');
            Route::get('sales/searchSales', 'searchSales')->name('sales.searchSales');
            Route::get('sales/getSalesByKonsumen', 'getSalesByKonsumen');            
        });

        Route::controller(PenagihanController::class)->group(function () {
            Route::get('penagihan', 'index');
            Route::get('penagihan/tambah', 'tambah');
            Route::get('penagihan/edit/{idsuratjalan}', 'edit');
            Route::get('penagihan/detail/{idpiutang}', 'detail');
            Route::get('penagihan/getDataID', 'getDataID');
            Route::get('penagihan/hapus/{id}', 'hapus');
            Route::post('penagihan/simpanData', 'simpanData');
            Route::get('penagihan/listdata', 'listdata')->name('penagihan.listdata');
            Route::get('penagihan/getPiutangBelumLunas', 'getPiutangBelumLunas')->name('penagihan.getPiutangBelumLunas');
            Route::get('penagihan/getPiutangID', 'getPiutangID');
            Route::get('penagihan/cetak/{idpenagihan}', 'cetak');            
        });

        Route::controller(BonussalesController::class)->group(function () {
            Route::get('bonussales', 'index');
            Route::get('bonussales/tambah', 'tambah');
            Route::get('bonussales/edit/{PenggunaID}', 'edit');
            Route::get('bonussales/getDataID', 'getDataID');
            Route::get('bonussales/hapus/{id}', 'hapus');
            Route::post('bonussales/simpanData', 'simpanData');
            Route::get('bonussales/listdata', 'listdata')->name('bonussales.listdata');
            Route::get('bonussales/searchSales', 'searchSales')->name('bonussales.searchSales');
            Route::get('bonussales/getSalesByKonsumen', 'getSalesByKonsumen');
            Route::get('bonussales/getBonus', 'getBonus');
            Route::get('bonussales/cetak/{idbonus}', 'cetak');            
        });

        Route::controller(SupplierController::class)->group(function () {            
            Route::get('supplier', 'index');
            Route::get('supplier/tambah', 'tambah');
            Route::get('supplier/edit/{PenggunaID}', 'edit');
            Route::get('supplier/getDataID', 'getDataID');
            Route::get('supplier/hapus/{id}', 'hapus');
            Route::post('supplier/simpanData', 'simpanData');
            Route::get('supplier/listdata', 'listdata')->name('supplier.listdata');
            Route::get('supplier/searchSupplier', 'searchSupplier')->name('supplier.searchSupplier');
        });

        Route::controller(JenispiutangController::class)->group(function () {
            Route::get('jenispiutang/searchJenisPiutang', 'searchJenisPiutang')->name('jenispiutang.searchJenisPiutang');
        });


        Route::controller(BankController::class)->group(function () {
            Route::get('bank', 'index');
            Route::get('bank/tambah', 'tambah');
            Route::get('bank/edit/{PenggunaID}', 'edit');
            Route::get('bank/getDataID', 'getDataID');
            Route::get('bank/hapus/{id}', 'hapus');
            Route::post('bank/simpanData', 'simpanData');
            Route::get('bank/listdata', 'listdata')->name('bank.listdata');
            Route::get('bank/searchBank', 'searchBank')->name('bank.searchBank');            
        });

        Route::controller(PembelianController::class)->group(function () {
            Route::get('pembelian', 'index');
            Route::get('pembelian/tambah', 'tambah');
            Route::get('pembelian/edit/{PenggunaID}', 'edit');
            Route::get('pembelian/getDataID', 'getDataID');
            Route::get('pembelian/hapus/{id}', 'hapus');
            Route::post('pembelian/simpanData', 'simpanData');
            Route::get('pembelian/listdata', 'listdata')->name('pembelian.listdata');
            Route::get('pembelian/searchFaktur', 'searchFaktur')->name('pembelian.searchFaktur');
            Route::get('pembelian/searchFakturHutang', 'searchFakturHutang')->name('pembelian.searchFakturHutang');            
        });

        Route::controller(PembelianpenerimaanController::class)->group(function () {
            Route::get('pembelianpenerimaan', 'index');
            Route::get('pembelianpenerimaan/tambah', 'tambah');
            Route::get('pembelianpenerimaan/edit/{PenggunaID}', 'edit');
            Route::get('pembelianpenerimaan/getDataID', 'getDataID');
            Route::get('pembelianpenerimaan/hapus/{id}', 'hapus');
            Route::post('pembelianpenerimaan/simpanData', 'simpanData');
            Route::get('pembelianpenerimaan/listdata', 'listdata')->name('pembelianpenerimaan.listdata');
            Route::get('pembelianpenerimaan/searchFaktur', 'searchFaktur')->name('pembelianpenerimaan.searchFaktur');
            Route::get('pembelianpenerimaan/searchFakturHutang', 'searchFakturHutang')
                ->name('pembelianpenerimaan.searchFakturHutang');
            Route::get('pembelianpenerimaan/searchPO', 'searchPO')->name('pembelianpenerimaan.searchPO');
            Route::get('pembelianpenerimaan/getPurchaseOrder', 'getPurchaseOrder')->name('pembelianpenerimaan.getPurchaseOrder');
            Route::get('pembelianpenerimaan/getDetailId', 'getDetailId');
            Route::get('pembelianpenerimaan/getModalInfo', 'getModalInfo');            
        });

        Route::controller(ReturpembelianController::class)->group(function () {
            Route::get('returpembelian', 'index');
            Route::get('returpembelian/tambah', 'tambah');
            Route::get('returpembelian/getDataID', 'getDataID');
            Route::get('returpembelian/hapus/{id}', 'hapus');
            Route::post('returpembelian/simpanData', 'simpanData');
            Route::get('returpembelian/listdata', 'listdata')->name('returpembelian.listdata');
            Route::get('returpembelian/searchPembelian', 'searchPembelian')->name('returpembelian.searchPembelian');
            Route::get('returpembelian/searchBarangRetur', 'searchBarangRetur')->name('returpembelian.searchBarangRetur');
            Route::get('returpembelian/getPembelian', 'getPembelian');
            Route::get('returpembelian/getDetailPembelian', 'getDetailPembelian');
            Route::get('returpembelian/ubahstatus/{idreturpembelian}', 'ubahstatus');
            Route::post('returpembelian/simpanubahstatus', 'simpanubahstatus');            
        });

        Route::controller(ReturpenjualanController::class)->group(function () {
            Route::get('returpenjualan', 'index');
            Route::get('returpenjualan/tambah', 'tambah');
            Route::get('returpenjualan/lihat/{PenggunaID}', 'lihat');
            Route::get('returpenjualan/getDataID', 'getDataID');
            Route::get('returpenjualan/hapus/{id}', 'hapus');
            Route::post('returpenjualan/simpanData', 'simpanData');
            Route::get('returpenjualan/listdata', 'listdata')->name('returpenjualan.listdata');
            Route::get('returpenjualan/searchPenjualan', 'searchPenjualan')->name('returpenjualan.searchPenjualan');
            Route::get('returpenjualan/searchBarangRetur', 'searchBarangRetur')->name('returpenjualan.searchBarangRetur');
            Route::get('returpenjualan/getPenjualan', 'getPenjualan');
            Route::get('returpenjualan/getDetailPenjualan', 'getDetailPenjualan');            
        });

        Route::controller(PenjualanController::class)->group(function () {
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
        });

        Route::controller(HutangController::class)->group(function () {
            Route::get('hutang', 'index');
            Route::get('hutang/tambah', 'tambah');
            Route::get('hutang/edit/{idhutang}', 'edit');
            Route::get('hutang/detail/{idhutang}', 'detail');
            Route::get('hutang/getDataID', 'getDataID');
            Route::get('hutang/hapus/{id}', 'hapus');
            Route::get('hutang/hapusDetailPembayaran/{id}', 'hapusDetailPembayaran');
            Route::post('hutang/simpanData', 'simpanData');
            Route::post('hutang/simpanTambahPiutang', 'simpanTambahPiutang');
            Route::get('hutang/listdata', 'listdata')->name('hutang.listdata');
            Route::get('hutang/cetakBukuHutang/{id}', 'cetakBukuHutang');            
        });

        Route::controller(HutangekspedisiController::class)->group(function () {
            Route::get('hutangekspedisi', 'index');
            Route::get('hutangekspedisi/tambah', 'tambah');
            Route::get('hutangekspedisi/edit/{idhutang}', 'edit');
            Route::get('hutangekspedisi/detail/{idhutang}', 'detail');
            Route::get('hutangekspedisi/getDataID', 'getDataID');
            Route::get('hutangekspedisi/hapus/{id}', 'hapus');
            Route::post('hutangekspedisi/simpanPembayaran', 'simpanPembayaran');
            Route::get('hutangekspedisi/listdata', 'listdata')->name('hutangekspedisi.listdata');
            Route::get('hutangekspedisi/cetakBukuHutang/{id}', 'cetakBukuHutang');            
        });

        Route::controller(PiutangController::class)->group(function () {
            Route::get('piutang', 'index');
            Route::get('piutang/tambah', 'tambah');
            Route::get('piutang/edit/{idpiutang}', 'edit');
            Route::get('piutang/detail/{idpiutang}', 'detail');
            Route::get('piutang/getDataID', 'getDataID');
            Route::get('piutang/hapus/{id}', 'hapus');
            Route::get('piutang/hapusList/{id}', 'hapusList');
            Route::post('piutang/simpanData', 'simpanData');
            Route::post('piutang/simpanTambahPiutang', 'simpanTambahPiutang');
            Route::get('piutang/listdata', 'listdata')->name('piutang.listdata');            
        });

        Route::controller(SuratjalanController::class)->group(function () {            
            Route::get('suratjalan', 'index');
            Route::get('suratjalan/tambah', 'tambah');
            Route::get('suratjalan/edit/{idsuratjalan}', 'edit');
            Route::get('suratjalan/detail/{idpiutang}', 'detail');
            Route::get('suratjalan/getDataID', 'getDataID');
            Route::get('suratjalan/hapus/{id}', 'hapus');
            Route::post('suratjalan/simpanData', 'simpanData');
            Route::get('suratjalan/listdata', 'listdata')->name('suratjalan.listdata');
            Route::get('suratjalan/searchInvoice', 'searchInvoice')->name('suratjalan.searchInvoice');
            Route::get('suratjalan/cetaksuratjalan/{id}', 'cetaksuratjalan');
        });

        Route::controller(PengeluaranController::class)->group(function () {
            Route::get('pengeluaran', 'index');
            Route::get('pengeluaran/tambah', 'tambah');
            Route::get('pengeluaran/edit/{PenggunaID}', 'edit');
            Route::get('pengeluaran/getDataID', 'getDataID');
            Route::get('pengeluaran/hapus/{id}', 'hapus');
            Route::post('pengeluaran/simpanData', 'simpanData');
            Route::get('pengeluaran/listdata', 'listdata')->name('pengeluaran.listdata');            
        });

        Route::controller(PenerimaanController::class)->group(function () {
            Route::get('penerimaan', 'index');
            Route::get('penerimaan/tambah', 'tambah');
            Route::get('penerimaan/edit/{PenggunaID}', 'edit');
            Route::get('penerimaan/getDataID', 'getDataID');
            Route::get('penerimaan/hapus/{id}', 'hapus');
            Route::post('penerimaan/simpanData', 'simpanData');
            Route::get('penerimaan/listdata', 'listdata')->name('penerimaan.listdata');            
        });

        Route::controller(StockopnameController::class)->group(function () {
            Route::get('stockopname', 'index');
            Route::get('stockopname/tambah', 'tambah');
            Route::get('stockopname/edit/{PenggunaID}', 'edit');
            Route::get('stockopname/getDataID', 'getDataID');
            Route::get('stockopname/hapus/{id}', 'hapus');
            Route::post('stockopname/simpanData', 'simpanData');
            Route::get('stockopname/listdata', 'listdata')->name('stockopname.listdata');
            Route::get('stockopname/cetakform', 'cetakform');
            Route::get('stockopname/cetakSO/{idstockopname}', 'cetakSO');            
        });

        Route::controller(SaldoawalController::class)->group(function () {
            Route::get('saldoawal', 'index');
            Route::get('saldoawal/tambah', 'tambah');
            Route::get('saldoawal/edit/{PenggunaID}', 'edit');
            Route::get('saldoawal/getDataID', 'getDataID');
            Route::get('saldoawal/hapus/{id}', 'hapus');
            Route::post('saldoawal/simpanData', 'simpanData');
            Route::get('saldoawal/listdata', 'listdata')->name('saldoawal.listdata');            
        });

        Route::controller(JurnalController::class)->group(function () {
            Route::get('jurnal', 'index');
            Route::get('jurnal/tambah', 'tambah');
            Route::get('jurnal/edit/{PenggunaID}', 'edit');
            Route::get('jurnal/getDataID', 'getDataID');
            Route::get('jurnal/hapus/{id}', 'hapus');
            Route::post('jurnal/simpanData', 'simpanData');
            Route::get('jurnal/listdata', 'listdata')->name('jurnal.listdata');            
        });

        Route::controller(PostingjurnalController::class)->group(function () {
            Route::get('postingjurnal', 'index');
            Route::get('postingjurnal/getDataID', 'getDataID');
            Route::get('postingjurnal/hapus/{id}', 'hapus');
            Route::post('postingjurnal/mulaiPosting', 'mulaiPosting');
            Route::get('postingjurnal/listdata', 'listdata')->name('postingjurnal.listdata');            
        });

        Route::controller(KategoribarangController::class)->group(function () {
            Route::get('kategoribarang', 'index');
            Route::get('kategoribarang/tambah', 'tambah');
            Route::get('kategoribarang/edit/{PenggunaID}', 'edit');
            Route::get('kategoribarang/getDataID', 'getDataID');
            Route::get('kategoribarang/hapus/{id}', 'hapus');
            Route::post('kategoribarang/simpanData', 'simpanData');
            Route::get('kategoribarang/listdata', 'listdata')->name('kategoribarang.listdata');
            Route::get('kategoribarang/searchKategori', 'searchKategori')->name('kategoribarang.searchKategori');            
        });

        Route::controller(JenisbarangController::class)->group(function () {
            Route::get('jenisbarang/searchJenisBarang', 'searchJenisBarang')->name('jenisbarang.searchJenisBarang');            
        });

        Route::controller(BarangController::class)->group(function () {
            Route::get('barang', 'index');
            Route::get('barang/tambah', 'tambah');
            Route::get('barang/edit/{PenggunaID}', 'edit');
            Route::get('barang/getDataID', 'getDataID');
            Route::get('barang/hapus/{id}', 'hapus');
            Route::post('barang/simpanData', 'simpanData');
            Route::get('barang/listdata', 'listdata')->name('barang.listdata');
            Route::get('barang/searchKategoriBarang', 'searchKategoriBarang')->name('barang.searchKategoriBarang');
            Route::get('barang/searchAkunBarang', 'searchAkunBarang')->name('barang.searchAkunBarang');
            Route::get('barang/searchBarang', 'searchBarang')->name('barang.searchBarang');            
        });

        Route::controller(Akun1Controller::class)->group(function () {
            Route::get('akun1', 'index');
            Route::get('akun1/tambah', 'tambah');
            Route::get('akun1/edit/{KdAkun}', 'edit');
            Route::get('akun1/getDataID', 'getDataID');
            Route::get('akun1/hapus/{KdAkun}', 'hapus');
            Route::post('akun1/simpanData', 'simpanData');
            Route::get('akun1/listdata', 'listdata')->name('akun1.listdata');            
        });

        Route::controller(Akun2Controller::class)->group(function () {
            Route::get('akun2', 'index');
            Route::get('akun2/tambah', 'tambah');
            Route::get('akun2/edit/{KdAkun}', 'edit');
            Route::get('akun2/getDataID', 'getDataID');
            Route::get('akun2/hapus/{KdAkun}', 'hapus');
            Route::post('akun2/simpanData', 'simpanData');
            Route::get('akun2/listdata', 'listdata')->name('akun2.listdata');
            Route::get('akun2/searchParentAkun', 'searchParentAkun')->name('akun2.searchParentAkun');
        });

        Route::controller(Akun3Controller::class)->group(function () {
            Route::get('akun3', 'index');
            Route::get('akun3/tambah', 'tambah');
            Route::get('akun3/edit/{KdAkun}', 'edit');
            Route::get('akun3/getDataID', 'getDataID');
            Route::get('akun3/hapus/{KdAkun}', 'hapus');
            Route::post('akun3/simpanData', 'simpanData');
            Route::get('akun3/listdata', 'listdata')->name('akun3.listdata');
            Route::get('akun3/searchParentAkun', 'searchParentAkun')->name('akun3.searchParentAkun');            
        });

        Route::controller(Akun4Controller::class)->group(function () {
            Route::get('akun4', 'index');
            Route::get('akun4/tambah', 'tambah');
            Route::get('akun4/edit/{KdAkun}', 'edit');
            Route::get('akun4/getDataID', 'getDataID');
            Route::get('akun4/hapus/{KdAkun}', 'hapus');
            Route::post('akun4/simpanData', 'simpanData');
            Route::get('akun4/listdata', 'listdata')->name('akun4.listdata');
            Route::get('akun4/searchParentAkun', 'searchParentAkun')->name('akun4.searchParentAkun');
            Route::get('akun4/searchAkunAll', 'searchAkunAll')->name('akun4.searchAkunAll');
            Route::get('akun4/searchAkunKas', 'searchAkunKas')->name('akun4.searchAkunKas');
            Route::get('akun4/searchAkunPengeluaran', 'searchAkunPengeluaran')->name('akun4.searchAkunPengeluaran');
            Route::get('akun4/searchAkunPenerimaan', 'searchAkunPenerimaan')->name('akun4.searchAkunPenerimaan');
            Route::get('akun4/searchAkunPiutangKonsumen', 'searchAkunPiutangKonsumen')->name('akun4.searchAkunPiutangKonsumen');
            Route::get('akun4/searchAkunUtangSupplier', 'searchAkunUtangSupplier')->name('akun4.searchAkunUtangSupplier');
            Route::get('akun4/searchAkunUtangEkspedisi', 'searchAkunUtangEkspedisi')->name('akun4.searchAkunUtangEkspedisi');            
        });

        Route::controller(PengaturanController::class)->group(function () {
            Route::get('pengaturan', 'index');
            Route::get('pengaturan/tambah', 'tambah');
            Route::get('pengaturan/edit/{PenggunaID}', 'edit');
            Route::get('pengaturan/getDataID', 'getDataID');
            Route::get('pengaturan/hapus/{id}', 'hapus');
            Route::post('pengaturan/simpanData', 'simpanData');
            Route::get('pengaturan/listdata', 'listdata')->name('pengaturan.listdata');            
        });

        Route::controller(LappembelianController::class)->group(function () {
            Route::get('lappembelian', 'index');
            Route::get('/lappembelian/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LapreturpembelianController::class)->group(function () {
            Route::get('lapreturpembelian', 'index');
            Route::get('lapreturpembelian/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LapbukuhutangController::class)->group(function () {
            Route::get('lapbukuhutang', 'index');
            Route::get('lapbukuhutang/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LaprekaphutangController::class)->group(function () {
            Route::get('laprekaphutang', 'index');
            Route::get('laprekaphutang/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LaputangekspedisiController::class)->group(function () {
            Route::get('laputangekspedisi', 'index');
            Route::get('laputangekspedisi/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LappenjualanController::class)->group(function () {
            Route::get('lappenjualan', 'index');
            Route::get('lappenjualan/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LapbonussalesController::class)->group(function () {
            Route::get('lapbonussales', 'index');
            Route::get('lapbonussales/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LappenagihansalesController::class)->group(function () {
            Route::get('lappenagihansales', 'index');
            Route::get('lappenagihansales/cetak/{jenisCetakan}', 'cetak');            
        });

        Route::controller(LapbukupiutangController::class)->group(function () {
            Route::get('lapbukupiutang', 'index');
            Route::get('lapbukupiutang/cetak/{jenisCetakan}', 'cetak');
        });

        Route::controller(LaprekappiutangController::class)->group(function () {
            Route::get('laprekappiutang', 'index');
            Route::get('laprekappiutang/cetak/{jenisCetakan}', 'cetak');            
        });

        Route:: controller(LapreturpenjualanController::class)->group(function () {
            Route::get('lapreturpenjualan', [LapreturpenjualanController::class, 'index']);
            Route::get('lapreturpenjualan/cetak/{jenisCetakan}', [LapreturpenjualanController::class, 'cetak']);            
        });

        Route::controller(LappersediaanController::class)->group(function () {
            Route::get('lappersediaan', 'index');
            Route::get('lappersediaan/getDataID', 'getDataID');
            Route::get('lappersediaan/cetak/{jenisCetakan}/{idkategori}', 'cetak');
            Route::get('lappersediaan/listdata', 'listdata')->name('lappersediaan.listdata');
        });

        Route::controller(LappengeluaranController::class)->group(function () {
            Route::get('lappengeluaran', 'index');
            Route::get('lappengeluaran/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{carabayar}', 'cetak');            
        });

        Route::controller(LappenerimaanController::class)->group(function () {
            Route::get('lappenerimaan', 'index');
            Route::get('lappenerimaan/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{carabayar}', 'cetak');            
        });

        Route::controller(LapbukubesarController::class)->group(function () {
            Route::get('lapbukubesar', 'index');
            Route::get('lapbukubesar/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{kdakun}', 'cetak');            
        });

        Route::controller(LapjurnalController::class)->group(function () {
            Route::get('lapjurnal', 'index');
            Route::get('lapjurnal/cetak/{jenisCetakan}/{tglawal}/{tglakhir}', 'cetak');            
        });

        Route::controller(LapneracasaldoController::class)->group(function () {
            Route::get('lapneracasaldo', 'index');
            Route::get('lapneracasaldo/cetak/{jenisCetakan}/{tglawal}/{tglakhir}', 'cetak');            
        });

        Route::controller(LaplabarugiController::class)->group(function () {
            Route::get('laplabarugi', 'index');
            Route::get('laplabarugi/cetak/{tglawal}/{tglakhir}', 'cetak');            
        });

});
