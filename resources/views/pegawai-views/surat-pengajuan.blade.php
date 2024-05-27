@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
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
                <h1>Jadwal Lembur Hari Ini</h1>
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
                                        @foreach ($filteredSpkls as $spkl)
                                            <tr>
                                                <td scope="col">{{ $loop->index + 1 }}</td>
                                                <td scope="col">{{ $spkl->spkl->spkl_number ?? '' }}</td>
                                                <td scope="col">{{ $spkl->spkl->proyek->proyek_name ?? '' }}</td>
                                                <td scope="col">{{ $spkl->spkl->departemen->departemen_name ?? '' }}</td>
                                                <td scope="col">{{ $spkl->spkl->bengkel->bengkel_name ?? '' }}</td>
                                                <td scope="col">{{ $spkl->spkl->tanggal ?? '' }}</td>
                                                <td>
                                                    <a href="{{ route('detail-spkl-pegawai', ['id' => $spkl->spkl->id_spkl]) }}">
                                                        <button type="button"
                                                                class="btn btn-success fas fa-book"
                                                                data-toggle="modal">
                                                        </button>
                                                    </a>
                                                    <button type="button" value="{{ $spkl->id }}"
                                                        data-spkl-id="{{ $spkl->id }}"
                                                        class="btn btn-success checkinButton" data-toggle="modal"
                                                        data-target="#checkinModal">
                                                        Check-in
                                                    </button>

                                                    <button type="button" class="btn btn-danger deleteButton"
                                                        value=""
                                                        onclick="event.preventDefault();
                                                        document.getElementById('checkout-form').submit();">
                                                        Check-out
                                                    </button>

                                                    <form id="checkout-form" action="{{ route('checkout-spkl-pegawai') }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        <input type="hidden" name="user_spkl_id"
                                                            value="{{ $spkl->id }}">
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
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
                        <h4>List SPKL</h4>
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
                                        <td scope="col">{{ $spkl->spkl->spkl_number ?? '' }}</td>
                                        <td scope="col">{{ $spkl->spkl->proyek->proyek_name ?? '' }}</td>
                                        <td scope="col">{{ $spkl->spkl->departemen->departemen_name ?? '' }}</td>
                                        <td scope="col">{{ $spkl->spkl->bengkel->bengkel_name ?? '' }}</td>
                                        <td scope="col">{{ $spkl->spkl->tanggal ?? '' }}</td>
                                        <td>
                                            <button type="button" value="{{ $spkl->id }}"
                                                data-spkl-id="{{ $spkl->id }}" class="btn btn-success checkinButton"
                                                >
                                                detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

{{-- modal untuk absen --}}
<div class="col-12 col-md-6 col-lg-6">
    <div class="modal fade" id="checkinModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="myForm" action="{{ route('absen-spkl-pegawai') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_spkl_id" id="userSpklId">
                    <input type="hidden" name="user_name" id="user_id"
                        value="{{ Auth::user()->user_fullname }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Absen Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>kolom Foto</p>
                    </div>
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br />
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary" onClick="take_snapshot()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@push('scripts')
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    </script>
    {{--    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script> --}}
    {{--    <script src="{{ asset('library/popper.js/dist/popper.js') }}"></script> --}}
    {{--    <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script> --}}
    {{--    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            $('.checkinButton').click(function() {
                var spklId = $(this).data('spkl-id');
                $('#userSpklId').val(spklId);
                $('#checkinModal').modal('show');
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

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                $('#image_preview').html('<img src="' + data_uri + '"/>');
                submitForm();
            });
        }

        function submitForm() {
            $('#myForm').submit();
        }

        document.getElementById('image_file').onchange = function(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;

            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    $(".image-tag").val(fr.result);
                    $('#image_preview').html('<img src="' + fr.result + '"/>');
                    submitForm();
                }
                fr.readAsDataURL(files[0]);
            }
        };
    </script>
@endpush
