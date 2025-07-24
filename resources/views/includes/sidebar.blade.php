<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-10">
            <i class="fa fa-file-text-o"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Surat Menyurat</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
        @if (auth()->user()->role == 'admin')
            <a class="nav-link" href="{{ route('dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        @elseif(auth()->user()->role == 'user')
            <a class="nav-link" href="{{ route('userdashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        @endif
    </li>

    <!-- Surat Masuk & Keluar (Khusus admin bidang 5) -->
    @auth
        @if (Auth::user()->role == 'admin' && Auth::user()->id_bidang == 5)
            <li class="nav-item {{ Route::is('surat.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('surat.index') }}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Surat Masuk</span>
                </a>
            </li>
            <li class="nav-item {{ Route::is('surat-keluar.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('surat-keluar.index') }}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Surat Keluar</span>
                </a>
            </li>
        @endif
    @endauth

    <!-- Disposisi -->
    <li class="nav-item {{ Route::is('disposisi.index') ? 'active' : '' }}">
        @if (auth()->user()->role == 'admin')
            <a class="nav-link" href="{{ route('disposisi.index') }}">
                <i class="fas fa-fw fa-th-list"></i>
                <span>Disposisi</span>
            </a>
        @elseif(auth()->user()->role == 'user')
            <a class="nav-link" href="{{ route('userdisposisi.index') }}">
                <i class="fas fa-fw fa-th-list"></i>
                <span>Disposisi</span>
            </a>
        @endif
    </li>

    <!-- Data Instansi -->
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin')
        <li class="nav-item {{ Route::is('instansi.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('instansi.index') }}">
                <i class="fas fa-fw fa-building"></i>
                <span>Data Instansi</span>
            </a>
        </li>
    @endif

    <!-- Kelola Bidang -->
    @auth
        @if (Auth::user()->role == 'admin' && Auth::user()->id_bidang == 5)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Kelola Bidang</span>
                </a>
                <div id="collapsePages"
                    class="collapse {{ Route::is('bidang.index') || Route::is('sub_bidang.index') ? 'show' : '' }}"
                    aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Route::is('bidang.index') ? 'active' : '' }}"
                            href="{{ route('bidang.index') }}">Bidang</a>
                    </div>
                </div>
            </li>

            <!-- Data Peran -->
            <li class="nav-item {{ Route::is('dataperan.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dataperan.index') }}">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>Data Peran</span>
                </a>
            </li>
        @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
