<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Gelombang_belajar;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $user = $query->latest()->get();
        confirmDelete('Delete', 'yakin?');
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $jurusans = Jurusan::all();
        $gelombang_belajars = Gelombang_belajar::all();

        return view('admin.user.create', compact('kelas', 'jurusans', 'gelombang_belajars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        if ($request->role === 'siswa') {
            $siswa = new Siswa;
            $siswa->id_user = $user->id;
            $siswa->jenis_kelamin = $request->jenis_kelamin;
            $siswa->kelas_id = $request->kelas_id;
            $siswa->jurusan_id = $request->jurusan_id;
            $siswa->gelombang_belajar_id = $request->gelombang_belajar_id;
            $siswa->nomor_telp = $request->nomor_telp;
            $siswa->save();
        }
        Alert::success('success', "data berhasil ditambah")->autoClose(1000);

        return redirect()->route('user.index');
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
    $user = User::findOrFail($id);
    $siswa = null;
    $kelas = Kelas::all();
    $jurusans = Jurusan::all();
    $gelombang_belajars = Gelombang_belajar::all();

   
    if ($user->role === 'siswa') {
        $siswa = Siswa::where('id_user', $id)->first(); 
    }

    return view('admin.user.edit', compact('user', 'siswa', 'kelas', 'jurusans', 'gelombang_belajars'));
}


    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    // Update password only if a new password is provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    if ($request->role === 'siswa') {
        // Check if the user has associated siswa record
        $siswa = Siswa::where('id_user', $id)->first();

        if (!$siswa) {
            // If no siswa found, create a new siswa
            $siswa = new Siswa();
            $siswa->id_user = $id;
        }

        // Update siswa data
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->jurusan_id = $request->jurusan_id;
        $siswa->gelombang_belajar_id = $request->gelombang_belajar_id;
        $siswa->nomor_telp = $request->nomor_telp;
        $siswa->save();
    }

    Alert::success('success', "Data berhasil diperbarui")->autoClose(1000);
    return redirect()->route('user.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Alert::success('success', 'Data berhasil dihapus')->autoClose(1000);
        return redirect()->route('user.index');
    }
    public function updateStatus(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->status = $request->has('status') ? 1 : 0;
            $user->save();
        }
        return redirect()->ack();
    }
}