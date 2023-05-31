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

            {{-- FARMER --}}
            <div class="flex justify-center items-center">
                <div class="bg-[#F1F8FE] shadow-md m-0 md:m-3 w-full md:w-2/3 flex flex-col justify-center items-center p-5">
                    <h3 class="mb-4 text-xl text-center font-medium text-[#36BB6A]">UBAH PRODUK</h3>
                    <img class="rounded-lg" id="img-preview" src="{{ asset('storage/' . $product->image) }}"
                        alt="display-img">
                    <form class="space-y-6" action="/dashboard/product/{{ $product->id }}" method="post"
                        enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="hidden" name="oldImage" value="{{ $product->image }}">
                        <div class="w-full mb-3">
                            <input
                                class="block w-full text-sm text-[#1B232E] border border-[#1B232E] rounded-lg cursor-pointer bg-[#F1F8FE] focus:outline-none @error('image') invalid:border-[#FF5A8A] @enderror image_path"
                                aria-describedby="image" id="image" name="image" type="file"
                                onchange="previewImage()" />
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
                                    oninput="setCustomValidity('')" value="{{ old('name', $product->name) }}">
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
                                    oninput="setCustomValidity('')" value="{{ old('stock', $product->stock) }}">
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
                                    oninput="setCustomValidity('')" value="{{ old('price', $product->price) }}">
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
                                    placeholder="NOMOR REKENING" value="{{ $product->rekening }}">
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
                                    placeholder="ALAMAT PRODUK" value="{{ old('address', $product->address) }}">
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
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        info
                                    </span>
                                </span>
                                <select id="status" name="status"
                                    class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5"
                                    required>
                                    @if ($product->status == 1)
                                        <option value="1" selected>Buka</option>
                                        <option value="2">Tutup</option>
                                    @else
                                        <option value="1">Buka</option>
                                        <option value="2" selected>Tutup</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-row flex-wrap justify-center">
                            <button type="submit" onclick="return confirm('Apakah ingin memperbarui data?')"
                                class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
