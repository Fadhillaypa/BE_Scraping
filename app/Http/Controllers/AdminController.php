<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
        ]);

        $admin = new Admin();
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password); // Enkripsi password
        $admin->save();

        return response()->json(['message' => 'Admin created successfully'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::guard('admin')->attempt($credentials)) {
            // Login berhasil
            $user = Auth::guard('admin')->user();
            return response()->json(['message' => 'Login successful', 'user' => $user], 200);
        }
    
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logout successful'], 200);
    }
}
