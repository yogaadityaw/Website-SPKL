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
    <style>
        td {}
    </style>
@endpush

@include('components.sidebar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat SPKL Baru</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Buat SPKL Baru</h4>
                        </div>
                        <div class="card-body">
                            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                                <button data-toggle="modal" data-target="#buatSPKLModal" type="button"
                                    class="btn btn-primary mr-2">+ BUAT SPKL</button>
                                <button type="button" class="btn btn-light">FILTER</button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- modal untuk input data spkl --}}

<div id="buatSPKLModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Nama PT</label>
                            <select id="inputState" class="form-control">
                                <option selected>Nama PT</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Nama Proyek</label>
                            <select id="inputState" class="form-control">
                                <option selected>Nama Proyek</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Departemen</label>
                            <select id="inputState" class="form-control">
                                <option selected>Departemen</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Bengkel</label>
                            <select id="inputState" class="form-control">
                                <option selected>Bengkel</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">pelaksanaan</label>
                            <input type="text" class="form-control" id="inputPelaksanaan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Uraian Target Lembur</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Rencana</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <section class="ftco-section ftco-no-pt ftco-no-pb">
                        <div class="container">
                            <div class="text-start">
                                <p>Karyawan</p>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-4 d-flex justify-content-center align-items-center">
                                    <select class="js-select2" multiple="multiple">
                                        <option value="O1" data-badge="">Royhan Fathur</option>
                                        <option value="O1" data-badge="">Fathur Rohman</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
</div>

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>

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
