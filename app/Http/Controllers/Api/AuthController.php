<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name'                => 'required|string|max:255',
        'email'               => 'required|string|max:255|unique:users',
        'password'            => 'required|string|min:8|confirmed',
        'jenis_kelamin'       => 'required|in:L,P',
        'kelas_id'            => 'required|exists:kelas,id',
        'jurusan_id'          => 'required|exists:jurusans,id',
        'gelombang_belajar_id'=> 'required|exists:gelombang_belajars,id',
        'nomor_telp'          => 'required|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Siswa::create([
        'id_user'              => $user->id,
        'jenis_kelamin'        => $request->jenis_kelamin,
        'kelas_id'             => $request->kelas_id,
        'jurusan_id'           => $request->jurusan_id,
        'gelombang_belajar_id' => $request->gelombang_belajar_id,
        'nomor_telp'           => $request->nomor_telp,
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'data'         => $user,
        'access_token' => $token,
        'token_type'   => 'Bearer',
    ], 201);
}


    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Ambil siswa_id jika user adalah siswa
        $siswa = $user->siswa;
        $siswa_id = $siswa ? $siswa->id : null;

        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'siswa_id' => $siswa_id,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success',
        ]);
    }
}