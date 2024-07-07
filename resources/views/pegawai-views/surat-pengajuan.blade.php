@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/multi-choice.css') }}">
    <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
@endpush

@include('components.sidebar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Jadwal Lembur</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jadwal Lembur Hari Ini</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-bordered table">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">No SPKL</th>
                                            <th scope="col">Nama Proyek</th>
                                            <th scope="col">Departemen</th>
                                            <th scope="col">Bengkel</th>
                                            <th scope="col">Tanggal Lembur</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                        @foreach ($filteredSpkls as $index => $spkl)
                                            <tr>
                                                <td scope="col">{{ $index+$filteredSpkls->firstItem() }}</td>
                                                <td scope="col">{{ $spkl->spkl->ref_number ?? ' ' }}</td>
                                                <td scope="col">{{ $spkl->spkl->proyek->proyek_name ?? ' ' }}</td>
                                                <td scope="col">
                                                    {{ $spkl->spkl->bengkel->departemen->departemen_name ?? ' ' }}</td>
                                                <td scope="col">{{ $spkl->spkl->bengkel->bengkel_name ?? ' ' }}</td>
                                                <td scope="col">{{ $spkl->spkl->tanggal ?? '' }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('detail-spkl-pegawai', ['id' => $spkl->spkl->id_spkl]) }}">
                                                        <button type="button" class="btn btn-success fas fa-book"
                                                                data-toggle="modal">
                                                        </button>
                                                    </a>
                                                    <button type="button" value="{{ $spkl->id }}"
                                                            data-spkl-id="{{ $spkl->id }}"
                                                            class="btn btn-success checkinButton" data-toggle="modal"
                                                            data-target="#checkinModal">
                                                        Check-in
                                                    </button>
                                                    <button type="button" value="{{ $spkl->id }}"
                                                            data-spkl-id="{{ $spkl->id }}"
                                                            class="btn btn-danger checkoutButton" data-toggle="modal"
                                                            data-target="#checkoutModal">
                                                        Check-out
                                                    </button>

                                                    {{-- <form id="checkout-form" action="{{ route('checkout-spkl-pegawai') }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        <input type="hidden" name="user_spkl_id"
                                                            value="{{ $spkl->id }}">
                                                    </form> --}}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    {{ $filteredSpkls->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Riwayat SPKL</h4>
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
                                    <th scope="col">No SPKL</th>
                                    <th scope="col">Nama Proyek</th>
                                    <th scope="col">Departemen</th>
                                    <th scope="col">Bengkel</th>
                                    <th scope="col">Tanggal Lembur</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                @foreach ($finishedSpkls as $spkl)
                                    <tr>
                                        <td scope="col">{{ $loop->index + 1 }}</td>
                                        <td scope="col">{{ $spkl->spkl->ref_number ?? '' }}</td>
                                        <td scope="col">{{ $spkl->spkl->proyek->proyek_name ?? '' }}</td>
                                        <td scope="col">{{ $spkl->spkl->bengkel->departemen->departemen_name ?? '' }}
                                        </td>
                                        <td scope="col">{{ $spkl->spkl->bengkel->bengkel_name ?? '' }}</td>
                                        <td scope="col">{{ $spkl->spkl->tanggal ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('detail-spkl-pegawai', ['id' => $spkl->spkl->spkl_number]) }}">
                                                <button type="button" class="btn btn-success fas fa-book">

                                                </button>
                                            </a>
                                            <a href="{{ route('print-spkl', ['id_spkl' => $spkl->spkl->spkl_number]) }}">
                                                <button type="button" value='' class="btn btn-primary fas fa-print"
                                                        data-toggle="modal">
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            {{ $finishedSpkls->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<div class="modal fade" id="checkinModal" tabindex="-1" role="dialog" aria-labelledby="checkinModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="checkinForm" action="{{ route('absen-spkl-pegawai') }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_spkl_id" id="checkinUserSpklId">
                <input type="hidden" name="user_name" id="checkinUserName"
                       value="{{ Auth::user()->user_fullname }}">
                <input type="hidden" name="lokasi_check_in" id="lokasi_check_in">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkinModalLabel">Absen Foto Check-in</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Foto checkin</p>
                    <div class="justify-content-center d-flex align-items-center">
                        <div id="checkinCamera"></div>
                        <br/>
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary"
                            onClick="take_snapshot('checkinCamera', '#checkinForm')">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="checkoutForm" action="{{ route('checkout-spkl-pegawai') }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_spkl_id" id="checkoutUserSpklId">
                <input type="hidden" name="user_name" id="checkoutUserName"
                       value="{{ Auth::user()->user_fullname }}">
                <input type="hidden" name="lokasi_check_out" id="lokasi_check_out">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Absen Foto Check-out</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Foto Check out</p>
                    <div class="justify-content-center d-flex align-items-center">
                        <div id="checkoutCamera"></div>
                        <br/>
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary"
                            onClick="take_snapshot('checkoutCamera', '#checkoutForm')">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.checkinButton').click(function () {
                var spklId = $(this).data('spkl-id');
                $('#checkinUserSpklId').val(spklId);
                $('#checkinModal').modal('show');
            });
            $('.checkoutButton').click(function () {
                var spklId = $(this).data('spkl-id');
                $('#checkoutUserSpklId').val(spklId);
                $('#checkoutModal').modal('show');
            });
        });
    </script>

    <script language="JavaScript">
        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#checkinCamera');
        Webcam.attach('#checkoutCamera');

        function take_snapshot(cameraId, formId) {
            Webcam.snap(function (data_uri) {
                $(formId + " .image-tag").val(data_uri);
                $('#image_preview').html('<img src="' + data_uri + '"/>');
                submitForm(formId);
            });
        }

        function submitForm(formId) {
            $(formId).submit();
        }

        document.getElementById('image_file').onchange = function (evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;

            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    $(".image-tag").val(fr.result);
                    $('#image_preview').html('<img src="' + fr.result + '"/>');
                    submitForm('#myForm');
                }
                fr.readAsDataURL(files[0]);
            }
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError, {
                        enableHighAccuracy: true,
                        timeout: 5000,
                        maximumAge: 0
                    });
                } else {
                    lokasi_check_in.value = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                const locationData = {
                    longitude: position.coords.longitude,
                    latitude: position.coords.latitude
                };
                lokasi_check_in.value = JSON.stringify(locationData);
                lokasi_check_out.value = JSON.stringify(locationData);
            }

            function showError(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        lokasi_check_in.value = "User denied the request for Geolocation.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        lokasi_check_in.value = "Location information is unavailable.";
                        break;
                    case error.TIMEOUT:
                        lokasi_check_in.value = "The request to get user location timed out.";
                        break;
                    case error.UNKNOWN_ERROR:
                        lokasi_check_in.value = "An unknown error occurred.";
                        break;
                }
            }

            $('#checkinModal').on('shown.bs.modal', function () {
                getLocation();
            });
            $('#checkoutModal').on('shown.bs.modal', function () {
                getLocation();
            });
        });
    </script>
@endpush
