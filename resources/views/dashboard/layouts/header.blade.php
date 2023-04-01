<!-- navbar -->
<header class="navbar navbar-expand-md bg-body-tertiary sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">De-Lay</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item dropdown dropstart">
                    <a class="nav-link d-inline" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                        <i class="bi bi-person-circle"></i></a>
                    <ul class="dropdown-menu mt-2">
                        <li><a class="dropdown-item" href="/">Home</a></li>
                        <li>
                            <a class="dropdown-item" href="/dashboard">Dashboard</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- end-navbar -->
