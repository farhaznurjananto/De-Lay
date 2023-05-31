@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 sm:ml-64 bg-[#F1F8FE] min-h-screen">
        {{-- <div class="p-4"> --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="flex rounded">
                <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                    <span class="material-symbols-rounded">
                        featured_video
                    </span>
                    <span class="ml-3">{{ $title }}</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
            <div class="rounded bg-[#FFFFFF] col-span-2 xl:col-auto p-2">
                <div class="p-1 flex justify-center items-center h-full">
                    <img class="rounded-lg" id="img-preview" src="{{ asset('storage/' . $advertisement->image_path) }}"
                        alt="display-img">
                </div>
            </div>
            <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                <h3 class="mb-5 text-xl text-center font-medium text-[#36BB6A]">IKLAN</h3>
                <div class="flex flex-col justify-between">
                    <div class="space-y-6">
                        <form class="space-y-6 w-full" action="/dashboard/advertisement/{{ $advertisement->id }}"
                            enctype="multipart/form-data" method="post">
                            @method('put')
                            @csrf
                            <input type="hidden" name="oldImage" value="{{ $advertisement->image_path }}">
                            <div class="w-full mb-3">
                                <input
                                    class="block w-full text-sm text-[#1B232E] border border-[#1B232E] rounded-lg cursor-pointer bg-[#FFFFFF] focus:outline-none @error('image_path') invalid:border-[#FF5A8A] @enderror image_path"
                                    aria-describedby="image_path" id="image_path" name="image_path" type="file"
                                    onchange="previewImage()">
                                <p class="mt-1 text-sm text-gray-500" id="image_path">Upload
                                    gambar iklan max 1mb.
                                </p>
                                @error('image_path')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full mb-3">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            tag
                                        </span>
                                    </span>
                                    <input type="text" id="title" name="title"
                                        class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('title') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="JUDUL"
                                        oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                        oninput="setCustomValidity('')" value="{{ old('title', $advertisement->title) }}"
                                        required>
                                </div>
                                @error('title')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full mb-3">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            link
                                        </span>
                                    </span>
                                    <input type="text" id="link" name="link"
                                        class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5  @error('link') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="TAUTAN" value="{{ old('link', $advertisement->link) }}">
                                </div>
                                @error('link')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full mb-3">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            checklist
                                        </span>
                                    </span>
                                    <select id="advertising_package" name="advertising_package"
                                        class="bg-[#FFFFFF] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                        @if ($advertisement->advertising_package == 'I')
                                            <option value="I" selected>Paket I</option>
                                            <option value="II">Paket II</option>
                                        @else
                                            <option value="I">Paket I</option>
                                            <option value="II" selected>Paket II</option>
                                        @endif
                                        {{-- <option value="III">Paket III</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="w-full mb-3">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            event_available
                                        </span>
                                    </span>
                                    <input type="date" id="start_date" name="start_date"
                                        class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5  @error('start_date') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="TANGGAL MULAI"
                                        value="{{ old('start_date', date_format(date_create($advertisement->start_date), 'Y-m-d')) }}"
                                        oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                        oninput="setCustomValidity('')" required>
                                </div>
                                @error('start_date')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="w-full mb-3">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            event_busy
                                        </span>
                                    </span>
                                    <input type="date" id="end_date" name="end_date"
                                        class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5  @error('end_date') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="TANGGAL SELESAI"
                                        value="{{ old('end_date', date_format(date_create($advertisement->end_date), 'Y-m-d')) }}"
                                        oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                        oninput="setCustomValidity('')" required>
                                </div>
                                @error('end_date')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            {{-- <div class="w-full mb-3">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            info
                                        </span>
                                    </span>
                                    <select id="countries"
                                        class="bg-[#FFFFFF] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                        <option selected>Aktif</option>
                                        <option value="US">Kadaluarsa</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="w-full mb-3">
                                <textarea id="description" name="description" rows="4"
                                    class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#FFFFFF] rounded-lg border border-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] @error('description') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="DESKRIPSI IKLAN ANDA">{{ old('description', $advertisement->description) }}</textarea>
                                @error('description')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex flex-row flex-wrap justify-center">
                                <button type="submit"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                    onclick="return confirm('Apakah anda yakin ingin memperbarui data?')">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
