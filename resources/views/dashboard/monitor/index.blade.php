@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3">Monitoring Pertanian</h1>
        </div>

        <hr class="featurette-divider" />

        <form class="d-flex mb-3" role="search">
            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>

        <!-- weather-information -->
        <div class="container-fluid border rounded p-3">
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
                @if ($monitors->count())
                    <p class="h5 text-center my-3">Penanaman Terkini</p>

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
                                    <form action="/dashboard/monitor/{{ $monitor->id }}" method="post"
                                        class="d-inline">
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
@endsection
