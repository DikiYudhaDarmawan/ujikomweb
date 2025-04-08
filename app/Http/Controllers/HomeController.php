<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use App\Models\User;
use Auth;

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
$totalSiswaIkutEkskul = SiswaEkskul::count();
$totalPembina = User::where('role', 'pembina')->count();

return view('admin.dashboard.index', compact(
    'totalSiswa',
    'totalEkskul',
    'totalSiswaIkutEkskul',
    'totalPembina'
));

        }if ($user->role == 'pembina') {
            $ekskul = Ekskul::where('pembina_id', $user->id)->get();
            return view('pembina.dashboard.index', compact('ekskul'));
        }if ($user->role == 'siswa') {
            $user = Auth::user();
            $siswa = Siswa::where('id_user', $user->id)->first();

            $ekskul = Ekskul::all();

            $ekskulDiikuti = SiswaEkskul::where('siswa_id', $siswa->id)->pluck('ekskul_id')->toArray();

            return view('index2', compact('ekskul', 'ekskulDiikuti'));

        }

        abort(403, 'Anda tidak memiliki akses.');
    }
}