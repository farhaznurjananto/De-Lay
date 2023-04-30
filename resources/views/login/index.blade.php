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
        <img class="img-fluid" src="/img/login.png" alt="login" style="width:500px" />
        {{-- END-IMG --}}

        {{-- CARD LOGIN --}}
        <div class="card mb-4 rounded-3 shadow-sm border-success" style="width:500px">
            <div class="card-header py-3 text-bg-success border-success">
                <h4 class="my-0 fw-normal text-center fw-bold">Login</h4>
            </div>
            <form action="/login" method="post" class="card-body d-flex flex-column justify-content-around">
                @csrf
                <ul class="list-unstyled">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-at"></i></span>
                        <div class="form-floating">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Username" value="{{ old('email') }}"
                                required oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" />
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
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Username" required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" autocomplete="false" />
                            <label for="password">Masukkan Password</label>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-danger m-0">
                            {{ $message }}
                        </p>
                    @enderror
                </ul>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <button type="submit" class="w-100 btn btn-lg btn-outline-success">Masuk</button>
                <p class="text-center mt-2">Belum punya akun? <a href="/register"
                        class="text-decoration-none">Daftar</a></p>
            </form>
        </div>
        {{-- END-CARD LOGIN --}}
    </div>

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
