@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 sm:ml-64 bg-[#F1F8FE] min-h-screen">
        <div class="p-4">
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

            <div class="flex justify-end mb-4">
                <button data-modal-target="large-modal" data-modal-toggle="large-modal" type="submit"
                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm px-5 py-2.5 focus:outline-none flex flex-row justify-center items-center"><span
                        class="material-symbols-rounded">
                        add_circle
                    </span>
                    <p class="text-xl ml-3">Tambah</p>
                </button>
            </div>

            @if (session()->has('error'))
                <div id="alert" class="flex p-4 text-[#1B232E] rounded-lg bg-[#FF5A8A] w-full" role="alert">
                    <span class="material-symbols-rounded">
                        info
                    </span>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button" id="dismiss-btn"
                        class="ml-auto -mx-1.5 -my-1.5 bg-[#F1F8FE] text-[#1B232E] rounded-lg focus:ring-2 focus:ring-[#FF1458]/50 p-1.5 hover:bg-[#FF1458]/75 inline-flex h-8 w-8"
                        data-dismiss="alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <span class="material-symbols-rounded">
                            close
                        </span>
                    </button>
                </div>
            @elseif(session()->has('success'))
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

            <div class="relative overflow-x-auto border sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Mulai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Selesai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Paket
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    @if ($advertisements->count())
                        <tbody>
                            @foreach ($advertisements as $advertisement)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $advertisement->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ date_format(date_create($advertisement->start_date), 'd M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ date_format(date_create($advertisement->end_date), 'd M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (now() < $advertisement->end_date && now() > $advertisement->start_date)
                                            <span
                                                class="bg-[#8ED145] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Aktif</span>
                                        @else
                                            <span
                                                class="bg-[#FF5A8A] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Kadaluarsa</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $advertisement->advertising_package }}
                                    </td>
                                    <td class="px-6 py-4 flex flex-row">
                                        <a href="/dashboard/advertisement/{{ $advertisement->id }}"
                                            class="text-[#F1F8FE] bg-[#FF9E22] hover:bg-[#FF9E22]/75 focus:ring-4 focus:ring-[#FF9E22]/50 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none"><span
                                                class="material-symbols-rounded">
                                                visibility
                                            </span></a>
                                        <form action="/dashboard/advertisement/{{ $advertisement->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                class="text-[#F1F8FE] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:ring-[#FF5A8A]/50 font-medium rounded-lg text-sm px-3 py-2 mx-2 focus:outline-none"
                                                onclick="return confirm('Apakah anda yakin untuk menghapus iklan ini?')"><span
                                                    class="material-symbols-rounded">
                                                    delete
                                                </span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4" colspan="7">
                                    <p class="text-center text-[#1B232E]">Tidak ada iklan.</p>
                                </td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>

        {{ $advertisements->links() }}
    </div>

    {{-- MODAL --}}
    <div id="large-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full md:w-1/2 max-h-full">
            <div class="relative bg-[#F1F8FE] rounded-lg shadow">
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-5 text-xl text-center font-medium text-[#36BB6A]">TAMBAH IKLAN</h3>
                    <div class="grid grid-cols-1 xl:grid-cols-2 justify-between">
                        <div class="flex justify-center items-center mx-5 mb-5 xl:mb-0">
                            <img class="rounded-lg" id="img-preview" src="/img/display-img.png" alt="display-img">
                        </div>
                        <form class="space-y-6" action="/dashboard/advertisement" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="w-full mb-3">
                                <input
                                    class="block w-full text-sm text-[#1B232E] border border-[#1B232E] rounded-lg cursor-pointer bg-[#F1F8FE] focus:outline-none @error('image_path') invalid:border-[#FF5A8A] @enderror image_path"
                                    aria-describedby="image_path" id="image_path" name="image_path" type="file"
                                    onchange="previewImage()"
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')" value="{{ old('title') }}" required>
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
                                        class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            tag
                                        </span>
                                    </span>
                                    <input type="text" id="title" name="title"
                                        class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('title') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="JUDUL"
                                        oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                        oninput="setCustomValidity('')" value="{{ old('title') }}" required>
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
                                        class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            link
                                        </span>
                                    </span>
                                    <input type="text" id="link" name="link"
                                        class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5  @error('link') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="TAUTAN" value="{{ old('link') }}">
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
                                        class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            checklist
                                        </span>
                                    </span>
                                    <select id="advertising_package" name="advertising_package"
                                        class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                        <option value="I">Paket I</option>
                                        <option value="II">Paket II</option>
                                        {{-- <option value="III">Paket III</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="w-full mb-3">
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            event_available
                                        </span>
                                    </span>
                                    <input type="date" id="start_date" name="start_date"
                                        class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5  @error('start_date') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="TANGGAL MULAI" value="{{ old('start_date') }}"
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
                                        class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            event_busy
                                        </span>
                                    </span>
                                    <input type="date" id="end_date" name="end_date"
                                        class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5  @error('end_date') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="TANGGAL SELESAI" value="{{ old('end_date') }}"
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
                                        class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                        <span class="material-symbols-rounded">
                                            info
                                        </span>
                                    </span>
                                    <select id="countries"
                                        class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                        <option selected>Aktif</option>
                                        <option value="US">Kadaluarsa</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="w-full mb-3">
                                <textarea id="description" name="description" rows="4"
                                    class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#F1F8FE] rounded-lg border border-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] @error('description') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="DESKRIPSI IKLAN ANDA">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex flex-row flex-wrap justify-center">
                                <button type="button" data-modal-hide="large-modal"
                                    class="text-[#F1F8FE] bg-[#1B232E] hover:bg-[#1B232E]/75 focus:ring-4 focus:outline-none focus:ring-[#1B232E]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Batal</button>
                                <button type="submit"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                    onclick="return confirm('Apakah data yang dimasukkan sudah benar?')">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
