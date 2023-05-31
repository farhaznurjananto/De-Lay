<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>De-Lay | Register</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ICON --}}
    <link rel="icon" type="image/png" href="{{ asset('img/ICON.png') }}">

    {{-- GOOGLE FONT --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
</head>

<body class="min-h-screen bg-[#F1F8FE]">
    <div class="min-h-screen flex justify-center items-center">
        <div class="bg-[#F1F8FE] shadow-md m-3 md:m-0 w-full md:w-2/3 xl:w-1/3">
            <div class="bg-[#1B232E] py-10 flex justify-center items-center">
                <img src="/img/register.png" alt="register" class="w-60">
            </div>
            <form action="/register" method="post" class="flex flex-col items-center justify-center px-3 md:px-10">
                @csrf
                <p class="text-[#36BB6A] text-2xl font-medium py-5 md:py-10">Daftar</p>
                <div class="w-full mb-3">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                            <span class="material-symbols-rounded">
                                person
                            </span>
                        </span>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('name') invalid:border-[#FF5A8A] @enderror"
                            placeholder="NAMA" required
                            oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                            oninput="setCustomValidity('')">
                    </div>
                    @error('name')
                        <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-full mb-3">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                            <span class="material-symbols-rounded">
                                alternate_email
                            </span>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('email') invalid:border-[#FF5A8A] @enderror"
                            placeholder="EMAIL" required
                            oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                            oninput="setCustomValidity('')">
                    </div>
                    @error('email')
                        <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-full mb-3">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                            <span class="material-symbols-rounded">
                                call
                            </span>
                        </span>
                        <input type="number" id="phone" name="phone" value="{{ old('phone') }}"
                            class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('phone') invalid:border-[#FF5A8A] @enderror"
                            placeholder="NOMOR TELEPON" required
                            oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                            oninput="setCustomValidity('')">
                    </div>
                    @error('phone')
                        <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-full mb-3">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                            <span class="material-symbols-rounded">
                                lock
                            </span>
                        </span>
                        <input type="password" id="password" name="password"
                            class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('password') invalid:border-[#FF5A8A] @enderror"
                            placeholder="KATA SANDI" required
                            oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                            oninput="setCustomValidity('')" autocomplete="false">
                    </div>
                    @error('password')
                        <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="w-full mb-3">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                            <span class="material-symbols-rounded">
                                link
                            </span>
                        </span>
                        <select id="countries" name="actor_id" id="actor_id"
                            class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                            @foreach ($actors as $actor)
                                {{-- @if (old('actor_id') == $actor->actor_id)
                                    <option value="{{ $actor->id }}" selected>{{ $actor->name }}</option>
                                @else
                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                @endif --}}
                                <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div id="alert" class="flex p-4 w-full text-[#1B232E] rounded-lg bg-[#8ED145]" role="alert">
                        <span class="material-symbols-rounded">
                            info
                        </span>
                        <span class="sr-only">Info</span>
                        <div class="ml-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button" id="dismiss-btn"
                            class="ml-auto -mx-1.5 -my-1.5 bg-[#F1F8FE] text-[#1B232E] rounded-lg focus:ring-2 focus:ring-[#36BB6A]/50 p-1.5 hover:bg-[#36BB6A]/75 inline-flex h-8 w-8"
                            data-dismiss="alert" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <span class="material-symbols-rounded">
                                close
                            </span>
                        </button>
                    </div>
                @endif
                <button type="submit"
                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center my-5"
                    onclick="return confirm('Apakah data yang dimasukkan sudah benar?')">Daftar</button>
                <div class="flex items-start mb-10 justify-between">
                    <p class="text-[#1B232E]">Sudah punya Akun?</p>
                    <p class="font-semibold"><a href="/login" class="text-[#36BB6A] hover:text-[#36BB6A]/75">
                            Masuk</a></p>
                </div>
            </form>
        </div>
    </div>
    <svg class="fixed bottom-0 -z-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#1B232E" fill-opacity="1" d="M0,192L1440,64L1440,320L0,320Z"></path>
    </svg>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- CUSTOM JS --}}
    <script src="/js/script.js"></script>
</body>

</html>
