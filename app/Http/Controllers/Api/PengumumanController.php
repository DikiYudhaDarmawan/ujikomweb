<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\Ekskul;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
class PengumumanController extends Controller
{
   public function index($ekskul_id): JsonResponse
{
    // Pastikan Ekskul ada
    $ekskul = Ekskul::find($ekskul_id);

    if (!$ekskul) {
        return response()->json([
            'success' => false,
            'message' => 'Ekskul tidak ditemukan.',
            'data' => []
        ], 404);
    }

    // Ambil semua pengumuman untuk ekskul ini
    $pengumuman = Pengumuman::where('ekskul_id', $ekskul_id)->get();

    return response()->json([
        'success' => true,
        'message' => $pengumuman->isEmpty() ? 'Tidak ada pengumuman untuk ekskul ini.' : 'Daftar pengumuman berhasil diambil.',
        'data' => $pengumuman
    ], 200);
}

}