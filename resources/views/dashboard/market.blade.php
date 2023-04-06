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
                            <img class="img-fluid d-inline rounded-top" src="https://source.unsplash.com/300x150?soya-bean"
                                alt="product-image" style="height: 150px" />
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
                                <a href="/dashboard/product/{{ $product->id }}"
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

        <div class="mt-3">
            {{ $products->links() }}
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
