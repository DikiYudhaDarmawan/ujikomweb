<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiswaEkskul;
use Illuminate\Support\Facades\Auth;
use Request;

class SiswaEkskulController extends Controller
{
    // Ambil daftar ekskul berdasarkan siswa yang login
public function index(Request $request)
{
    $user = auth()->user();

    // Ambil siswa_id dari relasi user -> siswa
    $siswa = $user->siswa; // Relasi ke model Siswa
    $siswa_id = $siswa ? $siswa->id : null;

    // Ambil data siswa ekskul berdasarkan siswa_id
    $siswaEkskul = SiswaEkskul::where('siswa_id', $siswa_id)->with('ekskul')->get();

    return response()->json([
        'status' => 'success',
        'siswa_id' => $siswa_id,
        'data' => $siswaEkskul
    ]);
}

}