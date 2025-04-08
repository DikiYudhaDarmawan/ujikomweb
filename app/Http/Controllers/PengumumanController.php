<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekskul = Ekskul::where('pembina_id', auth()->id())->first();

        $pengumuman = Pengumuman::where('ekskul_id', $ekskul->id)->get();

        return view('pembina.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembina.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ekskul = Ekskul::where('pembina_id', auth()->id())->first();

        $pengumuman = new Pengumuman;
        $pengumuman->ekskul_id = $ekskul->id;
        $pengumuman->judul = $request->judul;
        $pengumuman->description = $request->description;
        if ($request->hasFile('foto')) {
            $img = $request->file('foto');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('image/fotopengumuman', $name);
            $pengumuman->foto = $name;
        }

        $pengumuman->save();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ekskul = Ekskul::where('pembina_id', auth()->id())->first();
        $pengumuman = Pengumuman::where('ekskul_id', $ekskul->id)
            ->findOrFail($id);
        return view('pembina.pengumuman.edit', compact('pengumuman'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ekskul = Ekskul::where('pembina_id', auth()->id())->first();

        $pengumuman = Pengumuman::where('ekskul_id', $ekskul->id)
            ->findOrFail($id);

        $pengumuman->judul = $request->judul;
        $pengumuman->description = $request->description;
        if ($request->hasFile('foto')) {
            $img = $request->file('foto');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('image/fotopengumuman', $name);
            $pengumuman->foto = $name;
        }

        $pengumuman->save();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }

}