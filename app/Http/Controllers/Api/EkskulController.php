<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Ekskul;
use Illuminate\Http\JsonResponse;
use DB;
use Auth;
use App\Models\Siswa;

class EkskulController extends Controller
{
    /**
     * Get all Ekskul data
     */
   public function index()
{
    $user = Auth::user(); // Ambil user yang sedang login

    // Pastikan user sudah memiliki data siswa
    $siswaId = Siswa::where('id_user', $user->id)->value('id');

    if (!$siswaId) {
        return response()->json([
            'success' => false,
            'message' => 'Data siswa tidak ditemukan.'
        ], 404);
    }

    // Ambil semua ekskul
    $ekskuls = Ekskul::all()->map(function ($ekskul) use ($siswaId) {
        // Cek apakah siswa sudah mendaftar ekskul ini
        $ekskul->is_registered = DB::table('siswa_ekskuls')
            ->where('siswa_id', $siswaId)
            ->where('ekskul_id', $ekskul->id)
            ->exists();
        return $ekskul;
    });

    return response()->json([
        'success' => true,
        'data' => $ekskuls
    ], 200);
}


    /**
     * Get Ekskul data by ID
     */
    public function show($id): JsonResponse
    {
        $ekskul = Ekskul::with('user:id,name,email')->findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Detail ekstrakurikuler',
            'data' => $ekskul,
        ], 200);
    }

    public function daftarEkskulAPI(Request $request)
    {
        try {
            $request->validate([
                'ekskul_id' => 'required|exists:ekskuls,id',
            ]);

            // Ambil ID siswa berdasarkan user yang login
            $user = Auth::user();
            $siswaId = Siswa::where('id_user', $user->id)->value('id');

            if (!$siswaId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data siswa tidak ditemukan.'
                ], 404);
            }

            // Pastikan siswa belum mendaftar ekskul ini
            $sudahMendaftar = DB::table('siswa_ekskuls')
                ->where('siswa_id', $siswaId)
                ->where('ekskul_id', $request->ekskul_id)
                ->exists();

            if ($sudahMendaftar) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah terdaftar dalam ekskul ini!'
                ], 400);
            }

            // Simpan data ke tabel siswa_ekskuls
            DB::table('siswa_ekskuls')->insert([
                'siswa_id' => $siswaId,
                'ekskul_id' => $request->ekskul_id,
                'joined_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }

    }
}