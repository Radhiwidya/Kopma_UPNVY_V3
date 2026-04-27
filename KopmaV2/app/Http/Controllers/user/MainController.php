<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function update(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'nullable|min:5',
    ]);

    $user = Auth::user();

    $data = [
        'username' => $request->username,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return back()->with('success', 'Data berhasil diperbarui');
}
}