@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3">Market Kedelai</h1>
        </div>

        <hr class="featurette-divider" />

        {{-- alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- end alert --}}

            @if ($products->count())
                <div class="container-fluid d-flex flex-wrap">
                    @foreach ($products as $product)
                        <!-- produk -->
                        <div class="card m-2" style="width: 18rem">
                            @if ($product->image)
                                <img class="img-fluid d-inline rounded-top" src="{{ asset('storage/' . $product->image) }}"
                                    alt="product-image" style="height: 150px" />
                            @else
                                <img class="img-fluid d-inline rounded-top"
                                    src="https://source.unsplash.com/300x150?soya-bean" alt="product-image"
                                    style="height: 150px" />
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text mb-2 small">
                                    Stok : {{ $product->stock }} kg
                                </p>
                                <p class="card-text mb-2 small">
                                    Harga : {{ $product->price }} / kg
                                </p>
                                <div class="action">
                                    <a href="/dashboard/market/{{ $product->id }}"
                                        class="btn btn-outline-success btn-sm float-end"><i class="bi bi-basket"></i>
                                        Beli</a>
                                </div>
                            </div>
                        </div>
                        <!-- end-produk -->
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted fs-4">No Product Found.</p>
            @endif

            {{-- create forum modal --}}
            <div class="modal" id="createProductModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/dashboard/product" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Produk</label>
                                    <div class="d-flex justify-content-center">
                                        <img class="img-preview img-fluid mb-3" style="max-height: 150px" />
                                    </div>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" placeholder="Gambar Produk" required
                                        onchange="previewImage()" />
                                    <div id="stockHelp" class="form-text">
                                        Upload gambar produk max 1mb.
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Nama Produk" value="{{ old('name') }}"
                                        required />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok Produk</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" placeholder="Stok Produk" value="{{ old('stock') }}"
                                        required />
                                    <div id="stockHelp" class="form-text">
                                        Masukkan jumlah stok dalam satuan kg.
                                    </div>
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga Produk</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" placeholder="Harga Produk"
                                        value="{{ old('price') }}" required />
                                    <div id="priceHelp" class="form-text">
                                        Masukkan harga per-kg.
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Tambah
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- end create forum modal --}}

                <hr class="featurette-divider" />
            </div>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector("#image");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }
    </script>
@endsection
