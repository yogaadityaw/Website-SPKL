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
                                    <h6 class="card-title">Detail SPKL</h6>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Nama PT</h5>
                                            <p>{{$spkl->pt->pt_name}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Bengkel</h5>
                                            <p>{{$spkl->bengkel->bengkel_name}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Jam Mulai Lembur</h5>
                                            <p>-</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Rencana</h5>
                                            <p>{{$spkl->rencana}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Nomor Pengajuan</h5>
                                            <p>{{$spkl->spkl_number}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Departemen</h5>
                                            <p>{{$spkl->departemen->departemen_name}}</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Jam Akhir Lembur</h5>
                                            <p>-</p>
                                        </div>
                                        <div class="col-3">
                                            <h5>Uraian Target Lembur</h5>
                                            <p>{{$spkl->uraian_pekerjaan}}</p>
                                        </div>
                                        <div class="row ml-1 mr-1">
                                            <div class="col-9">
                                                <label><h5>Karyawan</h5></label>
                                                <textarea
                                                    class="form-control"
                                                    data-height="150"
                                                    required="" readonly>
                                                    @foreach($spkl->user as $karyawan)
                                                        {{$karyawan->user->user_fullname}}  
                                                    @endforeach
                                                </textarea>
                                            </div>
                                            <div class="col-3">
                                                <h5>Progress</h5>
                                                <p>Kami telah mencapai 50% dari target pengujian dan menemukan beberapa
                                                    potensi perbaikan yang dapat meningkatkan kinerja sistem secara
                                                    keseluruhan.</p>
                                            </div>
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
                                            <h5>Kepala Biro</h5>
                                            <p>{{ $qr->workshopHead->user_fullname ?? 'Gak tau namanya' }}</p>
                                            {!! $qr->workshop_head_qr_code ?? '' !!}
                                        </div>
                                        <div class="col-4">
                                            <h5>Kepala Departemen</h5>
                                            <p>{{ $qr->departmentHead->user_fullname ?? 'Gak tau namanya' }}</p>
                                            {!! $qr->department_head_qr_code ?? '' !!}
                                        </div>
                                        <div class="col-4">
                                            <h5>Kepala Manajemen</h5>
                                            <p>{{ $qr->ptHead->user_fullname ?? 'Gak tau namanya' }}</p>
                                            {!! $qr->pj_proyek_qr_code ?? '' !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
