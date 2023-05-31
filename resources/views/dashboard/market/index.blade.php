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
                <div id="alert" class="flex p-4 text-[#1B232E] rounded-lg bg-[#FF5A8A] w-full mb-3" role="alert">
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
            @elseif (session()->has('success'))
                <div id="alert" class="flex p-4 w-full text-[#1B232E] rounded-lg bg-[#8ED145] mb-3" role="alert">
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

            <div class="flex justify-between md:justify-around flex-wrap items-center">
                @if ($products->count())
                    @foreach ($products as $product)
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow m-3">
                            <a href="#">
                                <img class="rounded-t-lg max-h-36" src="{{ asset('storage/' . $product->image) }}"
                                    alt="produk" />
                            </a>
                            <div class="p-5 flex flex-col justify-center">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $product->name }}
                                    </h5>
                                </a>
                                <p class="mb-3 font-normal text-gray-700"><span class="font-medium">Stok:</span>
                                    {{ $product->stock }} kg</p>
                                <p class="mb-3 font-normal text-gray-700"><span class="font-medium">Harga:</span> Rp.
                                    {{ number_format($product->price) }}
                                    /
                                    kg</p>
                                <a href="/dashboard/market/{{ $product->id }}"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center flex justify-center items-center">Beli
                                    <span class="material-symbols-rounded">
                                        shopping_cart
                                    </span></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-2">
                        <p class="text-center">Tidak ada produk.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
