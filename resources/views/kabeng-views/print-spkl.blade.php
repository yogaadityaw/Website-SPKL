<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
</head>
<body>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tampilan SPKL</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Tampilan SPKL</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('img/logo-pal-spkl.png') }}" height="72">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">Surat Perintah Kerja Lembur</div>
                                            <div class="d-flex justify-content-center">Labour Supply Divisi Harkan</div>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>Nama PT: </td>
                                                    <td>PT. ALREDHO</td>
                                                    <td>Dept:</td>
                                                    <td>Prod Prod</td>
                                                </tr>
                                                <tr>
                                                    <td>NOMOR: </td>
                                                    <td>PT. ALREDHO</td>
                                                    <td>BENGKEL:</td>
                                                    <td>Prod Prod</td>
                                                </tr>
                                                <tr>
                                                    <td>TANGGAL: </td>
                                                    <td>PT. ALREDHO</td>
                                                    <td>HARI:</td>
                                                    <td>Prod Prod</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>
                                                    No
                                                </td>
                                                <td>
                                                    Nama
                                                </td>
                                                <td>
                                                    Rencana
                                                </td>
                                                <td>
                                                    Pelaksaan
                                                </td>
                                                <td>
                                                    Jam
                                                </td>
                                                <td>
                                                    Uraian Target Lembur
                                                </td>
                                                <td>
                                                    Proyek
                                                </td>
                                                <td>
                                                    Progress
                                                </td>
                                                <td>
                                                    Paraf
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="d-flex justify-content-start">Distribusi:</div>
                                                    <div class="d-flex justify-content-start">1. Kadep Rendalhar</div>
                                                    <div class="d-flex justify-content-start">2. KAM</div>
                                                    <div class="d-flex justify-content-start">3. PT</div>
                                                    <div class="d-flex justify-content-start">3. Arsip</div>
                                                </td>
                                                <td colspan="3">
                                                    <div class="d-flex flex-column align-items-center">KEMENPROAN
                                                        <img class="mt-2" src="{{ asset('img/qr-example.png') }}" height="150"
                                                            width="150">
                                                    </div>
                                                </td>
                                                <td colspan="1">
                                                    <div class="d-flex flex-column align-items-center">
                                                        KEPALA DEPARTEMEN
                                                        <img class="mt-2" src="{{ asset('img/qr-example.png') }}" height="150"
                                                            width="150">
                                                    </div>
                                                </td>
                                                <td colspan="3">
                                                    <div class="d-flex flex-column align-items-center">
                                                        KEPALA BENGKEL
                                                        <img class="mt-2" src="{{ asset('img/qr-example.png') }}" height="150"
                                                            width="150">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


</body>
</html>