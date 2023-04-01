@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3">Produk | Edit</h1>
        </div>

        <hr class="featurette-divider" />

        <div class="form-edit my-3">
            <form action="/dashboard/product/{{ $product->id }}" method="post" enctype="multipart/form-data">
                @method('put') @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Produk</label>
                    <input type="hidden" name="oldImage" value="{{ $product->image }}">
                    <div class="d-flex justify-content-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-preview img-fluid mb-3"
                                style="max-height: 150px" />
                        @else
                            <img class="img-preview img-fluid mb-3" style="max-height: 150px" />
                        @endif
                    </div>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image" placeholder="Gambar Produk" onchange="previewImage()" />
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
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Nama Produk" value="{{ old('name', $product->name) }}" required />
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok Produk</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                        name="stock" placeholder="Stok Produk" value="{{ old('stock', $product->stock) }}" required />
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
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                        name="price" placeholder="Harga Produk" value="{{ old('price', $product->price) }}" required />
                    <div id="priceHelp" class="form-text">
                        Masukkan harga per-kg.
                    </div>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <hr class="featurette-divider" />
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
