<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>De-Lay | {{ $title }}</title>

    {{-- BOOTSTRAP CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />

    {{-- BOOTSTRAP ICON --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="css/style.css" />
</head>

<body class="h-100 d-flex justify-content-center align-content-center">
    <div class="container m-auto d-flex justify-content-around flex-wrap">
        {{-- IMG --}}
        <img class="img-fluid align-middle" src="/img/register.png" alt="register" style="width:600px" />
        {{-- END-IMG --}}

        {{-- CARD REGISTER --}}
        <div class="card mb-4 rounded-3 shadow-sm border-success" style="width:500px">
            <div class="card-header py-3 text-bg-success border-success">
                <h4 class="my-0 fw-normal text-center fw-bold">Register</h4>
            </div>
            <div class="card-body">
                <form action="/register" method="post">
                    @csrf
                    <ul class="list-unstyled">
                        <label for="name" class="form-label">Nama</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Username" value="{{ old('name') }}"
                                    required />
                                <label for="name">Masukkan Nama</label>
                            </div>
                        </div>
                        @error('name')
                            <p class="text-danger m-0">
                                {{ $message }}
                            </p>
                        @enderror
                    </ul>
                    <ul class="list-unstyled">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-at"></i></span>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Username" value="{{ old('email') }}"
                                    required />
                                <label for="email">Masukkan Email</label>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-danger m-0">
                                {{ $message }}
                            </p>
                        @enderror
                    </ul>
                    <ul class="list-unstyled">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                            <div class="form-floating">
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Username" value="{{ old('phone') }}"
                                    required />
                                <label for="phone">Masukkan Nomor Telepon</label>
                            </div>
                        </div>
                        @error('phone')
                            <p class="text-danger m-0">
                                {{ $message }}
                            </p>
                        @enderror
                    </ul>
                    <ul class="list-unstyled">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Username" required
                                    autocomplete="false" />
                                <label for="password">Masukkan Password</label>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-danger m-0">
                                {{ $message }}
                            </p>
                        @enderror
                    </ul>
                    <ul class="list-unstyled">
                        <label for="actor" class="form-label">Actor</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="bi bi-link"></i></span>
                            <select class="form-select" aria-label="Default select example" name="actor_id">
                                @foreach ($actors as $actor)
                                    @if (old('actor_id') == $actor->id)
                                        <option value="{{ $actor->id }}" selected="selected"{{ $actor->name }}>
                                            {{ $actor->name }}</option>
                                    @else
                                        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </ul>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <button type="submit" class="w-100 btn btn-lg btn-outline-success"
                        onclick="return confirm('Apa data yang dimasukkan sudah benar?')">Daftar</button>
                    <p class="text-center mt-2">Sudah punya akun? <a href="/login"
                            class="text-decoration-none">Masuk</a></p>
                </form>
            </div>
        </div>
        {{-- END-CARD REGISTER --}}
    </div>

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
