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

            {{-- FARMER --}}
            <div class="grid grid-flow-col-1 xl:grid-cols-2 gap-4 mb-4">
                <div class="rounded bg-[#FFFFFF] p-5 shadow-md">
                    <div class="flex flex-col justify-center items-center">
                        <h3 class="mb-4 text-xl text-center font-medium text-[#36BB6A]">UBAH FORUM</h3>
                        <form class="space-y-6 w-full" action="/dashboard/forum/{{ $forum->id }}" method="post">
                            @method('put')
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
                                        class="bg-[#FFFFFF] border border-[#1B232E] text-[#1B232E] text-sm rounded-r-lg focus:ring-[#1B232E] focus:border-[#1B232E] block w-full p-2.5">
                                        @foreach ($forum_categories as $category)
                                            @if ($forum->forum_category_id == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="w-full mb-3">
                                <textarea id="question" name="question" rows="4"
                                    class="block my-4 p-2.5 w-full text-sm text-[#1B232E] bg-[#FFFFFF] rounded-lg border border-[#1B232E] focus:ring-[#1B232E] focus:border-[#1B232E] @error('question') invalid:border-[#FF5A8A] @enderror"
                                    placeholder="BELUM ADA TANGGAPAN" required oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                    oninput="setCustomValidity('')">{{ old('question', $forum->question) }}</textarea>
                                @error('question')
                                    <p class="text-[#FF5A8A] mt-2 text-sm font-medium">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="flex flex-row flex-wrap justify-center">
                                <button type="submit"
                                    class="text-[#1B232E] bg-[#36BB6A] hover:bg-[#36BB6A]/75 focus:ring-4 focus:outline-none focus:ring-[#36BB6A]/50 m-1 font-medium rounded-full text-sm w-full sm:w-auto px-10 py-2.5 text-center"
                                    onclick="return confirm('Apakah anda yakin ingin memperbarui data?')">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="rounded bg-[#1B232E] p-5">
                    <span class="h-full px-3 rounded-md bg-[#F1F8FE] text-[#1B232E] text-center">ADS</span>
                    <div class="flex flex-col justify-center mt-3">
                    </div>
                </div>
            </div>
            {{-- END FARMER --}}
        </div>
    </div>
@endsection
