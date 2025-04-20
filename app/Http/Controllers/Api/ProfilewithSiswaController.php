<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Siswa;


class ProfilewithSiswaController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $siswa = Siswa::with([
            'user',
            'kelas',
            'jurusan',
            'gelombangBelajar',
            'siswaEkskuls.ekskul',
        ])->where('id_user', $user->id)->first();

        if (!$siswa) {
            return response()->json([
                'status' => false,
                'message' => 'Data siswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $siswa,
        ]);
    }

 public function update(Request $request)
{
    $user = Auth::user();

    // Ambil data JSON dari body jika pakai application/json
    $data = $request->isJson() ? $request->json()->all() : $request->all();

    // Validasi
    $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'nomor_telp' => 'nullable|string|max:20',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validasi gagal',
            'errors' => $validator->errors(),
        ], 422);
    }

    // Update data user
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->save();

    // Update nomor telepon
    $siswa = Siswa::where('id_user', $user->id)->first();
    if ($siswa) {
        $siswa->nomor_telp = $data['nomor_telp'];
        $siswa->save();
    }

    return response()->json([
        'status' => true,
        'message' => 'Profil berhasil diperbarui',
    ]);
}
}