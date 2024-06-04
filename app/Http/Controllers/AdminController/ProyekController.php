<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Proyek;
use App\Models\Pt;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProyekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $proyeks = Proyek::orderBy('id_proyek', 'desc')->get();
        $roles = User::where('role_id',4)->get();
        return view('admin-views.list-proyek', compact('proyeks','roles'));
    }

    public function getProyekData($id_proyek)
    {

        $proyek = Proyek::findOrFail($id_proyek);
        return response()->json($proyek);
    }

    public function TambahProyek(Request $request)
    {
        try {
            $proyek = Proyek::create([

                'proyek_name' => $request->input('proyek'),
                'pj_proyek' => $request->input('id_role'),

            ]);

            return redirect()->route('proyek-list')->with('success', 'Data proyek baru berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('proyek-list')->with('error', 'Nama Proyek Tidak Boleh Kosong');
        }
    }

    public function updateProyek(Request $request)
    {
//        dd($request->all());

        $proyek = Proyek::findOrFail($request->proyek_id);
        $proyek->proyek_name = $request->input('proyek_name');
        $proyek->pj_proyek = $request->input('id_role');
        $proyek->save();

        return redirect()->route('proyek-list')->with('success', 'Nama proyek berhasil diperbarui.');


    }

    public function deleteProyek(Request $request)
    {
        $proyek = Proyek::findOrFail($request->proyek_id);
        $proyek->delete();

        return redirect()->route('proyek-list')->with('success', 'Proyek berhasil dihapus.') ;
    }

}
