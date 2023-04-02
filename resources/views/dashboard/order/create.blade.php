@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3">Order Kedelai</h1>
        </div>

        <hr class="featurette-divider" />

        <div class="container-fluid d-flex justify-content-center">
            <div class="card m-2" style="width: 25rem">
                @if ($product->image)
                    <img class="img-fluid d-inline rounded-top" src="{{ asset('storage/' . $product->image) }}"
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
                        Harga : {{ $product->price }} / kg
                    </p>

                    <hr class="featurette-divider" />

                    <form action="" enctype="multipart/form-data">
                        <div class="mb-3 text-center fw-semibold">
                            <label for="kwantitas" class="form-label">Kwantitas</label>
                            <input type="number" class="form-control" id="kwantitas" placeholder="kwantitas pembelian"
                                oninput="totalHarga()">
                        </div>
                        <div class="mb-3 text-center fw-semibold">
                            <label for="kwantitas" class="form-label">Metode Pengiriman</label>
                            <select class="form-select" aria-label="Default select example" id="pengiriman">
                                <option value="1">Delivery (Diantar)</option>
                                <option value="2">Non Delivery (Ambil ditempat)</option>
                            </select>
                        </div>
                        <div class="mb-3 text-center fw-semibold">
                            <div id="div-address-input" style="display: none">
                                <label for="address" class="form-label">Alamat Anda</label>
                                <input type="text" class="form-control" id="address" placeholder="alamat pembeli">
                            </div>
                            <div id="div-address-seller" style="display: none">
                                <label for="address" class="form-label">Alamat Kami</label>
                                <p class="text-danger small">Mawar merah 11
                                    Probolinggo, Jawa Timur</p>
                            </div>
                        </div>
                        <div class="mb-3 text-center fw-semibold">
                            <p class="mb-1">Total Harga</p>
                            <p class="text-danger small">Rp. <span id="price"></span></p>
                        </div>
                        <div class="mb-3 text-center fw-semibold">
                            <label for="kwantitas" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" aria-label="Default select example" id="metode-pembayaran">
                                <option value="1">Cash</option>
                                <option value="2">Transfer</option>
                            </select>
                        </div>
                        <div class="mb-3 text-center fw-semibold" id="div-metode-transfer" style="display: none">
                            <label for="bukti" class="form-label">No Rekening</label>
                            <p class="text-danger small">XXXXX</p>
                            <label for="bukti" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="bukti" placeholder="bukti pembelian">
                        </div>
                    </form>
                    <div class="action d-grid">
                        <a href="/dashboard/market/{{ $product->id }}" class="btn btn-outline-success btn-sm"><i
                                class="bi bi-basket"></i>
                            Beli</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="featurette-divider" />
    </div>
    <script>
        // untuk harga
        let price;
        let deliveryPrice = 0;

        // untuk metode pengiriman
        var eSelect1 = document.getElementById('pengiriman');
        var optDeliver1 = document.getElementById('div-address-input');
        var optDeliver2 = document.getElementById('div-address-seller');
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

        // untuk metode pembayaran
        var eSelect2 = document.getElementById('metode-pembayaran');
        var optPayment = document.getElementById('div-metode-transfer');
        eSelect2.onchange = function() {
            if (eSelect2.selectedIndex === 1) {
                optPayment.style.display = 'block';
            } else {
                optPayment.style.display = 'none';
            }
        }

        function totalHarga() {
            price = document.getElementById("kwantitas").value;
            document.getElementById("price").innerHTML = (price * {{ $product->price }}) + deliveryPrice;
        }
    </script>
@endsection
