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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#buatSPKLModalButton').click(function() {
                $('#buatSPKLModal').modal('show');
            });
        });
    </script>
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        (function($) {

            "use strict";

            $(".js-select2").select2({
                closeOnSelect: false,
                placeholder: "Click to select an option",
                allowHtml: true,
                allowClear: true,
                tags: true
            });

            $('.icons_select2').select2({
                width: "100%",
                templateSelection: iformat,
                templateResult: iformat,
                allowHtml: true,
                placeholder: "Click to select an option",
                dropdownParent: $('.select-icon'),
                allowClear: true,
                multiple: false,
            });


            function iformat(icon, badge, ) {
                var originalOption = icon.element;
                var originalOptionBadge = $(originalOption).data('badge');

                return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text +
                    '<span class="badge">' + originalOptionBadge + '</span></span>');
            }

        })(jQuery);
    </script>
@endpush
