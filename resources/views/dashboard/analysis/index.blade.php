@extends('dashboard.layouts.main')

@section('container')
    <div class="p-4 min-h-screen sm:ml-64 bg-[#F1F8FE]">
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex rounded">
                    <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                        <span class="material-symbols-rounded">
                            bar_chart_4_bars
                        </span>
                        <span class="ml-3">{{ $title }}</span>
                    </a>
                </div>
            </div>

            {{-- FARMER --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
                <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                    <div class="flex flex-col">
                        <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">ANALISIS</span>
                        <div class="flex flex-col justify-between">
                            <canvas class="mt-4 w-full" id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="rounded bg-[#1B232E] col-span-2 xl:col-auto p-2">
                    <div class="p-1">
                        <span class="h-full px-3 rounded-lg bg-[#F1F8FE]">ADS</span>
                    </div>
                </div>
            </div>
            {{-- END FARMER --}}

            <div class="flex justify-end mb-4">
                <button data-modal-target="large-modal" data-modal-toggle="large-modal" type="submit"
                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm px-5 py-2.5 focus:outline-none flex flex-row justify-center items-center"><span
                        class="material-symbols-rounded">
                        add_circle
                    </span>
                    <p class="text-xl ml-3">Tambah</p>
                </button>
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
            @elseif (session()->has('error'))
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
            @endif

            <div class="relative overflow-x-auto border sm:rounded-lg mt-5">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Modal
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pendapatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Keuntungan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Pencatatan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    @if ($datas->count())
                        @foreach ($datas as $data)
                            <tbody>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4">
                                        Rp. {{ number_format($data->initial_capital) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp. {{ number_format($data->total_income) }}
                                    </td>
                                    <td
                                        class="px-6 py-4 {{ $data->total_income - $data->initial_capital < 0 ? 'text-[#FF5A8A]' : 'text-[#36BB6A]' }} font-medium">
                                        Rp. {{ number_format($data->total_income - $data->initial_capital) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $data->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="/dashboard/analysis/{{ $data->id }}/edit"
                                            class="flex justify-center items-center text-[#F1F8FE] bg-[#FF9E22] hover:bg-[#FF9E22]/75 focus:ring-4 focus:ring-[#FF9E22]/50 font-medium rounded-lg text-sm w-10 px-3 py-2 focus:outline-none"><span
                                                class="material-symbols-rounded">
                                                visibility
                                            </span></a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    @else
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th class="px-6 py-4 text-center" colspan="6">
                                    Tidak ada data laba rugi
                                </th>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        {{ $datas->links() }}
    </div>

    {{-- MODAL --}}
    <div id="large-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-[#F1F8FE] rounded-lg shadow">
                <div class="px-6 py-6 lg:px-8 flex flex-col justify-center items-center">
                    <h3 class="mb-4 text-xl text-center font-medium text-[#36BB6A]">TAMBAH ANALISIS</h3>
                    <form class="space-y-6 w-full" action="/dashboard/analysis" method="post">
                        @csrf
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        inbox
                                    </span>
                                </span>
                                <input type="number" id="initial_capital" name="initial_capital"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('initial_capital') invalid:border-[#FF5A8A] @enderror"
                                    value="{{ old('initial_capital') }}" placeholder="MODAL" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')">
                            </div>
                            @error('initial_capital')
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
                                        move_to_inbox
                                    </span>
                                </span>
                                <input type="number" id="total_income" name="total_income"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('total_income') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="PENDAPATAN" value="{{ old('total_income') }}" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')">
                            </div>
                            @error('total_income')
                                <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full mb-3">
                            <textarea id="description" name="description" rows="4"
                                class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#F1F8FE] rounded-lg border border-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] @error('description') invalid:border-[#FF5A8A] @enderror"
                                placeholder="BELUM ADA TANGGAPAN">{{ old('description') }}</textarea>
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
@endsection
