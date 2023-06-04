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
                <div class="bg-[#F1F8FE] shadow-md m-3 md:m-0 w-full md:w-2/3 rounded-lg">
                    <form action="/dashboard/market" method="post" enctype="multipart/form-data"
                        class="flex flex-col items-center justify-center px-3 md:px-10">
                        @csrf
                        <p class="text-[#36BB6A] text-2xl font-medium my-5 md:my-5">TAMBAH PEMESANAN</p>
                        <div
                            class="bg-[#1B232E] rounded-lg flex flex-row flex-wrap justify-center xl:justify-normal p-2 my-3">
                            <img class="rounded-lg w-full xl:w-1/2" src="{{ asset('storage/' . $product->image) }}"
                                alt="produk-img">
                            <div class="flex flex-col text-[#F1F8FE] justify-center text-center xl:text-left p-3">
                                <p class="font-medium text-3xl">{{ $product->name }}</p>
                                <p class="text-xl">Stok: {{ $product->stock }} kg</p>
                                <p class="text-xl">Harga: Rp. {{ number_format($product->price) }} / kg</p>
                            </div>
                        </div>
                        <input type="number" id="product_id" name="product_id" value="{{ $product->id }}" required hidden>
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        inventory
                                    </span>
                                </span>
                                <input type="number" id="quantity" name="quantity"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('quantity') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="KWANTITAS PRODUK" value="{{ old('quantity') }}" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="totalHarga(); setCustomValidity('')">
                            </div>
                            <p class="mt-1 text-sm text-gray-500" id="file_input_help">Masukkan stok produk dalam
                                satuan Kilogram.
                            </p>
                            @error('quantity')
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
                                        local_shipping
                                    </span>
                                </span>
                                <select id="metode_delivery"
                                    class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                    <option value="1">Delivery (Diantar di tempat)</option>
                                    <option value="2">Non-Delivery (Diambil di tempat)</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full mb-3" id="customer_address">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        home
                                    </span>
                                </span>
                                {{-- @if ($product->address == null) --}}
                                {{-- <input type="text" id="customer_address" name="customer_address"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5 @error('customer_address') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="ALAMAT PEMBELI" value="{{ old('customer_address') }}" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')"> --}}
                                {{-- @else --}}
                                <input type="text" id="customer_address" name="customer_address"
                                    class="rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="ALAMAT PEMBELI" value="{{ old('customer_address') }}">
                                {{-- @endif --}}
                            </div>
                            <p class="mt-1 text-sm text-gray-500" id="file_input_help">Masukkan alamat pembeli sebgai
                                pengiriman delivery.
                            </p>
                            @error('customer_address')
                                <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-3" id="seller_address" style="display: none">
                            <p class="text-lg font-semibold text-[#1B232E] text-center">Alamat Penjual.</p>
                            <p class="text-lg font-semibold text-[#FF5A8A] text-center">
                                {{ $product->address == null ? 'Tidak menerima pengiriman produk Non-Delivery' : $product->address }}
                            </p>
                        </div>
                        <div class="border border-[#1B232E] p-5 rounded-md mb-3">
                            <p class="text-lg font-semibold text-[#1B232E] text-center">Total Harga</p>
                            <p class="text-2xl font-semibold text-[#FF5A8A] text-center">Rp. <span id="price"></span>
                            </p>
                        </div>
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        add_card
                                    </span>
                                </span>
                                <select id="metode_payment"
                                    class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                    <option value="1">CASH</option>
                                    <option value="2">TRANSFER</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full mb-3" id="div_metode_payment" style="display: none">
                            <div class="flex flex-col mb-3">
                                <p class="text-lg font-semibold text-[#1B232E] text-center">Nomor Rekening.</p>
                                <p class="text-lg font-semibold text-[#FF5A8A] text-center">123.</p>
                            </div>
                            {{-- @if ($product->rekening == 0) --}}
                            <input
                                class="block w-full text-sm text-[#1B232E] border border-[#1B232E] rounded-lg cursor-pointer bg-[#F1F8FE] focus:outline-none"
                                aria-describedby="proof_of_payment" id="proof_of_payment" name="proof_of_payment"
                                type="file">
                            {{-- @else
                                <input
                                    class="block w-full text-sm text-[#1B232E] border border-[#1B232E] rounded-lg cursor-pointer bg-[#F1F8FE] focus:outline-none @error('proof_of_payment') invalid:border-[#FF5A8A] @enderror"
                                    aria-describedby="proof_of_payment" id="proof_of_payment" name="proof_of_payment"
                                    type="file" required
                                    oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')">
                            @endif --}}
                            <p class="mt-1 text-sm text-gray-500" id="proof_of_payment">Upload
                                bukti pembayaran max 1mb.
                            </p>
                            @error('proof_of_payment')
                                <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <p class="text-lg font-semibold text-[#FF5A8A] text-center">Aplikasi kami tidak melayani
                            sistem
                            pendistribusian produk harap komunikasikan hal pendistribusian produk bersama pembeli.</p>
                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin membeli?')"
                            class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center my-5 md:my-10 flex flex-row justify-center">Beli
                            <span class="material-symbols-rounded mx-2">
                                shopping_cart
                            </span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // FOR PRICE
        let price;
        let deliveryPrice = 0;

        // FOR DELIVERY METHOD
        var eSelect1 = document.getElementById('metode_delivery');
        var optDeliver1 = document.getElementById('customer_address');
        var optDeliver2 = document.getElementById('seller_address');
        eSelect1.onchange = function() {
            if (eSelect1.selectedIndex === 0) {
                optDeliver1.style.display = 'block';
                optDeliver2.style.display = 'none';
            } else {
                optDeliver1.style.display = 'none';
                optDeliver2.style.display = 'block';
            }
        }

        // FOR PAYMENT METHOD
        var eSelect2 = document.getElementById('metode_payment');
        var optPayment = document.getElementById('div_metode_payment');
        eSelect2.onchange = function() {
            if (eSelect2.selectedIndex === 1) {
                optPayment.style.display = 'block';
            } else {
                optPayment.style.display = 'none';
            }
        }

        function totalHarga() {
            price = document.getElementById("quantity").value;
            document.getElementById("price").innerHTML = (price * {{ $product->price }});
        }
    </script>
@endsection
