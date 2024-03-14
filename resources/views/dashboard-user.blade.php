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
                <h1>Selamat Datang</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div style="width:100%" class="card">

                        <img class="img-responsive center-block" style="margin: 0 auto" width="35%"
                             src="{{ asset('img/konfirmasi-akun.png') }}" alt="">
                        <h2 class="text-center mt-2" style="color: blue"><b> Akun Anda Sedang Dikonfirmasi</b></h2>
                        {{-- <p class="text-center">Hi {{ Auth::user()->user_fullname }},</p> --}}
                        <p class="text-center">Anda Telah Melakukan Pendaftaran di Registrasi SPKL Online PT PAL.
                            <br>
                            Akun anda sedang diproses mohon untuk menunggu
                            <br>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
