@extends('dashboard.layouts.main') @section('container')
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3 fw-bold text-success">Edit Pemesanan Kedelai</h1>
    </div>

    <hr class="featurette-divider" />

    <div class="container-fluid d-flex justify-content-center">
        <div class="card m-2" style="width: 25rem">
            @if ($order->product->image)
                <img class="img-fluid d-inline rounded-top" src="{{ asset('storage/' . $order->product->image) }}"
                    alt="product-image" style="height: 150px" />
            @else
                <img class="img-fluid d-inline rounded-top" src="https://source.unsplash.com/300x150?soya-bean"
                    alt="product-image" style="height: 150px" />
            @endif
            <div class="card-body">
                <h5 class="card-title fw-semibold text-center mb-3">{{ $order->product->name }}</h5>
                <p class="card-text mb-2 small">
                    Stok : {{ $order->product->stock }} kg
                </p>
                <p class="card-text mb-2 small">
                    Harga : Rp. {{ number_format($order->product->price) }} / kg
                </p>

                <hr class="featurette-divider" />

                <form action="/dashboard/order/{{ $order->id }}" method="post" enctype="multipart/form-data">
                    @method('put') @csrf
                    <div class="mb-3 text-center fw-semibold">
                        <label for="quantity" class="form-label">Kwantitas</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                            name="quantity" placeholder="kwantitas pembelian" oninput="totalHarga()"
                            value="{{ $order->quantity }}" required>
                        @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <label for="metode_delivery" class="form-label">Metode Pengiriman</label>

                        <select class="form-select" aria-label="Default select example" id="metode_delivery">
                            {{-- INI MASIH SALAH --}}
                            @if ($order->customer_address != null)
                                <option value="1" selected>Delivery (Diantar)</option>
                                <option value="2">Non Delivery (Ambil ditempat)</option>
                            @else
                                <option value="1">Delivery (Diantar)</option>
                                <option value="2" selected>Non Delivery (Ambil ditempat)</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <div id="customer_address" style="display: none">
                            <label for="customer_address" class="form-label">Alamat Anda</label>
                            <input type="text" class="form-control @error('customer_address') is-invalid @enderror"
                                id="customer_address" name="customer_address" placeholder="Alamat pembeli"
                                value="{{ $order->customer_address }}">
                            @error('customer_address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div id="seller_address" style="display: none">
                            <label for="seller_address" class="form-label">Alamat Kami</label>
                            <p class="text-danger small">
                                {{ $order->product->address == null ? 'Tidak menerima pengiriman produk Non-Delivery' : $order->product->address }}
                            </p>
                        </div>
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <p class="mb-1">Total Harga</p>
                        <p class="text-danger small">Rp. <span id="price"></span></p>
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <label for="metode_payment" class="form-label">Metode Pembayaran</label>
                        <select class="form-select" aria-label="Default select example" id="metode_payment">
                            @if ($order->proof_of_payment != null)
                                <option value="1">Cash</option>
                                <option value="2" selected>Transfer</option>
                            @else
                                <option value="1" selected>Cash</option>
                                <option value="2">Transfer</option>
                            @endif
                        </select>
                    </div>
                    <div class="mb-3 text-center fw-semibold" id="div_metode_payment" style="display: none">
                        <label for="nomor_rekening" class="form-label">No Rekening</label>
                        <p class="text-danger small">
                            {{ $order->product->rekening == 0 ? 'Tidak menerima pembayaran transfer' : $order->product->rekening }}
                        </p>
                        <label for="proof_of_payment" class="form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control @error('proof_of_payment') is-invalid @enderror"
                            id="proof_of_payment" name="proof_of_payment" placeholder="bukti pembelian">
                        @error('proof_of_payment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="action d-grid">
                        @if ($order->proof_of_payment != null)
                            <input type="hidden" name="oldImage"
                                value="{{ asset('storage/' . $order->proof_of_payment) }}">
                            <a class="btn btn-outline-warning btn-sm mb-3" data-bs-toggle="modal"
                                data-bs-target="#proof_of_payment_modal"><i class="bi bi-file-earmark-image"></i> Lihat
                                Bukti
                                Pembayaran</a>
                        @endif
                        <button type="submit" class="btn btn-outline-primary btn-sm"
                            onclick="return confirm('Apakah anda yakin ingin membeli?')"><i class="bi bi-basket"></i>
                            Perbarui Pemesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr class="featurette-divider" />

    {{-- PROOF OF PAYMENT MODAL --}}
    @if ($order->proof_of_payment != null)
        <div class="modal fade" id="proof_of_payment_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer Pembayaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img src="{{ asset('storage/' . $order->proof_of_payment) }}" alt="proof_of_payment">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- END-PROOF OF PAYMENT MODAL --}}

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
                deliveryPrice = 5000;
            } else {
                optDeliver1.style.display = 'none';
                optDeliver2.style.display = 'block';
                deliveryPrice = 0;
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
            document.getElementById("price").innerHTML = (price * {{ $order->product->price }}) + deliveryPrice;
        }
    </script>
@endsection
