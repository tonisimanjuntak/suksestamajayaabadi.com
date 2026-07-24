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
                <img src="{{ session('fotopengguna') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ session()->get('namapengguna') }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ $menu == 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @php
                $userMenus = session('user_menus', []);
                $currentPath = request()->path();
                $controller = explode('/', $currentPath)[0]; // ambil segmen pertama
                @endphp

                @for ($i = 0; $i < count($userMenus); $i++) @php $menuLevel0=$userMenus[$i]; @endphp @if (
                    count($menuLevel0['children'])> 0)
                    @php
                    $controllerChildren = [];
                    @endphp

                    @for ($x = 0; $x < count($menuLevel0['children']); $x++) {{-- membuat array children untuk status
                        aktif dan menu-open --}} @php if ( count($menuLevel0['children'][$x]['children']) ) { for ($y=0;
                        $y < count($menuLevel0['children'][$x]['children']) ; $y++) {
                        $controllerChildren[]=$menuLevel0['children'][$x]['children'][$y]['urlmenus']; } }else{ if
                        ($menuLevel0['children'][$x]['urlmenus'] !=null) {
                        $controllerChildren[]=$menuLevel0['children'][$x]['urlmenus']; } } @endphp @endfor <li
                        class="nav-item {{ in_array($controller, $controllerChildren) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ in_array($controller, $controllerChildren) ? 'active' : '' }}">
                            <i class="nav-icon {{ $menuLevel0['iconmenus'] }}"></i>
                            <p>
                                {{ $menuLevel0['menus'] }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @for ($j = 0; $j < count($menuLevel0['children']) ; $j++) @php
                                $menuLevel1=$menuLevel0['children'][$j]; @endphp @if ( count($menuLevel1['children'])>0
                                )
                                {{-- menus level2 --}}
                                @php
                                $controllerChildren = [];
                                @endphp

                                @for ($x = 0; $x < count($menuLevel1['children']); $x++) {{-- membuat array children
                                    untuk status aktif dan menu-open --}} @php if
                                    ($menuLevel1['children'][$x]['urlmenus'] !=null) {
                                    $controllerChildren[]=$menuLevel1['children'][$x]['urlmenus']; } @endphp @endfor <li
                                    class="nav-item {{ in_array($controller, $controllerChildren) ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ in_array($controller, $controllerChildren) ? 'active' : '' }}">
                                        <i class="nav-icon {{ $menuLevel1['iconmenus'] }}"></i>
                                        <p>
                                            {{ $menuLevel1['menus'] }}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">

                                        @for ($k = 0; $k < count($menuLevel1['children']); $k++) {!!
                                            generateLink($menuLevel1['children'][$k], $controller) !!} @endfor </ul>
                                            </li>

                                            @else
                                            {!! generateLink($menuLevel1, $controller) !!}
                                            @endif
                                            @endfor
                                    </ul>
                                    </li>

                                    @else
                                    {!! generateLink($menuLevel0, $controller) !!}
                                    @endif
                                    @endfor


                                    <li class="nav-item">
                                        <a href="{{ route('riwayatupdate') }}"
                                            class="nav-link {{ $menu == 'riwayatupdate' ? 'active' : '' }}">
                                            <i class="nav-icon fa fa-calendar"></i>
                                            <p id="pRiwayatUpdate">Riwayat Update
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('logout') }}" class="nav-link">
                                            <i class="nav-icon fa fa-sign-out-alt text-warning"></i>
                                            <p>Logout</p>
                                        </a>
                                    </li>

                        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>