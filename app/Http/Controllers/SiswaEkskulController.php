<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use Illuminate\Http\Request;
use Alert;


class SiswaEkskulController extends Controller
{
public function index(Request $request)
{
    $ekskuls = Ekskul::all();
    $selectedEkskul = $request->ekskul_id;
    $search = $request->search;

    $siswas = Siswa::all();

    $dataSiswaEkskul = [];
    if($selectedEkskul){
        $dataSiswaEkskul = SiswaEkskul::with('siswa.user')
                                ->where('ekskul_id', $selectedEkskul)
                                ->when($search, function($query) use ($search){
                                    $query->whereHas('siswa.user', function($q) use ($search){
                                        $q->where('name', 'like', '%'.$search.'%');
                                    });
                                })
                                ->get();
    }
    confirmDelete('Keluarkan', 'yakin?');

    return view('admin.siswaekskul.index', compact('ekskuls', 'selectedEkskul', 'siswas', 'dataSiswaEkskul', 'search'));
}


public function store($ekskul_id, $siswa_id)
{
    SiswaEkskul::create([
        'ekskul_id' => $ekskul_id,
        'siswa_id'  => $siswa_id,
        'joined_at' => now(), 
    ]);
Alert::success('success', "Siswa telah tidambahkan!")->autoClose(1000);

    return redirect()->back();
}
    public function getByEkskul($ekskul_id)
    {
        $data = SiswaEkskul::with('siswa.user')->where('ekskul_id', $ekskul_id)->get();
        return response()->json($data);
    }
    public function destroy($ekskul_id, $siswa_id)
{
    $data = SiswaEkskul::where('ekskul_id', $ekskul_id)
        ->where('siswa_id', $siswa_id)
        ->first();

    if (!$data) {
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    $data->delete();
Alert::success('success', "siswa telah dikeluarkan dari ekskul!")->autoClose(1000);

    return redirect()->back();
}

}