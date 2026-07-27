<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // ==========================
    // Tampilkan semua user
    // ==========================
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    // ==========================
    // Form tambah user
    // ==========================
    public function create()
    {
        return view('admin.users.create');
    }

    // ==========================
    // Simpan user baru
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,admin',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // ==========================
    // Detail User
    // ==========================
    public function show($id)
    {
        return redirect()->route('admin.users.index');
    }

    // ==========================
    // Form Edit User
    // ==========================
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    // ==========================
    // Update User
    // ==========================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:user,admin',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    // ==========================
    // Hapus User
    // ==========================
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}