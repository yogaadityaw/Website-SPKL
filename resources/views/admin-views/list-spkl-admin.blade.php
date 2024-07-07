@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@include('components.sidebar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rekap SPKL</h1>
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
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Departemen</th>
                                    <th scope="col">Nama Proyek</th>
                                    <th scope="col">Bengkel</th>
                                    <th scope="col"> Status</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                                <tbody>
                                @foreach ($spkls as $index => $spkl)
                                    <tr>
                                        <td>{{ $index + $spkls->firstItem() }}</td>
                                        <td> {{ $spkl->ref_number}} </td>
                                        <td> {{ \App\Helper\DateTimeParser::parse($spkl->tanggal) }} </td>
                                        <td> {{ $spkl->bengkel->departemen->departemen_name}} </td>
                                        <td> {{ $spkl->proyek->proyek_name}} </td>
                                        <td> {{ $spkl->bengkel->bengkel_name}} </td>
                                        <td class="text-center">
                                            @switch($spkl->status)
                                                @case("approved")
                                                    <div class="badge badge-pill badge-success mb-1">
                                                        Disetujui
                                                    </div>
                                                    @break
                                                @case("process")
                                                    <div class="badge badge-pill badge-warning mb-1">Dalam
                                                        Proses
                                                    </div>
                                                    @break
                                                @case("rejected")
                                                    <div class="badge badge-pill badge-danger mb-1">Ditolak
                                                    </div>
                                                    @break
                                                @default
                                                    <div class="badge badge-pill badge-danger mb-1">Tidak
                                                        Diketahui
                                                    </div>
                                            @endswitch
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-info dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{$spkl->id_spkl}}"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu"
                                                     aria-labelledby="dropdownMenuButton-{{$spkl->id_spkl}}">
                                                    <a class="dropdown-item"
                                                       href="{{ route('print-spkl', ['id_spkl' => $spkl->spkl_number])}}">
                                                        <i class="fas fa-print"></i> Print
                                                    </a>
                                                    <a class="dropdown-item"
                                                       href="{{ route('view-spkl-admin', ['id' => $spkl->spkl_number]) }}">
                                                        <i class="fas fa-book"></i> Detail
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            {{ $spkls->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- modal untuk input data spkl --}}

