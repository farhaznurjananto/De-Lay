@extends('dashboard.layouts.main') @section('container')
    <div class="header">
        <h1 class="h2 mt-3 fw-bold text-success">Market Kedelai</h1>
        <hr class="featurette-divider" />
    </div>

    <div class="main-wrapper">
        {{-- ALERT --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- END-ALERT --}}

        {{-- PRODUCT --}}
        @if ($products->count())
            <div class="d-flex flex-wrap">
                @foreach ($products as $product)
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
                                Harga : Rp. {{ number_format($product->price) }} / kg
                            </p>
                            <div class="action">
                                <a href="/dashboard/market/{{ $product->id }}"
                                    class="btn btn-outline-success btn-sm float-end"><i class="bi bi-basket"></i>
                                    Beli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-muted fs-4">Tidak ada produk.</p>
        @endif
        {{-- END-PRODUCT --}}

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>

    <hr class="featurette-divider" />
@endsection
