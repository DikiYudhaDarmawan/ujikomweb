<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\SiswaEkskul;
use Auth;

class PembinaController extends Controller
{
    public function index()
    {
        $pembina_id = Auth::id();

        // Ambil semua ekskul yang dibina oleh pembina ini
        $ekskuls = Ekskul::withCount('siswaekskul')
            ->where('pembina_id', $pembina_id)
            ->get();

        // Hitung total siswa dari semua ekskul yang dibina pembina ini
        $totalSiswa = SiswaEkskul::whereIn('ekskul_id', $ekskuls->pluck('id'))->count();

        return view('pembina.dashboard.index', compact('ekskuls', 'totalSiswa'));
    }
}