{{--<div id="buatSPKLModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buatSPKLModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <form action="{{ route('pengajuan-spkl-post') }}" enctype="multipart/form-data" method="POST">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title">Modal title</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}

{{--                    <div class="form-row">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputState">Nama PT</label>--}}
{{--                            <select id="inputState" class="form-control" name="pt_id">--}}
{{--                                @foreach($pts as $pt)--}}
{{--                                    <option value="{{$pt->id_pt}}">{{$pt->pt_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputState">Nama Proyek</label>--}}
{{--                            <select id="inputState" class="form-control" name="proyek_id">--}}
{{--                                @foreach($proyeks as $proyek)--}}
{{--                                    <option value="{{$proyek->id_proyek}}">{{$proyek->proyek_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="tanggal">Tanggal:</label>--}}
{{--                            <input type="date" class="form-control" id="tanggal" name="tanggal">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputCity">Rencana</label>--}}
{{--                            <input type="text" class="form-control" id="inputRencana" name="rencana">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleFormControlTextarea1">Uraian Target Lembur</label>--}}
{{--                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"--}}
{{--                                  name="uraian_pekerjaan"></textarea>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleFormControlTextarea1">Progres</label>--}}
{{--                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"--}}
{{--                                  name="progres"></textarea>--}}
{{--                    </div>--}}
{{--                    <section class="ftco-section ftco-no-pt ftco-no-pb">--}}
{{--                        <div class="container">--}}
{{--                            <div class="text-start">--}}
{{--                                <p>Karyawan</p>--}}
{{--                            </div>--}}
{{--                            <div class="row justify-content-center">--}}
{{--                                <div--}}
{{--                                    class="col-lg-4 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">--}}
{{--                                    <select class="js-select2" multiple="multiple" name="user_id[]">--}}
{{--                                        @foreach($users as $user)--}}
{{--                                            <option value="{{$user->id_user}}"--}}
{{--                                                    data-badge="">{{$user->user_fullname}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </section>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>--}}
{{--                    <button type="submit" class="btn btn-primary">Simpan</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}

{{--modal untuk edit spkl--}}

{{--<div id="buatSPKLModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSPKLModalLabel"--}}
{{--     aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <form action="{{ route('pengajuan-spkl-post') }}" enctype="multipart/form-data" method="POST">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title">Modal title</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}

{{--                    <div class="form-row">--}}
{{--                        @csrf--}}
{{--                        @method('PUT')--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputState">Nama PT</label>--}}
{{--                            <select id="inputState" class="form-control" name="pt_id">--}}
{{--                                @foreach($pts as $pt)--}}
{{--                                    <option value="{{$pt->id_pt}}">{{$pt->pt_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputState">Nama Proyek</label>--}}
{{--                            <select id="inputState" class="form-control" name="proyek_id">--}}
{{--                                @foreach($proyeks as $proyek)--}}
{{--                                    <option value="{{$proyek->id_proyek}}">{{$proyek->proyek_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputState">Departemen</label>--}}
{{--                            <select id="inputState" class="form-control" name="departemen_id">--}}
{{--                                @foreach($departemens as $departemen)--}}
{{--                                    <option--}}
{{--                                        value="{{$departemen->id_departemen}}">{{$departemen->departemen_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputState">Bengkel</label>--}}
{{--                            <select id="inputState" class="form-control" name="bengkel_id">--}}
{{--                                @foreach($bengkels as $bengkel)--}}
{{--                                    <option value="{{$bengkel->id_bengkel}}">{{$bengkel->bengkel_name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="tanggal">Tanggal:</label>--}}
{{--                            <input type="date" class="form-control" id="tanggal" name="tanggal">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-6">--}}
{{--                            <label for="inputCity">Rencana</label>--}}
{{--                            <input type="text" class="form-control" id="inputRencana" name="rencana">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleFormControlTextarea1">Uraian Target Lembur</label>--}}
{{--                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"--}}
{{--                                  name="uraian_pekerjaan"></textarea>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleFormControlTextarea1">Progres</label>--}}
{{--                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"--}}
{{--                                  name="progres"></textarea>--}}
{{--                    </div>--}}
{{--                    <section class="ftco-section ftco-no-pt ftco-no-pb">--}}
{{--                        <div class="container">--}}
{{--                            <div class="text-start">--}}
{{--                                <p>Karyawan</p>--}}
{{--                            </div>--}}
{{--                            <div class="row justify-content-center">--}}
{{--                                <div--}}
{{--                                    class="col-lg-4 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">--}}
{{--                                    <select class="js-select2" multiple="multiple" name="user_id">--}}
{{--                                        @foreach($users as $user)--}}
{{--                                            <option value="{{$user->id_user}}"--}}
{{--                                                    data-badge="">{{$user->user_fullname}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </section>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>--}}
{{--                    <button type="submit" class="btn btn-primary">Simpan</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}

{{--modal untuk delete spkl--}}
<div class="col-12 col-md-6 col-lg-6">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="spklModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="deleteUserForm" action="{{route('delete-spkl')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="spkl_id" id="spkl_id" value="spkl_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="spklModalLabel">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus spkl ini ini ? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
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

    {{--    script untuk modal buat spkl baru--}}
    <script>
        $(document).ready(function () {
            $('#buatSPKLModalButton').click(function () {
                $('#buatSPKLModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // $(document).on('click', '.editButton', function () {
            //     let userId = $(this).val();
            //     $('#editModal').modal('show');
            //     $.ajax({
            //         type: "GET",
            //         url: "/admin/change-role/edit/" + userId,
            //         success: function (response) {
            //             $('#id_user').val(response.id_user);
            //             $('#role_id').val(response.role_id);
            //             $('#pt_id').val(response.pt_id);
            //             $('#departemen_id').val(response.departemen_id);
            //             $('#bengkel_id').val(response.bengkel_id);
            //         }
            //     })
            // });

            $(document).on('click', '.deleteButton', function () {

                let spklId = $(this).val();
                $('#deleteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/kabeng/deletespkl/" + spklId,
                    success: function (response) {
                        $('#spkl_id').val(response.id_spkl);
                        // $('#role_id').val(response.role_id);
                    }
                })
            });
        });
    </script>

    {{-- <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script> --}}
    {{-- (function ($) {

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

        function iformat(icon, badge,) {
            var originalOption = icon.element;
            var originalOptionBadge = $(originalOption).data('badge');

            return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text +
                '<span class="badge">' + originalOptionBadge + '</span></span>');
        }

    })(jQuery);
</script> --}}
@endpush
