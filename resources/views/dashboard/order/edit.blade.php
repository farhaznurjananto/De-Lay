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
                    <form action="/dashboard/order/{{ $order->id }}" method="post" enctype="multipart/form-data"
                        class="flex flex-col items-center justify-center px-3 md:px-10">
                        @method('put')
                        @csrf
                        <p class="text-[#36BB6A] text-2xl font-medium my-5 md:my-5">UBAH PEMESANAN</p>
                        <div
                            class="bg-[#1B232E] rounded-lg flex flex-row flex-wrap justify-center xl:justify-normal p-2 my-3">
                            <img class="rounded-lg w-full xl:w-1/2" src="{{ asset('storage/' . $order->product->image) }}"
                                alt="produk-img">
                            <div class="flex flex-col text-[#F1F8FE] justify-center text-center xl:text-left p-3">
                                <p class="font-medium text-3xl">{{ $order->product->name }}</p>
                                <p class="text-xl">Stok: {{ $order->product->stock }} kg</p>
                                <p class="text-xl">Harga: Rp. {{ number_format($order->product->price) }} / kg</p>
                            </div>
                        </div>
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
                                    placeholder="KWANTITAS PRODUK" value="{{ old('quantity', $order->quantity) }}" required
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
                                <select id="metode_delivery" name="metode_delivery"
                                    class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                    @if ($order->customer_address != null)
                                        <option value="1" selected>Delivery (Diantar di tempat)</option>
                                        <option value="2">Non-Delivery (Diambil di tempat)</option>
                                    @else
                                        <option value="1">Delivery (Diantar di tempat)</option>
                                        <option value="2" selected>Non-Delivery (Diambil di tempat)</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="w-full mb-3" id="customer_address"
                            style="display: {{ $order->customer_address == null ? 'none' : 'block' }}">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        home
                                    </span>
                                </span>
                                <input type="text" id="customer_address" name="customer_address"
                                    class="customer_address rounded-none rounded-r-lg bg-[#F1F8FE] border-[#1B232E] text-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] block flex-1 min-w-0 w-full text-sm p-2.5"
                                    placeholder="ALAMAT PEMBELI"
                                    value="{{ old('customer_address', $order->customer_address) }}">
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
                        <div class="flex flex-col mb-3" id="seller_address"
                            style="display: {{ $order->customer_address == null ? 'block' : 'none' }}">
                            <p class="text-lg font-semibold text-[#1B232E] text-center">Alamat Penjual.</p>
                            <p class="text-lg font-semibold text-[#FF5A8A] text-center">
                                {{ $order->product->address == null ? 'Tidak menerima pengiriman produk Non-Delivery' : $order->product->address }}
                            </p>
                        </div>
                        <div class="border border-[#1B232E] p-5 rounded-md mb-3">
                            <p class="text-lg font-semibold text-[#1B232E] text-center">Total Harga</p>
                            <p class="text-2xl font-semibold text-[#FF5A8A] text-center">Rp. <span id="price"></p>
                        </div>
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        add_card
                                    </span>
                                </span>
                                <select id="metode_payment" name="metode_payment"
                                    class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                    @if ($order->proof_of_payment != null)
                                        <option value="1">CASH</option>
                                        <option value="2" selected>TRANSFER</option>
                                    @else
                                        <option value="1" selected>CASH</option>
                                        <option value="2">TRANSFER</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="oldImage" value="{{ $order->proof_of_payment }}">
                        <div class="w-full mb-3" id="div_metode_payment"
                            style="display: {{ $order->proof_of_payment == null ? 'none' : 'block' }}">
                            <div class="flex flex-col mb-3">
                                <p class="text-lg font-semibold text-[#1B232E] text-center">Nomor Rekening.</p>
                                <p class="text-lg font-semibold text-[#FF5A8A] text-center">123.</p>
                            </div>
                            <input
                                class="block w-full text-sm text-[#1B232E] border border-[#1B232E] rounded-lg cursor-pointer bg-[#F1F8FE] focus:outline-none"
                                aria-describedby="proof_of_payment" id="proof_of_payment" name="proof_of_payment"
                                type="file">
                            <p class="mt-1 text-sm text-gray-500" id="proof_of_payment">Upload
                                bukti pembayaran max 1mb.
                            </p>
                            @error('proof_of_payment')
                                <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                            @if ($order->proof_of_payment != null)
                                <div class="flex flex-row justify-center items-center">
                                    <p class="mr-3">Bukti Pembayaran :</p>
                                    <a data-modal-target="large-modal" data-modal-toggle="large-modal" href="#"
                                        class="text-[#1B232E] bg-[#FF9E22] hover:bg-[#FF9E22]/75 focus:ring-4 focus:ring-[#FF9E22]/50 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none"><span
                                            class="material-symbols-rounded">
                                            receipt_long
                                        </span></a>
                                </div>
                            @endif
                        </div>
                        <p class="text-lg font-semibold text-[#FF5A8A] text-center">Aplikasi kami tidak melayani
                            sistem
                            pendistribusian produk harap komunikasikan hal pendistribusian produk bersama pembeli.</p>
                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin memperbarui ini?')"
                            class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center my-5 md:my-10 flex flex-row justify-center">Perbarui
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    @if ($order->proof_of_payment != null)
        <div id="large-modal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-[#F1F8FE] rounded-lg shadow">
                    <div class="px-6 py-6 lg:px-8 flex flex-col justify-center items-center">
                        <h3 class="mb-4 text-xl text-center font-medium text-[#36BB6A]">BUKTI TRANSFER PEMBAYARAN</h3>
                        <img class="w-1/2 rounded-lg my-3" src="{{ asset('storage/' . $order->proof_of_payment) }}"
                            alt="display-img">
                        <button type="button" data-modal-hide="large-modal"
                            class="text-[#F1F8FE] bg-[#1B232E] hover:bg-[#1B232E]/75 focus:ring-4 focus:outline-none focus:ring-[#1B232E]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Keluar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        // FOR PRICE
        let price;
        let deliveryPrice = 0;

        // FOR METHOD DELIVERY
        var eSelect1 = document.getElementById('metode_delivery');
        var optDeliver1 = document.getElementById('customer_address');
        var optDeliver2 = document.getElementById('seller_address');
        eSelect1.onchange = function() {
            if (eSelect1.selectedIndex === 0) {
                optDeliver1.style.display = 'block';
                optDeliver2.style.display = 'none';
            } else {
                optDeliver1.style.display = 'none';
                document.querySelector('.customer_address').value = '';
                optDeliver2.style.display = 'block';
            }
        }

        // FOR METHOD PAYMENT
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
            document.getElementById("price").innerHTML = (price * {{ $order->product->price }});
        }
    </script>
@endsection
