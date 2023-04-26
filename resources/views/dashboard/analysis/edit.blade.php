@extends('dashboard.layouts.main')

@section('container')
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3 fw-bold text-success">Edit Analisis Laba Rugi</h1>
    </div>

    <hr class="featurette-divider" />

    {{-- SCHEDULING --}}
    <div class="container-fluid overflow-auto">
        <form action="/dashboard/analysis/{{ $data->id }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="initial_capital" class="form-label">Modal Usaha<span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('initial_capital') is-invalid @enderror"
                    id="initial_capital" name="initial_capital" placeholder="Modal anda...."
                    value="{{ old('initial_capital', $data->initial_capital) }}">
                @error('initial_capital')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total_income" class="form-label">Pendapatan Usaha<span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('total_income') is-invalid @enderror" id="total_income"
                    name="total_income" placeholder="Pendapatan anda...."
                    value="{{ old('total_income', $data->total_income) }}">
                @error('total_income')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Keterangan</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="3" placeholder="Keterangan....">{{ old('description', $data->description) }}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="action text-end">
                <button type="submit" class="btn btn-primary"
                    onclick="return confirm('Apakah ingin memperbarui data?')">Update
                    Analisis</button>
            </div>
        </form>
    </div>
    {{-- END-SCHEDULING --}}

    <hr class="featurette-divider" />
@endsection
