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
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="img-preview img-fluid mb-3 img-thumbnail" style="max-height: 150px" />
                        @else
                            <img class="img-preview img-fluid mb-3 img-thumbnail" style="max-height: 150px" />
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
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="bi bi-braces"></i></span>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Nama Produk" value="{{ old('name', $product->name) }}" required />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok Produk</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="bi bi-boxes"></i></span>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                            name="stock" placeholder="Stok Produk" value="{{ old('stock', $product->stock) }}" required />
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div id="stockHelp" class="form-text">
                        Masukkan jumlah stok dalam satuan kg.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Produk</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" placeholder="Harga Produk" value="{{ old('price', $product->price) }}"
                            required />
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div id="priceHelp" class="form-text">
                        Masukkan harga per-kg.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="rekening" class="form-label">Nomor Rekening</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="bi bi-credit-card"></i></span>
                        <input type="number" class="form-control @error('rekening') is-invalid @enderror" id="rekening"
                            name="rekening" placeholder="Nomor rekening anda" value="{{ $product->rekening }}" />
                        @error('rekening')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div id="rekeningHelp" class="form-text">
                        Masukkan nomor rekening anda sebagai alternatif pembayaran transfer. <span
                            class="fw-semibold">Default 0</span> untuk
                        tidak memilih alternatif pembayaran transfer.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Pengambilan Produk</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted"><i class="bi bi-house"></i></span>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" placeholder="Alamat anda" value="{{ old('address', $product->address) }}" />
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div id="addressHelp" class="form-text">
                        Alamat ini sebagai alternatif pengiriman non-delivery.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon<span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" placeholder="Nomor telepon anda" value="{{ auth()->user()->phone }}" required
                        readonly disabled />
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
                    <label for="status" class="form-label">Status</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-info-circle-fill"></i></i></span>
                        <select class="form-select" aria-label="Default select example" name="status">
                            @if ($product->status == 1)
                                <option value="{{ $product->status }}" selected="selected">
                                    Open</option>
                                <option value="2">Close</option>
                            @else
                                <option value="1">Open</option>
                                <option value="{{ $product->status }}" selected="selected">
                                    Close</option>
                            @endif
                        </select>
                    </div>
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
