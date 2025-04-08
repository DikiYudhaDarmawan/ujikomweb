<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Ekskul;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    public function index()
    {
        // Muat relasi 'ekskul' dan 'presensis'
        $acaras = Acara::with(['ekskul', 'presensis'])->latest()->get();
        return view('pembina.acara.index', compact('acaras'));
    }

    public function create()
    {
        return view('pembina.acara.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        // Ambil ekskul berdasarkan pembina yang login
        $ekskul = Ekskul::where('pembina_id', auth()->id())->first();

        if (!$ekskul) {
            return redirect()->back()->with('error', 'Anda belum memiliki ekskul.');
        }

        $acara = new Acara;
        $acara->ekskul_id = $ekskul->id;
        $acara->nama = $request->nama;
        $acara->tanggal = $request->tanggal;
        $acara->save();

        return redirect()->route('acara.index')->with('success', 'Acara berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $acara = Acara::findOrFail($id);
        return view('pembina.acara.edit', compact('acara'));
    }

    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        $acara = Acara::findOrFail($id);
        $acara->nama = $request->nama;
        $acara->tanggal = $request->tanggal;
        $acara->save();

        return redirect()->route('acara.index')->with('success', 'Acara berhasil diupdate');
    }

    public function destroy(Acara $acara)
    {
        $acara->delete();
        return redirect()->route('acara.index')->with('success', 'Acara berhasil dihapus');
    }
}