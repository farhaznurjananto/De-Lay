@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3">Monitoring Pertanian</h1>
        </div>

        <hr class="featurette-divider" />

        <!-- weather-information -->
        <div class="container-fluid border rounded p-3">
            <div class="rounded-3 bg-light shadow-sm">
                <div class="d-flex flex-row justify-content-center align-items-center">
                    <div class="weather__card my-4">
                        <div class="d-flex flex-row justify-content-center align-items-center">
                            <div class="p-3">
                                <img id="Icon" alt="weather-image" style="width:150px">
                            </div>
                            <div class="p-3">
                                <h5 id="Date">Tuesday, 10 AM</h5>
                                {{-- <h3>San Francisco</h3> --}}
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

            <!-- Weather Forecast -->
            <div class="weather__forecast d-flex flex-row overflow-x-auto justify-content-around align-items-center mt-3"
                id="weather-forecast">
            </div>
        </div>
        <!-- end-weather-information -->

        {{-- penjadwalan --}}
        <h1 class="h4 mt-4 text-center mb-3">Penjadwalan</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel sunt fugit, magnam sapiente cumque, aliquid eveniet
            voluptate officiis iure, corrupti dolorum ipsa quasi beatae praesentium doloribus voluptas. Sint fuga hic
            architecto optio sapiente accusantium eum, dolorum error! Cupiditate, id error maiores consectetur cum obcaecati
            voluptatum quia alias maxime odio! Minima!</p>

        <div class="container-fluid border p-3 rounded">
            <div class="container-fluid d-flex flex-wrap justify-content-around p-0 mb-3">
                <p class="h2 text-center">Tambah Jadwal Penanaman</p>
                <form class="d-flex" action="/dashboard/monitor" method="post">
                    @csrf
                    <input class="form-control me-2 @error('penanaman') is-invalid @enderror" type="date"
                        placeholder="penanaman" aria-label="penanaman" name="penanaman" id="penanaman" required>
                    <button class="btn btn-outline-success" type="submit">Tambah</button>
                </form>
            </div>

            {{-- alert --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- end alert --}}

            <div class="container-fluid my-4">
                <p class="h5 text-center my-3">Penanaman Terkini</p>
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
            </div>

            <div class="container-fluid overflow-auto">
                <table class="table overflow-auto text-center">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Penanaman</th>
                            <th scope="col">Pemupukan 1</th>
                            <th scope="col">Pemupukan 2</th>
                            <th scope="col">pemanenan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monitors as $monitor)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $monitor->penanaman }}</td>
                                <td>{{ $monitor->pemupukan_1 }}</td>
                                <td>{{ $monitor->pemupukan_2 }}</td>
                                <td>{{ $monitor->pemanenan }}</td>
                                <td>
                                    <form action="/dashboard/monitor/{{ $monitor->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm float-end"
                                            onclick="return confirm('Apa anda yakin untuk menghapus ini?')">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="6">
                            <p class="text-center">Tidak ada jadwal penanaman</p>
                        </td>
                        @endif
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $monitors->links() }}
                </div>
            </div>
        </div>

        <hr class="featurette-divider" />
    </div>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var apiKey = "j5qyr0K6scqcmq8pLVNqNT6qqaFnbnhr";

            var url = "http://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey=" + apiKey + "&q=" +
                latitude + "%2C" + longitude;

            $.get(url, function(data) {
                var locationKey = data.Key;
                var forecastUrl = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/" + locationKey +
                    "?apikey=" + apiKey;

                $.get(forecastUrl, function(data) {
                    var dailyForecasts = data.DailyForecasts;

                    console.log(dailyForecasts);

                    // headline weather
                    document.getElementById('Date').innerHTML = new Date(dailyForecasts[0]['Date'])
                        .toDateString();
                    document.getElementById('IconPhrase').innerHTML = dailyForecasts[0]['Day'][
                        'IconPhrase'
                    ];
                    document.getElementById('Icon').src =
                        'https://developer.accuweather.com/sites/default/files/' + (dailyForecasts[0]['Day']
                            ['Icon'] < 10 ? "0" + dailyForecasts[0]['Day']['Icon'] : dailyForecasts[0][
                                'Day'
                            ]['Icon']) + '-s.png';
                    document.getElementById('Maximum').innerHTML = dailyForecasts[0]['Temperature'][
                        'Maximum'
                    ]['Value'] + '°' + dailyForecasts[0]['Temperature'][
                        'Maximum'
                    ]['Unit'];
                    document.getElementById('Minimum').innerHTML = dailyForecasts[0]['Temperature'][
                        'Minimum'
                    ]['Value'] + '°' + dailyForecasts[0]['Temperature'][
                        'Minimum'
                    ]['Unit'];
                    // end headline weather

                    // forecasts weather
                    var forecastHtml;
                    dailyForecasts.forEach(function(forecast) {
                        var date = new Date(forecast.Date);
                        var dayOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday",
                            "Friday", "Saturday"
                        ][date.getDay()];
                        var weatherDescription = forecast.Day.IconPhrase;
                        var weatherIcon = forecast.Day.Icon < 10 ? "0" + forecast.Day.Icon :
                            forecast.Day.Icon;
                        var minTemp = forecast.Temperature.Minimum.Value;

                        forecastHtml +=
                            '<div class="px-4 mx-1 pt-1 d-flex flex-column justify-content-center align-items-center border rounded-3 text-center">';
                        forecastHtml += '<span>' + dayOfWeek + '</span>';
                        forecastHtml +=
                            "<img src='https://developer.accuweather.com/sites/default/files/" +
                            weatherIcon + "-s.png'>";
                        forecastHtml += '<span>' + weatherDescription + '</span>';
                        forecastHtml += '<span>' + minTemp + '°F</span>';
                        forecastHtml += "</div>";
                    });

                    $("#weather-forecast").html(forecastHtml);
                    // end forecasts weather
                });
            });
        }
    </script>
@endsection
