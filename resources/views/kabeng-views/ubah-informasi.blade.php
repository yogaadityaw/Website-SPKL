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
                                    <form action="{{ route('fungsi-ubah-informasi', ['id' => $spkl->id_spkl]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-3 my-3">
                                                <h5>Nama PT</h5>
                                                <select id="inputState" class="form-control" name="pt_id">
                                                    @foreach($pts as $pt)
                                                        <option value="{{$pt->id_pt}}" {{ $spkl->pt_id == $pt->id_pt ? 'selected' : '' }}>{{$pt->pt_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3 my-3">
                                                <label for="inputRencana"></label>
                                                <h5>Rencana Mulai</h5>
                                                <input type="time" class="form-control" id="inputRencana" name="rencana_mulai" value="{{ $spkl->rencana_mulai }}">
                                            </div>
                                            <div class="col-3 my-3">
                                                <label for="inputRencana"></label>
                                                <h5>Rencana Selesai</h5>
                                                <input type="time" class="form-control" id="inputRencana" name="rencana_selesai" value="{{ $spkl->rencana_selesai }}">
                                            </div>

                                            <div class="col-3 my-3">
                                                <h5>Tanggal</h5>
                                                <input type="date" name="tanggal" class="form-control" value="{{ $spkl->tanggal ? date('Y-m-d', strtotime($spkl->tanggal)) : '' }}">
                                            </div>
                                            <div class="col-3 my-3">
                                                <h5>Uraian Target Lembur</h5>
                                                <input type="text" name="uraian_pekerjaan" class="form-control" value="{{ $spkl->uraian_pekerjaan }}">
                                            </div>
                                            <div class="col-3 my-3">
                                                <h5>Progress</h5>
                                                <input type="text" name="progres" class="form-control" value="{{ $spkl->progres }}">
                                            </div>
                                            <div class="col-3 my-3">
                                                    <label>
                                                        <h5>Proyek</h5>
                                                    </label>
                                                    <select id="inputState" class="form-control" name="proyek_id">
                                                        @foreach($proyeks as $proyek)
                                                            <option value="{{$proyek->id_proyek}}" {{ $spkl->proyek_id == $proyek->id_proyek ? 'selected' : '' }}>{{$proyek->proyek_name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            @if ($spkl->alasan_penolakan)
                                            <div class="col-12">
                                                <h5>Alasan Penolakan</h5>
                                                <p>{{ $spkl->alasan_penolakan }}</p>
                                            </div>
                                            @endif
                                            <div class="col-12">
                                                <input type="submit" value="submit" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
