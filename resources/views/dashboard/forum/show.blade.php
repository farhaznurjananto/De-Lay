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

            <div class="grid grid-flow-col-1 gap-4 mb-4">
                <div class="rounded bg-[#FFFFFF] p-5 shadow-md">
                    <span
                        class="h-full px-3 rounded-md bg-[#293649] text-[#F1F8FE] text-center">{{ $forum->forum_category->name }}</span>
                    <div class="flex flex-col justify-center mt-3">
                        <p class="text-2xl font-medium text-justify">{{ $forum->question }}</p>
                        <p class="my-2">By : <span class="font-medium text-[#7095F3]">{{ $forum->user->name }}</span> |
                            {{ $forum->created_at->diffForHumans() }} @if ($forum->updated_at != $forum->created_at)
                                | diubah {{ $forum->updated_at->diffForHumans() }}
                            @endif
                        </p>
                        @canany(['farmer', 'produsen'])
                            <form action="/dashboard/discussion" method="post">
                                @csrf
                                <div class="w-full mb-3"><input type="hidden" name="forum_id" id="forum_id"
                                        value="{{ $forum->id }}" />
                                    <textarea id="message" name="message" rows="4"
                                        class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#FFFFFF] rounded-lg border border-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] @error('message') invalid:border-[#FF5A8A] @enderror"
                                        placeholder="BERI TANGGAPAN ANDA" required oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                        oninput="setCustomValidity('')"></textarea>
                                    @error('message')
                                        <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div class="flex flex-row justify-end">
                                    <button type="submit"
                                        class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-5 py-2.5 text-center m-1">Kirim</button>
                                </div>
                            </form>
                            {{-- <div class="flex flex-row justify-end">
                                @if ($forum->user_id == auth()->user()->id)
                                    <a href="/dashboard/forum/{{ $forum->id }}/edit"
                                        class="text-[#1B232E] bg-[#8ED145] hover:bg-[#8ED145]/75 focus:ring-4 focus:outline-none focus:ring-[#8ED145]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 m-1 text-center"><span
                                            class="material-symbols-rounded">
                                            edit
                                        </span></a>
                                    <form action="/dashboard/forum/{{ $forum->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"
                                            class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 text-center m-1"><span
                                                class="material-symbols-rounded">
                                                delete
                                            </span></button>
                                    </form>
                                @endif
                            </div> --}}
                        @endcanany
                        @can('admin')
                            <div class="flex flex-row justify-end">
                                <form action="/dashboard/forum/{{ $forum->id }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"
                                        class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 text-center m-1"><span
                                            class="material-symbols-rounded">
                                            delete
                                        </span></button>
                                </form>
                            </div>
                        @endcan
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
                @if ($discussions->count())
                    @foreach ($discussions as $discussion)
                        <div class="rounded bg-[#FFFFFF] p-5 shadow-md">
                            <div class="flex flex-row flex-wrap justify-between items-center">
                                <div class="flex flex-col">
                                    <p class="text-2xl font-medium text-justify">{{ $discussion->message }}</p>
                                    <p class="my-2">By : <span
                                            class="font-medium text-[#7095F3]">{{ $discussion->user->name }}</span> |
                                        {{ $discussion->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                @if ($discussion->sender_id == auth()->user()->id)
                                    <form action="/dashboard/discussion/{{ $discussion->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"
                                            class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 text-center m-1"><span
                                                class="material-symbols-rounded">
                                                delete
                                            </span></button>
                                    </form>
                                @endif
                                @can('admin')
                                    <form action="/dashboard/discussion/{{ $discussion->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus ini?')"
                                            class="text-[#1B232E] bg-[#FF5A8A] hover:bg-[#FF5A8A]/75 focus:ring-4 focus:outline-none focus:ring-[#FF5A8A]/50 font-medium rounded-full text-sm w-full sm:w-auto px-3 py-2 text-center m-1"><span
                                                class="material-symbols-rounded">
                                                delete
                                            </span></button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="rounded bg-[#FFFFFF] p-5 shadow-md">
                        <p class="text-center">Tidak ada jawaban.</p>
                    </div>
                @endif
            </div>
        </div>

        {{ $discussions->links() }}
    </div>
@endsection
