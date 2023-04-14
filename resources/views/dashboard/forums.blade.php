@extends('dashboard.layouts.main') @section('container')
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3 fw-bold text-success">Forum Diskusi Global</h1>
    </div>

    <hr class="featurette-divider" />

    {{-- FORUM --}}
    @if ($forums->count())
        @foreach ($forums as $forum)
            <div class="card m-1">
                <div class="card-header">
                    <i class="bi bi-bookmark-fill"></i>
                    {{ $forum->forum_category->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title fs-5">{{ $forum->question }}</h5>
                    <p class="card-text small">
                        By:
                        <span class="fw-bold text-primary">
                            {{ $forum->user->name }}</span>
                        - {{ $forum->created_at->diffForHumans() }}
                        @if ($forum->updated_at != $forum->created_at)
                            <span class="text-muted">| Edited -
                                {{ $forum->updated_at->diffForHumans() }}</span>
                        @endif
                    </p>
                    <div class="action text-end">
                        <a href="/dashboard/forum/{{ $forum->id }}" class="btn btn-warning btn-sm"><i
                                class="bi bi-door-open"></i> Masuk Forum</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-muted fs-4">Tidak ada forum.</p>
    @endif
    {{-- FORUM --}}

    <div class="mt-3">
        {{ $forums->links() }}
    </div>

    <hr class="featurette-divider" />
@endsection
