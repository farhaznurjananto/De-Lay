@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 sm:ml-64 bg-[#F1F8FE] min-h-screen">
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex rounded">
                    <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                        <span class="material-symbols-rounded">
                            inventory_2
                        </span>
                        <span class="ml-3">{{ $title }}</span>
                    </a>
                </div>
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
                                Nama Produk
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Pemesanan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    @if ($orders->count())
                        <tbody>
                            @foreach ($orders as $order)
                                @if ($order->product != null)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $order->product->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($order->status == 'pending')
                                                <span
                                                    class="bg-[#FF9E22] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $order->status }}</span>
                                            @elseif($order->status == 'rejected')
                                                <span
                                                    class="bg-[#FF5A8A] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $order->status }}</span>
                                            @else
                                                {{-- ini kalau mau ada riwayat hapus aja --}}
                                                <span
                                                    class="bg-[#8ED145] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td class="flex px-6 py-4">
                                            <a href="/dashboard/order/{{ $order->id }}"
                                                class="flex justify-center items-center w-12 text-[#F1F8FE] bg-[#FF9E22] hover:bg-[#FF9E22]/75 focus:ring-4 focus:ring-[#FF9E22]/50 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none"><span
                                                    class="material-symbols-rounded">
                                                    visibility
                                                </span></a>
                                            @can('produsen')
                                                <a href="/dashboard/order/{{ $order->id }}/edit"
                                                    class="mx-2 text-[#F1F8FE] bg-[#8ED145] hover:bg-[#8ED145]/75 focus:ring-4 focus:ring-[#8ED145]/50 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none"><span
                                                        class="material-symbols-rounded">
                                                        edit
                                                    </span></a>
                                                <form action="/dashboard/order/{{ $order->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-[#F1F8FE] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:ring-[#FF5A8A]/50 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none"
                                                        onclick="return confirm('Apakah anda yakin untuk membatalkan pemesanan ini?')"><span
                                                            class="material-symbols-rounded">
                                                            delete
                                                        </span></button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    @else
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4" colspan="5">
                                    <p class="text-center text-[#1B232E]">Tidak ada pemesanan.</p>
                                </td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        {{ $orders->links() }}
    </div>
@endsection
