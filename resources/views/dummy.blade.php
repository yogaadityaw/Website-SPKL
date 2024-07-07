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
                                        <td> {{ $spkl->ref_number}} </td>
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



{{--<?php

namespace App\Http\Controllers\PegawaiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Spkl;
use App\Models\UserSpkl;
use App\Models\QRCode;

class DashboardPegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard-pegawai');
    }

    public function listSpklPegawai()
    {
        $logged_user = Auth::user();
        $unfinishedSpkls = UserSpkl::where('user_id', $logged_user->id_user)
            ->where('check_out', null)
            ->get();

        $filteredSpkls = [];

        foreach ($unfinishedSpkls as $userSpkl) {
            if ($userSpkl->spkl->is_kabeng_acc && $userSpkl->spkl->is_departemen_acc && $userSpkl->spkl->is_kemenpro_acc) {
                $filteredSpkls[] = $userSpkl;
            }
        }

        $finishedSpkls = UserSpkl::where('user_id', $logged_user->id_user)
            ->where('check_out', '!=', null)
            ->with('spkl')
            ->get();

        if (!$unfinishedSpkls) {
            return view('pegawai-views.surat-pengajuan')->with('error', 'gagal menampilkan data spkl');
        }
        if (!$finishedSpkls) {
            return view('pegawai-views.surat-pengajuan')->with('error', 'gagal menampilkan data spkl');
        }

        return view('pegawai-views.surat-pengajuan', compact('filteredSpkls', 'finishedSpkls'));
    }

    public function absen(Request $request)
    {
        $userSpkl = UserSpkl::findOrFail($request->user_spkl_id);

        if ($userSpkl->check_in && $userSpkl->image) {
            return redirect()->route('list-spkl-pegawai')->with('error', 'Anda sudah absen');
        }

        $base64ImageData = $request->image;
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64ImageData));
        $file_name = time() . '_' . $request->user_name . '.png';
        $filePath = 'public/images/' . $file_name;
        Storage::disk('local')->put($filePath, $decodedImageData);

        $userSpkl->update([
            'lokasi_check_in' => $request->lokasi_check_in,
            'foto_check_in' => $file_name,
            'check_in' => now(),
        ]);

        return redirect()->route('list-spkl-pegawai')->with('success', 'Data proyek baru berhasil ditambahkan');;
    }

    public function checkout(Request $request)
    {
        $userSpkl = UserSpkl::findOrFail($request->user_spkl_id);

        if ($userSpkl->check_out && $userSpkl->image) {
            return redirect()->route('list-spkl-pegawai')->with('error', 'Anda sudah checkout');
        }

        $base64ImageData = $request->image;
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64ImageData));
        $file_name = time() . '_' . $request->user_name . '.png';
        $filePath = 'public/images/' . $file_name;
        Storage::disk('local')->put($filePath, $decodedImageData);

        $userSpkl->update([
            'lokasi_check_out' => $request->lokasi_check_out,
            'foto_check_out' => $file_name,
            'check_out' => now(),
        ]);

        return redirect()->route('list-spkl-pegawai')->with('success', 'Berhasil Checkout');
    }

    public function getDetailSpkl($id)
    {
        $spkls = Spkl::findOrFail($id);
        $qr = QRCode::where('spkl_id', $spkls->id_spkl)->first();

        return view('pegawai-views.detail-spkl-pegawai', compact('spkls', 'qr'));
    }
}
--}}
