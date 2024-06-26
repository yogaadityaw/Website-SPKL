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
                <h1>PT list</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div style="width:100%" class="card">
                        <div class="card-body">
                            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                                <button data-toggle="modal" data-target="#buatPtModal" type="button"
                                    class="btn btn-primary mr-2">+ Tambah PT
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
                                        <th scope="col">Nama PT</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                    <tbody>
                                        @foreach ($pts as $index=>$pt)
                                            <tr>
                                                <td>{{ $index+$pts->firstItem() }}</td>
                                                <td>{{ $pt->pt_name }}</td>
                                                <td>
                                                    <button type="button" value="{{ $pt->id_pt }}"
                                                        class="btn btn-warning editButton fas fa-pencil" data-target="#editPtModal"
                                                        data-toggle="modal">
                                                    </button>
                                                    <button type="button" class="btn btn-danger deleteButton fas fa-trash"
                                                        value="{{ $pt->id_pt }}" data-toggle="modal"
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
                                {{ $pts->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
{{-- modal untuk tambah proyek --}}

<div id="buatPtModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSPKLModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('pt-baru-post') }}" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah PT Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="inputCity">Tambah PT Baru</label>
                            <input type="text" class="form-control" id="inputPt" name="pt">
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

<div id="editPtModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProyekModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('pt-update') }}" method="post">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Proyek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pt_id" id="edit_pt_id">

                    <div class="form-group">
                        <label for="editPtName">Nama Proyek</label>
                        <input type="text" class="form-control" id="editPtName" name="pt_name">
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

<div class="col-12 col-md-6 col-lg-6">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="deleteUserForm" action="{{ route('pt-delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="pt_id" id="delete_pt_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Hapus PT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus PT ini ? </p>
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
            $('#tambahPtModalButton').click(function() {
                $('#buatPtModal').modal('show');
            });
        });
    </script>

    <script>
        $(document).on('click', '.editButton', function() {
            let ptId = $(this).val();
            $('#editPtModal').modal('show');

            $.ajax({
                type: "GET",
                url: "/admin/pt-list/edit/" + ptId,
                success: function(response) {
                    $('#edit_pt_id').val(response.id_pt);
                    $('#editPtName').val(response.pt_name);
                }
            })
        });


        $(document).on('click', '.deleteButton', function() {
            let ptId = $(this).val();
            $('#deleteModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/admin/pt-list/edit/" + ptId,
                success: function(response) {
                    $('#delete_pt_id').val(response.id_pt);
                }
            })
        });
    </script>
@endpush
