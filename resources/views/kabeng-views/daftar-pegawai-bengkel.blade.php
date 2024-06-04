@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush


@include('components.sidebar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Daftar Personil</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Personil</h4>
                        </div>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-bordered table">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No Telp</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">PT</th>
                                        <th scope="col">Departemen</th>
                                        <th scope="col">Bengkel</th>

                                    </tr>
                                    <tbody>
                                    @foreach ($pegawaiBengkel as $pegawai)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pegawai->user_nip }}</td>
                                            <td>{{ $pegawai->user_fullname }}</td>
                                            <td>{{ $pegawai->username }}</td>
                                            <td>{{ $pegawai->email }}</td>
                                            <td>{{ $pegawai->user_telephone }}</td>
                                            <td>{{ $pegawai->user_age }}</td>
                                            <td>{{ $pegawai->role->role_name }}</td>
                                            <td>
                                                {{ $pegawai->pt ? $pegawai->pt->pt_name : '' }}
                                            </td>
                                            <td>
                                                {{ $pegawai->bengkel->departemen->departemen_name }}
                                            </td>
                                            <td>
                                                {{ $pegawai->bengkel ? $pegawai->bengkel->bengkel_name: '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>


@endpush
