<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>De-Lay | {{ $title }}</title>

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="container m-auto">
        <!-- header -->
        <div class="pricing-header mx-auto text-center">
            <img class="img-fluid" src="https://source.unsplash.com/800x160?petani" alt="" />
        </div>
        <!-- end-header -->

        <!-- main -->
        <div class="row row-cols-1 row-cols-lg-2 my-3 justify-content-evenly">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-success">
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
                                            id="name" name="name" placeholder="Username"
                                            value="{{ old('name') }}" required />
                                        <label for="name">Masukkan Nama</label>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </ul>
                            <ul class="list-unstyled">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-at"></i></span>
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Username"
                                            value="{{ old('email') }}" required />
                                        <label for="email">Masukkan Email</label>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </ul>
                            <ul class="list-unstyled">
                                <label for="phone" class="form-label">Phone Number</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                    <div class="form-floating">
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" placeholder="Username"
                                            value="{{ old('phone') }}" required />
                                        <label for="phone">Masukkan Nomor Telepon</label>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </ul>
                            <ul class="list-unstyled">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <div class="form-floating">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password" placeholder="Username" required autocomplete="false" />
                                        <label for="password">Masukkan Password</label>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </ul>
                            <ul class="list-unstyled">
                                <label for="actor" class="form-label">Actor</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-link"></i></span>
                                    <select class="form-select" aria-label="Default select example" name="actor_id">
                                        @foreach ($actors as $actor)
                                            @if (old('actor_id') == $actor->id)
                                                <option value="{{ $actor->id }}"
                                                    selected="selected"{{ $actor->name }}>{{ $actor->name }}</option>
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
                            <button type="submit" class="w-100 btn btn-lg btn-outline-success">Daftar</button>
                            <p class="text-center mt-2">Sudah punya akun? <a href="/login"
                                    class="text-decoration-none">Masuk</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end-main -->
    </div>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
