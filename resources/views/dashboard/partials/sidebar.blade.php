<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand text-center" href="{{ route('dashboard.index') }}">
            <img class="logo-brand" src="{{ asset('images/logos/logo.png') }}" alt="Inventaris" style="
          width:80%" />
        </a>

        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <i class="fa-regular nav-icon fa-house me-2 fa-fw"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/aset') ? 'active' : '' }}"
                    href="/dashboard/aset">
                    <i class="fa-solid fa-container-storage me-2 fa-fw"></i>
                    Aset
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/laporan*') ? '' : 'collapsed' }}" href="#!"
                    data-bs-toggle="collapse" data-bs-target="#navLaporan" aria-expanded="false"
                    aria-controls="navLaporan">
                    <i class="fa-solid fa-book me-2 fa-fw"></i>
                    Laporan
                </a>

                <div id="navLaporan" class="collapse {{ Request::is('dashboard/laporan*') ? 'show' : '' }}"
                    data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/laporan/laporan-barang/*') ? 'active' : '' }}"
                                href="{{ route('laporan-barang-utama.index') }}">
                                Laporan Barang
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow {{ Request::is('dashboard/laporan/laporan-peminjaman/*') ? 'active' : '' }}"
                                href="{{ route('laporan-peminjaman-utama.index') }}">
                                Laporan Peminjaman
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <li class="nav-item px-5">
                <hr class=" nav-link text-white p-0">
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/barang') ? 'active' : '' }}"
                    href="/dashboard/barang">
                    <i class="fa-solid fa-box-open me-2 fa-fw"></i>
                    Barang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/variant') ? 'active' : '' }}"
                    href="/dashboard/variant">
                    <i class="fa-solid fa-sitemap me-2 fa-fw"></i>
                    Variant Barang
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/ruang') ? 'active' : '' }}"
                    href="/dashboard/ruang">
                    <i class="fa-solid fa-building me-2 fa-fw"></i>
                    Ruangan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/unit') ? 'active' : '' }}"
                    href="/dashboard/unit">
                    <i class="fa-regular fa-buildings me-2 fa-fw"></i>
                    Unit
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link has-arrow {{ Request::is('dashboard/user') ? 'active' : '' }}"
                    href="/dashboard/user">
                    <i class="fa-solid fa-user me-2 fa-fw"></i>
                    User
                </a>
            </li>

        </ul>
    </div>
</nav>
