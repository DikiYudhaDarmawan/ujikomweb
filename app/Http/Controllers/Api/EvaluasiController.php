<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Models\Siswa;
use Auth;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function index(Request $request)
    {
        // Dapatkan data siswa berdasarkan user yang sedang login
        $siswa = Siswa::where('id_user', auth()->user()->id)->first();

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak ditemukan',
                'data' => [],
            ], 404);
        }

        // Ambil daftar ekskul yang diikuti siswa
        $ekskulIds = $siswa->ekskuls->pluck('id')->toArray();

        // Ambil ekskul_id dari request
        $ekskulId = $request->query('ekskul_id');

        // Query evaluasi
        $evaluasiQuery = Evaluasi::where('siswa_id', $siswa->id)
            ->whereIn('ekskul_id', $ekskulIds)
            ->with([
                'pembina:id,name',
                'ekskul:id,name',
            ]);

        // Jika ekskul_id diberikan, filter evaluasi untuk ekskul tersebut
        if ($ekskulId) {
            $evaluasiQuery->where('ekskul_id', $ekskulId);
        }

        $evaluasi = $evaluasiQuery->get();

        if ($evaluasi->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Belum ada evaluasi untuk ekskul ini',
                'data' => [],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Daftar Evaluasi Ekskul',
            'data' => $evaluasi,
        ]);
    }
}