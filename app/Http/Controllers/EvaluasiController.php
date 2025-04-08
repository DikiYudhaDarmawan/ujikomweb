<?php

namespace App\Http\Controllers;

use App;
use App\Models\Ekskul;
use App\Models\Evaluasi;
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $ekskul = Ekskul::where('pembina_id', auth()->id())->firstOrFail();
    
    $data_siswa = SiswaEkskul::with(['siswa.user', 'ekskul'])
        ->where('ekskul_id', $ekskul->id)
        ->firstOrFail();

    $evaluasi = Evaluasi::with(['siswa.user', 'ekskul', 'pembina'])
        ->where('siswa_id', $data_siswa->siswa->id)
        ->where('ekskul_id', $ekskul->id)
        ->get();

    return view('pembina.evaluasi.index', compact('ekskul', 'evaluasi', 'data_siswa'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $siswa = SiswaEkskul::with('siswa.user')->where('id', $request->siswa_id)->firstOrFail();
        return view('pembina.evaluasi.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $siswaEkskul = SiswaEkskul::findOrFail($request->siswa_id);

        $nilai = new Evaluasi;
        $nilai->siswa_id = $siswaEkskul->siswa_id;
        $nilai->pembina_id = auth()->id();
        $nilai->grade = $request->grade;
        $nilai->description = $request->description;
        $nilai->ekskul_id = $siswaEkskul->ekskul_id;
        $nilai->save();

        // Redirect ke halaman show menggunakan ID pivot
        return redirect()->route('evaluasi.show', ['evaluasi' => $siswaEkskul->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data_siswa = SiswaEkskul::with(['siswa.user', 'ekskul'])
            ->where('id', $id)
            ->firstOrFail();

        $ekskul = $data_siswa->ekskul;

        $evaluasi = Evaluasi::with(['ekskul', 'pembina'])
            ->where('siswa_id', $data_siswa->siswa->id)
            ->where('ekskul_id', $ekskul->id)
            ->get();

        return view('pembina.evaluasi.index', compact('ekskul', 'data_siswa', 'evaluasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nilai = Evaluasi::with(['siswa.user'])->findOrFail($id);
        $siswa = Siswa::with('user')->findOrFail($nilai->siswa_id);
        return view('pembina.evaluasi.edit', compact('nilai', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nilai = Evaluasi::findOrFail($id);
        $nilai->grade = $request->grade;
        $nilai->description = $request->description;
        $nilai->save();

        return redirect()->route('evaluasi.show', ['evaluasi' => $nilai->siswa_id]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilai = Evaluasi::findOrFail($id);
        $nilai->delete();
        return redirect()->route('evaluasi.show', ['evaluasi' => $nilai->siswa_id]);

    }
}