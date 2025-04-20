<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Ekskul;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use App\Models\User;
use App\Models\Pengumuman;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $totalSiswa = Siswa::count();
            $totalEkskul = Ekskul::count();
            $totalSiswaIkutEkskul = SiswaEkskul::distinct('siswa_id')->count('siswa_id');
            $totalPembina = User::where('role', 'pembina')->count();

// Ambil data ekskul dengan jumlah siswa yang ikut ekskul
            $chartData = Ekskul::withCount('siswaekskul')
                ->get()
                ->map(function ($ekskul) {
                    return [
                        'name' => $ekskul->name,
                        'count' => $ekskul->siswaekskul_count, // Pastikan key ini sesuai dengan yang dipakai di Blade
                    ];
                });

            return view('admin.dashboard.index', compact(
                'totalSiswa',
                'totalEkskul',
                'totalSiswaIkutEkskul',
                'totalPembina',
                'chartData'
            ));

        }if ($user->role == 'pembina') {

            $pembina_id = Auth::id();
            $ekskul = Ekskul::where('pembina_id', auth()->id())->first();

            $ekskuls = Ekskul::withCount('siswaekskul', 'pengumuman', 'acara', 'presensi')
                ->where('pembina_id', $pembina_id)
                ->get();

            $totalSiswa = SiswaEkskul::whereIn('ekskul_id', $ekskuls->pluck('id'))->count();
            $totalPengumuman = Pengumuman::whereIn('ekskul_id', $ekskuls->pluck('id'))->count();
            $totalAcara = Acara::whereIn('ekskul_id', $ekskuls->pluck('id'))->count();
           $totalAbsensi = Presensi::distinct('acara_id')->count('acara_id');

            
            $ekskul_ids = Ekskul::where('pembina_id', $pembina_id)->pluck('id');
            $acaras = Acara::whereIn('ekskul_id', $ekskul_ids)->orderBy('tanggal')->get();

            $labels = [];
            $dataHadir = [];
            $dataIzin = [];
            $dataSakit = [];
            $dataAlpha = [];

            foreach ($acaras as $acara) {
                $labels[] = Carbon::parse($acara->tanggal)->format('d M');

                $absensi = Presensi::where('acara_id', $acara->id)->get()->groupBy('keterangan');
                $dataHadir[] = count($absensi['Hadir'] ?? []);
                $dataIzin[] = count($absensi['Izin'] ?? []);
                $dataSakit[] = count($absensi['Sakit'] ?? []);
                $dataAlpha[] = count($absensi['Alpha'] ?? []);
            }

            return view('pembina.dashboard.index', compact(
                'ekskuls',
                'totalSiswa',
                'totalPengumuman',
                'totalAcara',
                'totalAbsensi',
                'labels',
                'dataHadir',
                'dataIzin',
                'dataSakit',
                'dataAlpha'
            ));
        }
        if ($user->role == 'siswa') {
            $user = Auth::user();
            $siswa = Siswa::where('id_user', $user->id)->first();

            $ekskul = Ekskul::all();

            $ekskulDiikuti = SiswaEkskul::where('siswa_id', $siswa->id)->pluck('ekskul_id')->toArray();

            return view('index2', compact('ekskul', 'ekskulDiikuti'));

        }

        abort(403, 'Anda tidak memiliki akses.');
    }
}