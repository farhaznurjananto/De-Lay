@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
          <h1 class="h2 mt-3">Forum Diskusi</h1>
          <div class="">
            <a href="#" class="btn btn-outline-success btn-sm mt-2"><i class="bi bi-plus-circle"></i> Buat Forum</a>
          </div>
        </div>

        <hr class="featurette-divider" />

        <!-- produk -->
        <div class="container-fluid d-flex flex-column justify-content-center">
          <div class="card m-1">
            <div class="card-header">#kesehatan-pertanian</div>
            <div class="card-body">
              <h5 class="card-title fs-5">Bagaimana cara merawat kedelai agar hasil panen kedelai maksimal?</h5>
              <p class="card-text small">By: Farhaz Nurjananto - Sunday 23 March 2023</p>
              <div class="action">
                <a href="#" class="btn btn-outline-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>
                <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-reply"></i></a>
                <a href="#" class="btn btn-outline-danger btn-sm float-end"><i class="bi bi-trash3-fill"></i> </a>
                <a href="#" class="btn btn-outline-primary btn-sm float-end me-1"><i class="bi bi-pencil-square"></i></a>
                <span class="badge text-bg-danger float-end me-1">4 replay</span>
              </div>
            </div>
          </div>
          <div class="card m-1">
            <div class="card-header">#kesehatan-pertanian</div>
            <div class="card-body">
              <h5 class="card-title fs-5">Bagaimana cara merawat kedelai agar hasil panen kedelai maksimal?</h5>
              <p class="card-text small">By: Farhaz Nurjananto - Sunday 23 March 2023</p>
              <div class="action">
                <a href="#" class="btn btn-outline-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>
                <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-reply"></i></a>
                <a href="#" class="btn btn-outline-danger btn-sm float-end"><i class="bi bi-trash3-fill"></i> </a>
                <a href="#" class="btn btn-outline-primary btn-sm float-end me-1"><i class="bi bi-pencil-square"></i></a>
                <span class="badge text-bg-danger float-end me-1">4 replay</span>
              </div>
            </div>
          </div>
          <div class="card m-1">
            <div class="card-header">#kesehatan-pertanian</div>
            <div class="card-body">
              <h5 class="card-title fs-5">Bagaimana cara merawat kedelai agar hasil panen kedelai maksimal?</h5>
              <p class="card-text small">By: Farhaz Nurjananto - Sunday 23 March 2023</p>
              <div class="action">
                <a href="#" class="btn btn-outline-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>
                <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-reply"></i></a>
                <a href="#" class="btn btn-outline-danger btn-sm float-end"><i class="bi bi-trash3-fill"></i> </a>
                <a href="#" class="btn btn-outline-primary btn-sm float-end me-1"><i class="bi bi-pencil-square"></i></a>
                <span class="badge text-bg-danger float-end me-1">4 replay</span>
              </div>
            </div>
          </div>
        </div>
        <!-- end-produk -->

        <hr class="featurette-divider" />
    </div>
@endsection