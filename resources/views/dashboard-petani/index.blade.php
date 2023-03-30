<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>De-Lay | {{ $title }}</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body id="page-top">
    <!-- navbar -->
    <header class="navbar navbar-expand-md bg-body-tertiary sticky-top shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">De-Lay</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
            <li class="nav-item dropdown">
              <a class="nav-link d-inline" data-bs-toggle="dropdown" aria-expanded="false"> {{ auth()->user()->name }} <i class="bi bi-person-circle"></i></a>
              <ul class="dropdown-menu mt-2">
                <li><a class="dropdown-item" href="/">Home</a></li>
                <li><a class="dropdown-item" href="/dashboard-petani">Dashboard</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>                  
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <!-- end-navbar -->

    <div class="container-fluid">
      <div class="row">
        <!-- sidebar -->
        <nav id="navbarSupportedContent" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
          <div class="position-sticky py-3">
            <ul class="navbar-nav flex-column">
              <li class="nav-item">
                <a class="nav-link text-primary" href="dashboard-petani.html"> <i class="bi bi-house"></i> Dashboard </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard-petani-pemesanan.html"> <i class="bi bi-file-earmark"></i> Pemesanan </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard-petani-produk.html"> <i class="bi bi-cart"></i> Produk </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="dashboard-petani-forum.html"> <i class="bi bi-people"></i> Forum Diskusi </a>
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

        <!-- main -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="container-fluid">
            <h1 class="h2 mt-3">Dashboard Petani</h1>

            <hr class="featurette-divider" />

            <!-- information-all -->
            <div class="row">
              <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
                <div class="card shadow h-100 border-success py-2 input-group">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col">
                        <p class="fw-bold text-success text-uppercase mb-1">Pendapatan</p>
                        <p class="h5 mb-0 fw-bold text-muted">Rp. 100.000</p>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-piggy-bank-fill fs-1 text-muted opacity-25"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
                <div class="card shadow h-100 border-warning py-2 input-group">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col">
                        <p class="fw-bold text-warning text-uppercase mb-1">Pemesanan Tertunda</p>
                        <p class="h5 mb-0 fw-bold text-muted">50</p>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-file-earmark-fill fs-1 text-muted opacity-25"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
                <div class="card shadow h-100 border-info py-2 input-group">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col">
                        <p class="fw-bold text-info text-uppercase mb-1">Produk</p>
                        <p class="h5 mb-0 fw-bold text-muted">1</p>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-cart-fill fs-1 text-muted opacity-25"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
                <div class="card shadow h-100 border-primary py-2 input-group">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col">
                        <p class="fw-bold text-primary text-uppercase mb-1">Forum Diskusi</p>
                        <p class="h5 mb-0 fw-bold text-muted">1</p>
                      </div>
                      <div class="col-auto">
                        <i class="bi bi-chat-dots-fill fs-1 text-muted opacity-25"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end-information-all -->

            <hr class="featurette-divider" />

            <!-- weather-information -->
            <div class="container-fluid">
              <div class="rounded-3 bg-light shadow-sm">
                <div class="d-flex flex-row justify-content-center align-items-center">
                  <div class="weather__card my-4">
                    <div class="d-flex flex-row justify-content-center align-items-center">
                      <div class="p-3">
                        <h2>15&deg;</h2>
                      </div>
                      <div class="p-3">
                        <i class="bi bi-brightness-low-fill fs-2"></i>
                      </div>
                      <div class="p-3">
                        <h5>Tuesday, 10 AM</h5>
                        <h3>San Francisco</h3>
                        <span class="weather__description">Mostly Cloudy</span>
                      </div>
                    </div>
                    <div class="weather__status d-flex flex-row justify-content-center align-items-center mt-3">
                      <div class="p-4 d-flex justify-content-center align-items-center">
                        <i class="bi bi-brightness-low-fill fs-2"></i>
                        <span>10%</span>
                      </div>
                      <div class="p-4 d-flex justify-content-center align-items-center">
                        <i class="bi bi-brightness-low-fill fs-2"></i>
                        <span>0.53 mB</span>
                      </div>
                      <div class="p-4 d-flex justify-content-center align-items-center">
                        <i class="bi bi-brightness-low-fill fs-2"></i>
                        <span>10 km/h</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Weather Forecast -->
              <div class="weather__forecast d-flex flex-row overflow-x-auto justify-content-around align-items-center mt-3">
                <div class="px-4 mx-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Wed</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>13&deg;</span>
                </div>

                <div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Thu</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>15&deg;</span>
                </div>

                <div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Wed</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>15&deg;</span>
                </div>

                <div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Fri</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>13&deg;</span>
                </div>

                <div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Sat</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>13&deg;</span>
                </div>

                <div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Sun</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>11&deg;</span>
                </div>

                <div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Mon</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>11&deg;</span>
                </div>

                <div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3">
                  <span>Tue</span>
                  <i class="bi bi-brightness-low-fill text-muted fs-4"></i>
                  <span>6&deg;</span>
                </div>
              </div>
            </div>
            <!-- end-weather-information -->

            <hr class="featurette-divider" />
          </div>
        </main>
      </div>
    </div>
    <!-- end-main -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="bi bi-caret-up-fill"></i>
    </a>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>
  </body>
</html>
