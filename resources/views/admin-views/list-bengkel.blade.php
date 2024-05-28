@extends('layouts.app')

@section('title', 'User Dashboard')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@include('components.sidebar')


@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center margin: 0 auto">
                <h1>Bengkel list</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div style="width:100%" class="card">
                        <div class="card-body">
                            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                                <button data-toggle="modal" data-target="#buatBengkelModal" type="button"
                                    class="btn btn-primary mr-2">
                                    + Tambah Bengkel Baru
                                </button>
                            </nav>
                            <div class="table-responsive">
                                <table class="table-bordered table">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Departemen</th>
                                        <th scope="col">Nama Bengkel</th>
                                        <th scope="col">Kepala Bengkel</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                    <tbody>
                                    @foreach ($bengkels as $bengkel)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bengkel->departemen->departemen_name }}</td>
                                            <td>{{ $bengkel->bengkel_name }}</td>
                                            <td> {{ $bengkel->user->user_fullname }} </td>
                                            <td>
                                                <button type="button" value="{{ $bengkel->id_bengkel }}" class="btn btn-warning editButton"
                                                        data-target="#editBengkelModal" data-toggle="modal">Edit</button>
                                                <button type="button" class="btn btn-danger deleteButton"
                                                        value="{{ $bengkel->id_bengkel }}" data-toggle="modal"
                                                        data-target="#deleteModal">Hapus
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
        </section>
    </div>

@endsection
{{--modal untuk tambah proyek--}}

<div id="buatBengkelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSPKLModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('bengkel-baru-post') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bengkel Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label>Departemen</label>
                            <select class="form-control selectric" name="departemen_id">
                                @foreach ($departemens as $departemen)
                                    <option value="{{ $departemen->id_departemen }}">{{ $departemen->departemen_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputCity">Tambah Bengkel Baru</label>
                            <input type="text" class="form-control" id="inputBengkel" name="bengkel">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Kepala Bengkel</label>
                            <select class="form-control selectric" name="id_role">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id_user }}">{{ $user->user_fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal for Editing Project -->
<div id="editBengkelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProyekModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('bengkel-update') }}" method="post">
                @csrf
                @method('PUT') <!-- karena Anda melakukan update, Anda mungkin perlu menggunakan method PUT pada form -->

                <div class="modal-header">
                    <h5 class="modal-title">Edit Bengkel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="bengkel_id" id="edit_bengkel_id"> <!-- ini untuk menyimpan ID proyek yang akan diubah -->

                    <div class="form-group">
                        <label>Departemen</label>
                        <select class="form-control selectric" name="departemen_id">
                            @foreach ($departemens as $departemen)
                                <option value="{{ $departemen->id_departemen }}">{{ $departemen->departemen_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editBengkelName">Nama Bengkel</label>
                        <input type="text" class="form-control" id="editBengkelName" name="bengkel_name">
                    </div>

                    <div class="form-group">
                        <label>Kepala Bengkel</label>
                        <select class="form-control selectric" name="id_role">
                            @foreach ($users as $user)
                                <option value="{{ $user->id_user }}">{{ $user->user_fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- delete modal proyek--}}

<div class="col-12 col-md-6 col-lg-6">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="deleteUserForm" action="{{route('bengkel-delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="bengkel_id" id="delete_bengkel_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Hapus Bengkel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data bengkel ini ? </p>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
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
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#tambahBengkelModalButton').click(function () {
                $('#buatBengkelModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).on('click', '.editButton', function () {
            let bengkelId = $(this).val();
            $('#editBengkelModal').modal('show');

            // Mengambil data proyek yang akan diedit melalui AJAX
            $.ajax({
                type: "GET",
                url: "/admin/bengkel-list/edit/" + bengkelId,
                success: function (response) {
                    // Mengisikan nilai data proyek ke dalam form edit
                    $('#edit_bengkel_id').val(response.id_bengkel);
                    $('#editBengkelName').val(response.bengkel_name);
                    $('#editBengkelRole').val(response.id_role);
                }
            })
        });

        $(document).on('click', '.deleteButton', function () {
            let bengkelId = $(this).val();
            $('#deleteModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/admin/bengkel-list/edit/" + bengkelId,
                success: function (response) {
                    $('#delete_bengkel_id').val(response.id_bengkel);
                }
            })
        });

    </script>
@endpush
