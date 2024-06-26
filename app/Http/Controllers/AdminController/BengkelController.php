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

class BengkelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bengkels = Bengkel::orderBy('Created_at', 'desc')->paginate(10);
        $users = User::where('role_id', 2)->get();
        $departemens = Departemen::all();
        return view('admin-views.list-bengkel', compact('bengkels','users','departemens'));
    }

    public function getBengkelData($id_bengkel)
    {
        $bengkel = Bengkel::findOrFail($id_bengkel);
        return response()->json($bengkel);
    }

    public function TambahBengkel(Request $request)
    {
        try {
            Bengkel::create([

                'departemen_id' => $request->input('departemen_id'),
                'bengkel_name' => $request->input('bengkel'),
                'bengkel_head' => $request->input('id_role'),

            ]);

            return redirect()->route('bengkel-list')->with('success', 'Data bengkel baru berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('bengkel-list')->with('error', 'Nama Bengkel Tidak Boleh Kosong');
        }
    }

    public function updateBengkel(Request $request)
    {
        $bengkel = Bengkel::findOrFail($request->bengkel_id);
        $bengkel->departemen_id = $request->input('departemen_id');
        $bengkel->bengkel_name = $request->input('bengkel_name');
        $bengkel->bengkel_head = $request->input('id_role');
        $bengkel->save();

        return redirect()->route('bengkel-list')->with('success', 'data bengkel berhasil diperbarui.');


    }

    public function deleteBengkel(Request $request)
    {
        $bengkel = Bengkel::findOrFail($request->bengkel_id);
        $bengkel->delete();

        return redirect()->route('bengkel-list')->with('success', 'bengkel berhasil dihapus.') ;
    }

}
