<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Kelas;
use App\Models\SiswaEkskul;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekskul = Ekskul::where('pembina_id', auth()->id())->first();
        $data_siswa = SiswaEkskul::where('ekskul_id', $ekskul->id)->get();
        $kelass = Kelas::all();
        
        
        return view('pembina.data_siswa.index', compact('data_siswa','ekskul','kelass'));
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