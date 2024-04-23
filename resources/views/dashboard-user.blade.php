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
                <h1>Dashboard</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div style="width:100%" class="card">
                        <img class="img-responsive center-block" style="margin: 0 auto" width="40%"
                             src="{{ asset('img/image-wait.svg') }}" alt="">
                        <h2 class="text-center">Akun Sedang Dikonfirmasi</h2>
                        <p class="text-center">Mohon untuk menunggu akun Anda telah melakukan pendaftaran SPKL Online
                            PT.PAL</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
