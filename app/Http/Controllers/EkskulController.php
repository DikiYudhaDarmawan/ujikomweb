<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Siswa;
use App\Models\User;
// use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Alert;
use Storage;
use DB;
use Illuminate\Http\Request;

class EkskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      confirmDelete('Delete', 'yakin?');

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
    // Validasi bahwa pembina tidak membina lebih dari satu ekskul
    $request->validate([
        'pembina_id' => 'required|unique:ekskuls,pembina_id',
        'activity_date' => 'required',
        'start_time' => 'required|before:end_time',
        'end_time' => 'required',
        'location' => 'required'
    ]);

    // Validasi bahwa tidak ada ekskul dengan hari, waktu, dan tempat yang sama
    $existingEkskul = Ekskul::where('activity_date', $request->activity_date)
        ->where('start_time', $request->start_time)
        ->where('end_time', $request->end_time)
        ->where('location', $request->location)
        ->first();

    if ($existingEkskul) {
        return back()->withErrors(['location' => 'Ekskul dengan waktu dan tempat ini sudah ada.'])->withInput();
    }

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
    // Hapus foto lama jika ada
    if ($ekskuls->foto && Storage::exists('public/' . $ekskuls->foto)) {
        Storage::delete('public/' . $ekskuls->foto);
    }

    $img = $request->file('foto');

    // Buat nama file unik
    $name = rand(1000, 9999) . '_' . time() . '.' . $img->getClientOriginalExtension();

    // Simpan file ke storage/app/public/logoekskul
    $img->storeAs('public/logoekskul', $name);

    // Simpan path relatif (tanpa asset!)
    $ekskuls->foto = 'logoekskul/' . $name;
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
    // Validasi bahwa pembina tidak membina lebih dari satu ekskul
    $request->validate([
        'pembina_id' => 'required|unique:ekskuls,pembina_id,' . $id,
        'activity_date' => 'required',
        'start_time' => 'required|before:end_time',
        'end_time' => 'required',
        'location' => 'required'
    ]);

    // Validasi bahwa tidak ada ekskul dengan hari, waktu, dan tempat yang sama
    $existingEkskul = Ekskul::where('activity_date', $request->activity_date)
        ->where('start_time', $request->start_time)
        ->where('end_time', $request->end_time)
        ->where('location', $request->location)
        ->where('id', '!=', $id)
        ->first();

    if ($existingEkskul) {
        return back()->withErrors(['location' => 'Ekskul dengan waktu dan tempat ini sudah ada.'])->withInput();
    }

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
    // Hapus foto lama jika ada
    if ($ekskuls->foto && Storage::exists('public/' . $ekskuls->foto)) {
        Storage::delete('public/' . $ekskuls->foto);
    }

    $img = $request->file('foto');

    // Buat nama file unik
    $name = rand(1000, 9999) . '_' . time() . '.' . $img->getClientOriginalExtension();

    // Simpan file ke storage/app/public/logoekskul
    $img->storeAs('public/logoekskul', $name);

    // Simpan path relatif (tanpa asset!)
    $ekskuls->foto = 'logoekskul/' . $name;
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

        // Gunakan SweetAlert untuk menampilkan pesan sukses
        Alert::success('Sukses', 'Data berhasil dihapus')->autoClose(1000);

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