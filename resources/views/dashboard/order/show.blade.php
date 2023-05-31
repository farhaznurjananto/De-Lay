@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 sm:ml-64 bg-[#F1F8FE] min-h-screen">
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="flex rounded">
                    <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                        <span class="material-symbols-rounded">
                            inventory_2
                        </span>
                        <span class="ml-3">{{ $title }}</span>
                    </a>
                </div>
            </div>

            <div class="mb-4 rounded bg-[#FFFFFF] p-5">
                <div class="flex flex-col">
                    <span class="h-full w-60 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">DETAIL
                        PEMESANAN</span>
                    <div class="mt-5 grid grid-cols-2 gap-4 font-medium">
                        <p>Pemesanan : {{ $order->user->name }}</p>
                        <div class="flex flex-row justify-end">
                            <p class="mr-3">Status :</p>
                            @if ($order->status == 'pending')
                                <span
                                    class="bg-[#FF9E22] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $order->status }}</span>
                            @endif
                            @if ($order->status == 'rejected')
                                <span
                                    class="bg-[#FF5A8A] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $order->status }}</span>
                            @endif
                            @if ($order->status == 'accepted')
                                <span
                                    class="bg-[#8ED145] text-[#1B232E] text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $order->status }}</span>
                            @endif

                        </div>
                        <p class="col-span-2">Tanggal : {{ $order->created_at->format('d M Y') }}</p>
                        <p>Metode Pembayaran : {{ $order->proof_of_payment != null ? 'Transfer' : 'Cash' }}</p>
                        @if ($order->proof_of_payment != null)
                            <div class="flex flex-row">
                                <p class="mr-3">Bukti Pembayaran :</p>
                                <button data-modal-target="large-modal" data-modal-toggle="large-modal" type="submit"
                                    class="text-[#1B232E] bg-[#FF9E22] hover:bg-[#FF9E22]/75 focus:ring-4 focus:ring-[#FF9E22]/50 font-medium rounded-lg text-sm px-3 py-2 focus:outline-none"><span
                                        class="material-symbols-rounded">
                                        receipt_long
                                    </span></button>
                            </div>
                        @endif
                        <p>Metode Pengiriman : {{ $order->customer_address != null ? 'Delivery' : 'Non-Delivery' }}</p>
                        @if ($order->customer_address != null)
                            <p>Alamat Pengiriman : {{ $order->customer_address }}</p>
                        @else
                            <p>Alamat Pengambilan : {{ $order->product->address }}</p>
                        @endif
                        <p>Nomor Telepon Pembeli : {{ $order->user->phone }}</p>
                        <p>Nomor Telepon Penjual : {{ $order->product->user->phone }}</p>
                        <hr class="col-span-2">
                        <p>Nama Produk</p>
                        <p class="text-right">Jumlah</p>
                        <p>{{ $order->product->name }}</p>
                        <p class="text-right">{{ $order->quantity }}</p>
                        <p class="col-span-2 text-right">Total : Rp.
                            {{ number_format($order->quantity * $order->product->price) }}</p>
                    </div>
                </div>
            </div>
            @can('farmer')
                <div class="mb-4 rounded bg-[#FFFFFF] p-5">
                    <div class="flex flex-col">
                        <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">TANGGAPAN</span>
                        @if ($order->status == 'pending')
                            <form action="/dashboard/order/{{ $order->id }}" method="post">
                                @method('put')
                                @csrf
                                <textarea id="feedback" name="feedback" rows="4"
                                    class="block my-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#1B232E] focus:border-[#1B232E] @error('feedback') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="BELUM ADA TANGGAPAN" required oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')"></textarea>
                                @error('feedback')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <input type="text" name="status" id="status" hidden>
                                <div class="flex flex-row justify-end flex-wrap">
                                    <button type="submit" onclick="reject()"
                                        class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Tolak</button>
                                    <button type="submit" onclick="accept()"
                                        class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Terima</button>
                                </div>
                            </form>
                        @else
                            <textarea id="feedback" name="feedback" rows="4"
                                class="block my-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#1B232E] focus:border-[#1B232E]"
                                placeholder="BELUM ADA TANGGAPAN" readonly>{{ $order->feedback != null ? $order->feedback : 'Belum ada tanggapan' }}</textarea>
                        @endif
                    </div>
                </div>
            @endcan

            @can('produsen')
                <div class="mb-4 rounded bg-[#FFFFFF] p-5">
                    <div class="flex flex-col">
                        <span class="h-full w-36 px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">TANGGAPAN</span>
                        <textarea id="feedback" name="feedback" rows="4"
                            class="block my-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#1B232E] focus:border-[#1B232E]"
                            placeholder="BELUM ADA TANGGAPAN" readonly>{{ $order->feedback != null ? $order->feedback : 'Belum ada tanggapan' }}</textarea>
                        @if ($order->status != 'accepted')
                            <div class="flex flex-row justify-end flex-wrap">
                                <form action="/dashboard/order/{{ $order->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        onclick="return confirm('Apa anda yakin untuk membatalkan pemesanan ini?')"
                                        class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Batalkan
                                        Pemesanan</button>
                                </form>
                                <a href="/dashboard/order/{{ $order->id }}/edit"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Ubah
                                    Pemesanan</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endcan

            <div class="mb-4 rounded bg-[#293649] p-5">
                <span class="h-full w-36 px-3 rounded-md bg-[#F1F8FE] text-[#293649] text-center">ADS</span>
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
        function accept() {
            document.getElementById('status').value = 'accepted'
            return confirm('Apakah anda yakin untuk menerima pemesanan ini?')
        }

        function reject() {
            document.getElementById('status').value = 'rejected'
            return confirm('Apakah anda yakin untuk menolak pemesanan ini?')
        }
    </script>
@endsection
