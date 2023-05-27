@extends('dashboard.layouts.main') @section('container')
    <div class="header">
        <h1 class="h2 mt-3 fw-bold text-success">Pemesanan Kedelai</h1>
        <hr class="featurette-divider" />
    </div>

    {{-- ALERT --}}
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- END-ALERT --}}

    <div class="container-fluid d-flex justify-content-center">
        <div class="card m-2" style="width: 25rem">
            @if ($product->image)
                <img class="img-fluid d-inline h-auto rounded-top" src="{{ asset('storage/' . $product->image) }}"
                    alt="product-image" style="height: 150px" />
            @else
                <img class="img-fluid d-inline rounded-top" src="https://source.unsplash.com/300x150?soya-bean"
                    alt="product-image" style="height: 150px" />
            @endif
            <div class="card-body">
                <h5 class="card-title fw-semibold text-center mb-3">{{ $product->name }}</h5>
                <p class="card-text mb-2 small">
                    Stok : {{ $product->stock }} kg
                </p>
                <p class="card-text mb-2 small">
                    Harga : Rp. {{ number_format($product->price) }} / kg
                </p>

                <hr class="featurette-divider" />

                <form action="/dashboard/market" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="number" class="form-control" id="product_id" name="product_id" value="{{ $product->id }}"
                        required hidden>
                    <div class="mb-3 text-center fw-semibold">
                        <label for="quantity" class="form-label">Kwantitas<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text text-muted">Kg</span>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity" name="quantity" placeholder="Kwantitas pembelian"
                                value="{{ old('quantity') }}" required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="totalHarga(); setCustomValidity('')">
                            @error('quantity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <label for="metode_delivery" class="form-label">Metode Pengiriman</label>
                        <div class="input-group">
                            <span class="input-group-text text-muted"><i class="bi bi-truck"></i></span>
                            <select class="form-select" aria-label="Default select example" id="metode_delivery">
                                <option value="1">Delivery (Diantar)</option>
                                <option value="2">Non Delivery (Ambil ditempat)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <div id="customer_address">
                            <label for="customer_address" class="form-label">Alamat Anda</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted"><i class="bi bi-house"></i></span>
                                @if ($product->address == null)
                                    <input type="text"
                                        class="form-control @error('customer_address') is-invalid @enderror"
                                        id="customer_address" name="customer_address" placeholder="Alamat pembeli"
                                        value="{{ old('customer_address') }}" required
                                        oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                        oninput="setCustomValidity('')">
                                @else
                                    <input type="text"
                                        class="form-control @error('customer_address') is-invalid @enderror"
                                        id="customer_address" name="customer_address" placeholder="Alamat pembeli"
                                        value="{{ old('customer_address') }}">
                                @endif
                                @error('customer_address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div id="seller_address" style="display: none">
                            <label for="seller_address" class="form-label">Alamat Kami</label>
                            <p class="text-danger small">
                                {{ $product->address == null ? 'Tidak menerima pengiriman produk Non-Delivery' : $product->address }}
                            </p>
                        </div>
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <p class="mb-1">Total Harga</p>
                        <p class="text-danger small">Rp. <span id="price"></span></p>
                    </div>
                    <div class="mb-3 text-center fw-semibold">
                        <label for="metode_payment" class="form-label">Metode Pembayaran</label>
                        <div class="input-group">
                            <span class="input-group-text text-muted"><i class="bi bi-credit-card-2-back"></i></span>
                            <select class="form-select" aria-label="Default select example" id="metode_payment">
                                <option value="1">Cash</option>
                                <option value="2">Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 text-center fw-semibold" id="div_metode_payment" style="display: none">
                        <label for="nomor_rekening" class="form-label">No Rekening</label>
                        <p class="text-danger small">
                            {{ $product->rekening == 0 ? 'Tidak menerima pembayaran transfer' : $product->rekening }}
                        </p>
                        <label for="proof_of_payment" class="form-label">Bukti Pembayaran</label>
                        @if ($product->rekening == null)
                            <input type="file" class="form-control @error('proof_of_payment') is-invalid @enderror"
                                id="proof_of_payment" name="proof_of_payment" placeholder="bukti pembelian">
                        @else
                            <input type="file" class="form-control @error('proof_of_payment') is-invalid @enderror"
                                id="proof_of_payment" name="proof_of_payment" placeholder="bukti pembelian" required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')">
                        @endif
                        @error('proof_of_payment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="action d-grid">
                        <button type="submit" class="btn btn-outline-success btn-sm"
                            onclick="return confirm('Apakah anda yakin ingin membeli?')"><i class="bi bi-basket"></i>
                            Beli</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <hr class="featurette-divider" />

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
                deliveryPrice = 5000;
            } else {
                optDeliver1.style.display = 'none';
                optDeliver2.style.display = 'block';
                deliveryPrice = 0;
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
            document.getElementById("price").innerHTML = (price * {{ $product->price }}) + deliveryPrice;
        }
    </script>
@endsection
