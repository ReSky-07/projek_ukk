<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    User
                </a>
                <a class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}"
                    href="{{ route('admin.buku.index') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    Buku
                </a>
                <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"
                    href="{{ route('admin.kategoris.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Kategori
                </a>
                <a class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}"
                    href="{{ route('admin.peminjaman.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                    Peminjaman
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name }}
        </div>
    </nav>
</div>