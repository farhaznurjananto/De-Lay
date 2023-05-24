<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>De-Lay | {{ $title }}</title>

    {{-- ICON --}}
    <link rel="icon" type="image/png" href="{{ asset('img/ICON.png') }}">

    {{-- BOOTSTRAP CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />

    {{-- BOOTSTRAP ICON --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    {{-- CUSTOM CSS --}}
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body id="page-top">
    @include('dashboard.layouts.header')

    <div class="container-fluid main-wrapper">
        <div class="row main-wrapper">
            @include('dashboard.layouts.sidebar')

            {{-- MAIN --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex flex-column justify-content-between">
                @yield('container')
            </main>
        </div>
    </div>

    {{-- SCROLL TOP --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="bi bi-caret-up-fill"></i>
    </a>
    {{-- END-SCROLL TOP --}}

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    {{-- CUSTOM JS --}}
    <script defer src="/js/script.js"></script>
    @yield('script')
</body>

</html>
