@extends('layouts.app')

@section('title', 'User Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
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
                                            <p>{{$spkls->pt->pt_name}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Bengkel</h5>
                                            <p>{{$spkls->bengkel->bengkel_name}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Pelaksanaan</h5>
                                            @foreach ($spkls->userSpkls as $pegawai)
                                                @if ($pegawai->check_in && $pegawai->check_out)
                                                    {{ $pegawai->user->user_fullname }} : {{ $pegawai->jam_realisasi }} <br>
                                                @else
                                                    <p>-</p>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-3">
                                            <h5>Rencana</h5>
                                            <p>{{$spkls->rencana}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Nomor Pengajuan</h5>
                                            <p>{{$spkls->spkl_number}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Departemen</h5>
                                            <p>{{$spkls->bengkel->departemen->departemen_name}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Tanggal</h5>
                                            <p> {{$spkls->tanggal}} </p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Jam Realisasi</h5>
                                            @if ($spkls->userSpkls->every(fn($pegawai) => $pegawai->check_out != null) && $spkls->jam_realisasi != null)
                                                <p>{!! $spkls->jam_realisasi !!}</p>
                                            @else
                                                <p>-</p>
                                            @endif
                                        </div>
                                        <div class="col-3">
                                            <h5>Proyek</h5>
                                            <p> {{ $spkls->proyek->proyek_name }} </p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Uraian Target Lembur</h5>
                                            <p>{{$spkls->uraian_pekerjaan}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Progress</h5>
                                            <p> {{$spkls->progres}} </p>
                                        </div>
                                        <div class="row ml-1 mr-1">
                                            <div class="col-9">
                                                <label><h5>Karyawan</h5></label>
                                                <textarea
                                                    class="form-control"
                                                    data-height="150"
                                                    required="">
                                                    @foreach ($spkls->userSpkls as $karyawan)
                                                        {{ $karyawan->user->user_fullname }},
                                                    @endforeach
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h5>Lokasi :</h5>
                                            @foreach ($spkls->userSpkls as $detail)
                                                <p>
                                                    {{ $detail->user->user_fullname }}
                                                    @if ($detail->lokasi_check_in)
                                                        @php
                                                            $location = json_decode($detail->lokasi_check_in, true);
                                                        @endphp
                                                        <p>Lokasi Check In</p>
                                                        <p>Longitude: {{ $location['longitude'] }}</p>
                                                        <p>Latitude: {{ $location['latitude'] }}</p>
                                                    @else
                                                        <p>-</p>
                                                    @endif
                                                    @if ($detail->lokasi_check_out)
                                                        @php
                                                            $location = json_decode($detail->lokasi_check_out, true);
                                                        @endphp
                                                        <p>Lokasi Check Out</p>
                                                        <p>Longitude: {{ $location['longitude'] }}</p>
                                                        <p>Latitude: {{ $location['latitude'] }}</p>
                                                    @else
                                                        <p>-</p>
                                                    @endif
                                                </p>
                                            @endforeach
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
                                            <p>{{ $qr->spkl->bengkel->user->user_fullname ?? 'Gak tau namanya' }}</p>
                                            {!! $qr->workshop_head_qr_code ?? '' !!}
                                        </div>
                                        <div class="col-4">
                                            <h5>Kepala Departemen</h5>
                                            <p>{{ $qr->spkl->bengkel->departemen->user->user_fullname ?? 'Gak tau namanya' }}</p>
                                            {!! $qr->department_head_qr_code ?? '' !!}
                                        </div>
                                        <div class="col-4">
                                            <h5>Kepala Manajemen</h5>
                                            <p>{{ $qr->spkl->proyek->user->user_fullname ?? 'Gak tau namanya' }}</p>
                                            {!! $qr->pj_proyek_qr_code ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('audit-spkl-kemenpro')}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="spkl_id" value="{{ $spkls->id_spkl }}">
                                <input type="hidden" name="action" value="approve">
                                <div class="row-12 mx-4 mb-4">
                                    <div class="d-flex justify-content-end">
                                        <button type="button"
                                            class="btn btn-outline-danger d-flex justify-content-end ml-2"
                                            data-bs-toggle="modal" data-bs-target="#tolakModal" id="buttonTolakModal">
                                            Tolak
                                        </button>
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
@endsection


<div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('tolak-spkl', ['id' => $spkls->id_spkl]) }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="alasanPenolakan" class="form-label">Alasan Penolakan</label>
                        <textarea class="form-control" id="alasanPenolakan" rows="5" col="5" name="alasanPenolakan" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    {{-- <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $('#buttonTolakModal').click(function() {
                $('#tolakModal').modal('show');
            });
        });
    </script>
@endpush
