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
                <h1>Departemen list</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div style="width:100%" class="card">
                        <div class="card-body">
                            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                                <button data-toggle="modal" data-target="#buatDepartemenModal" type="button"
                                        class="btn btn-primary mr-2">+ Tambah Departemen Baru
                                </button>
                            </nav>
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
                            <div class="table-responsive">
                                <table class="table-bordered table">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Departemen</th>
                                        <th scope="col">Kepala Departemen</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                    <tbody>
                                    @foreach ($departemens as $index => $departemen)
                                        <tr>
                                            <td>{{ $index + $departemens->firstItem()  }}</td>
                                            <td>{{ $departemen->departemen_name }}</td>
                                            <td> {{ $departemen->user->user_fullname }} </td>
                                            <td>
                                                <button type="button" value="{{ $departemen->id_departemen }}" class="btn btn-warning editButton fas fa-pencil"
                                                        data-target="#editBengkelModal" data-toggle="modal">
                                                </button>
                                                <button type="button" class="btn btn-danger deleteButton fas fa-trash"
                                                        value="{{ $departemen->id_departemen }}" data-toggle="modal"
                                                        data-target="#deleteModal">
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                {{ $departemens->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
{{--modal untuk tambah proyek--}}

<div id="buatDepartemenModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSPKLModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('departemen-baru-post') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Departemen Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="inputCity">Tambah Departemen Baru</label>
                            <input type="text" class="form-control" id="inputDepartemen" name="departemen">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Kepala Departemen</label>
                            <select class="form-control selectric" name="id_role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id_user }}">{{ $role->user_fullname }}</option>
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
            <form action="{{ route('departemen-update') }}" method="post">
                @csrf
                @method('PUT') <!-- karena Anda melakukan update, Anda mungkin perlu menggunakan method PUT pada form -->

                <div class="modal-header">
                    <h5 class="modal-title">Edit Departemen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="departemen_id" id="edit_departemen_id"> <!-- ini untuk menyimpan ID proyek yang akan diubah -->

                    <div class="form-group">
                        <label for="editDepartemenName">Nama Departemen</label>
                        <input type="text" class="form-control" id="editDepartemenName" name="departemen_name">
                    </div>

                    <div class="form-group">
                        <label>Kepala Departemen</label>
                        <select class="form-control selectric" name="id_role">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id_user }}">{{ $role->user_fullname }}</option>
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
                <form id="deleteUserForm" action="{{ route('departemen-delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="departemen_id" id="delete_departemen_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Hapus Departemen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus data departemen ini ? </p>
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
            $('#tambahDepartemenModalButton').click(function () {
                $('#buatDepartemenModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).on('click', '.editButton', function () {
            let departemenId = $(this).val();
            $('#editDepartemenModal').modal('show');

            // Mengambil data proyek yang akan diedit melalui AJAX
            $.ajax({
                type: "GET",
                url: "/admin/departemen-list/edit/" + departemenId,
                success: function (response) {
                    // Mengisikan nilai data proyek ke dalam form edit
                    $('#edit_departemen_id').val(response.id_departemen);
                    $('#editDepartemenName').val(response.departemen_name);
                    $('#editDepartemenRole').val(response.id_role);
                }
            })
        });

        $(document).on('click', '.deleteButton', function () {
            let departemenId = $(this).val();
            $('#deleteModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/admin/departemen-list/edit/" + departemenId,
                success: function (response) {
                    $('#delete_departemen_id').val(response.id_departemen);
                }
            })
        });

    </script>
@endpush
