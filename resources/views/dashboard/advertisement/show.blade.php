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
                    <img class="rounded-lg" src="{{ asset('storage/' . $advertisement->image_path) }}" alt="display-img">
                </div>
            </div>
            <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                <h3 class="mb-5 text-xl text-center font-medium text-[#36BB6A]">IKLAN</h3>
                <div class="flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        tag
                                    </span>
                                </span>
                                <input type="text" id="title" name="title"
                                    class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="NAMA" value="{{ $advertisement->title }}" disabled required>
                            </div>
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
                                    class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="TAUTAN" value="{{ $advertisement->link }}" disabled required>
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        checklist
                                    </span>
                                </span>
                                <input type="text" id="advertising_package" name="advertising_package"
                                    class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="TAUTAN" value="Paket {{ $advertisement->advertising_package }}" disabled
                                    required>
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
                                <input type="text" id="start_date" name="start_date"
                                    class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="TANGGAL MULAI"
                                    value="{{ date_format(date_create($advertisement->start_date), 'd M Y') }}" disabled
                                    required>
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#FFFFFF] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        event_busy
                                    </span>
                                </span>
                                <input type="text" id="end_date" name="end_date"
                                    class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="TANGGAL SELESAI"
                                    value="{{ date_format(date_create($advertisement->end_date), 'd M Y') }}" disabled
                                    required>
                            </div>
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
                                class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#FFFFFF] rounded-lg border border-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E]"
                                placeholder="DESKRIPSI IKLAN ANDA" disabled>{{ $advertisement->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
