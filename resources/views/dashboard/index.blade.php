@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 sm:ml-64 bg-[#F1F8FE] min-h-screen">
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex rounded">
                    <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                        <span class="material-symbols-rounded">
                            dashboard
                        </span>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </div>
            </div>

            @can('farmer')
                {{-- FARMER --}}
                <div class="mb-4 rounded bg-[#FFFFFF] p-5">
                    <div class="flex flex-col">
                        <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">RNGKASAN</span>
                        <div class="mt-5 flex flex-row justify-between flex-wrap">
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#FF5A8A]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#FF5A8A] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            monitoring
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#FF5A8A]">Rp. {{ number_format($incomes) }}</p>
                                    <p class="text-sm text-[#293649]">Pendapatan</p>
                                </div>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#7095F3]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#7095F3] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            list_alt
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#7095F3]">{{ $orders }}</p>
                                    <p class="text-sm text-[#293649]">Pemesanan</p>
                                </div>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#FF9E22]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#FF9E22] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            inventory_2
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#FF9E22]">{{ $products }}</p>
                                    <p class="text-sm text-[#293649]">Produk</p>
                                </div>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#36BB6A]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#36BB6A] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            forum
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#36BB6A]">{{ $forums }}</p>
                                    <p class="text-sm text-[#293649]">Forum</p>
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
                                                <a href="{{ $advertisement2[0]->link }}" target="_blank">
                                                    <div class="flex flex-row justify-center items-center w-full">
                                                        <img src="{{ asset('storage/' . $advertisement2[0]->image_path) }}"
                                                            alt="ads">
                                                    </div>
                                                </a>
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
                                    <p class="text-sm font-semibold">Tidak Ada Jadwal Penanaman</p>
                                @endif
                                <div class="flex flex-row">
                                    <div class="bg-[#FF5A8A] h-5 w-5 rounded-full mr-2"></div>
                                    <p class="text-sm font-semibold">Penjadwalan ini hanya sebagai gambaran mulai proses
                                        penanaman sampai pemanenan</p>
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
                {{-- END FARMER --}}

                {{-- JS --}}
                <script src="/js/weather.js"></script>
            @endcan

            @can('produsen')
                {{-- PRODUSEN --}}
                <div class="mb-4 rounded bg-[#FFFFFF] p-5">
                    <div class="flex flex-col">
                        <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">RNGKASAN</span>
                        <div class="mt-5 flex flex-row justify-between flex-wrap">
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#FF5A8A]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#FF5A8A] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            monitoring
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#FF5A8A]">Rp. {{ number_format($incomes) }}</p>
                                    <p class="text-sm text-[#293649]">Pendapatan</p>
                                </div>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#7095F3]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#7095F3] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            list_alt
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#7095F3]">{{ $orders_produsen }}</p>
                                    <p class="text-sm text-[#293649]">Pemesanan</p>
                                </div>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#FF9E22]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#FF9E22] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            receipt_long
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#FF9E22]">{{ $total_orders }}</p>
                                    <p class="text-sm text-[#293649]">Riwayat Pemesanan</p>
                                </div>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row m-2 w-full md:w-60">
                                <div class="bg-[#36BB6A]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#36BB6A] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            forum
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#36BB6A]">{{ $forums }}</p>
                                    <p class="text-sm text-[#293649]">Forum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END PRODUSEN --}}
            @endcan

            @canany(['farmer', 'produsen'])
                <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
                    <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                        <div class="flex flex-col">
                            <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">ANALISIS</span>
                            <canvas class="mt-4 w-full" id="myChart"></canvas>
                            {{-- <div class="flex flex-col justify-between h-60">
                            </div> --}}
                        </div>
                    </div>
                    <div class="rounded bg-[#1B232E] col-span-2 xl:col-auto p-2">
                        @if ($advertisement1->count())
                            <a href="{{ $advertisement1[0]->link }}" target="_blank">
                                <div class="flex justify-center items-center h-full">
                                    <img src="{{ asset('storage/' . $advertisement1[0]->image_path) }}" alt="ads">
                                </div>
                            </a>
                        @else
                            <div class="p-1">
                                <span class="h-full px-3 rounded-lg bg-[#F1F8FE]">ADS</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- JS --}}
                <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
                    integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
                </script>

                <script>
                    const ctx = document.getElementById("myChart");

                    const labels = {!! json_encode($labels) !!};
                    const keuntungan = {!! json_encode($profit) !!};

                    const data = {
                        labels: labels,
                        datasets: [{
                            label: "Keuntungan",
                            data: keuntungan,
                            backgroundColor: "rgba(54, 187, 106, 0.2)",
                            borderColor: "rgba(54, 187, 106, 1)",
                            borderWidth: 1,
                            pointRadius: 5,
                            pointBackgroundColor: function(context) {
                                var value = context.dataset.data[context.dataIndex];
                                return value >= 0 ? "rgba(54, 187, 106, 1)" : "rgba(255, 90, 138, 1)";
                            },
                            pointBorderColor: '#fff',
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: function(context) {
                                var value = context.dataset.data[context.dataIndex];
                                return value >= 0 ? "rgba(54, 187, 106, 1)" : "rgba(255, 90, 138, 1)";
                            },
                        }, ],
                    };

                    const config = {
                        type: "line",
                        data: data,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },
                        },
                    };

                    var myChart = new Chart(ctx, config);
                </script>
            @endcanany

            @can('admin')
                {{-- ADMIN --}}
                <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
                    <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                        <div class="flex flex-col">
                            <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">IKLAN</span>
                            <div class="relative overflow-x-auto border sm:rounded-lg my-5">
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
                                        </tr>
                                    </thead>
                                    @if ($advertisements->count())
                                        <tbody>
                                            @foreach ($advertisements as $advertisement)
                                                <tr class="bg-white border-b hover:bg-gray-50">
                                                    <th scope="row"
                                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td class="px-6 py-4" colspan="7">
                                                    <p class="text-center text-[#1B232E]">Tidak ada iklan.</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                            {{ $advertisements->links() }}
                        </div>
                    </div>
                    <div class="rounded bg-[#FFFFFF] col-span-2 xl:col-auto p-5">
                        <div class="flex flex-col justify-between h-full">
                            <div class="title-section">
                                <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">FORUM</span>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row mt-5">
                                <div class="bg-[#36BB6A]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#36BB6A] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            forum
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#36BB6A]">{{ $forums }}</p>
                                    <p class="text-sm text-[#293649]">Semua Forum</p>
                                </div>
                            </div>
                            <div class="border-2 border-[#293649] rounded-lg p-5 flex flex-row mt-5">
                                <div class="bg-[#FF5A8A]/75 rounded-full w-12 h-12 flex justify-center items-center mr-2">
                                    <div
                                        class="bg-[#FF5A8A] rounded-full w-10 h-10 flex justify-center items-center text-[#F1F8FE]">
                                        <span class="material-symbols-rounded">
                                            speaker_notes_off
                                        </span>
                                    </div>
                                </div>
                                <div class="description">
                                    <p class="text-2xl font-semibold text-[#FF5A8A]">{{ $forums_deleted }}</p>
                                    <p class="text-sm text-[#293649]">Forum di Tutup</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END ADMIN --}}
            @endcan
        </div>
    </div>
@endsection
