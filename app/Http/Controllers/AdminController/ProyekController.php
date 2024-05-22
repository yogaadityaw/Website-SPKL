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
        return view('admin-views.list-proyek', compact('proyeks'));
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

            ]);

            return redirect()->route('proyek-list')->with('success', 'Data proyek baru berhasil ditambahkan');
        } catch (\Exception $e) {
            dd("Error $e");
        }
    }

    public function updateProyek(Request $request)
    {

        $proyek = Proyek::findOrFail($request->id_proyek);
        $proyek= $request->input('proyek_id');
        $proyek->save();

        return redirect()->route('proyek-list')->with('success', 'Nama proyek berhasil diperbarui.');


    }


}

