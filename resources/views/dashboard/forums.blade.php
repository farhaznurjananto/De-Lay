@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 h-screen sm:ml-64 bg-[#F1F8FE]">
        <div class="p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex rounded">
                    <a href="#" class="flex items-center text-[#293649] text-2xl font-semibold">
                        <span class="material-symbols-rounded">
                            forum
                        </span>
                        <span class="ml-3">{{ $title }}</span>
                    </a>
                </div>
            </div>

            @if (session()->has('success'))
                <div id="alert" class="flex p-4 w-full text-[#1B232E] rounded-lg bg-[#8ED145]" role="alert">
                    <span class="material-symbols-rounded">
                        info
                    </span>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" id="dismiss-btn"
                        class="ml-auto -mx-1.5 -my-1.5 bg-[#F1F8FE] text-[#1B232E] rounded-lg focus:ring-2 focus:ring-[#36BB6A]/50 p-1.5 hover:bg-[#36BB6A]/75 inline-flex h-8 w-8"
                        data-dismiss="alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <span class="material-symbols-rounded">
                            close
                        </span>
                    </button>
                </div>
            @endif

            <div class="grid grid-flow-col-1 xl:grid-cols-2 gap-4 mb-4">
                @if ($forums->count())
                    @foreach ($forums as $forum)
                        <div class="rounded bg-[#FFFFFF] p-5 shadow-md">
                            <span
                                class="h-full px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">{{ $forum->forum_category->name }}</span>
                            <div class="flex flex-col justify-center mt-3">
                                <p class="text-2xl font-medium text-justify">{{ $forum->question }}</p>
                                <p class="my-2">By : <span
                                        class="font-medium text-[#7095F3]">{{ $forum->user->name }}</span> |
                                    {{ $forum->created_at->diffForHumans() }} @if ($forum->updated_at != $forum->created_at)
                                        | diubah {{ $forum->updated_at->diffForHumans() }}
                                    @endif
                                </p>
                                <div class="flex flex-row justify-end">
                                    @can('admin')
                                        <form action="/dashboard/forum/{{ $forum->id }}" method="post">
                                            @method('delete')
                                            <button type="submit"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"
                                                class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 text-center m-1"><span
                                                    class="material-symbols-rounded">
                                                    delete
                                                </span></button>
                                        </form>
                                    @endcan
                                    <a href="/dashboard/forum/{{ $forum->id }}"
                                        class="text-[#1B232E] bg-[#FF9E22] hover:bg-[#FF9E22]/75 focus:ring-4 focus:outline-none focus:ring-[#FF9E22]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center m-1">Lihat</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-2">
                        <p class="text-center">Tidak ada forum.</p>
                    </div>
                @endif

                {{ $forums->links() }}
            </div>
        </div>
    </div>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- CUSTOM JS --}}
    <script src="/js/script.js"></script>
@endsection
