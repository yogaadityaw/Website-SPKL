@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary bg color">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form method="post" action="/register">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="username" class="form-control" name="username">
                    <div class="invalid-feedback">
                    </div>
                </div>


                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input id="nip" type="nip" class="form-control" name="nip">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label for="fullname">Fullname</label>
                    <input id="fullname" type="fullname" class="form-control" name="fullname">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input id="telephone" type="telephone" class="form-control" name="telephone">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label for="age">Umur</label>
                    <input id="age" type="age" class="form-control" name="age">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="d-block">Password</label>
                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                           name="password">
                    <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
