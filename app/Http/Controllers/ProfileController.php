<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan Profil Pengguna
    public function show()
    {
        $user = Auth::user();  // Mendapatkan data pengguna yang sedang login
        return view('profile.show', compact('user'));
    }

    // Menampilkan Form Edit Profil
    public function edit()
    {
        $user = Auth::user();  // Mendapatkan data pengguna yang sedang login
        return view('profile.edit', compact('user'));
    }

    // Memperbarui Profil Pengguna
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);
    
        $user = auth()->user();
        
        // Update nama dan email
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        // Jika ada foto yang di-upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/profile_photos/' . $user->foto);
            }
    
            // Simpan foto baru
            $photo = $request->file('foto');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('public/profile_photos', $filename);
    
            // Update nama file foto di database
            $user->foto = $filename;
        }
    
        // Simpan perubahan
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna yang sedang login

        // Invalidasi sesi pengguna dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect pengguna kembali ke halaman login
        return redirect('/login')->with('success', 'Anda berhasil logout!');
    }
}
