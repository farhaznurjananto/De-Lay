@extends('dashboard.layouts.main') @section('container')
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3 fw-bold text-success">Riwayat Pemesanan Kedelai Anda</h1>
    </div>

    <hr class="featurette-divider" />

    {{-- ALERT --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- END-ALERT --}}

    <div class="container-fluid overflow-auto">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Tanggal Pemesanan</th>
                    <th scope="col">Tanggal Disetujui</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->count())
                    @foreach ($orders as $order)
                        <tr valign="middle">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>{{ date_format(date_create($order->acc_date), 'd M Y') }}</td>
                            <td>
                                <a href="/dashboard/order/{{ $order->id }}" class="btn btn-outline-warning m-1 btn-sm"><i
                                        class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="6">
                        <p class="text-center text-muted fs-4 m-0">Belum ada pemesanan yang disetujui</p>
                    </td>
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>

    <hr class="featurette-divider" />
@endsection
