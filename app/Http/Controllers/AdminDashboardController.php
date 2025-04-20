<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use App\Models\User;

class AdminDashboardController extends Controller
{
public function index()
{
    $totalSiswa = Siswa::count();
    $totalEkskul = Ekskul::count();
    $totalSiswaIkutEkskul = SiswaEkskul::distinct('siswa_id')->count('siswa_id');
    $totalPembina = User::whereHas('pembinaEkskul')->count();

    // Data untuk grafik siswa per ekskul
    $chartData = Ekskul::withCount('siswaEkskul')->get();

    return view('admin.dashboard.index', compact(
        'totalSiswa', 'totalEkskul', 'totalSiswaIkutEkskul',
        'totalPembina', 'chartData'
    ));
}
}