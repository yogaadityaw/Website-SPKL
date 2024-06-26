<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Departemen;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $departemens = Departemen::orderBy('Created_at', 'desc')->paginate(10);
        $roles = User::where('role_id', [3, 4   ])->get();
        return view('admin-views.list-departemen', compact('departemens','roles'));
    }

    public function getDepartemenData($id_departemen)
    {

        $departemen = Departemen::findOrFail($id_departemen);
        return response()->json($departemen);
    }

    public function TambahDepartemen(Request $request)
    {
        try {
            $departemen = Departemen::create([

                'departemen_name' => $request->input('departemen'),
                'departemen_head' => $request->input('id_role'),

            ]);

            return redirect()->route('departemen-list')->with('success', 'Data departemen baru berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('departemen-list')->with('error', 'Nama Departemen Tidak Boleh Kosong');
        }
    }

    public function updateDepartemen(Request $request)
    {
//        dd($request->all());

        $departemen = Departemen::findOrFail($request->departemen_id);
        $departemen->departemen_name = $request->input('departemen_name');
        $departemen->departemen_head = $request->input('id_role');
        $departemen->save();

        return redirect()->route('departemen-list')->with('success', 'data departemen berhasil diperbarui.');


    }

    public function deleteDepartemen(Request $request)
    {
        $departemen = Departemen::findOrFail($request->departemen_id);
        $departemen->delete();

        return redirect()->route('departemen-list')->with('success', 'bengkel berhasil dihapus.') ;
    }

}
