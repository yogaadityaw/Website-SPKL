<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Bengkel;
use App\Models\Pt;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::with('role')->orderBy('user_nip', 'desc')->get();
        $roles = Role::all();
        $pts = Pt::all();
        $bengkels = Bengkel::all();

        return view('admin-views.change-role', compact('users', 'roles', 'pts', 'bengkels'));
    }

    public function updateRole(Request $request)
    {
        try {
            $user = User::findOrFail($request->id_user);
            $user->role_id = $request->id_role ?? $user->role_id;
            $user->pt_id = $request->id_pt ?? $user->pt_id;
            $user->bengkel_id = $request->id_bengkel ?? $user->bengkel_id;
            $user->save();

            return redirect()->route('change-role')->with('success', 'Data pegawai berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('change-role')->with('error', $e->getMessage());
        }
    }

    public function getUserData($id_user)
    {
        $user = User::findOrFail($id_user);
        return response()->json($user);
    }

    public function deleteUser(Request $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            $user->delete();

            return redirect()->route('change-role')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('change-role')->with('error', $e->getMessage());
        }
    }
}
