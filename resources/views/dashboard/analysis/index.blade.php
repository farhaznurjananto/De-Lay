@extends('dashboard.layouts.main')

@section('container')
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3 fw-bold text-success">Analisis Laba Rugi</h1>
    </div>

    <hr class="featurette-divider" />

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    {{-- SCHEDULING --}}
    <h1 class="h4 mt-4 text-center mb-3">Laba Rugi</h1>
    <p class="text-center">Monitoring penjadwalan memberikan kemudahan bagi petani kedelai dalam menentukan masa pemupukakan
        deleai serta pemanenan. Perlu diperhatikan bahwasannya tanggal yang diberikan oleh sistem hanya sebagai gambaran,
        selebihnya melihat kondisi dilapangan pertanian.</p>

    <div class="create py-2 d-flex align-content-center justify-content-between">
        <p class="m-0 h5">Tambah Data Modal dan Pendapatan</p>
        <button class="btn btn-outline-success btn-sm w-25" data-bs-toggle="modal" data-bs-target="#createAnalysisModal"><i
                class="bi bi-plus-circle"></i> Tambah Data</button>
    </div>

    <div class="container-fluid border p-3 rounded">
        <div class="container-fluid d-flex flex-wrap justify-content-around p-0 mb-3">
            <p class="h2 text-center">Laba Rugi Bisnis Anda</p>
        </div>

        {{-- ALERT --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- END-ALERT --}}

        <div class="container-fluid overflow-auto">
            <table class="table overflow-auto text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Modal</th>
                        <th scope="col">Pendapatan</th>
                        <th scope="col">Tanggal Pencatatan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($datas->count())
                        @foreach ($datas as $data)
                            <tr valign="middle">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->initial_capital }}</td>
                                <td>{{ $data->total_income }}</td>
                                <td>{{ $data->createed_at }}</td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    <p>Action</p>
                                    {{-- <form action="/dashboard/monitor/{{ $monitor->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Apa anda yakin untuk menghapus ini?')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="6">
                            <p class="text-center">Tidak ada data laba rugi</p>
                        </td>
                    @endif

                </tbody>
            </table>

            <div class="mt-3">
                {{ $datas->links() }}
            </div>
        </div>
    </div>
    {{-- END-SCHEDULING --}}

    <hr class="featurette-divider" />

    {{-- CREATE ANALYSIS MODAL --}}
    <div class="modal" id="createAnalysisModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Modal dan Pendapatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/analysis" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="initial_capital" class="form-label">Modal Usaha<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('initial_capital') is-invalid @enderror"
                                id="initial_capital" name="initial_capital" placeholder="Modal anda....">
                            @error('initial_capital')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_income" class="form-label">Pendapatan Usaha<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('total_income') is-invalid @enderror"
                                id="total_income" name="total_income" placeholder="Pendapatan anda....">
                            @error('total_income')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                rows="3" value="{{ old('description') }}" placeholder="Keterangan...."></textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Buat Analisis</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- END-CREATE ANALYSIS MODAL --}}

        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
            integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
        </script>
        <script src="/js/canvas.js"></script>
    @endsection
