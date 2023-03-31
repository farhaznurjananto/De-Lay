@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
      <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3">Forum Diskusi Anda</h1>
        <div class="">
          <button class="btn btn-outline-success btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#createForumModal"><i class="bi bi-plus-circle"></i> Buat Forum</button>
        </div>
      </div>

      {{-- alert --}}        
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      {{-- end alert --}}

      <hr class="featurette-divider" />

      <!-- produk -->
      <div class="container-fluid d-flex flex-column justify-content-center" id="my-forum">
        @if ($forums->count())
          @foreach ($forums as $forum)    
          <div class="card m-1">
            <div class="card-header">
              <i class="bi bi-bookmark-fill"></i> {{ $forum->forum_category->name }}
              <i class="bi bi-three-dots-vertical float-end" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
              <div class="dropdown">
                <ul class="dropdown-menu">
                  <li>
                    <form action="/dashboard/forum/{{ $forum->id }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button type="submit" class="dropdown-item" href="#" onclick="return confirm('Apa anda yakin untuk menghapus ini?')">Hapus Forum</i></a>
                    </form>
                  </li>
                  <li>
                    <a class="dropdown-item" href="/dashboard/forum/{{ $forum->id }}/edit">Edit Forum</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title fs-5">{{ $forum->question }}</h5>
              <p class="card-text small">By: <span class="fw-bold text-primary">
                {{ $forum->user->name }}</span> - {{ $forum->created_at->diffForHumans() }}
                @if ($forum->updated_at != $forum->created_at)
                  <span class="text-muted">| Edited - {{ $forum->updated_at->diffForHumans() }}</span>
                @endif
              </p>
              <div class="action">
                <a href="#" class="btn btn-outline-warning btn-sm"><i class="bi bi-door-open"></i> Masuk Forum</a>
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
                  <label for="question" class="form-label">Tuliskan pertanyaan anda</label>
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
                <button type="submit" class="btn btn-primary">Buat Forum</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- end create forum modal --}}

      <div class="mt-3">
        {{ $forums->links() }}
      </div>

      <hr class="featurette-divider" />
    </div>

    <script>
      // setInterval(() => {
      //   $("#my-forum").load("");
      // }, 10000);
    </script>
@endsection