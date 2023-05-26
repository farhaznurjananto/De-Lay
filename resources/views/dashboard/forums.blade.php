@extends('dashboard.layouts.main') @section('container')
    <div class="header">
        <h1 class="h2 mt-3 fw-bold text-success">Forum Diskusi Global</h1>
        <hr class="featurette-divider" />
    </div>

    {{-- FORUM --}}
    <div class="main-wrapper">
        @if ($forums->count())
            @foreach ($forums as $forum)
                <div class="card m-1">
                    <div class="card-header">
                        <i class="bi bi-bookmark-fill"></i>
                        {{ $forum->forum_category->name }}
                        @can('admin')
                            <i class="bi bi-three-dots-vertical float-end" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false"></i>
                            <div class="dropdown">
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="/dashboard/forum/{{ $forum->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ini?')">Suspend
                                                Forum</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endcan
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

        {{-- ADVERTISEMENT --}}
        @if ($advertisements->count())
            @foreach ($advertisements as $advertisement)
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">{{ $advertisement->title }}</strong>
                            @if ($advertisement->link != null)
                                <small>Pergi ke Iklan? <a href="{{ $advertisement->link }}" target="_blank">Klik
                                        disini!</a></small>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img class="mx-2 mt-2 img-thumbnail w-75"
                                src="{{ asset('storage/' . $advertisement->image_path) }}" class="rounded me-2"
                                alt="{{ $advertisement->title }}">
                        </div>
                        @if ($advertisement->description != null)
                            <div class="toast-body">
                                {{ $advertisement->description }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
        {{-- END ADVERTISEMENT --}}
    </div>

    <hr class="featurette-divider" />

    {{-- ADVERTISEMENT JS --}}
    <script>
        window.addEventListener('load', function() {
            var toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        });
    </script>
@endsection
