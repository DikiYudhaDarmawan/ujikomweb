<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\SiswaEkskul;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    $ekskul = Ekskul::where('pembina_id', auth()->id())->first();
    $kelass = Kelas::all();
    $jurusans = Jurusan::all(); // ambil semua jurusan

    $search = $request->search;
    $kelas = $request->kelas;
    $jurusan = $request->jurusan;

    $data_siswa = SiswaEkskul::with('siswa.user', 'siswa.kelas', 'siswa.jurusan')
        ->where('ekskul_id', $ekskul->id)
        ->get();

    return view('pembina.data_siswa.index', compact('data_siswa', 'ekskul', 'kelass', 'jurusans', 'search', 'kelas', 'jurusan'));
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}