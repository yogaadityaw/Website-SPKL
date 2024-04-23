<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <title>Test View</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 1);
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-12">
        <div class="px-2 py-5">
            <div class="row justify-content-between">
                <div class="col">
                    <img src="{{ asset('img/bumn-pal-r1.png') }}" width="120%" alt="">
                </div>
                <div class="col">
                    <div class="row justify-content-end">
                        <div class="col-auto">
                            <p>No. SPKL</p>
                            <p>Tanggal</p>
                            <p>Status</p>
                        </div>
                        <div class="col-auto">
                            <p>PAL123456789</p>
                            <p>20 April 2024</p>
                            <p class="text-primary font-weight-bold">Disetujui</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <h3>Surat Perintah Kerja Lembur</h3>
                <div class="d-flex mt-4">
                    <div class="col-auto">
                        <h3>Nama PT</h3>
                        <p>PT. ALREDHO TEKNIK</p>
                    </div>
                    <div class="col-auto">
                        <h3>Bengkel</h3>
                        <p>Bengkel A</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-auto">
                        <h3>Proyek</h3>
                        <p>Perbaikan Awak Kapal</p>
                    </div>
                    <div class="col-auto">
                        <h3>Tanggal</h3>
                        <p>20/04/2024</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-auto">
                        <h3>No.Pengajuan</h3>
                        <p>PAL123456789</p>
                    </div>
                    <div class="col-auto">
                        <h3>Jam Mulai Lembur</h3>
                        <p>17.00</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="col-auto">
                        <h3>Departemen</h3>
                        <p>Departemen Sistem</p>
                    </div>
                    <div class="col-auto">
                        <h3>Jam Akhir Lembur</h3>
                        <p>19.00</p>
                    </div>
                </div>
                <div class="content-item mt-4">
                    <h3>Uraian Target Lembur</h3>
                    <p>Meningkatkan efisiensi perbaikan sistem radar kapal dengan mengurangi waktu penyelesaian sebesar
                        20% dalam dua bulan</p>
                </div>
                <div class="content-item mt-4">
                    <h3>Progress</h3>
                    <p>Kami telah mencapai 50% dari target pengujian dan menemukan beberapa potensi perbaikan yang dapat
                        meningkatkan kinerja sistem secara keseluruhan.</p>
                </div>
                <div class="content-item mt-4">
                    <h3>Rencana</h3>
                    <p>Pengembangan sistem deteksi awal untuk kapal perang baru dengan fokus pada integrasi sensor baru
                        dan pengujian kemampuan anti-serangan rudal</p>
                </div>
                <h3>Bukti Persetujuan</h3>
                <hr>
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <h4>Kepala Biro</h4>
                        <p>Ahmad Santoso, S.T</p>
                        <img src="{{ asset('img/qr-example.png') }}" width="100px" alt="">
                    </div>
                    <div class="col-auto">
                        <h4>Kepala Departemen</h4>
                        <p>Rizki Pratama, S.T</p>
                        <img src="{{ asset('img/qr-example.png') }}" width="100px" alt="">
                    </div>
                    <div class="col-auto">
                        <h4>Kepala Manajemen</h4>
                        <p>Indra Wijaya, S.T</p>
                        <img src="{{ asset('img/qr-example.png') }}" width="100px" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
