@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3">Produk Anda</h1>
            <div class="">
                <button class="btn btn-outline-success btn-sm mt-2" data-bs-toggle="modal"
                    data-bs-target="#createProductModal">
                    <i class="bi bi-plus-circle"></i> Tambah
                </button>
            </div>
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
                                    {{-- <form action="/dashboard/product/{{ $product->id }}" method="post" class="d-inline">
                                        @method('delete') @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm float-end"
                                        onclick="return confirm('Apa anda yakin untuk menghapus ini?')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form> --}}
                                    <a href="/dashboard/product/{{ $product->id }}/edit"
                                        class="btn btn-outline-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @if ($product->status == 1)
                                        <span class="badge text-bg-success float-end">Open</span>
                                    @else
                                        <span class="badge text-bg-danger float-end">Close</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end-produk -->
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted fs-4">No Product Found.</p>
            @endif

            <div class="mt-3">
                {{ $products->links() }}
            </div>

            <hr class="featurette-divider" />

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
                                        id="image" name="image" placeholder="Gambar produk" required
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
                                    <label for="name" class="form-label">Nama Produk<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Nama produk" value="{{ old('name') }}"
                                        required />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stok Produk<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" placeholder="Stok produk" value="{{ old('stock') }}"
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
                                    <label for="price" class="form-label">Harga Produk<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" placeholder="Harga produk"
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
                                <div class="mb-3">
                                    <label for="rekening" class="form-label">Nomor Rekening</label>
                                    <input type="number" class="form-control @error('rekening') is-invalid @enderror"
                                        id="rekening" name="rekening" placeholder="Nomor rekening anda"
                                        value="0" />
                                    <div id="rekeningHelp" class="form-text">
                                        Masukkan nomor rekening anda sebagai alternatif pembayaran transfer. <span
                                            class="fw-semibold">Default 0</span> untuk
                                        tidak memilih alternatif pembayaran transfer.
                                    </div>
                                    @error('rekening')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Pengambilan Produk</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" placeholder="Alamat anda"
                                        value="{{ old('address') }}" />
                                    <div id="addressHelp" class="form-text">
                                        Alamat ini sebagai alternatif pengiriman non-delivery.
                                    </div>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon<span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="Nomor telepon anda"
                                        value="{{ auth()->user()->phone }}" required readonly disabled />
                                    <div id="phoneHelp" class="form-text">
                                        Nomor telephon anda akan digunakan oleh calon pembeli untuk menghubungi anda.
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div id="priceHelp" class="form-text text-danger fw-bold">
                                        Aplikasi kami tidak melayani sistem pendistribusian produk harap komunikasikan hal
                                        pendistribusian produk bersama pembeli.
                                    </div>
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
