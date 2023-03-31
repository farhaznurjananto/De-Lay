@extends('dashboard.layouts.main')

@section('container')
  <div class="container-fluid">
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3">Produk Anda</h1>
        <div class="">
            <button class="btn btn-outline-success btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#createForumModal"><i class="bi bi-plus-circle"></i> Tambah</button>
        </div>
    </div>

    <hr class="featurette-divider" />

    <!-- produk -->
    <div class="container-fluid d-flex flex-wrap">
      <div class="card m-2" style="width: 18rem">
        <img class="img-fluid d-inline rounded-top" src="https://source.unsplash.com/150x100?" alt="" style="height: 150px" />
        <div class="card-body">
          <h5 class="card-title">Kedelai Indonesia</h5>
          <p class="card-text mb-2 small">Stok : 10000 kg</p>
          <p class="card-text mb-2 small">Harga : Rp. 11000 / kg</p>
          <div class="action">
            <a href="#" class="btn btn-outline-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>
            <a href="#" class="btn btn-outline-danger btn-sm float-end"><i class="bi bi-trash3-fill"></i> </a>
            <a href="#" class="btn btn-outline-primary btn-sm align-self-end"><i class="bi bi-pencil-square"></i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- end-produk -->

    <hr class="featurette-divider" />
  </div>
@endsection