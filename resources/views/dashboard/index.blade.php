@extends('dashboard.layouts.main') @section('container')
    <div class="header">
        <h1 class="h2 mt-3 fw-bold text-success">Dashboard</h1>
        <hr class="featurette-divider" />
    </div>

    <div class="main-wrapper">
        {{-- PRODUSEN DASHBOARD --}}
        @can('produsen')
            {{-- INFORMATION CARD --}}
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
                                        Rp. {{ number_format($incomes) }}
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
                                    <p class="h5 mb-0 fw-bold text-muted">{{ $orders_produsen }}</p>
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
                                        Total Pemesanan
                                    </p>
                                    <p class="h5 mb-0 fw-bold text-muted">{{ $total_orders }}</p>
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
                                    <p class="h5 mb-0 fw-bold text-muted">{{ $forums }}</p>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-chat-dots-fill fs-1 text-muted opacity-25"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END-INFORMATION CARD --}}

            {{-- WEATHER INFORMATION --}}
            <div class="rounded-3 border">

                <p class="fs-3 text-center my-3">Keuntugnan Bisnis Anda</p>
                <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

            </div>
            {{-- END-WEATHER INFORMATION --}}

            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
                integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
            </script>

            <script>
                const ctx = document.getElementById("myChart");
                // eslint-disable-next-line no-unused-vars

                const labels = {!! json_encode($labels) !!};
                const keuntungan = {!! json_encode($profit) !!};

                const data = {
                    labels: labels,
                    datasets: [{
                        label: "Keuntungan",
                        data: keuntungan,
                        backgroundColor: "rgba(25, 135, 84, 0.2)",
                        borderColor: "rgba(25, 135, 84, 1)",
                        borderWidth: 1,
                        pointRadius: 5,
                        pointBackgroundColor: function(context) {
                            var value = context.dataset.data[context.dataIndex];
                            return value >= 0 ? "rgba(25, 135, 84, 1)" : "rgba(220, 53, 87, 1)";
                        },
                        pointBorderColor: '#fff',
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: function(context) {
                            var value = context.dataset.data[context.dataIndex];
                            return value >= 0 ? "rgba(25, 135, 84, 1)" : "rgba(220, 53, 87, 1)";
                        },
                    }, ],
                };

                const config = {
                    type: "line",
                    data: data,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                    },
                };

                var myChart = new Chart(ctx, config);
            </script>
        @endcan

        {{-- FARMER DASHBOARD --}}
        @can('farmer')
            {{-- INFORMATION CARD --}}
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
                                        Rp. {{ number_format($incomes) }}
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
                                    <p class="h5 mb-0 fw-bold text-muted">{{ $orders }}</p>
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
                                    <p class="h5 mb-0 fw-bold text-muted">{{ $products }}</p>
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
                                    <p class="h5 mb-0 fw-bold text-muted">{{ $forums }}</p>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-chat-dots-fill fs-1 text-muted opacity-25"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END-INFORMATION CARD --}}

            <hr class="featurette-divider" />

            {{-- WEATHER INFORMATION --}}
            <div class="rounded-3 border">
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <div class="weather__card my-4">
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <div class="p-3">
                                <img id="Icon" alt="weather-image" style="width:150px">
                            </div>
                            <div class="p-3">
                                <h5 id="Date">Tuesday, 10 AM</h5>
                                <span class="weather__description" id="IconPhrase">Mostly Cloudy</span>
                            </div>
                        </div>
                        <div class="weather__status d-flex flex-row justify-content-center align-items-center mt-3">
                            <div class="p-4 d-flex justify-content-center align-items-center">
                                <i class="bi bi-thermometer-high"></i>
                                <span id="Maximum">10%</span>
                            </div>
                            <div class="p-4 d-flex justify-content-center align-items-center">
                                <i class="bi bi-thermometer-low"></i>
                                <span id="Minimum">10 km/h</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END-WEATHER INFORMATION --}}

            {{-- SCHEDULING --}}
            <div class="container-fluid my-4">
                <p class="fs-3 text-center my-3">Penanaman Terkini</p>
                @if ($monitors->count())
                    <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        @if (now() >= $monitors[0]->pemanenan)
                            <div class="progress-bar align-items-end bg-success" style="width: 100%"></div>
                        @endif
                        @if (now() >= $monitors[0]->pemupukan_2 && now() <= $monitors[0]->pemanenan)
                            <div class="progress-bar align-items-end bg-success" style="width: 65%"></div>
                        @endif
                        @if (now() >= $monitors[0]->pemupukan_1 && now() <= $monitors[0]->pemupukan_2)
                            <div class="progress-bar align-items-end bg-success" style="width: 35%"></div>
                        @endif
                        @if (now() >= $monitors[0]->penanaman && now() <= $monitors[0]->pemupukan_1)
                            <div class="progress-bar align-items-end bg-success" style="width: 15%"></div>
                        @endif
                    </div>
                    <div class="row align-items-center text-center small">
                        <div class="col">
                            {{ $monitors[0]->penanaman }} <p class="fw-semibold">(Penanaman)</p>
                        </div>
                        <div class="col">
                            {{ $monitors[0]->pemupukan_1 }} <p class="fw-semibold">(Pemupukan 1)</p>
                        </div>
                        <div class="col">
                            {{ $monitors[0]->pemupukan_2 }} <p class="fw-semibold">(Pemupukan 2)</p>
                        </div>
                        <div class="col">
                            {{ $monitors[0]->pemanenan }} <p class="fw-semibold">(Pemanenan)</p>
                        </div>
                    </div>
                    <p class="small text-muted my-2"><span tex></span> Penjadwalan ini hanya sebagai gambaran mulai proses
                        penanaman
                        sampai pemanenan<span class="text-danger fw-bold">*</span></p>
                @else
                    <td colspan="6">
                        <p class="text-center">Tidak ada jadwal penanaman</p>
                    </td>
                @endif
            </div>
            {{-- END-SCHEDULING --}}

            {{-- WHEATHER JS --}}
            <script src="/js/weather.js"></script>
        @endcan

        @can('admin')
            <div class="rounded-3 border main-wrapper d-flex flex-column justify-content-center align-items-center">
                <p class="fs-3 my-3 fw-bold">Selamat Datang Admin De-Lay</p>
                <img class="img-fluid" src="/img/admin.png" alt="admin" width="500px">
            </div>
        @endcan
    </div>

    <hr class="featurette-divider" />
@endsection
