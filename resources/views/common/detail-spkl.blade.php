@extends('layouts.app-blank')

@section('title', 'User Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Draft SPKL</h1>
            </div>
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Persetujuan Surat Perintah Kerja Lembur</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Nama PT</h5>
                                <p>{{ $spkls->pt->pt_name }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Bengkel</h5>
                                <p>{{ $spkls->bengkel->bengkel_name }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Rencana Mulai</h5>
                                <p>{{ $spkls->rencana_mulai }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Rencana Selesai</h5>
                                <p>{{ $spkls->rencana_selesai }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Proyek</h5>
                                <p>{{ $spkls->proyek->proyek_name }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Nomor Pengajuan</h5>
                                <p>{{ $spkls->ref_number }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Departemen</h5>
                                <p>{{ $spkls->bengkel->departemen->departemen_name }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Tanggal</h5>
                                <p>{{ date('d-m-Y', strtotime($spkls->tanggal)) }}</p>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <h5>Jam Realisasi</h5>
                                @if ($spkls->userSpkls->every(fn($pegawai) => $pegawai->jam_realisasi != null))
                                    @foreach ($spkls->userSpkls as $karyawan)
                                        {{ $karyawan->user->user_fullname }}
                                        : {{ $karyawan->jam_realisasi }} <br>
                                    @endforeach
                                @elseif (!$spkls->is_kemenpro_acc)
                                    <p>-</p>
                                @else
                                    <form action="{{ route('input-jam-realisasi', ['id' => $spkls->id_spkl]) }}"
                                          method="post">
                                        @csrf
                                        @method('PUT')
                                        <table class="table table-sm">
                                            @foreach ($spkls->userSpkls as $pegawai)
                                                <tr>
                                                    <td>{{ $pegawai->user->user_fullname }}</td>
                                                    <td>
                                                        <input type="text" name="jam_realisasi_{{ $pegawai->id }}"
                                                               class="form-control form-control-sm">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <h5>Uraian Target Lembur</h5>
                                <p>{{ $spkls->uraian_pekerjaan }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5>Progress</h5>
                                <p>{{ $spkls->progres }}</p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <h5>Karyawan</h5>
                                <textarea class="form-control" rows="3" readonly>
                                    @foreach ($spkls->userSpkls as $karyawan)
                                        {{ $karyawan->user->user_fullname }},
                                    @endforeach
                                </textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5>Pelaksanaan</h5>
                                @foreach ($spkls->userSpkls as $pegawai)
                                    @if ($pegawai->check_in && $pegawai->check_out)
                                        <p>{{ $pegawai->user->user_fullname }} :
                                            {{ date('H:i', strtotime($pegawai->check_in)) }}
                                            - {{ date('H:i', strtotime($pegawai->check_out)) }}
                                        </p>
                                    @else
                                        <p>-</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Lokasi section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Lokasi :</h5>
                                @foreach ($spkls->userSpkls as $detail)
                                    <p>
                                        <strong>{{ $detail->user->user_fullname }}</strong><br>
                                        @if ($detail->lokasi_check_in)
                                            @php
                                                $location = json_decode($detail->lokasi_check_in, true);
                                            @endphp
                                            <span>Lokasi Check In: </span>
                                            <span class="coordinates"
                                                  data-latitude="{{ $location['latitude'] }}"
                                                  data-longitude="{{ $location['longitude'] }}">
                                            </span>
                                            <span class="address" id="address-{{ $loop->index }}-in">Mendapatkan alamat...</span>
                                            <br>
                                        @else
                                            <span>Lokasi Check In: -</span><br>
                                        @endif

                                        @if ($detail->lokasi_check_out)
                                            @php
                                                $location = json_decode($detail->lokasi_check_out, true);
                                            @endphp
                                            <span>Lokasi Check Out: </span>
                                            <span class="coordinates"
                                                  data-latitude="{{ $location['latitude'] }}"
                                                  data-longitude="{{ $location['longitude'] }}">
                                            </span>
                                            <span class="address" id="address-{{ $loop->index }}-out">Mendapatkan alamat...</span>
                                        @else
                                            <span>Lokasi Check Out: -</span>
                                        @endif
                                    </p>
                                @endforeach
                            </div>
                        </div>

                        @if ($spkls->alasan_penolakan)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h5>Alasan Penolakan</h5>
                                    <p>{{ $spkls->alasan_penolakan }}</p>
                                    <a href="{{ route('ubah-informasi', ['id' => $spkls->id_spkl]) }}"
                                       class="btn btn-info">
                                        Ubah Informasi
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Persetujuan Pihak section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5>Persetujuan Pihak</h5>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h6>Kepala Biro/Kabeng</h6>
                                <p>{{ $qr->spkl->bengkel->user->user_fullname ?? ' ' }}</p>
                                {!! $qr->workshop_head_qr_code ?? '' !!}
                            </div>
                            <div class="col-md-4 mb-3">
                                <h6>Kepala Departemen</h6>
                                <p>{{ $qr->spkl->bengkel->departemen->user->user_fullname ?? ' ' }}</p>
                                {!! $qr->department_head_qr_code ?? '' !!}
                            </div>
                            <div class="col-md-4 mb-3">
                                <h6>Kepala Manajer Proyek</h6>
                                <p>{{ $qr->spkl->proyek->user->user_fullname ?? ' ' }}</p>
                                {!! $qr->pj_proyek_qr_code ?? '' !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <form action="{{ route('audit-spkl-kabeng') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="spkl_id" value="{{ $spkls->id_spkl }}">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit" class="btn btn-primary">Setujui</button>
                        </form>
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
