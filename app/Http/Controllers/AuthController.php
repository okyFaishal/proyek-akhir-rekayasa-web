<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // validasi
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // database
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // respon
        return response()->json([
            'message' => 'Registrasi berhasil',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        // validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // get user by email
        $user = User::where('email', $request->email)->first();

        // cek ada user dan password sama
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        // create token
        $token = $user->createToken('api-token')->plainTextToken;

        // respon
        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        // hapus token
        $request->user()->currentAccessToken()->delete();

        // respon
        return response()->json([
            'message' => 'Logout berhasil',
        ]);
    }
}
