<!-- sidebar -->
<nav id="navbarSupportedContent" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
<div class="position-sticky py-3">
    <ul class="navbar-nav flex-column">
    <li class="nav-item">
        @if (auth()->user()->actor_id == 1)
            <a class="nav-link {{ Request::is('dashboard/petani*') ? 'text-primary' : '' }}" href="/dashboard/petani"> <i class="bi bi-house"></i> Dashboard </a>
            @else
            <a class="nav-link {{ Request::is('dashboard/produsen*') ? 'text-primary' : '' }}" href="/dashboard/produsen"> <i class="bi bi-house"></i> Dashboard </a>
        @endif
    </li>
    <li class="nav-item">
        <a class="nav-link" href="dashboard-petani-pemesanan.html"> <i class="bi bi-file-earmark"></i> Pemesanan </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="dashboard-petani-produk.html"> <i class="bi bi-cart"></i> Produk </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/forum*') ? 'text-primary' : '' }}" href="/dashboard/forum"> <i class="bi bi-people"></i> Forum Diskusi </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="dashboard-petani-monitoring.html"> <i class="bi bi-calendar2-plus"></i> Monitoring </a>
    </li>
    </ul>
    <ul class="navbar-nav flex-column">
    <li class="nav-item">
        <p class="nav-link fs-5 p-0 mb-0 mt-3 fw-medium text-muted">Save Report</p>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="dashboard-petani-transaksi.html"> <i class="bi bi-file-earmark-check"></i> Transaksi </a>
    </li>
    </ul>
</div>
</nav>
<!-- end-sidebar -->