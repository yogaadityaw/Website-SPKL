@extends('layouts.app')

@section('title', 'User Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <style>
        .location-image {
            max-width: 50%;
            height: auto;
            display: block;
            margin-top: 10px;
        }
    </style>
@endpush

@include('components.sidebar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center margin: 0 auto">
                <h1>Draft SPKL</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Persetujuan Surat Perintah Kerja Lembur</h4>
                            </div>
                            <div class="card border border-lg rounded-lg mx-4">
                                <div class="card-header">
                                    <h6 class="card-title">Detail Pengajuan Lembur</h6>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Nama PT</h5>
                                            <p>{{ $spkls->pt->pt_name }}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Bengkel</h5>
                                            <p>{{ $spkls->bengkel->bengkel_name }}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Rencana Mulai</h5>
                                            <p>{{ $spkls->rencana_mulai }}</p>
                                        </div>

                                        <div class="col-3">
                                            <h5>Rencana Selesai</h5>
                                            <p>{{ $spkls->rencana_selesai }}</p>
                                        </div>

                                        <div class="col-3">
                                            <h5>Proyek</h5>
                                            <p> {{ $spkls->proyek->proyek_name }} </p>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Nomor Pengajuan</h5>
                                            <p>{{ $spkls->ref_number }}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Progress</h5>
                                            <p> {{ $spkls->progres }} </p>
                                        </div>

                                        <div class="col-3">
                                            <h5>Uraian Target Lembur</h5>
                                            <p>{{ $spkls->uraian_pekerjaan }}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Tanggal</h5>
                                            <p>{{ date('d-m-Y', strtotime($spkls->tanggal)) }}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Departemen</h5>
                                            <p>{{ $spkls->bengkel->departemen->departemen_name }}</p>
                                        </div>

                                        <div class="col-3">
                                            <h5>Pelaksanaan</h5>
                                            @foreach ($spkls->userSpkls as $pegawai)
                                                @if ($pegawai->check_in && $pegawai->check_out)
                                                    <p>{{ $pegawai->user->user_fullname }} :
                                                        {{ date('H:i', strtotime($pegawai->check_in)) }}
                                                        -{{ date('H:i', strtotime($pegawai->check_out)) }}
                                                    </p>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            @endforeach
                                        </div>


                                        <div class="row ml-1 mr-1">
                                            <div class="col-9">
                                                <label>
                                                    <h5>Karyawan</h5>
                                                </label>
                                                <textarea class="form-control" data-height="150" required="">
                                                    @foreach ($spkls->userSpkls as $karyawan)
                                                        {{ $karyawan->user->user_fullname }},
                                                    @endforeach
                                                </textarea>
                                            </div>
                                        </div>
                                        {{--jam realisasi--}}
                                        <div class="col-3">
                                            <h5>Jam Realisasi</h5>
                                            @if ($spkls->userSpkls->every(fn($pegawai) => $pegawai->jam_realisasi != null))
                                                @foreach ($spkls->userSpkls as $karyawan)
                                                    {{ $karyawan->user->user_fullname }}
                                                    : {{ $karyawan->jam_realisasi }} <br>
                                                @endforeach
                                            @elseif (!$spkls->is_kemenpro_acc)
                                                <p>-</p>
                                            @else
                                                <form
                                                    action="{{ route('input-jam-realisasi', ['id' => $spkls->id_spkl]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <table>
                                                        @foreach ($spkls->userSpkls as $pegawai)
                                                            <tr>
                                                                <td>{{ $pegawai->user->user_fullname }}</td>
                                                                <td>
                                                                    <input type="text"
                                                                           name="jam_realisasi_{{ $pegawai->id }}"
                                                                           class="col-12">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                    <input type="submit" value="Simpan">
                                                </form>
                                            @endif
                                        </div>

                                        <div class="col-md-3">
                                            <h5>Lokasi :</h5>
                                            @foreach ($spkls->userSpkls as $detail)
                                                <p>
                                                {{ $detail->user->user_fullname }}
                                                @if ($detail->lokasi_check_in)
                                                    @php
                                                        $location = json_decode($detail->lokasi_check_in, true);
                                                    @endphp
                                                    <h5>Lokasi Check In</h5>
                                                    <div class="coordinate-container">
                                                        <p class="coordinates"
                                                           data-latitude="{{ $location['latitude'] }}"
                                                           data-longitude="{{ $location['longitude'] }}">
                                                        </p>
                                                        <p class="address" id="address-{{ $loop->index }}-in">
                                                            Mendapatkan
                                                            alamat...</p>
                                                    </div>
                                                    @if ($detail->foto_check_in)
                                                        <img
                                                            src="{{ \App\Helpers\ImageHelper::getImageUrl('images/' . $detail->foto_check_in)  }}"
                                                            alt="Location Image"
                                                            class="location-image img-fluid">
                                                    @else
                                                        <p></p>
                                                    @endif
                                                @else
                                                    <p>-</p>
                                                @endif
                                                <br>


                                                @if ($detail->lokasi_check_out)
                                                    @php
                                                        $location = json_decode($detail->lokasi_check_out, true);
                                                    @endphp
                                                    <h5>Lokasi Check Out</h5>
                                                    <div class="coordinate-container">
                                                        <p class="coordinates"
                                                           data-latitude="{{ $location['latitude'] }}"
                                                           data-longitude="{{ $location['longitude'] }}">
                                                        </p>
                                                        <p class="address" id="address-{{ $loop->index }}-out">
                                                            Mendapatkan
                                                            alamat...</p>
                                                    </div>
                                                    @if ($detail->foto_check_out)
                                                        <img
                                                            src="{{ \App\Helpers\ImageHelper::getImageUrl('images/' . $detail->foto_check_out)  }}"
                                                            alt="Location Image"
                                                            class="location-image img-fluid">
                                                    @else
                                                        <p></p>
                                                    @endif
                                                @else
                                                    <p>-</p>
                                                    @endif
                                                    </p>
                                                    @endforeach
                                        </div>
                                        <div class="col-3">
                                            <h5>Alasan Penolakan</h5>
                                            <p>{{ $spkls->alasan_penolakan ?: '-' }}</p>
                                            @if ($spkls->status == 'rejected')
                                                <a href="{{ route('ubah-informasi', ['id' => $spkls->id_spkl]) }}"
                                                   class="btn btn-info">
                                                    Ubah Informasi
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card border border-lg rounded-lg mx-4">
                                <div class="card-header">
                                    <h6 class="card-title">Persetujuan Pihak </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <h5>Kepala Biro/Kabeng</h5>
                                            <p>{{ $qr->spkl->bengkel->user->user_fullname ?? ' ' }}</p>
                                            {!! $qr->workshop_head_qr_code ?? '' !!}
                                        </div>
                                        <div class="col-4">
                                            <h5>Kepala Departemen</h5>
                                            <p>{{ $qr->spkl->bengkel->departemen->user->user_fullname ?? ' ' }}</p>
                                            {!! $qr->department_head_qr_code ?? '' !!}
                                        </div>
                                        <div class="col-4">
                                            <h5>Kepala Manajer Proyek</h5>
                                            <p>{{ $qr->spkl->proyek->user->user_fullname ?? ' ' }}</p>
                                            {!! $qr->pj_proyek_qr_code ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('audit-spkl-kabeng') }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="spkl_id" value="{{ $spkls->id_spkl }}">
                                <input type="hidden" name="action" value="approve">
                                <div class="row-12 mx-4 mb-4">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="action" value="approve"
                                                class="btn btn-primary d-flex justify-content-end ml-2">
                                            Setujui
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<script src="{{asset("/js/reverse_geolocator.js")}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const coordinateElements = document.querySelectorAll('.coordinates');

        coordinateElements.forEach((element, index) => {
            const latitude = element.dataset.latitude;
            const longitude = element.dataset.longitude;
            const addressElement = element.nextElementSibling;

            getAddressFromCoordinates(latitude, longitude, addressElement);
        });
    });
</script>
