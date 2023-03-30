@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="top-bar d-flex justify-content-between align-items-center">
          <h1 class="h2 mt-3">Forum Diskusi</h1>
          <div class="">
            <a href="#" class="btn btn-outline-success btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#createForumModal"><i class="bi bi-plus-circle"></i> Buat Forum</a>
          </div>
        </div>

        <hr class="featurette-divider" />

        <!-- produk -->
        <div class="container-fluid d-flex flex-column justify-content-center">
          @if ($forums->count())
            @foreach ($forums as $forum)    
            <div class="card m-1">
              <div class="card-header"><i class="bi bi-bookmark-fill"></i> {{ $forum->forum_category->name }}</div>
              <div class="card-body">
                <h5 class="card-title fs-5">{{ $forum->question }}</h5>
                <p class="card-text small">By: <span class="fw-bold text-primary">{{ $forum->user->name }}</span> - {{ $forum->created_at->diffForHumans() }}</p>
                <div class="action">
                  <a href="#" class="btn btn-outline-warning btn-sm"><i class="bi bi-eye"></i> Detail</a>
                  <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-reply"></i></a>
                  <a href="#" class="btn btn-outline-danger btn-sm float-end"><i class="bi bi-trash3-fill"></i> </a>
                  <a href="#" class="btn btn-outline-primary btn-sm float-end me-1"><i class="bi bi-pencil-square"></i></a>
                  <span class="badge text-bg-danger float-end me-1">4 replays</span>
                </div>
              </div>
            </div>
            @endforeach
          @else
            <p class="text-center text-muted fs-4">No Forum Found.</p>
          @endif
        </div>
        <!-- end-produk -->

        {{-- create forum modal --}}
        <div class="modal" id="createForumModal" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Buat Forum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="/dashboard/forum" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="question" class="form-label">Tuliskan pertanyaan anda.</label>
                    <textarea class="form-control @error('question') is-invalid @enderror" name="question" id="question" rows="3" value="{{ old('question') }}" required></textarea>
                    @error('question')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="forum_category_id" class="form-label">Kategori</label>
                    <select class="form-select mb-3" id="forum_category" name="forum_category_id" aria-label="Default select example">
                      @foreach ($forum_categories as $category)
                          @if (old('forum_category_id') == $category->id)
                              <option value="{{ $category->id }}" selected="selected"{{ $category->name }}>{{ $category->name }}</option>
                          @else
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary" id="liveToastBtn">Buat Forum</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        {{-- end create forum modal --}}

        {{-- toast --}}        
        @if (session()->has('success'))
          <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <i class="bi bi-bookmark-plus-fill me-2"></i>
                  <strong class="me-auto text-success">Success!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                  {{ session('success') }}
              </div>
            </div>
          </div>
        @endif
        {{-- end toast --}}

        <hr class="featurette-divider" />
    </div>
@endsection