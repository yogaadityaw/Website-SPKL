@extends('layouts.error')

@section('title', '404')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="page-error">
        <div class="page-inner">
            <h1>404</h1>
            <div class="page-description">
                {{ $errorMessage }}
            </div>
            <div class="page-search">
                <div class="mt-3">
                    <a href="{{ url()->previous() }}">Kembali ke Halaman Sebelumnya</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
