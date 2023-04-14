@extends('dashboard.layouts.main')

@section('container')
    <h1 class="h2 mt-3 fw-bold text-success">Profile</h1>

    <hr class="featurette-divider" />

    {{-- ALERT --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- END-ALERT --}}

    {{-- PROFILE --}}
    <div class="d-flex justify-content-center">
        <div class="border rounded p-3 col-lg-6 col-12">
            <div class="profile-pic text-muted text-center" style="font-size: 100px">
                <img class="rounded-circle" src="/img/farmer-avatar.png" alt="farmer-avatar" style="width:200px">
            </div>
            <form action="/profile/{{ $user[0]->id }}" method="post">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Nama anda" value="{{ old('name', $user[0]->name) }}" required />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Nama anda" value="{{ old('email', $user[0]->email) }}" required />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" placeholder="Nama anda" value="{{ old('phone', $user[0]->phone) }}" required />
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="action d-grid">
                    <button class="btn btn-primary" type="submit"
                        onclick="return confirm('Yakin ingin memperbarui profile?')">Update</button>
                </div>
            </form>
        </div>
    </div>
    {{-- END-PROFILE --}}

    <hr class="featurette-divider" />
@endsection
