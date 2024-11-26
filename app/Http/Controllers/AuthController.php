<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Fungsi untuk registrasi
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8', // Hapus 'confirmed' untuk tidak menggunakan konfirmasi password
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    // Fungsi untuk login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Cek apakah pengguna ada
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); // Ambil pengguna yang terautentikasi
            return response()->json(['message' => 'Login successful', 'user' => $user], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Fungsi untuk mendapatkan data pengguna
     // Mendapatkan semua pengguna
     public function getUser()
     {
         $users = User::all(); // Ambil semua pengguna
         return response()->json($users);
     }
     
     

     // Mendapatkan pengguna berdasarkan ID
     public function show($id)
     {
         $user = User::find($id);
         if ($user) {
             return response()->json($user, 200);
         }
         return response()->json(['error' => 'User not found'], 404);
     }

     // Fungsi untuk update
     public function update(Request $request, $id)
     {
        \Log::info('Request Data:', $request->all());
         $user = User::find($id);
         if (!$user) {
             return response()->json(['error' => 'User not found'], 404);
         }
 
         $user->update($request->all());
         return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
     }

     // Fungsi untuk hapus
     public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    // Fungsi untuk logout
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    public function profile($id)
{
    // Cari pengguna berdasarkan id_user
    $user = User::find($id);

    // Jika pengguna tidak ditemukan
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Mengembalikan data profil
    return response()->json([
        'id_user' => $user->id_user,
        'name' => $user->name,
        'email' => $user->email,
        'alamat' => $user->alamat,
        'no_tlfn' => $user->no_tlfn,
        'role' => $user->role,
    ]);
}

}


