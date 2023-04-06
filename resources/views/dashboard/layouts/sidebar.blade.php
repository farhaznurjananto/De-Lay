<!-- sidebar -->
<nav id="navbarSupportedContent" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse shadow-sm">
    <div class="position-sticky py-3">
        @can('petani')
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'text-success' : '' }}" href="/dashboard">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard-petani-pemesanan.html">
                        <i class="bi bi-file-earmark"></i> Pemesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/product*') ? 'text-success' : '' }}"
                        href="/dashboard/product">
                        <i class="bi bi-cart"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/monitor*') ? 'text-success' : '' }}"
                        href="/dashboard/monitor">
                        <i class="bi bi-calendar2-plus"></i> Monitoring
                    </a>
                </li>
            </ul>
        @endcan

        @can('produsen')
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'text-success' : '' }}" href="/dashboard">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <p class="nav-link fs-5 p-0 mb-0 mt-3 fw-bold text-muted">
                        Bahan Baku
                    </p>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/market*') ? 'text-success' : '' }}"
                        href="/dashboard/market">
                        <i class="bi bi-file-earmark"></i> Cari Bahan Baku
                    </a>
                </li>
                <li class="nav-item {{ Request::is('dashboard/order*') ? 'text-success' : '' }}">
                    <a class="nav-link" href="/dashboard/order">
                        <i class="bi bi-file-earmark"></i> Pemesanan
                    </a>
                </li>
            </ul>
        @endcan
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <p class="nav-link fs-5 p-0 mb-0 mt-3 fw-bold text-muted">
                    Forum Diskusi
                </p>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/forum') ? 'text-success' : '' }}" href="/dashboard/forum">
                    <i class="bi bi-people"></i> Forum Anda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/forums') ? 'text-success' : '' }}"
                    href="/dashboard/forums">
                    <i class="bi bi-globe"></i> Forum Global
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <p class="nav-link fs-5 p-0 mb-0 mt-3 fw-bold text-muted">
                    Save Report
                </p>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard-petani-transaksi.html">
                    <i class="bi bi-file-earmark-check"></i> Transaksi
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- end-sidebar -->
