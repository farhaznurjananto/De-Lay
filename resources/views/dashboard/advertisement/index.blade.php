@extends('dashboard.layouts.main') @section('container')
    <div class="header">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h2 mt-3 fw-bold text-success">Iklan</h1>
            <button class="btn btn-outline-success btn-sm mt-2" data-bs-toggle="modal"
                data-bs-target="#createAdvertisementModal">
                <i class="bi bi-plus-circle"></i> Tambah
            </button>
        </div>
        <hr class="featurette-divider" />
    </div>

    <div class="main-wrapper">
        {{-- ALERT --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- END-ALERT --}}

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Mulai</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Status</th>
                    <th scope="col">Paket</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            @if ($advertisements->count())
                <tbody>
                    @foreach ($advertisements as $advertisement)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $advertisement->title }}</td>
                            <td>{{ date_format(date_create($advertisement->start_date), 'd M Y') }}</td>
                            <td>{{ date_format(date_create($advertisement->end_date), 'd M Y') }}</td>
                            <td>
                                @if (now() < $advertisement->end_date && now() > $advertisement->start_date)
                                    <span class="badge text-bg-success }}">Aktif</span>
                                @else
                                    <span class="badge text-bg-danger }}">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>{{ $advertisement->advertising_package }}</td>
                            <td>
                                <a href="/dashboard/advertisement/{{ $advertisement->id }}"
                                    class="btn btn-outline-warning m-1 btn-sm"><i class="bi bi-eye"></i></a>
                                <form action="/dashboard/advertisement/{{ $advertisement->id }}" method="post"
                                    class="d-inline">
                                    @method('delete') @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Apakah anda yakin untuk menghapus iklan ini?')">
                                        <i class="bi bi-x-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody>
                    <tr>
                        <td colspan="7">
                            <p class="text-center text-muted fs-4">Tidak ada produk.</p>
                        </td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>

    <hr class="featurette-divider" />

    {{-- CREATE PRODUCT MODAL --}}
    <div class="modal" id="createAdvertisementModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Iklan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/dashboard/advertisement" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image_path" class="form-label">Gambar Iklan<span
                                    class="text-danger">*</span></label>
                            <div class="d-flex justify-content-center">
                                <img class="img-preview img-fluid mb-3 img-thumbnail" style="max-height: 150px" />
                            </div>
                            <input type="file" class="form-control @error('image_path') is-invalid @enderror"
                                id="image_path" name="image_path" placeholder="Gambar produk" required
                                onchange="previewImage()"
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" />
                            <div id="stockHelp" class="form-text">
                                Upload gambar iklan max 1mb.
                            </div>
                            @error('image_path')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="title" class="form-label">Nama<span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-muted"><i class="bi bi-braces"></i></span>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" placeholder="Nama iklan anda...." value="{{ old('title') }}" required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" />
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="link" class="form-label">Link Iklan<span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-muted"><i class="bi bi-link"></i></span>
                            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                                name="link" placeholder="Link iklan anda...." value="{{ old('link') }}" required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" />
                            @error('link')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="advertising_package" class="form-label">Paket Iklan<span
                                class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-muted"><i class="bi bi-card-list"></i></span>
                            <select class="form-select" aria-label="Default select example" id="advertising_package"
                                name="advertising_package">
                                <option value="1">Paket I</option>
                                <option value="2">Paket II</option>
                                <option value="3">Paket III</option>
                            </select>
                        </div>
                        <label for="start_date" class="form-label">Tanggal Mulai<span
                                class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-muted"><i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date" placeholder="Tanggal mulai iklan anda...."
                                value="{{ old('start_date') }}" required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" />
                            @error('start_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <label for="end_date" class="form-label">Tanggal Selesai<span
                                class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-muted"><i class="bi bi-calendar"></i></span>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date" placeholder="Tanggal selesai iklan anda...."
                                value="{{ old('end_date') }}" required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')"
                                oninput="setCustomValidity('')" />
                            @error('end_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- <label for="status" class="form-label">Status Iklan<span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text text-muted"><i class="bi bi-info-circle"></i></span>
                            <select class="form-select" aria-label="Default select example" id="status"
                                name="status">
                                <option value="0">Kadaluarsa</option>
                                <option value="1">Aktif</option>
                            </select>
                        </div> --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Tuliskan deskripsi iklan<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                rows="3" value="{{ old('description') }}" placeholder="Deskripsi iklan anda...." required
                                oninvalid="this.setCustomValidity('Silahkan isi form dengan lengkap.')" oninput="setCustomValidity('')">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary"
                                onclick="return confirm('Apakah data yang dimasukkan sudah benar?')">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- END-CREATE PRODUCT MODAL --}}
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector("#image_path");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            };
        }
    </script>
@endsection
