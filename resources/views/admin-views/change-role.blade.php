@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">

    <style>
        .search-element {
            display: flex;
            align-items: center;
            max-width: 400px;
            margin: 10px 0;
        }

        .search-element .form-control {
            flex: 1;
            padding: 10px;
            font-size: 17px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
        }

        .search-element .btn {
            padding: 10px;
            font-size: 17px;
            border: 1px solid #ccc;
            border-left: none;
            background-color: #ddd;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        .search-element .btn:hover {
            background-color: #ccc;
        }
    </style>

@endpush


@include('components.sidebar')


@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header d-flex justify-content-between align-items-center">
                <h1>Change Role</h1>

                {{-- <div class="search-element">
                    
                    @csrf
                    <form action="{{ route('change-role') }}" method="GET" class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ request('search') }}">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div> --}}
                
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
                                        <th scope="col">Aksi</th>
                                    </tr>
                                    <tbody>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index+$users->firstItem() }}</td>
                                                <td>{{ $user->user_nip }}</td>
                                                <td>{{ $user->user_fullname }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->user_telephone }}</td>
                                                <td>{{ $user->user_age }}</td>
                                                <td>{{ $user->role->role_name }}</td>
                                                <td>
                                                    {{ $user->pt->pt_name ?? ' '}}
                                                </td>
                                                <td>
                                                    {{ $user->bengkel->departemen->departemen_name ?? ' ' }}
                                                </td>
                                                <td>
                                                    {{ $user->bengkel ? $user->bengkel->bengkel_name : ' ' }}
                                                </td>
                                                <td>
                                                    <button type="button" value="{{ $user->id_user }}"
                                                        class="btn btn-warning editButton fas fa-pencil" data-toggle="modal">
                                                    </button>
                                                    <button type="button" class="btn btn-danger deleteButton fas fa-trash"
                                                        value="{{ $user->id_user }}" data-toggle="modal">
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                {{ $users->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<div class="col-12 col-md-6 col-lg-6">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="updateUserForm" action="{{ route('users-update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_user" id="id_user" value="id_user">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Update User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Jabatan</label>
                                <select class="form-control selectric" name="id_role">
                                    <option value="" selected disabled>Pilih Jabatan</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id_role }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>PT</label>
                                <select class="form-control selectric" name="id_pt">
                                    <option value="" selected disabled>Pilih PT</option>
                                    @foreach ($pts as $pt)
                                        <option value="{{ $pt->id_pt }}">{{ $pt->pt_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label>Bengkel</label>
                                        <select class="form-control selectric" name="id_bengkel">
                                            <option value="" selected disabled>Pilih Bengkel</option>
                                            @foreach ($bengkels as $bengkel)
                                                <option value="{{ $bengkel->id_bengkel }}">
                                                    {{ $bengkel->bengkel_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>           
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-6 col-lg-6">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="deleteUserForm" action="{{ route('users-delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="user_id" id="user_id" value="user_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Hapus User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus user ini ? </p>
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
        $(document).ready(function() {
            $(document).on('click', '.editButton', function() {
                let userId = $(this).val();
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/admin/change-role/edit/" + userId,
                    success: function(response) {
                        $('#id_user').val(response.id_user);
                        $('#role_id').val(response.role_id);
                        $('#pt_id').val(response.pt_id);
                        $('#bengkel_id').val(response.bengkel_id);
                    }
                })
            });

            $(document).on('click', '.deleteButton', function() {
                let userId = $(this).val();
                $('#deleteModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/admin/change-role/edit/" + userId,
                    success: function(response) {
                        $('#user_id').val(response.id_user);
                        $('#role_id').val(response.role_id);
                    }
                })
            });
        });
    </script>
@endpush
