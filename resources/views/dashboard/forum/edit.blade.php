@extends('dashboard.layouts.main')

@section('container')
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h1 class="h2 mt-3 fw-bold text-success">Forum Diskusi | Edit</h1>
    </div>

    <hr class="featurette-divider" />

    <div class="main-wrapper">
        <form action="/dashboard/forum/{{ $forum->id }}" method="post">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="question" class="form-label">Tuliskan pertanyaan anda</label>
                <textarea class="form-control @error('question') is-invalid @enderror" name="question" id="question" rows="3"
                    required>{{ $forum->question }}</textarea>
                @error('question')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="forum_category_id" class="form-label">Kategori</label>
                <select class="form-select mb-3" id="forum_category" name="forum_category_id"
                    aria-label="Default select example">
                    @foreach ($forum_categories as $category)
                        @if ($forum->forum_category_id == $category->id)
                            <option value="{{ $category->id }}" selected="selected"{{ $category->name }}>
                                {{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"
                onclick="return confirm('Apakah anda yakin ingin memperbarui data?')">Update</button>
        </form>
    </div>

    <hr class="featurette-divider" />
@endsection
