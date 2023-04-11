@extends('dashboard.layouts.main') @section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3">Pemesanan Kedelai Anda</h1>
        </div>

        <hr class="featurette-divider" />

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="container-fluid overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Tanggal Pemesanan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders->count())
                        @foreach ($orders as $order)
                            <tr valign="middle">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->created_at->format('d-M-Y') }}</td>
                                <td>
                                    <span
                                        class="badge text-bg-{{ $order->status == 'pending' ? 'warning' : 'danger' }}">{{ $order->status }}</span>
                                </td>
                                <td>
                                    @can('produsen')
                                        <a href="/dashboard/order/{{ $order->id }}"
                                            class="btn btn-outline-warning m-1 btn-sm"><i class="bi bi-eye"></i></a>
                                        <a
                                            href="/dashboard/order/{{ $order->id }}/edit"class="btn btn-outline-primary m-1 btn-sm"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <form action="/dashboard/order/{{ $order->id }}" method="post" class="d-inline">
                                            @method('delete') @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Apa anda yakin untuk membatalkan pemesanan ini?')">
                                                <i class="bi bi-x-square"></i>
                                            </button>
                                        </form>
                                    @elsecan('petani')
                                        <a href="/dashboard/order/{{ $order->id }}"
                                            class="btn btn-outline-warning m-1 btn-sm"><i class="bi bi-eye"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="6">
                            <p class="text-center text-muted fs-4 m-0">Belum ada Pemesanan</p>
                        </td>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>

        <hr class="featurette-divider" />
    </div>
@endsection
