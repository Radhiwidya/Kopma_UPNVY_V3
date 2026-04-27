<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PTController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $users = User::query()
            ->where('user_type', 'user')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('user_type', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();
        $admins = User::where('user_type', 'admin')->get();
        return view('admin.teknologi.password', compact('users', 'admins', 'search'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'username'  => 'required|string|max:255|unique:users,username',
            'password'  => 'required|min:5',
            'user_type' => 'required|in:user,admin',
            'role'      => 'required',
        ]);

        try {
            User::create([
                'name'      => $validated['name'],
                'username'  => $validated['username'],
                'password'  => Hash::make($validated['password']),
                'user_type' => $validated['user_type'],
                'role'      => $validated['role'],
            ]);
            return back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal tambah data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'     => 'nullable|string|max:255',
            'username' => 'nullable|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|min:5',
        ]);

        try {
            $user = User::findOrFail($id);
            if ($request->filled('name')) {
                $user->name = $validated['name'];
            }
            if ($request->filled('username')) {
                $user->username = $validated['username'];
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();
            return back()->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }
    public function destroy($id): RedirectResponse
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }
}