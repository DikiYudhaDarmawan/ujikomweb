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
        $totalSiswaIkutEkskul = SiswaEkskul::count();
        $totalPembina = User::where('role', 'pembina')->count();

        return view('admin.dashboard.index', compact(
            'totalSiswa',
            'totalEkskul',
            'totalSiswaIkutEkskul',
            'totalPembina'
        ));
    }
}