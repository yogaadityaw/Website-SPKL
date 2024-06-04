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
                <h1>Proyek list</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div style="width:100%" class="card">
                        <div class="card-body">
                            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                                <button data-toggle="modal" data-target="#buatProyekModal" type="button"
                                        class="btn btn-primary mr-2">+ Tambah Proyek
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
                                        <th scope="col">Nama Proyek</th>
                                        <th scope="col">Penanggung Jawab</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                    <tbody>
                                    @foreach ($proyeks as $proyek)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $proyek->proyek_name }}</td>
                                            <td> {{ $proyek->user->user_fullname }} </td>
                                            <td>
                                                <button type="button" value="{{ $proyek->id_proyek }}" class="btn btn-warning editButton fas fa-pencil"
                                                        data-target="#updateSPKLModal" data-toggle="modal">
                                                </button>
                                                <button type="button" class="btn btn-danger deleteButton fas fa-trash"
                                                        value="{{ $proyek->id_proyek }}" data-toggle="modal"
                                                        data-target="#deleteModal">
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

<div id="buatProyekModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSPKLModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('proyek-baru-post') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Proyek Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="inputCity">Tambah Proyek Baru</label>
                            <input type="text" class="form-control" id="inputProyek" name="proyek">
                        </div>

                        <div class="form-group col-md-12">
                            <label>Kepala Manajer Proyek</label>
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

<div id="editProyekModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProyekModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('proyek-update') }}" method="post">
                @csrf
                @method('PUT') <!-- karena Anda melakukan update, Anda mungkin perlu menggunakan method PUT pada form -->

                <div class="modal-header">
                    <h5 class="modal-title">Edit Proyek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="proyek_id" id="edit_proyek_id"> <!-- ini untuk menyimpan ID proyek yang akan diubah -->

                    <div class="form-group">
                        <label for="editProyekName">Nama Proyek</label>
                        <input type="text" class="form-control" id="editProyekName" name="proyek_name">
                    </div>

                    <div class="form-group">
                        <label>Kepala Manajer Proyek</label>
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
                <form id="deleteUserForm" action="{{route('proyek-delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="proyek_id" id="delete_proyek_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Hapus Proyek</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus proyek ini ? </p>
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
            $('#tambahProyekModalButton').click(function () {
                $('#buatProyekModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).on('click', '.editButton', function () {
            let proyekId = $(this).val();
            $('#editProyekModal').modal('show');

            // Mengambil data proyek yang akan diedit melalui AJAX
            $.ajax({
                type: "GET",
                url: "/admin/proyek-list/edit/" + proyekId,
                success: function (response) {
                    // Mengisikan nilai data proyek ke dalam form edit
                    $('#edit_proyek_id').val(response.id_proyek);
                    $('#editProyekName').val(response.proyek_name);
                    $('#editProyekRole').val(response.id_role);
                }
            })
        });

        $(document).on('click', '.deleteButton', function () {
            let proyekId = $(this).val();
            $('#deleteModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/admin/proyek-list/edit/" + proyekId,
                success: function (response) {
                    $('#delete_proyek_id').val(response.id_proyek);
                }
            })
        });

    </script>
@endpush
