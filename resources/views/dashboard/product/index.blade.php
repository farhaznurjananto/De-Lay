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
                            @if ($product->image)
                                <img class="rounded-t-lg max-h-36" src="{{ asset('storage/' . $product->image) }}"
                                    alt="produk" />
                            @else
                                <img class="rounded-t-lg" src="/img/default-img.jpeg" alt="produk" />
                            @endif
                            <div class="p-5 flex flex-col justify-center">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h5>
                                <p class="mb3 font-normal text-gray-700"><span class="font-medium">Stok:</span>
                                    {{ $product->stock }} kg</p>
                                <p class="mb-3 font-normal text-gray-700"><span class="font-medium">Harga:</span> Rp.
                                    {{ number_format($product->price) }}
                                    /
                                    kg</p>
                                <p class="mb-3 font-normal text-gray-700"><span class="font-medium">Status:</span>
                                    @if ($product->status == 1)
                                        <span
                                            class="bg-[#8ED145] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Buka</span>
                                    @else
                                        <span
                                            class="bg-[#FF5A8A] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Tutup</span>
                                    @endif
                                </p>
                                <a href="/dashboard/product/{{ $product->id }}/edit"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center flex justify-center items-center">Ubah
                                    <span class="material-symbols-rounded ml-2">
                                        edit
                                    </span></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-2">
                        <p class="text-center">Tidak ada produk.</p>
                    </div>
                @endif

                {{ $products->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div id="large-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-[#F1F8FE] rounded-lg shadow">
                <div class="px-6 py-6 lg:px-8 flex flex-col justify-center items-center">
                    <h3 class="mb-4 text-xl text-center font-medium text-[#36BB6A]">TAMBAH PRODUK</h3>
                    <img class="rounded-lg" id="img-preview" src="/img/display-img.png" alt="display-img">
                    <form class="space-y-6" action="/dashboard/product" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="w-full mb-3">
                            <input
                                class="block w-full text-sm text-[#1B232E] border border-[#1B232E] rounded-lg cursor-pointer bg-[#F1F8FE] focus:outline-none @error('image') invalid:border-[#FF5A8A] @enderror image_path"
                                aria-describedby="image" id="image" name="image" type="file" required
                                onchange="previewImage()"
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" />
                            <p class="mt-1 text-sm text-gray-500" id="image">Upload
                                gambar produk max 1mb.
                            </p>
                            @error('image')
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
                                        inventory_2
                                    </span>
                                </span>
                                <input type="text" id="name" name="name"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('name') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="NAMA PRODUK" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')" value="{{ old('name') }}">
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
                                        inventory
                                    </span>
                                </span>
                                <input type="number" id="stock" name="stock"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('stock') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="STOK PRODUK" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')" value="{{ old('stock') }}">
                            </div>
                            <p class="mt-1 text-sm text-gray-500" id="file_input_help">Masukkan stok produk dalam
                                satuan Kilogram.
                            </p>
                            @error('stock')
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
                                        sell
                                    </span>
                                </span>
                                <input type="text" id="price" name="price"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('price') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="HARGA PRODUK" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')" value="{{ old('price') }}">
                            </div>
                            @error('price')
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
                                        add_card
                                    </span>
                                </span>
                                <input type="number" id="rekening" name="rekening"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('rekening') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="NOMOR REKENING" value="0">
                            </div>
                            <p class="mt-1 text-sm text-gray-500" id="file_input_help">Masukkan nomor rekening anda
                                sebagai alternatif pembayaran transfer. Inputkan nilai 0 untuk pembayaran non-transfer.
                            </p>
                            @error('rekening')
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
                                        home
                                    </span>
                                </span>
                                <input type="text" id="address" name="address"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('address') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="ALAMAT PRODUK" value="{{ old('address') }}">
                            </div>
                            <p class="mt-1 text-sm text-gray-500" id="file_input_help">Masukkan alamat produk sebgai
                                pengiriman non-delivery.
                            </p>
                            @error('address')
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
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('phone') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="NOMOR TELEPON" value="{{ auth()->user()->phone }}" required readonly>
                            </div>
                            <p class="mt-1 text-sm text-gray-500" id="file_input_help">Nomor telepon anda akan kami
                                sertakan untuk jalur komunikasi antar pembeli dan penjual.
                            </p>
                            @error('phone')
                                <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <p class="text-lg font-semibold text-[#FF5A8A] text-center">Aplikasi kami tidak melayani
                            sistem
                            pendistribusian produk harap komunikasikan hal pendistribusian produk bersama pembeli.</p>
                        <div class="flex flex-row flex-wrap justify-center">
                            <button type="button" data-modal-hide="large-modal"
                                class="text-[#F1F8FE] bg-[#1B232E] hover:bg-[#1B232E]/75 focus:ring-4 focus:outline-none focus:ring-[#1B232E]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Batal</button>
                            <button type="submit" onclick="return confirm('Apakah data yang dimasukkan sudah benar?')"
                                class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
