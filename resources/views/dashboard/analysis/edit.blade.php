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
                            <canvas class="my-4" id="myChart"></canvas>
                        </div>
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
            {{-- END FARMER --}}

            {{-- FARMER --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
                <div class="rounded bg-[#FFFFFF] p-5 col-span-2 xl:col-span-3">
                    <h3 class="mb-4 text-xl text-center font-medium text-[#36BB6A]">UBAH ANALISIS</h3>
                    <form class="space-y-6 w-full" action="/dashboard/analysis/{{ $data->id }}" method="post">
                        @method('put')
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
                                    class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('initial_capital') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="MODAL" value="{{ old('initial_capital', $data->initial_capital) }}"
                                    required oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
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
                                    class="rounded-none rounded-r-lg bg-[#FFFFFF] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('total_income') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="PENDAPATAN" value="{{ old('total_income', $data->total_income) }}" required
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
                                class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#FFFFFF] rounded-lg border border-[#1B232E] focus:ring-blue-500 focus:border-blue-500"
                                placeholder="BELUM ADA TANGGAPAN">{{ old('description', $data->description) }}</textarea>
                        </div>
                        <div class="flex flex-row flex-wrap justify-center">
                            <button type="submit"
                                class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                onclick="return confirm('Apakah ingin memperbarui data?')">Perbarui</button>
                        </div>
                    </form>
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
            {{-- END FARMER --}}
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>

    <script>
        const ctx = document.getElementById("myChart");
        // eslint-disable-next-line no-unused-vars

        const labels = {!! json_encode($labels) !!};
        const modal = {!! json_encode($modal) !!};
        const pendapatan = {!! json_encode($income) !!};

        const data = {
            labels: labels,
            datasets: [{
                    label: "Modal",
                    data: modal,
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Pendapatan",
                    data: pendapatan,
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                },
            ],
        };

        const config = {
            type: "bar",
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
