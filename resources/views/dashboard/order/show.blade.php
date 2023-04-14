@extends('dashboard.layouts.main') @section('container')
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3 fw-bold text-success">Detai Pemesanan Kedelai</h1>
    </div>

    <hr class="featurette-divider" />

    <div class="container-fluid border rounded p-3">
        <p class="text-center fw-bold fs-4">Detail Pemesanan</p>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td class="text-start" scope="col"><span class="fw-bold">Pemesan :</span>
                        {{ $order->user->name }}</td>
                    <th class="text-end" scope="col">Status :
                        @if ($order->status == 'pending')
                            <span class="badge text-bg-warning">{{ $order->status }}</span>
                        @endif
                        @if ($order->status == 'rejected')
                            <span class="badge text-bg-danger">{{ $order->status }}</span>
                        @endif
                        @if ($order->status == 'accepted')
                            <span class="badge text-bg-success">{{ $order->status }}</span>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" colspan="2"><span class="fw-bold">Tanggal :</span>
                        {{ $order->created_at->format('d-M-Y') }}</td>
                </tr>
                <tr valign="middle">
                    <td scope="row"><span class="fw-bold">Metode Pembayaran :</span>
                        {{ $order->proof_of_payment != null ? 'Transfer' : 'Cash' }}</td>
                    @if ($order->proof_of_payment != null)
                        <td scope="row"><span class="fw-bold">Bukti Pembayaran :</span> <button
                                class="btn btn-outline-warning" data-bs-toggle="modal"
                                data-bs-target="#proof_of_payment_modal"><i class="bi bi-file-earmark-image"></i></button>
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <td scope="row"><span class="fw-bold">Metode Pengiriman :</span>
                        {{ $order->customer_address != null ? 'Delivery' : 'Non-Delivery' }}</td>
                    @if ($order->customer_address != null)
                        <td scope="row"><span class="fw-bold">Alamat Pengiriman :</span>
                            {{ $order->customer_address }}</td>
                    @else
                        <td><span class="fw-bold">Alamat Pengambilan :</span> {{ $order->product->address }}</td>
                    @endif
                </tr>
                <tr>
                    <th colspan="2">
                        <hr>
                    </th>
                </tr>
                <tr>
                    <th>Nama Produk</th>
                    <th class="text-end">Jumlah</th>
                </tr>
                <tr>
                    <td scope="col">{{ $order->product->name }}</td>
                    <td class="text-end">{{ $order->quantity }}</td>
                </tr>
                <tr>
                    <th class="text-end" scope="col" colspan="2">Total : Rp.
                        {{ $order->quantity * $order->product->price }}</th>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- FARMER ACTION --}}
    @can('farmer')
        @if ($order->status == 'pending')
            <div class="action my-3 text-end">
                <form action="/dashboard/order/{{ $order->id }}" method="post" class="d-inline">
                    @method('put') @csrf
                    <input type="text" name="status" id="status" value="accepted" hidden>
                    <button type="submit" class="btn btn-outline-success"
                        onclick="return confirm('Apa anda yakin untuk menerima pemesanan ini?')">
                        Accept
                    </button>
                </form>
                <form action="/dashboard/order/{{ $order->id }}" method="post" class="d-inline">
                    @method('put') @csrf
                    <input type="text" name="status" id="status" value="rejected" hidden>
                    <button type="submit" class="btn btn-outline-danger"
                        onclick="return confirm('Apa anda yakin untuk menolak pemesanan ini?')">
                        Cancel
                    </button>
                </form>
            </div>
        @endif
    @endcan
    {{-- END-FARMENR ACTION --}}

    {{-- PRODUSEN ACTION --}}
    @can('produsen')
        @if ($order->status != 'accepted')
            <div class="action my-3 text-end">
                <a href="/dashboard/order/{{ $order->id }}/edit"class="btn btn-outline-primary m-1"><i
                        class="bi bi-pencil-square"></i> Ubah Pemesanan</a>
                <form action="/dashboard/order/{{ $order->id }}" method="post" class="d-inline">
                    @method('delete') @csrf
                    <button type="submit" class="btn btn-outline-danger"
                        onclick="return confirm('Apa anda yakin untuk membatalkan pemesanan ini?')">
                        <i class="bi bi-x-square"></i> Batalkan Pemesanan
                    </button>
                </form>
            </div>
        @endif
    @endcan
    {{-- END-PRODUSEN ACTION --}}

    <hr class="featurette-divider" />

    {{-- PROOF OF PAYMENT MODAL --}}
    @if ($order->proof_of_payment != null)
        <div class="modal fade" id="proof_of_payment_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Transfer Pembayaran</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <img src="{{ asset('storage/' . $order->proof_of_payment) }}" alt="proof_of_payment">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- END-PROOF OF PAYMENT MODAL --}}
@endsection
