<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>De-Lay</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ICON --}}
    <link rel="icon" type="image/png" href="{{ asset('img/ICON.png') }}">

    {{-- GOOGLE FONT --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
</head>

<body class="min-h-screen bg-slate-200">
    <nav class="bg-[#1B232E] fixed w-full z-20 top-0 left-0 border-b border-[#1B232E]">
        <div class="flex flex-wrap items-center justify-between mx-auto py-4 px-5 md:px-10">
            <a href="#" class="flex items-center">
                <span class="self-center text-4xl font-bold whitespace-nowrap"><span
                        class="text-[#8ED145]">De</span><span class="text-[#F1F8FE]">Lay</span></span>
            </a>
            <div class="flex md:order-2">
                @auth
                    <button type="button" data-dropdown-toggle="user-dropdown"
                        class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-[#1B232E] bg-[#36BB6A] rounded-full cursor-pointer hover:bg-[#36BB6A]/75 mr-3 md:mr-0">
                        <span class="material-symbols-rounded mr-3">
                            person
                        </span>
                        User
                    </button>
                    <div class="z-50 hidden my-4 text-base list-none bg-[#F1F8FE] divide-y divide-gray-100 rounded-lg shadow"
                        id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900">{{ auth()->user()->name }}</span>
                            <span class="block text-sm  text-gray-500 truncate">{{ auth()->user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="/"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FFFFFF] ">Beranda</a>
                            </li>
                            <li>
                                <a href="/dashboard"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FFFFFF] ">Dashboard</a>
                            </li>
                            <li>
                                <a href="/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FFFFFF] ">Profile</a>
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-[#FFFFFF] ">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="/login"
                        class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm px-4 py-2 text-center mr-3 md:mr-0 flex flex-row justify-between items-center">Masuk
                        <span class="material-symbols-rounded ml-3">
                            login
                        </span></a>
                @endauth
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 text-sm text-[#F1F8FE] rounded-lg md:hidden hover:bg-[#36BB6A] focus:outline-none focus:ring-2 focus:ring-[#36BB6A]/75"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-[#1B232E] rounded-lg bg-[#293649] md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-[#1B232E]">
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-[#1B232E] bg-[#36BB6A] rounded md:bg-transparent md:text-[#36BB6A] md:p-0"
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="#layanan"
                            class="block py-2 pl-3 pr-4 text-[#F1F8FE] rounded hover:bg-[#36BB6A] md:hover:bg-transparent md:hover:text-[#36BB6A] md:p-0">Layanan</a>
                    </li>
                    <li>
                        <a href="#produk"
                            class="block py-2 pl-3 pr-4 text-[#F1F8FE] rounded hover:bg-[#36BB6A] md:hover:bg-transparent md:hover:text-[#36BB6A] md:p-0">Produk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <section class="bg-[#1B232E] pt-24 p-5 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center justify-center md:justify-start">
                    <div class="p-0 text-center md:text-left">
                        <span class="text-6xl font-bold whitespace-nowrap"><span class="text-[#8ED145]">De</span><span
                                class="text-[#F1F8FE]">Lay</span></span>
                        <p class="text-[#F1F8FE] font-medium text-3xl my-3">Membangun pertanian <br> Indonesia lebih
                            maju.
                        </p>
                        <p class="text-[#F1F8FE] text-lg my-3">Daftar dan dapatkan Akun</p>
                        @auth
                        @else
                            <div class="flex justify-center md:justify-start">
                                <a href="/register"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm px-4 py-2 text-center mr-3 md:mr-0 flex flex-row justify-between items-center">Daftar
                                    <span class="material-symbols-rounded ml-3">
                                        how_to_reg
                                    </span></a>
                            </div>
                        @endauth
                    </div>
                </div>
                <div class="flex justify-end">
                    <img class="rounded-2xl shadow-md" src="{{ asset('img/tanaman-kedelai.jpg') }}"
                        alt="tanaman-kedelai">
                </div>
            </div>
        </section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#1B232E" fill-opacity="1" d="M0,128L1440,256L1440,0L0,0Z"></path>
        </svg>
        <section class="p-5 md:px-10" id="layanan">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex">
                    <img class="rounded-2xl" src="{{ asset('img/landing-1.png') }}" alt="target-pengguna">
                </div>
                <div class="flex items-center justify-center md:justify-start">
                    <div class="p-0 text-center md:text-left">
                        <p class="text-[#8ED145] font-bold text-4xl my-3">Hadir dengan 2 Target Pengguna</p>
                        <p class="text-[#36BB6A] font-medium text-3xl my-3">Petani Kedelai</p>
                        <p class="text-[#1B232E] text-lg my-3">Membantu petani melakukan penjadwalan serta penjualan
                            kedelai dan membantu dalam perhitungan analisis laba dan rugi.</p>
                        <p class="text-[#36BB6A] font-medium text-3xl my-3">Produsen Susu</p>
                        <p class="text-[#1B232E] text-lg my-3">Membantu produsen susu kedelai dalam mendapatkan stok
                            kedelai yang berkwalitas serta perhitungan penjualan analisis laba dan rugi.</p>
                    </div>
                </div>
            </div>
        </section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#1B232E" fill-opacity="1" d="M0,192L1440,64L1440,320L0,320Z"></path>
        </svg>
        <section class="bg-[#1B232E] pt-24 p-5 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center justify-center md:justify-start">
                    <div class="p-0 text-center md:text-left">
                        <p class="text-[#8ED145] font-bold text-4xl my-3">Hadir dengan 2 Fitur Utama</p>
                        <p class="text-[#36BB6A] font-medium text-3xl my-3">Penjadwalan Pertanian Kedelai</p>
                        <p class="text-[#F1F8FE] text-lg my-3">Membantu memberikan informasi cuaca serta menentukan
                            tanggal
                            pemupukan serta pemanenan pertaniaan kedelai.</p>
                        <p class="text-[#36BB6A] font-medium text-3xl my-3">Pencatatan & Analisi Laba Rugi</p>
                        <p class="text-[#F1F8FE] text-lg my-3">Membantu produsen susu kedelai dalam menggitungn
                            keuntungan
                            dan kerugian penjualan.</p>
                    </div>
                </div>
                <div class="flex justify-end">
                    <img class="rounded-2xl" src="{{ asset('img/landing-2.png') }}" alt="fitur-utama">
                </div>
            </div>
        </section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#1B232E" fill-opacity="1" d="M0,192L1440,64L1440,0L0,0Z"></path>
        </svg>
        <section class="p-5 md:px-10" id="produk">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex">
                    <img class="rounded-2xl" src="{{ asset('img/landing-3.png') }}" alt="produk">
                </div>
                <div class="flex items-center justify-center md:justify-start">
                    <div class="p-0 text-center md:text-left">
                        <p class="text-[#8ED145] font-bold text-4xl my-3">Susu Kedelai</p>
                        <p class="text-[#1B232E] text-lg my-3">Sari kedelai atau susu kedelai adalah sari nabati yang
                            diproses dengan cara merendam dan menggiling kedelai, merebus campuran, dan menyaring
                            partikel yang tersisa.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#1B232E" fill-opacity="1" d="M0,96L1440,192L1440,320L0,320Z"></path>
        </svg>
        <section class="bg-[#1B232E] pt-24 p-5 md:px-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex justify-center md:justify-start items-end">
                    <p class="text-[#F1F8FE] font-medium text-lg">© 2023 De-Lay, All rights reserved.</p>
                </div>
                <div class="flex items-center justify-center md:justify-end">
                    <div class="p-0 text-center md:text-right">
                        <span class="text-6xl font-bold whitespace-nowrap"><span class="text-[#8ED145]">De</span><span
                                class="text-[#F1F8FE]">Lay</span></span>
                        <p class="text-[#8ED145] font-medium text-3xl my-3">Hubungin sosial media berikut untuk <br>
                            kerja sama iklan dengan kami.
                        </p>
                        <p class="text-[#F1F8FE] text-lg my-3">{{ $data[0]->phone }} <span
                                class="text-[#8ED145]"><span class="material-symbols-rounded">
                                    call
                                </span></span></p>
                        <p class="text-[#F1F8FE] text-lg my-3">{{ $data[0]->email }} <span
                                class="text-[#8ED145]"><span class="material-symbols-rounded">
                                    mail
                                </span></span></p>
                    </div>
                </div>
            </div>
        </section>
    </footer>
</body>

</html>
