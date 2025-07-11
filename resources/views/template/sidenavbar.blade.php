@php
$level = session()->get('level');
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/'.session('usaha_logo')) }}" alt="CLK" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ session()->get('usaha_nama_singkat') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ session('fotopengguna') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ session()->get('namapengguna') }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ $menu == 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['pengguna', 'konsumen', 'supplier', 'akun1', 'akun2', 'akun3', 'akun4', 'pengaturan', 'wilayah', 'bank'])) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp

                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Referensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="/pengguna" class="nav-link {{ $menu == 'pengguna' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="/wilayah" class="nav-link {{ $menu == 'wilayah' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Wilayah</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/konsumen" class="nav-link {{ $menu == 'konsumen' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Konsumen</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/supplier" class="nav-link {{ $menu == 'supplier' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/bank" class="nav-link {{ $menu == 'bank' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bank</p>
                            </a>
                        </li>

                        @php
                        $active = '';
                        $menuopen = '';
                        if (in_array($menu, ['akun1', 'akun2', 'akun3', 'akun4'])) {
                        $active = 'active';
                        $menuopen = 'menu-open';
                        }
                        @endphp
                        <li class="nav-item {{ $menuopen }}">
                            <a href="#" class="nav-link {{ $active }}">
                                <i class="nav-icon fas fa-stream"></i>
                                <p>
                                    Akun
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="/akun1" class="nav-link {{ $menu == 'akun1' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Akun Lv. 1</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/akun2" class="nav-link {{ $menu == 'akun2' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Akun Lv. 2</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/akun3" class="nav-link {{ $menu == 'akun3' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Akun Lv. 3</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/akun4" class="nav-link {{ $menu == 'akun4' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Akun Lv. 4</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        {{-- <li class="nav-item">
                            <a href="/pengaturan" class="nav-link {{ $menu == 'pengaturan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li> --}}

                    </ul>
                </li>


                


                @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['kategoribarang', 'barang', 'stockopname', 'lappersediaan'])) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp
                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-shapes"></i>
                        <p>
                            Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="/kategoribarang" class="nav-link {{ $menu == 'kategoribarang' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Barang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/barang" class="nav-link {{ $menu == 'barang' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Barang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/stockopname"
                                class="nav-link {{ $menu == 'stockopname' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stock Opname</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/lappersediaan" class="nav-link {{ $menu == 'lappersediaan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Persediaan</p>
                            </a>
                        </li>

                    </ul>
                </li>

                @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['sales', 'penagihan', 'bonussales', 'lapbonussales', 'lappenagihansales'])) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp
                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-universal-access"></i>
                        <p>
                            Sales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="/sales" class="nav-link {{ $menu == 'sales' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Sales</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/penagihan" class="nav-link {{ $menu == 'penagihan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penagihan Piutang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/bonussales" class="nav-link {{ $menu == 'bonussales' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bonus Sales</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/lappenagihansales" class="nav-link {{ $menu == 'lappenagihansales' ? 'active' : '' }}">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Laporan Penagihan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/lapbonussales" class="nav-link {{ $menu == 'lapbonussales' ? 'active' : '' }}">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Laporan Bonus Sales</p>
                            </a>
                        </li>

                    </ul>
                </li>


                @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['ekspedisi', 'hutangekspedisi', 'laputangekspedisi', 'suratjalan'])) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp
                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Ekspedisi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="/ekspedisi" class="nav-link {{ $menu == 'ekspedisi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Ekspedisi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/suratjalan" class="nav-link {{ $menu == 'suratjalan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Surat Jalan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/hutangekspedisi" class="nav-link {{ $menu == 'hutangekspedisi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku Utang Ekspedisi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/laputangekspedisi" class="nav-link {{ $menu == 'laputangekspedisi' ? 'active' : '' }}">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Laporan Utang Ekspedisi</p>
                            </a>
                        </li>

                    </ul>
                </li>


                @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['pembelian', 'hutang', 'returpembelian', 'lappembelian', 'lapbukuhutang', 'lapreturpembelian', 'laprekaphutang', 'pembelianpenerimaan'])) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp
                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Pembelian
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">


                        <li class="nav-item">
                            <a href="/pembelian" class="nav-link {{ $menu == 'pembelian' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Order (PO)</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/pembelianpenerimaan" class="nav-link {{ $menu == 'pembelianpenerimaan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penerimaan PO</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/hutang" class="nav-link {{ $menu == 'hutang' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku Utang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/returpembelian" class="nav-link {{ $menu == 'returpembelian' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Retur Pembelian</p>
                            </a>
                        </li>

                        @php
                        $active = '';
                        $menuopen = '';
                        if (in_array($menu, ['lappembelian', 'lapbukuhutang', 'lapreturpembelian', 'laprekaphutang'])) {
                        $active = 'active';
                        $menuopen = 'menu-open';
                        }
                        @endphp
                        <li class="nav-item {{ $menuopen }}">
                            <a href="#" class="nav-link {{ $active }}">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="/lappembelian" class="nav-link {{ $menu == 'lappembelian' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Pembelian</p>
                                    </a>
                                </li>
        
                                <li class="nav-item">
                                    <a href="/lapbukuhutang" class="nav-link {{ $menu == 'lapbukuhutang' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Rincian Utang</p>
                                    </a>
                                </li>
        
                                <li class="nav-item">
                                    <a href="/laprekaphutang" class="nav-link {{ $menu == 'laprekaphutang' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Rekap Utang</p>
                                    </a>
                                </li>
        
                                <li class="nav-item">
                                    <a href="/lapreturpembelian" class="nav-link {{ $menu == 'lapreturpembelian' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Retur Pembelian</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        

                    </ul>
                </li>


                @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['penjualan', 'piutang', 'returpenjualan', 'lappenjualan', 'lapbukupiutang', 'lapreturpenjualan', 'laprekappiutang'])) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp
                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-stamp"></i>
                        <p>
                            Penjualan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="/penjualan" class="nav-link {{ $menu == 'penjualan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penjualan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/piutang" class="nav-link {{ $menu == 'piutang' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku Piutang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/returpenjualan" class="nav-link {{ $menu == 'returpenjualan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Retur Penjualan</p>
                            </a>
                        </li>

                        @php
                        $active = '';
                        $menuopen = '';
                        if (in_array($menu, ['lappenjualan', 'lapbukupiutang', 'lapreturpenjualan', 'laprekappiutang'])) {
                        $active = 'active';
                        $menuopen = 'menu-open';
                        }
                        @endphp

                        <li class="nav-item {{ $menuopen }}">
                            <a href="#" class="nav-link {{ $active }}">
                                <i class="nav-icon fas fa-print"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="/lappenjualan" class="nav-link {{ $menu == 'lappenjualan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Penjualan</p>
                                    </a>
                                </li>
        
                                <li class="nav-item">
                                    <a href="/lapbukupiutang" class="nav-link {{ $menu == 'lapbukupiutang' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Rincian Piutang</p>
                                    </a>
                                </li>
        
                                <li class="nav-item">
                                    <a href="/laprekappiutang" class="nav-link {{ $menu == 'laprekappiutang' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Rekap Piutang</p>
                                    </a>
                                </li>
        
                                <li class="nav-item">
                                    <a href="/lapreturpenjualan" class="nav-link {{ $menu == 'lapreturpenjualan' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lap. Retur Penjualan</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        


                    </ul>
                </li>


                @php
                $active = '';
                $menuopen = '';
                if (in_array($menu, ['pengeluaran', 'penerimaan', 'lappengeluaran', 'lappenerimaan'])) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp
                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tv"></i>
                        <p>
                            Transaksi Umum
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="/pengeluaran" class="nav-link {{ $menu == 'pengeluaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/penerimaan" class="nav-link {{ $menu == 'penerimaan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penerimaan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/lappengeluaran" class="nav-link {{ $menu == 'lappengeluaran' ? 'active' : '' }}">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Lap. Pengeluaran</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/lappenerimaan" class="nav-link {{ $menu == 'lappenerimaan' ? 'active' : '' }}">
                                <i class="fas fa-print nav-icon"></i>
                                <p>Lap. Penerimaan</p>
                            </a>
                        </li>

                        

                    </ul>
                </li>


                @php
                $active = '';
                $menuopen = '';
                if (
                in_array($menu, [
                'saldoawal',
                'postingjurnal',
                'lapjurnal',
                'lapneracasaldo',
                'laplabarugi',
                'jurnal',
                'lapbukubesar',
                ])
                ) {
                $active = 'active';
                $menuopen = 'menu-open';
                }
                @endphp

                <li class="nav-item {{ $menuopen }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Akuntansi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="/saldoawal" class="nav-link {{ $menu == 'saldoawal' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Saldo Awal Akun</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/jurnal" class="nav-link {{ $menu == 'jurnal' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jurnal Penyesuaian</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/postingjurnal" class="nav-link {{ $menu == 'postingjurnal' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Posting Jurnal</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/lapbukubesar" class="nav-link {{ $menu == 'lapbukubesar' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku Besar</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="/lapjurnal" class="nav-link {{ $menu == 'lapjurnal' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Jurnal</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/lapneracasaldo"
                                class="nav-link {{ $menu == 'lapneracasaldo' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Neraca Saldo</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/laplabarugi" class="nav-link {{ $menu == 'laplabarugi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Laba Rugi</p>
                            </a>
                        </li>



                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-warning"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>