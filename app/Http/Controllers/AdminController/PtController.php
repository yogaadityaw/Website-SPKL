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

class PtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pts = Pt::orderBy('id_pt', 'desc')->get();
//
        return view('admin-views.list-pt', compact('pts',));
    }

  public function getPtData($id_pt)
        {

            $pt = Pt::findOrFail($id_pt);
            return response()->json($pt);
        }

        public function TambahPt(Request $request)
        {
            try {
                $pt = Pt::create([

                    'pt_name' => $request->input('pt'),

                ]);

                return redirect()->route('pt-list')->with('success', 'Data pt baru berhasil ditambahkan');
            } catch (\Exception $e) {
                dd("Error $e");
            }
        }

    public function updatePt(Request $request)
    {


        $pt = Pt::findOrFail($request->pt_id);
        $pt->pt_name = $request->input('pt_name');

        $pt->save();

        return redirect()->route('pt-list')->with('success', 'Nama proyek berhasil diperbarui.');

    }

    public function deletePt(Request $request)
    {
        $pt = Pt::findOrFail($request->pt_id);
        $pt->delete();

        return redirect()->route('pt-list')->with('success', 'Proyek berhasil dihapus.') ;
    }

}