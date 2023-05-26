@extends('dashboard.layouts.main') @section('container')
    <div class="header">
        <h1 class="h2 mt-3 fw-bold text-success">Detail Iklan</h1>
        <hr class="featurette-divider" />
    </div>
    <div class="d-flex flex-row flex-wrap justify-content-between align-content-center">
        <img class="img-thumbnail h-auto mb-3 m-md-0" src="{{ asset('storage/' . $advertisement->image_path) }}"
            alt="image_advertisement">
        <div class="border rounded p-2 p-md-5">
            <p class="text-center fw-bold fs-4">Detail Iklan</p>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <td class="text-start" scope="col"><span class="fw-bold">Nama :</span>
                            {{ $advertisement->title }}
                        </td>
                        <th class="text-end" scope="col">Status :
                            @if (now() < $advertisement->end_date && now() > $advertisement->start_date)
                                <span class="badge text-bg-success }}">Aktif</span>
                            @else
                                <span class="badge text-bg-danger }}">Tidak Aktif</span>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row" colspan="2"><span class="fw-bold">Tanggal Mulai :</span>
                            {{ date_format(date_create($advertisement->start_date), 'd M Y') }}</td>
                    </tr>
                    <tr>
                        <td scope="row" colspan="2"><span class="fw-bold">Tanggal Selesai :</span>
                            {{ date_format(date_create($advertisement->end_date), 'd M Y') }}</td>
                    </tr>
                    <tr valign="middle">
                        <td scope="row"><span class="fw-bold" colspan="2">Link Iklan :</span>
                            <a href="{{ $advertisement->link }}" target="_blank">{{ $advertisement->link }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row"><span class="fw-bold" colspan="2">Paket Iklan :</span>
                            {{ $advertisement->advertising_package }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr class="featurette-divider" />
@endsection
