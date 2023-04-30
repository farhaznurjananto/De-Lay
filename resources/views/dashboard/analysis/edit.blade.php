@extends('dashboard.layouts.main')

@section('container')
    <div class="header">
        <h1 class="h2 mt-3 fw-bold text-success">Edit Analisis Laba Rugi</h1>
        <hr class="featurette-divider" />
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    {{-- SCHEDULING --}}
    <div class="container-fluid overflow-auto">
        <form action="/dashboard/analysis/{{ $data->id }}" method="post">
            @method('put')
            @csrf
            <label for="initial_capital" class="form-label">Modal Usaha<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <span class="input-group-text">Rp.</span>
                <input type="number" class="form-control @error('initial_capital') is-invalid @enderror"
                    id="initial_capital" name="initial_capital" placeholder="Modal anda...."
                    value="{{ old('initial_capital', $data->initial_capital) }}" required
                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')" oninput="setCustomValidity('')">
            </div>
            @error('initial_capital')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="total_income" class="form-label">Pendapatan Usaha<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <span class="input-group-text">Rp.</span>
                <input type="number" class="form-control @error('total_income') is-invalid @enderror" id="total_income"
                    name="total_income" placeholder="Pendapatan anda...."
                    value="{{ old('total_income', $data->total_income) }}" required
                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')" oninput="setCustomValidity('')">
            </div>
            @error('total_income')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <label for="profit" class="form-label">Keuntungan Usaha<span class="text-danger">*</span></label>
            <div class="input-group mb-3">
                <span class="input-group-text">Rp.</span>
                <input type="number" class="form-control" id="profit" name="profit"
                    placeholder="{{ number_format($data->total_income - $data->initial_capital) }}" disabled readonly>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Keterangan</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="3" placeholder="Keterangan....">{{ old('description', $data->description) }}</textarea>
            </div>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="action text-end">
                <button type="submit" class="btn btn-primary"
                    onclick="return confirm('Apakah ingin memperbarui data?')">Update</button>
            </div>
        </form>
    </div>
    {{-- END-SCHEDULING --}}

    <hr class="featurette-divider" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>

    <script>
        const ctx = document.getElementById("myChart");
        // eslint-disable-next-line no-unused-vars

        const labels = {!! json_encode($labels) !!};
        const modal = {!! json_encode($modal) !!};
        const pendapatan = {!! json_encode($income) !!};

        const data = {
            labels: labels,
            datasets: [{
                    label: "Modal",
                    data: modal,
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Pendapatan",
                    data: pendapatan,
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                },
            ],
        };

        const config = {
            type: "bar",
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
@endsection
