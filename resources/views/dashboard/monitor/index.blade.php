@extends('dashboard.layouts.main') @section('container')
    <div class="header">
        <h1 class="h2 mt-3 fw-bold text-success">Monitoring Pertanian</h1>
        <hr class="featurette-divider" />
    </div>


    {{-- WEATHER INFORMATION --}}
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

        {{-- WEATHER FORECAST --}}
        <div class="weather__forecast d-flex flex-row overflow-x-auto justify-content-around align-items-center mt-3"
            id="weather-forecast">
        </div>
    </div>
    {{-- END-WEATHER INFORMATION --}}

    {{-- SCHEDULING --}}
    <h1 class="h4 mt-4 text-center mb-3">Penjadwalan</h1>
    <p class="text-center">Monitoring penjadwalan memberikan kemudahan bagi petani kedelai dalam menentukan masa pemupukakan
        deleai serta pemanenan. Perlu diperhatikan bahwasannya tanggal yang diberikan oleh sistem hanya sebagai gambaran,
        selebihnya melihat kondisi dilapangan pertanian.</p>

    <div class="container-fluid border p-3 rounded">
        <div class="container-fluid d-flex flex-wrap justify-content-around p-0 mb-3">
            <p class="h2 text-center">Tambah Jadwal Penanaman</p>
            <form class="d-flex" action="/dashboard/monitor" method="post">
                @csrf
                <input class="form-control me-2 @error('penanaman') is-invalid @enderror" type="date"
                    placeholder="penanaman" aria-label="penanaman" name="penanaman" id="penanaman" required
                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')" oninput="setCustomValidity('')">
                <button class="btn btn-outline-success" type="submit">Tambah</button>
                {{-- UNCOMMENT AJA BUAT PEMBENANARANNYA --}}
                {{-- <button class="btn btn-outline-success" type="submit"
                    onclick="return confirm('Apa data yang dimasukkan sudah benar?')">Tambah</button> --}}
            </form>
        </div>

        {{-- ALERT --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- END-ALERT --}}

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
                        {{ date_format(date_create($monitors[0]->penanaman), 'd M Y') }} <p class="fw-semibold">(Penanaman)
                        </p>
                    </div>
                    <div class="col">
                        {{ date_format(date_create($monitors[0]->pemupukan_1), 'd M Y') }} <p class="fw-semibold">
                            (Penanaman)
                        </p>
                    </div>
                    <div class="col">
                        {{ date_format(date_create($monitors[0]->pemupukan_2), 'd M Y') }} <p class="fw-semibold">
                            (Penanaman)
                        </p>
                    </div>
                    <div class="col">
                        {{ date_format(date_create($monitors[0]->pemanenan), 'd M Y') }} <p class="fw-semibold">(Penanaman)
                        </p>
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
                        <tr valign="middle">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ date_format(date_create($monitor->penanaman), 'd M Y') }}</td>
                            <td>{{ date_format(date_create($monitor->pemupukan_1), 'd M Y') }}</td>
                            <td>{{ date_format(date_create($monitor->pemupukan_2), 'd M Y') }}</td>
                            <td>{{ date_format(date_create($monitor->pemanenan), 'd M Y') }}</td>
                            <td>
                                <form action="/dashboard/monitor/{{ $monitor->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
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
    {{-- END-SCHEDULING --}}

    <hr class="featurette-divider" />


    {{-- WEATHER JS --}}
    <script src="/js/weather.js"></script>
@endsection
