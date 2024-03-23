@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/css/tabel-spkl.css') }}"> --}}
@endpush


@include('components.sidebar')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat SPKL Baru</h1>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Buat SPKL Baru</h4>

                        </div>
                        {{-- <div class="card-body">

                            <img src="data:image/png;base64,{logo_base64}" style="float:left; display:relative; width: 15%">
                            <img src="data:image/png;base64,{qr_base64}" style="float:right; display:relative; width: 12%">
                            <pre>&nbsp;</pre>
                            <pre>&nbsp;</pre>
                            <pre style="text-align:center; font-size:24; font-weight:bold;">INVOICE</pre>
                            <pre style="text-align:center;">MPM Distributor</pre>
                            <pre style="text-align:center;">Jl. Raya Sedati No.101, Blinjo, Wedi, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur</pre>

                            <hr>
                            <pre>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</pre>
                            <table border="0"
                                style="height: 72px; width: 100%; border-collapse: collapse; border-style: hidden;">
                                <tbody class="alignMe">
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>PKP</b>{json_data[0]['XTSNPWP']}</pre>
                                        </td>

                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>Jam Terbit</b>{current_time}</pre>
                                        </td>

                                    </tr>
                                    <tr style="height: 18px; align-text:center;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>No Packing</b>{json_data[0]['XTSPACKINGSLIPID']}</pre>
                                        </td>

                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>NPWP</b>{json_data[0]['XTSNPWP']}</pre>
                                        </td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>Kode Dealer</b>{json_data[0]['INVOICEACCOUNT']}</pre>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>

                            <table border="0"
                                style="height: 72px; width: 100%; border-collapse: collapse; border-style: hidden;"
                                class="aligned">
                                <tbody class="alignMe">
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre></pre>
                                        </td>
                                        <td style="width: 25.8157%; height: 18px;">
                                            <pre>Kepada:</pre>
                                        </td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>NOMOR</b>{json_data[0]['TRANSTYPE']} &ndash; {invoice_id}</pre>
                                        </td>
                                        <td style="width: 25.8157%; height: 18px;">
                                            <pre>{json_data[0]['NAME']}</pre>
                                        </td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>Tanggal</b>{datetime.strptime(json_data[0]['XTSTRANSDATE'][:10], "%Y-%m-%d").strftime("%d-%m-%Y")}</pre>
                                        </td>
                                        <td style="width: 25.8157%; height: 18px;">
                                            <pre>{kotaspl[0]}</pre>
                                        </td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>KD BAYAR-NO PKB</b>{json_data[0]['PAYMENT']} &ndash; {json_data[0]['PAYMENTNAME']}</pre>
                                        </td>
                                        <td style="width: 25.8157%; height: 18px;">
                                            <pre>{kotaspl[1]}</pre>
                                        </td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; height: 18px;">
                                            <pre><b>JATUH TEMPO</b>{datetime.strptime(json_data[0]['DUEDATE'][:10], "%Y-%m-%d").strftime("%d-%m-%Y")}</pre>
                                        </td>
                                        <td style="width: 25.8157%; height: 18px;">
                                            <pre><b>NPWP</b>530996289611000</pre>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>
                                """

                                total=0
                                html+=f"""
                            <table class="tablemain"
                                style="width: 100%; border-collapse: collapse; border: 1px solid #b4b4b4;">
                                <colgroup>
                                    <col style="width:5%;">
                                    <col style="width:13.5%;">
                                    <col style="width:21%;">
                                    <col style="width:5.5%;">
                                    <col style="width:14%;">
                                    <col style="width:15.5%;">
                                    <col style="width:15.5%;">
                                    <col style="width:10%;">
                                </colgroup>
                                <tbody style="height: 10px">
                                    <tr>
                                        <td style="padding:5px">
                                            <pre>NO</pre>
                                        </td>
                                        <td style="padding:5px">
                                            <pre>ITEM</pre>
                                        </td>
                                        <td style="padding:5px">
                                            <pre>NAMA ITEM</pre>
                                        </td>
                                        <td style="padding:5px">
                                            <pre>QTY</pre>
                                        </td>
                                        <td style="padding:5px">
                                            <pre>HARGA SATUAN</pre>
                                        </td>
                                        <td style="padding:5px">
                                            <pre>DISCOUNT PERCENT</pre>
                                        </td>
                                        <td style="padding:5px">
                                            <pre>DISCOUNT AMOUNT</pre>
                                        </td>
                                        <td style="border: 1px solid #b4b4b4; text-align: center;">
                                            <pre>JUMLAH</pre>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="tablemain"
                                style="width: 100%; border-collapse: collapse; border: 1px solid #b4b4b4;">
                                <colgroup>
                                    <col style="width:5%;">
                                    <col style="width:13.5%;">
                                    <col style="width:21%;">
                                    <col style="width:5.5%;">
                                    <col style="width:14%;">
                                    <col style="width:15.5%;">
                                    <col style="width:15.5%;">
                                    <col style="width:10%;">
                                </colgroup>
                                <tbody>
                                    """
                                    for i,entry in enumerate(json_data):
                                    print(entry['XTSTRANSDATE'][:10])


                                    total+=entry['LINEAMOUNT'] + entry['LINEAMOUNTTAX']
                                    html+=f"""
                                    <tr style="padding-left: 10px">
                                        <td style="padding:5px; border: 1px solid #b4b4b4;">
                                            <pre>{i+1}</pre>
                                        </td>
                                        <td style="padding:5px;">
                                            <pre>{entry['ITEMID']}</pre>
                                        </td>
                                        <td style="padding:5px;">
                                            <pre>{entry['ITEMNAME']}</pre>
                                        </td>
                                        <td style="padding:5px;">
                                            <pre>{int(entry['QTY'])}</pre>
                                        </td>
                                        <td style="padding:5px;">
                                            <pre>{f"{int(entry['SALESPRICE']):,}"}</pre>
                                        </td>
                                        <td style="padding:5px;">
                                            <pre>{f"{entry['DISCPERCENT']:.2f}"}</pre>
                                        </td>
                                        <td style="padding:5px;">
                                            <pre>{int(entry['DISCAMOUNT'])}</pre>
                                        </td>
                                        <td style="border-left: 1px solid #b4b4b4; text-align: right; padding:5px;">
                                            <pre>{f"{int(entry['LINEAMOUNT'] + entry['LINEAMOUNTTAX']):,}"}</pre>
                                        </td>
                                    </tr>"""

                                    html+=f"""
                                </tbody>
                            </table>
                            <table style=" width: 100%; border-collapse: collapse; border: 1px solid #b4b4b4;"
                                class="aligned">
                                <tbody>
                                    <tr style="height: 35px;">
                                        <td style="height: 35px; padding:5px">
                                            <pre>{entry['XTSNOTE']}</pre>
                                        </td>
                                        <td
                                            style="width: 15.5%; height: 35px; border-left: 1px solid #b4b4b4; text-align: right;">
                                        </td>
                                        <td
                                            style="width: 10%; height: 35px; border-left: 1px solid #b4b4b4; text-align: right;">
                                            <p></p>
                                        </td>
                                    </tr>
                                    <tr style="height: 35px;">
                                        <td style="height: 35px;  padding:5px">
                                            <pre>{entry['ALAMATKIRIM']}</pre>
                                        </td>
                                        <td
                                            style="width: 15.5%; height: 35px; border-left: 1px solid #b4b4b4; text-align: left; padding:5px;">
                                            <pre>Jumlah</pre>
                                        </td>
                                        <td
                                            style="width: 10%; height: 35px; border-left: 1px solid #b4b4b4; text-align: right; padding:5px;">
                                            <pre>{f"{int(total):,}"}</pre>
                                        </td>
                                    </tr>
                                    <tr style="height: 10px;">
                                        <td style="height: 10px;  padding:5px">
                                            <pre>Terbilang:</pre>
                                        </td>
                                        <td
                                            style="width: 15.5%; height: 35px; border-left: 1px solid #b4b4b4; text-align: left; padding:5px;">
                                            <pre>Disc</pre>
                                        </td>
                                        <td
                                            style="width: 10%; height: 10px; border-left: 1px solid #b4b4b4; text-align: right; padding:5px;">
                                            <pre>{int(entry['MARKUP']):,}</pre>
                                        </td>
                                    </tr>
                                    <tr style="height: 10px;">
                                        <td style="height: 10px; padding:5px">
                                            <pre>{entry['terbilang']}</pre>
                                        </td>
                                        <td
                                            style="width: 15.5%; height: 35px; border-left: 1px solid #b4b4b4; text-align: left;  padding:5px;">
                                            <pre>Total</pre>
                                        </td>
                                        <td
                                            style="width: 10%; height: 10px; border-left: 1px solid #b4b4b4; text-align: right; padding:5px;">
                                            <pre>{f"{int(entry['INVOICEAMOUNT']):,}"}</pre>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table style="width: 100%; margin-top:30px; border-collapse:collapse;">
                                <tr">
                                    <td style="width: 50%;border: 1px solid #b4b4b4; text-align:center;">
                                        <pre><b>Nomor Rekening
                                    PT. MITRA PINASTHIKA MULIA
                                    BCA VETERAN SURABAYA
                                    0107407000</b></pre>
                                    </td>

                                    <td style="width: 50%;border: 1px solid #b4b4b4; text-align:justify; padding:5px;">
                                        <pre>Dokumen ini diterbitkan melalui sistem 
                                            komputerisasi sehingga tidak memerlukan 
                                            tanda tangan secara fisik oleh pejabat 
                                            PT. MPM Distributor

                                                Kharisma
                                                Bagian A/R</pre>
                                        <pre style="text-align: right; padding: 5px">{now.strftime("%d-%m-%Y %H:%M:%S")}</pre>
                                    </td>
                                    </tr>
                            </table>
                            
                        </div> --}}
                        <div class="card-body">

                            <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>SURAT  PERINTAH  KERJA  LEMBUR  (  SPKL  )</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>LABOUR SUPPLY DIVISI HARKAN</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>NAMA PT</td>
                                        <td>: PT. ALREDHO TEKNIK</td>
                                        <td></td>
                                        <td></td>
                                        <td>DEPT  </td>
                                        <td>:</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>N O M O R</td>
                                        <td>:            /  RB02 / XI  /  2023</td>
                                        <td></td>
                                        <td></td>
                                        <td>BENGKEL</td>
                                        <td>:</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>TANGGAL</td>
                                        <td>:</td>
                                        <td></td>
                                        <td></td>
                                        <td>Hari  </td>
                                        <td>:</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>No</td>
                                        <td>Nama</td>
                                        <td>Rencana</td>
                                        <td>Pelaksanaan</td>
                                        <td>Jam</td>
                                        <td>Uraian  Target  Lembur</td>
                                        <td></td>
                                        <td>Proyek</td>
                                        <td>Progress</td>
                                        <td>Paraf</td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
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
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Distribusi  :</td>
                                        <td></td>
                                        <td>KEMANPROAN</td>
                                        <td></td>
                                        <td></td>
                                        <td>KEPALA DEPARTEMEN</td>
                                        <td></td>
                                        <td>KEPALA BENGKEL</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>01.  Kadep   Rendalhar</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>02.  KAM</td>
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
                                    <tr>
                                        <td>03.  PT</td>
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
                                    <tr>
                                        <td>04.  Arsip</td>
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
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>______________</td>
                                        <td></td>
                                        <td></td>
                                        <td>______________</td>
                                        <td></td>
                                        <td>______________</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>

                            {{-- <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col"><img src="logo-pal.png" alt="" width="50" height="50"></th>
                                        <th scope="col">SURAT PERINTAH KERJA LEMBUR (SPKL)</th>
                                        <nav>LABOUR SUPPLY DIVISI HARKAN </nav>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        
                                        
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        

                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        
                                    </tr>
                                </tbody>
                            </table> --}}
                        </div>

                    </div>
                </div>

            </div>



        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
