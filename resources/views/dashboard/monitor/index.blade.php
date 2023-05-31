@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 sm:ml-64 bg-[#F1F8FE]">
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex rounded">
                    <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                        <span class="material-symbols-rounded">
                            calendar_month
                        </span>
                        <span class="ml-3">{{ $title }}</span>
                    </a>
                </div>
            </div>

            {{-- FARMER --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
                <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                    <div class="flex flex-col h-full justify-between">
                        <div class="title-section">
                            <span class="h-full w-40 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">CUACA
                                FORECAST</span>
                        </div>
                        <div class="grid grid-cols-2 xl:grid-cols-3 gap-4 justify-between h-full">
                            <div class="col-span-2">
                                {{-- <div class="flex flex-row flex-wrap justify-between"> --}}
                                <div class="flex flex-row flex-wrap justify-between" id="weather-forecast">
                                    {{-- <div
                                        class="border-2 border-[#293649] rounded-lg p-5 flex flex-col mt-5 items-center text-center justify-between w-full md:w-52 lg:w-60 mr-2">
                                        <p class="text-2xl font-semibold text-[#293649] mb-2">Jum’at</p>
                                        <div
                                            class="bg-[#FF5A8A]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2 mb-2">
                                            <div
                                                class="bg-[#FF5A8A] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                                <span class="material-symbols-rounded">
                                                    monitoring
                                                </span>
                                            </div>
                                        </div>
                                        <p class="text-sm text-[#293649] mb-2">Pendapatan</p>
                                        <p class="text-2xl font-semibold text-[#293649]">89°F</p>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="flex items-center justify-center rounded mt-5 col-span-2 xl:col-auto">
                                <div class="bg-[#1B232E] w-full rounded-lg flex xl:h-full">
                                    <div class="p-1">
                                        @if ($advertisement1->count())
                                            <div class="flex justify-center items-center h-full">
                                                <img src="{{ asset('storage/' . $advertisement1[0]->image_path) }}"
                                                    alt="ads">
                                            </div>
                                        @else
                                            <div class="p-1">
                                                <span class="h-full px-3 rounded-lg bg-[#F1F8FE]">ADS</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded bg-[#FFFFFF] col-span-2 xl:col-auto p-5">
                    <div class="flex flex-col justify-between h-full">
                        <div class="title-section">
                            <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">CUACA</span>
                        </div>
                        <div
                            class="border-2 border-[#293649] rounded-lg p-5 flex flex-col mt-5 items-center text-center h-full justify-between">
                            <p class="text-2xl font-semibold text-[#293649] mb-3" id="Date">Jum’at 28 April 2023</p>
                            <div class="p-3">
                                <img class="w-12" id="Icon" src="/img/hourglass.png" alt="weather_image">
                            </div>
                            <p class="text-sm text-[#293649] mb-3" id="IconPhrase">Pendapatan</p>
                            <div class="flex flex-row flex-wrap">
                                <p class="text-2xl font-semibold text-[#293649] mx-2" id="Maximum">89°F</p>
                                <p class="text-2xl font-semibold text-[#293649] mx-2" id="Minimum">89°F</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
                <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                    <div class="flex flex-col">
                        <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">PENJADWALAN</span>
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex items-center justify-center rounded mt-5">
                                <div class="bg-[#1B232E] w-full rounded-lg flex">
                                    <div class="p-1 w-full">
                                        @if ($advertisement2->count())
                                            <div class="flex flex-row justify-center items-center w-full">
                                                <img src="{{ asset('storage/' . $advertisement2[0]->image_path) }}"
                                                    alt="ads">
                                            </div>
                                        @else
                                            <div class="p-1">
                                                <span class="h-full px-3 rounded-lg bg-[#F1F8FE]">ADS</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($monitors->count())
                                <div class="w-full bg-gray-200 rounded-full mt-5">
                                    @if (now() >= $monitors[0]->pemanenan)
                                        <div class="bg-[#8ED145] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                            style="width: 100%"> 100%</div>
                                    @endif
                                    @if (now() >= $monitors[0]->pemupukan_2 && now() <= $monitors[0]->pemanenan)
                                        <div class="bg-[#8ED145] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                            style="width: 65%"> 65%</div>
                                    @endif
                                    @if (now() >= $monitors[0]->pemupukan_1 && now() <= $monitors[0]->pemupukan_2)
                                        <div class="bg-[#8ED145] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                            style="width: 35%"> 35%</div>
                                    @endif
                                    @if (now() >= $monitors[0]->penanaman && now() <= $monitors[0]->pemupukan_1)
                                        <div class="bg-[#8ED145] text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                            style="width: 15%"> 15%</div>
                                    @endif
                                </div>
                                <div class="flex flex-row flex-wrap justify-around mt-2">
                                    <div class="bar-description text-center m-2">
                                        <p class="text-sm text-[#1B232E]">
                                            {{ date_format(date_create($monitors[0]->penanaman), 'd M Y') }}</p>
                                        <p class="text-2xl font-semibold text-[#1B232E]">(Penanaman)</p>
                                    </div>
                                    <div class="bar-description text-center m-2">
                                        <p class="text-sm text-[#1B232E]">
                                            {{ date_format(date_create($monitors[0]->pemupukan_1), 'd M Y') }}</p>
                                        <p class="text-2xl font-semibold text-[#1B232E]">(Pemupukan I)</p>
                                    </div>
                                    <div class="bar-description text-center m-2">
                                        <p class="text-sm text-[#1B232E]">
                                            {{ date_format(date_create($monitors[0]->pemupukan_2), 'd M Y') }}</p>
                                        <p class="text-2xl font-semibold text-[#1B232E]">(Pemupukan II)</p>
                                    </div>
                                    <div class="bar-description text-center m-2">
                                        <p class="text-sm text-[#1B232E]">
                                            {{ date_format(date_create($monitors[0]->pemanenan), 'd M Y') }}</p>
                                        <p class="text-2xl font-semibold text-[#1B232E]">(Pemanenan)</p>
                                    </div>
                                </div>
                            @else
                                <p class="my-3 text-center font-bold">Tidak ada jadwal penanaman</p>
                            @endif
                            <div class="caution flex flex-row">
                                <div class="bg-[#FF5A8A] h-5 w-5 rounded-full mr-2"></div>
                                <p class="text-sm font-semibold">Penjadwalan ini hanya sebagai gambaran mulai proses
                                    penanaman sampai pemanenan</p>
                            </div>
                        </div>
                        <div class="flex flex-row my-5 justify-center lg:justify-between flex-wrap">
                            <p class="text-2xl font-bold text-center lg:text-left">TAMBAH PENJADWALAN</p>
                            <form class="flex mt-2 lg:mt-0" action="/dashboard/monitor" method="post">
                                @csrf
                                <input class="mx-0 md:mx-3 rounded-full" type="date" id="penanaman" name="penanaman"
                                    required oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')">
                                <button type="submit" onclick="return confirm('Apa data yang dimasukkan sudah benar?')"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm px-5 py-2.5 focus:outline-none flex flex-row justify-center items-center @error('penananman') invalid:border-[#FF5A8A] @enderror"><span
                                        class="material-symbols-rounded">
                                        add_circle
                                    </span>
                                    <p class="text-xl">Tambah</p>
                                </button>
                            </form>
                            @error('penanaman')
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
                        @elseif (session()->has('error'))
                            <div id="alert" class="flex p-4 text-[#1B232E] rounded-lg bg-[#FF5A8A] w-full"
                                role="alert">
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
                        @endif
                        <div class="flex flex-col">
                            <div class="relative overflow-x-auto border sm:rounded-lg mt-5">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                No
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Penanaman
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Pemupukan I
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Pemupukan II
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Pemanenan
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    @if ($monitors->count())
                                        @foreach ($monitors as $monitor)
                                            <tbody>
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <th scope="row"
                                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $loop->iteration }}
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{ date_format(date_create($monitor->penanaman), 'd M Y') }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ date_format(date_create($monitor->pemupukan_1), 'd M Y') }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ date_format(date_create($monitor->pemupukan_2), 'd M Y') }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ date_format(date_create($monitor->pemanenan), 'd M Y') }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <form action="/dashboard/monitor/{{ $monitor->id }}"
                                                            method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit"
                                                                onclick="return confirm('Apa anda yakin untuk menghapus ini?')"
                                                                class="text-[#F1F8FE] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:ring-[#FF5A8A]/50 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none"><span
                                                                    class="material-symbols-rounded">
                                                                    delete
                                                                </span></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    @else
                                        <tbody>
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <th class="px-6 py-4 text-center" colspan="6">
                                                    Tidak ada jadwal penanaman
                                                </th>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded bg-[#1B232E] col-span-2 xl:col-auto p-2">
                    @if ($advertisement1->count())
                        <div class="flex justify-center items-center h-full">
                            <img src="{{ asset('storage/' . $advertisement1[0]->image_path) }}" alt="ads">
                        </div>
                    @else
                        <div class="p-1">
                            <span class="h-full px-3 rounded-lg bg-[#F1F8FE]">ADS</span>
                        </div>
                    @endif
                </div>
            </div>
            {{-- END FARMER --}}
        </div>
    </div>

    {{-- JS --}}
    <script src="/js/weather.js"></script>
@endsection
