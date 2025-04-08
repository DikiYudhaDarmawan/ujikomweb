<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaran = TahunAjaran::all();
        return view('admin.tahunAjaran.index', compact('tahunAjaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $years = range(1900, strftime("%Y", time()));
        return view('admin.tahunAjaran.create', compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tahunAjaran = new TahunAjaran;
        $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
        $tahunAjaran->semester = $request->semester;
        $tahunAjaran->status = $request->has('status') ? 1 : 0;

        $tahunAjaran->save();
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
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return view('admin.tahunAjaran.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);

        $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
        $tahunAjaran->semester = $request->semester;
        $tahunAjaran->status = $request->has('status') ? 1 : 0;

        $tahunAjaran->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function updateStatus(Request $request)
    {
        $tahunAjaran = TahunAjaran::find($request->id);
        if ($tahunAjaran) {
            $tahunAjaran->status = $request->has('status') ? 1 : 0;
            $tahunAjaran->save();
        }

        return redirect()->back();
    }
    public function destroy(string $id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->delete();
        return redirect()->route('tahunAjaran.index');

    }

    public function statusActive($id)
{
    TahunAjaran::query()->update(['status' => false]);

    $tahunAjaran = TahunAjaran::findOrFail($id);
    $tahunAjaran->status = true;
    $tahunAjaran->save();

    return redirect()->back()->with('success', 'Tahun ajaran berhasil diaktifkan.');
}

}