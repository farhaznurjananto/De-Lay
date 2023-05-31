@extends('dashboard.layouts.main')

@section('container')
    <div class="p-4 sm:ml-64 bg-[#F1F8FE] min-h-screen">
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex rounded">
                    <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                        <span class="material-symbols-rounded">
                            account_circle
                        </span>
                        <span class="ml-3">{{ $title }}</span>
                    </a>
                </div>
            </div>

            {{-- FARMER --}}
            <div class="flex justify-center items-center">
                <div class="bg-[#F1F8FE] shadow-md m-3 md:m-0 w-full md:w-2/3 xl:w-1/3">
                    <div class="bg-[#1B232E] py-10 flex justify-center items-center">
                        <img src="/img/profile.png" alt="profile" class="w-60">
                    </div>
                    <form action="/profile/{{ $user[0]->id }}" method="post"
                        class="flex flex-col items-center justify-center px-3 md:px-10">
                        @method('put')
                        @csrf
                        <p class="text-[#36BB6A] text-2xl font-medium py-5 md:py-10">Profile</p>
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        person
                                    </span>
                                </span>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $user[0]->name) }}"
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
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        alternate_email
                                    </span>
                                </span>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $user[0]->email) }}"
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
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        call
                                    </span>
                                </span>
                                <input type="number" id="phone" name="phone"
                                    value="{{ old('phone', $user[0]->phone) }}"
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
                        @if (session()->has('success'))
                            <div id="alert" class="flex p-4 w-full text-[#1B232E] rounded-lg bg-[#8ED145]"
                                role="alert">
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
                            class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center my-5 md:my-10"
                            onclick="return confirm('Apakah anda yakin ingin memperbarui data?')">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
