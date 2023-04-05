<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>De-Lay</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body id="page-top">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">De-Lay</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#product">Produk</a>
                    </li>
                    <li class="nav-item dropdown justify-center">
                        @auth
                            <a class="nav-link p-0 mx-0 my-2" href="#" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ auth()->user()->name }}
                                <i class="bi bi-person-circle"></i></a>
                            <ul class="dropdown-menu mt-2">
                                <li>
                                    <a class="dropdown-item" href="/">Home</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/profile">Profile</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <a class="btn btn-outline-success mx-2" href="/login">Masuk</a>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- end-navbar -->

    <!-- main -->
    <main>
        <!-- carousel -->
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid w-100" src="/img/kedelai_1.png" alt="kedelai-1" />
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1 class="fw-bold">Website Monitoring.</h1>
                            <p>
                                Menyediakan fitur monitoring penjadwalan penanaman kedelai.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid w-100" src="/img/kedelai_2.png" alt="kedelai_2" />
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 class="fw-bold">Website Pencatatan Laba Rugi.</h1>
                            <p>
                                Meyediakan fitur pencatatan keuangan laba rugi.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid w-100" src="/img/kedelai_3.png" alt="kedelai-3" />
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1 class="fw-bold">Website Dikusi.</h1>
                            <p>
                                Menyediakan fitur forum diskusi untuk berbagi ilmu dan pengalaman.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- end-carousel -->

        <div class="container my-5">
            <!-- about -->
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">
                        De-Lay
                    </h2>
                    <p class="lead">
                        Some great placeholder content for the first
                        featurette here. Imagine some exciting prose here.
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
                        src="/img/landing-img_1.png" alt="landing-img_1" style="width:500px height:500px">
                </div>
            </div>
            <!-- end-about -->

            <hr class="featurette-divider my-5" />

            <!-- user -->
            <div class="row text-center" id="services">
                <h1 class="">Layanan</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Inventore neque voluptatem possimus asperiores! At
                    nihil, nostrum aperiam cum tempora voluptatum maiores
                    nemo, voluptate voluptatem vero reprehenderit, maxime
                    laudantium officia suscipit numquam molestiae libero
                    totam quisquam qui magnam ut! Hic porro nisi error nobis
                    et amet! Voluptatibus odit minima repudiandae beatae
                    quisquam rerum alias. Voluptatum, ullam voluptatibus
                    aliquam doloremque voluptas natus?
                </p>
                <div class="d-flex justify-content-around flex-wrap">
                    <div class="col-lg-3 d-flex flex-column align-items-center justify-content-between">
                        <img class="rounded-circle my-3" src="/img/farmer-avatar.png" alt="farmer-avatar"
                            style="width:200px" />
                        <h2 class="fw-normal">Petani Kedelai</h2>
                        <p>
                            Some representative placeholder content for the
                            three columns of text below the carousel. This
                            is the first column.
                        </p>
                    </div>
                    <div class="col-lg-3 d-flex flex-column align-items-center">
                        <img class="rounded-circle my-3" src="/img/produsen-avatar.png" alt="produsen-avatar"
                            style="width:200px" />
                        <h2 class="fw-normal">Produsen Susu Kedelai</h2>
                        <p>
                            Another exciting bit of representative
                            placeholder content. This time, we've moved on
                            to the second column.
                        </p>
                    </div>
                </div>
            </div>
            <!-- end-user -->

            <hr class="featurette-divider my-5" />

            <!-- weather -->
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">
                        Monitoring Penjadwalan Pertanian Kedelai.
                    </h2>
                    <p class="lead">
                        Another featurette? Of course. More placeholder
                        content here to give you an idea of how this layout
                        would work with some actual real-world content in
                        place.
                    </p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
                        src="/img/monitoring.png" alt="monitoring" style="width:500px">
                </div>
            </div>
            <!-- end-weather -->

            <hr class="featurette-divider my-5" />

            <!-- menejemen -->
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">
                        Pencatatan Keuangan Laba Rugi.
                    </h2>
                    <p class="lead">
                        Some great placeholder content for the first
                        featurette here. Imagine some exciting prose here.
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
                        src="/img/keuangan.png" alt="keuangan" style="width:500px">
                </div>
            </div>
            <!-- end-menejemen -->

            <hr class="featurette-divider my-5" />

            <!-- product -->
            <div class="row d-flex justify-content-center" id="product">
                <h1 class="text-center">Produk</h1>
                <p class="text-center">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Inventore neque voluptatem possimus asperiores! At
                    nihil, nostrum aperiam cum tempora voluptatum maiores
                    nemo, voluptate voluptatem vero reprehenderit, maxime
                    laudantium officia suscipit numquam molestiae libero
                    totam quisquam qui magnam ut! Hic porro nisi error nobis
                    et amet! Voluptatibus odit minima repudiandae beatae
                    quisquam rerum alias. Voluptatum, ullam voluptatibus
                    aliquam doloremque voluptas natus?
                </p>
                <div class="card my-3 mx-3 p-0" style="max-width: 1080px">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img class="img-fluid rounded-start h-100" src="/img/susu_kedelai.webp"
                                alt="susu_kedelai" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Susu Kedelai</h5>
                                <p class="card-text">
                                    Sari kedelai atau susu kedelai adalah sari nabati yang diproses dengan cara merendam
                                    dan menggiling kedelai, merebus campuran, dan menyaring partikel yang tersisa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-product -->

            <hr class="featurette-divider mt-5" />
        </div>
    </main>
    <!-- end-main -->

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Home</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Features</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Pricing</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">FAQs</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">About</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Home</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Features</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Pricing</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">FAQs</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">About</a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Home</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Features</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">Pricing</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">FAQs</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-muted">About</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-5 offset-md-1 mb-3">
                    <h5>Subscribe to our newsletter</h5>
                    <p>
                        Monthly digest of what's new and exciting from us.
                    </p>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between pt-3 border-top align-items-center">
                <p>&copy; 2023 De-Lay, All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3">
                        <a class="link-dark" href="#"><i class="bi bi-twitter"></i></a>
                    </li>
                    <li class="ms-3">
                        <a class="link-dark" href="#"><i class="bi bi-instagram"></i></a>
                    </li>
                    <li class="ms-3">
                        <a class="link-dark" href="#"><i class="bi bi-facebook"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- end-footer -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="bi bi-caret-up-fill"></i>
    </a>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>
</body>

</html>
