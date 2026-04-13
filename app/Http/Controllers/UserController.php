<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function indexAdmin() {
        $users = User::where('role', 'admin')->get();
        return view('users.admin.index', compact('users'));
    }

    public function indexOperator() {
        $users = User::where('role', 'operator')->get();
        return view('users.operator.index', compact('users'));
    }

    public function create()
    {
        return view('users.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
        ]);

        $prefix = substr($request->email, 0, 4);
        $count = User::count() + 1;
        $passwordPlain = $prefix . $count;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($passwordPlain),
        ]);

        // REDIRECT BERDASARKAN ROLE
        $target = ($request->role == 'admin') ? 'users.admin.index' : 'users.operator.index';
        
        return redirect()->route($target)->with('success', $passwordPlain);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
            'password' => 'nullable|min:4',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        $target = ($request->role == 'admin') ? 'users.admin.index' : 'users.operator.index';
        return redirect()->route($target)->with('success', 'User berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $role = $user->role; 
        $user->delete();
        $target = ($role == 'admin') ? 'users.admin.index' : 'users.operator.index';
        return redirect()->route($target)->with('success', 'User berhasil dihapus');
    }

    public function export(Request $request)
    {
        $role = $request->query('role', 'admin');
        $fileName = ($role == 'admin') ? 'admin-accounts.xlsx' : 'operator-accounts.xlsx';

        return Excel::download(new UsersExport($role), $fileName);
    }

    public function resetPassword($id)
{
    $user = User::findOrFail($id);
    $prefix = substr($user->email, 0, 4);
    $newPass = $prefix . $user->id;

    $user->update([
        'password' => bcrypt($newPass),
    ]);

    return redirect()->back()->with('success', "Password baru dimunculkan: " . $newPass);
}
}