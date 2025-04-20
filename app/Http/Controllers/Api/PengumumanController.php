<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\Ekskul;
use App\Models\SiswaEkskul;
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


public function notifikasiBaru()
{
    $user = Auth::user();

    if (!$user->siswa) {
        return response()->json(['message' => 'Hanya siswa yang dapat menerima notifikasi'], 403);
    }

    $siswaId = $user->siswa->id;

    // Ambil semua ekskul yang diikuti oleh siswa
    $ekskulIds = SiswaEkskul::where('siswa_id', $siswaId)->pluck('ekskul_id');

    // Ambil pengumuman dari ekskul-ekskul tersebut, urutkan berdasarkan waktu terbaru
    $pengumumanBaru = Pengumuman::with('ekskul:id,name') // Biar dapat info nama ekskul juga
        ->whereIn('ekskul_id', $ekskulIds)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'status' => true,
        'pengumuman_baru' => $pengumumanBaru
    ]);
}
}