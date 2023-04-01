@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <h1 class="h2 mt-3">Dashboard</h1>

        <hr class="featurette-divider" />

        @can('produsen')
            <!-- information-all -->
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
                    <div class="card shadow h-100 border-success py-2 input-group">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <p class="fw-bold text-success text-uppercase mb-1">
                                        Pendapatan
                                    </p>
                                    <p class="h5 mb-0 fw-bold text-muted">
                                        Rp. 100.000
                                    </p>
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
                                    <p class="fw-bold text-warning text-uppercase mb-1">
                                        Pemesanan Tertunda
                                    </p>
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
                                    <p class="fw-bold text-info text-uppercase mb-1">
                                        Produk
                                    </p>
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
                                    <p class="fw-bold text-primary text-uppercase mb-1">
                                        Forum Diskusi
                                    </p>
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
        @endcan

        @can('petani')
            <!-- information-all -->
            <div class="row">
                <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
                    <div class="card shadow h-100 border-success py-2 input-group">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <p class="fw-bold text-success text-uppercase mb-1">
                                        Pendapatan
                                    </p>
                                    <p class="h5 mb-0 fw-bold text-muted">
                                        Rp. 100.000
                                    </p>
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
                                    <p class="fw-bold text-warning text-uppercase mb-1">
                                        Pemesanan Tertunda
                                    </p>
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
                                    <p class="fw-bold text-info text-uppercase mb-1">
                                        Produk
                                    </p>
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
                                    <p class="fw-bold text-primary text-uppercase mb-1">
                                        Forum Diskusi
                                    </p>
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
        @endcan

        <hr class="featurette-divider" />
    </div>
@endsection
