@extends('dashboard.layouts.main') @section('container')
    {{-- FORUM MESSAGE --}}
    <div class="card my-3">
        <div class="card-header">
            <i class="bi bi-bookmark-fill"></i>
            {{ $forum->forum_category->name }}
            @if ($forum->user_id == auth()->user()->id)
                <i class="bi bi-three-dots-vertical float-end" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"></i>
                <div class="dropdown">
                    <ul class="dropdown-menu">
                        <li>
                            <form action="/dashboard/forum/{{ $forum->id }}" method="post" class="d-inline">
                                @method('delete') @csrf
                                <button type="submit" class="dropdown-item"
                                    onclick="return confirm('Apa anda yakin untuk menghapus ini?')">
                                    Hapus Forum</button>
                            </form>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/dashboard/forum/{{ $forum->id }}/edit">Edit Forum</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="card-body">
            <h5 class="card-title fs-5">{{ $forum->question }}</h5>
            <p class="card-text small">
                By:
                <span class="fw-bold text-primary">
                    {{ $forum->user->name }}</span>
                - {{ $forum->created_at->diffForHumans() }}
                @if ($forum->updated_at != $forum->created_at)
                    <span class="text-muted">| Edited - {{ $forum->updated_at->diffForHumans() }}</span>
                @endif
            </p>
        </div>
    </div>
    {{-- END-FORUM MESSAGE --}}

    <hr class="featurette-divider" />

    {{-- ALERT --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- END-ALERT --}}

    {{-- REPLAY FORM --}}
    <div class="form-edit my-3">
        <form action="/dashboard/discussion" method="post">
            @csrf
            <div class="mb-2">
                <label for="message" class="form-label">Tuliskan jawaban anda</label>
                <input type="hidden" name="forum_id" id="forum_id" value="{{ $forum->id }}" />
                <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="2"
                    required></textarea>
                @error('message')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Kirim <i class="bi bi-send"></i></button>
        </form>
    </div>
    {{-- REPLAY FORM  --}}

    <hr class="featurette-divider" />

    {{-- REPLY MESSAGE --}}
    @if ($discussions->count())
        @foreach ($discussions as $discussion)
            <div class="card my-3">
                <div class="card-body p-2 text-end">
                    <h5 class="card-title fs-6 small m-0">
                        {{ $discussion->message }}
                    </h5>
                    <hr class="featurette-divider m-1" />
                    <p class="card-text fs6 small m-0">
                        @if ($discussion->sender_id == auth()->user()->id)
                    </p>

                    <form class="d-inline" action="/dashboard/discussion/{{ $discussion->id }}" method="post">
                        @method('delete') @csrf
                        <button class="small border-0 bg-transparent text-primary" href="#" type="submit"
                            onclick="return confirm('Apa anda yakin untuk menghapus ini?')">
                            hapus
                        </button>
                        |
                    </form>
        @endif By:
        <span class="fw-bold small text-primary">
            {{ $discussion->user->name }}</span>
        | {{ $discussion->created_at->diffForHumans() }}
        </div>
        </div>
    @endforeach
@else
    <p class="text-center text-muted fs-4">Tidak ada jawaban.</p>
    @endif
    {{-- END-REPLY MESSAGE --}}

    <div class="mt-3">
        {{ $discussions->links() }}
    </div>

    <hr class="featurette-divider" />
@endsection
