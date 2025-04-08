<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Evaluasi;
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use auth;

class SiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $siswa = Siswa::where('id_user', $user->id)->first();
        $ekskul = Ekskul::all();
        $ekskulDiikuti = SiswaEkskul::where('siswa_id', $siswa->id)->pluck('ekskul_id')->toArray();
        return view('index2', compact('ekskul', 'ekskulDiikuti'));

    }

    public function ekskulku()
    {
        $user = auth()->user();
        $siswa = Siswa::where('id_user', $user->id)->first();
        $ekskulKu = $siswa ? $siswa->ekskuls : collect();
        return view('siswa.ekskulku', compact('ekskulKu'));
    }

    public function show($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        return view('siswa.show', compact('ekskul'));
    }

    public function pengumuman($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $pengumuman = $ekskul->pengumuman;
        return view('siswa.pengumuman', compact('ekskul', 'pengumuman'));
    }

    public function nilai($ekskulId)
    {
        $user = auth()->user();
        $siswa = Siswa::where('id_user', $user->id)->first();
        if (!$siswa) {
            return redirect()->route('siswa.ekskulku')->with('error', 'Data siswa tidak ditemukan.');
        }
        $ekskul = Ekskul::find($ekskulId);
        if (!$ekskul) {
            return redirect()->route('siswa.ekskulku')->with('error', 'Ekskul tidak ditemukan.');
        }
        $evaluasi = Evaluasi::with(['ekskul', 'pembina'])
            ->where('siswa_id', $siswa->id)
            ->where('ekskul_id', $ekskul->id)
            ->get();

        return view('siswa.nilai', compact('evaluasi', 'ekskul'));
    }

}