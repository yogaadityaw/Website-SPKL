<?php

namespace App\Http\Controllers\DashboardAdminController;

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
        $type_menu = 'change-role';
        return view('admin-views.change-role', compact('type_menu', 'users', 'roles'));
    }

    public function updateRole(Request $request)
    {
        try {
            $user = User::findOrFail($request->id_user);
            $user->role_id = $request->id_role;
            $user->save();
            return redirect()->route('change-role')->with('success', 'Role berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('change-role')->with('error', 'Role gagal diubah');
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
            return redirect()->route('change-role')->with('error', 'User gagal dihapus');
        }
    }

}
