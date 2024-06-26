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
                                    <th scope="col">Aksi</th>

                                </tr>
                                <tbody>
                                @foreach ($spkls as $spkl)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> {{ $spkl->spkl_number}} </td>
                                        <td> {{ \App\Helper\DateTimeParser::parse($spkl->tanggal) }} </td>
                                        <td> {{ $spkl->bengkel->departemen->departemen_name}} </td>
                                        <td> {{ $spkl->proyek->proyek_name}} </td>
                                        <td> {{ $spkl->bengkel->bengkel_name}} </td>
                                        <td>


                                            <a href="{{ route('print-spkl', ['id_spkl' => $spkl->id_spkl])}}">
                                                <button type="button" value=''
                                                        class="btn btn-primary fas fa-print"
                                                        data-toggle="modal">
                                                </button>
                                                <a href="{{ route('view-spkl-admin', ['id' => $spkl->id_spkl]) }}">
                                                    <button type="button" value="${{$spkl->id_spkl}}"
                                                            class="btn btn-success fas fa-book"
                                                            data-toggle="modal">
                                                    </button>
                                                </a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link"
                                        href="#"
                                        tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link"
                                        href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link"
                                        href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



<div class="search-element">
    <input class="form-control d flexned" type="search" placeholder="Search" aria-label="Search" data-width="250" >
    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
    <div class="search-backdrop">

    </div>
    <div class="search-result">
    </div>
</div>