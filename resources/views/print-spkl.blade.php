<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print SPKL</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <style>
        .center-card {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .center-table {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-content img {
            margin-right: 20px;
        }

        .header-table {
            flex: 1;
        }

        .qr-code {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 20px;
        }

        .header-title {
            text-align: center;
            margin-bottom: 20px;
        }

        @media print {
            .main-content {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: auto;
                height: auto;
            }

            .center-table {
                width: 100%;
                max-width: 100%;
                margin: 0 auto;
            }

            .card {
                box-shadow: none;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            body, .main-content {
                margin: 0;
                padding: 0;
            }

            body {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<div class="main-content center-card">
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card center-table">
                    <div class="card-header">
                        <h4 class="header-title"></h4>
                    </div>
                    <div class="card-body">
                        <div class="header-content">
                            <img src="{{ asset('img/logo-pal-spkl.png') }}" height="72">
                            <div class="header-table">
                                <div class="text-center">
                                    <h4>
                                        Surat Perintah Kerja Lembur Labour Supply Divisi Harkan
                                    </h4>

                                </div>
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Nama PT:</td>
                                        <td>PT. ALREDHO</td>
                                        <td>Dept:</td>
                                        <td>Prod Prod</td>
                                    </tr>
                                    <tr>
                                        <td>NOMOR:</td>
                                        <td>PT. ALREDHO</td>
                                        <td>BENGKEL:</td>
                                        <td>Prod Prod</td>
                                    </tr>
                                    <tr>
                                        <td>TANGGAL:</td>
                                        <td>PT. ALREDHO</td>
                                        <td>HARI:</td>
                                        <td>Prod Prod</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="qr-code">
                                <img src="{{ asset('img/qr-example.png') }}" height="150" width="150">
                            </div>
                        </div>
                        <table class="table table-bordered mt-4">
                            <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Rencana</td>
                                <td>Pelaksaan</td>
                                <td>Jam</td>
                                <td>Uraian Target Lembur</td>
                                <td>Proyek</td>
                                <td>Progress</td>
                                <td>Paraf</td>
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
                                    <div>Distribusi:</div>
                                    <div>1. Kadep Rendalhar</div>
                                    <div>2. KAM</div>
                                    <div>3. PT</div>
                                    <div>4. Arsip</div>
                                </td>
                                <td colspan="3" class="text-center">
                                    KEMENPROAN
                                    <img src="{{ asset('img/qr-example.png') }}" height="150" width="150">
                                </td>
                                <td colspan="1" class="text-center">
                                    KEPALA DEPARTEMEN
                                    <img src="{{ asset('img/qr-example.png') }}" height="150" width="150">
                                </td>
                                <td colspan="3" class="text-center">
                                    KEPALA BENGKEL
                                    <img src="{{ asset('img/qr-example.png') }}" height="150" width="150">
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
