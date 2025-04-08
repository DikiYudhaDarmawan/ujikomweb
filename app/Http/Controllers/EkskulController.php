<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Siswa;
use App\Models\SiswaEkskul;
use App\Models\User;
// use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use DB;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Hapus Ekskul!';
        $text = "Apakah anda yakin ingin menghapus?";
        confirmDelete($title, $text);

        $ekskuls = Ekskul::all();
        // dd($ekskuls);
        return view('admin.ekskul.index', compact('ekskuls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembina_id = User::where('role', 'pembina')->get();
        return view('admin.ekskul.create', compact('pembina_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ekskuls = new Ekskul;
        $ekskuls->name = $request->name;
        $ekskuls->description = $request->description;
        $ekskuls->pembina_id = $request->pembina_id;
        $ekskuls->activity_date = $request->activity_date;
        $ekskuls->start_time = $request->start_time;
        $ekskuls->end_time = $request->end_time;
        $ekskuls->activity_date2 = $request->activity_date2;
        $ekskuls->start_time2 = $request->start_time2;
        $ekskuls->end_time2 = $request->end_time2;
        $ekskuls->location = $request->location;

        if ($request->hasFile('foto')) {
            $img = $request->file('foto');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('image/logoekskul', $name);
            $ekskuls->foto = $name;
        }

        $ekskuls->save();
        Alert('success', 'Data ekskul berhasil disimpan!');
        return redirect()->route('ekskul.index');

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
        $ekskuls = Ekskul::findOrFail($id);
        $pembina_id = User::where('role', 'pembina')->get();

        return view('admin.ekskul.edit', compact('ekskuls', 'pembina_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $ekskuls = Ekskul::findOrFail($id);

        $ekskuls->name = $request->name;
        $ekskuls->description = $request->description;
        $ekskuls->pembina_id = $request->pembina_id;
        $ekskuls->activity_date = $request->activity_date;
        $ekskuls->start_time = $request->start_time;
        $ekskuls->end_time = $request->end_time;
        $ekskuls->activity_date2 = $request->activity_date2;
        $ekskuls->start_time2 = $request->start_time2;
        $ekskuls->end_time2 = $request->end_time2;
        $ekskuls->location = $request->location;

        if ($request->hasFile('foto')) {
            $img = $request->file('foto');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('image/logoekskul', $name);
            $ekskuls->foto = $name;
        }

        $ekskuls->save();
        Alert('success', 'Data ekskul berhasil diubah!');
        return redirect()->route('ekskul.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ekskuls = Ekskul::findOrFail($id);
        $ekskuls->delete();
        Alert('success', 'Data berhasil dihapus')->autoClose(1000);
        return redirect()->route('ekskul.index');

    }

    // public function daftarEkskul(Request $request)
    // {

    //     $user = Auth::user();
    //     $siswa = Siswa::where('id_user', $user->id)->first();

    //     $ekskulId = $request->input('ekskul_id');

    //     SiswaEkskul::create([
    //         'siswa_id' => $siswa->id,
    //         'ekskul_id' => $ekskulId,
    //         'joined_at' => now(),
    //     ]);

    //     return response()->json(['message' => 'Berhasil mendaftar ekskul!']);
    // }
public function daftar(Request $request)
{
    $request->validate([
        'ekskul_id' => 'required|exists:ekskuls,id',
    ]);

    // Ambil ID siswa berdasarkan user yang login
    $user = Auth::user();
    $siswaId = Siswa::where('id_user', $user->id)->value('id'); // ✅ Ambil hanya ID

    // Pastikan siswa belum mendaftar ekskul ini
    $sudahMendaftar = DB::table('siswa_ekskuls')
        ->where('siswa_id', $siswaId)
        ->where('ekskul_id', $request->ekskul_id)
        ->exists();

    if ($sudahMendaftar) {
        return redirect()->back()->with('success', 'Anda sudah terdaftar dalam ekskul ini!');
    }

    // Simpan data ke tabel siswa_ekskuls
    DB::table('siswa_ekskuls')->insert([
        'siswa_id' => $siswaId, // ✅ Sekarang ini integer, bukan object!
        'ekskul_id' => $request->ekskul_id,
        'joined_at' => now(), 
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Pendaftaran berhasil!');
}

}