@extends('dashboard.layouts.main')
@section('container')
    <div class="p-4 min-h-screen sm:ml-64 bg-[#F1F8FE]">
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

            <div class="flex justify-end mb-4">
                <button data-modal-target="large-modal" data-modal-toggle="large-modal" type="submit"
                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm px-5 py-2.5 focus:outline-none flex flex-row justify-center items-center"><span
                        class="material-symbols-rounded">
                        add_circle
                    </span>
                    <p class="text-xl ml-3">Tambah</p>
                </button>
            </div>

            @if (session()->has('error'))
                <div id="alert" class="flex p-4 text-[#1B232E] rounded-lg bg-[#FF5A8A] w-full mb-3" role="alert">
                    <span class="material-symbols-rounded">
                        info
                    </span>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button" id="dismiss-btn"
                        class="ml-auto -mx-1.5 -my-1.5 bg-[#F1F8FE] text-[#1B232E] rounded-lg focus:ring-2 focus:ring-[#FF1458]/50 p-1.5 hover:bg-[#FF1458]/75 inline-flex h-8 w-8"
                        data-dismiss="alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <span class="material-symbols-rounded">
                            close
                        </span>
                    </button>
                </div>
            @elseif (session()->has('success'))
                <div id="alert" class="flex p-4 w-full text-[#1B232E] rounded-lg bg-[#8ED145] mb-3" role="alert">
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
                                    <a href="/dashboard/forum/{{ $forum->id }}/edit"
                                        class="text-[#1B232E] bg-[#8ED145] hover:bg-[#8ED145]/75 focus:ring-4 focus:outline-none focus:ring-[#8ED145]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 m-1 text-center"><span
                                            class="material-symbols-rounded">
                                            edit
                                        </span></a>
                                    <form class="m-1" action="/dashboard/forum/{{ $forum->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"
                                            class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 text-center"><span
                                                class="material-symbols-rounded">
                                                delete
                                            </span></button>
                                    </form>
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
            </div>
            {{ $forums->links() }}
        </div>
    </div>

    {{-- MODAL --}}
    <div id="large-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-[#F1F8FE] rounded-lg shadow">
                <div class="px-6 py-6 lg:px-8 flex flex-col justify-center items-center">
                    <h3 class="mb-4 text-xl text-center font-medium text-[#36BB6A]">TAMBAH FORUM</h3>
                    <form class="space-y-6 w-full" action="/dashboard/forum" method="post">
                        @csrf
                        <div class="w-full mb-3">
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 text-sm text-[#F1F8FE] bg-[#1B232E] rounded-l-lg">
                                    <span class="material-symbols-rounded">
                                        link
                                    </span>
                                </span>
                                <select id="forum_category" name="forum_category_id"
                                    class="bg-[#F1F8FE] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                    @foreach ($forum_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full mb-3">
                            <textarea id="question" name="question" rows="4"
                                class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#F1F8FE] rounded-lg border border-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] @error('question') invalid:border-[#FF5A8A] @enderror"
                                placeholder="BELUM ADA TANGGAPAN" required oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')">{{ old('question') }}</textarea>
                            @error('question')
                                <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex flex-row flex-wrap justify-center">
                            <button type="button" data-modal-hide="large-modal"
                                class="text-[#F1F8FE] bg-[#1B232E] hover:bg-[#1B232E]/75 focus:ring-4 focus:outline-none focus:ring-[#1B232E]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Batal</button>
                            <button type="submit" onclick="return confirm('apakah ingin membuat forum?')"
                                class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
