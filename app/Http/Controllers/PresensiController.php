<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Presensi;
use App\Models\SiswaEkskul;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PresensiController extends Controller
{
    public function show(Acara $acara)
    {
        // Ambil data siswa berdasarkan ekskul acara tersebut
        $data_siswa = SiswaEkskul::with('siswa.user')
            ->where('ekskul_id', $acara->ekskul_id)
            ->get();

        return view('pembina.presensi.show', compact('acara', 'data_siswa'));
    }

    public function store(Request $request, Acara $acara)
    {
        // Simpan atau update presensi per siswa
        foreach ($request->siswa_id as $key => $siswa_id) {
            Presensi::updateOrCreate(
                [
                    'acara_id' => $acara->id,
                    'siswa_id' => $siswa_id,
                ],
                [
                    'ekskul_id' => $acara->ekskul_id,
                    'keterangan' => $request->keterangan[$key],
                ]
            );
        }

        return redirect()->route('acara.index')->with('success', 'Presensi berhasil disimpan');
    }

    public function rekap(Acara $acara)
    {
        $presensis = Presensi::where('acara_id', $acara->id)
            ->with('siswa.user')
            ->get();

        return view('pembina.presensi.rekap', compact('acara', 'presensis'));
    }

   public function edit($acara_id)
{
    $acara = Acara::findOrFail($acara_id);

    $siswaEkskuls = SiswaEkskul::with([
    'siswa.user',
    'presensi' => function ($query) use ($acara_id) {
        $query->where('acara_id', $acara_id);
    },
])->where('ekskul_id', $acara->ekskul_id)
    ->get();


    return view('pembina.presensi.edit_rekap', compact('acara', 'siswaEkskuls'));
}

public function update(Request $request, $acara_id)
{

    $request->validate([
        'presensi' => 'required|array',
        'presensi.*.siswa_id' => 'required|integer',
        'presensi.*.keterangan' => 'required|string',
    ]);

    foreach ($request->presensi as $data) {
        Presensi::updateOrCreate(
            [
                'acara_id' => $acara_id,
                'siswa_id' => $data['siswa_id'],
            ],
            [
                'keterangan' => $data['keterangan'],
            ]
        );
    }

    return redirect()->route('acara.index')->with('success', 'Rekap presensi berhasil diperbarui');
}


public function exportPdf($acara_id)
{
    $acara = Acara::findOrFail($acara_id);
    $presensis = Presensi::where('acara_id', $acara_id)->get();

    $pdf = Pdf::loadView('pembina.presensi.pdf', compact('acara', 'presensis'))
        ->setPaper('A4', 'portrait');

    return $pdf->download('Rekap-Presensi-'.$acara->nama.'.pdf');
}

}