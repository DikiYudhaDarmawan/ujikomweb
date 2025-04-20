<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Acara;
use App\Models\Presensi;
use App\Models\SiswaEkskul;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function show(Acara $acara)
    {
        // Ambil data siswa berdasarkan ekskul acara tersebut
        $data_siswa = SiswaEkskul::with('siswa.user')
            ->where('ekskul_id', $acara->ekskul_id)
            ->get();
        confirmDelete('Delete', 'yakin?');

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
        Alert::success('success', "Presensi berhasil disimpan")->autoClose(1000);

        return redirect()->route('acara.index');
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
            'presensis' => function ($query) use ($acara_id) {
                $query->where('acara_id', $acara_id);
            },
        ])->where('ekskul_id', $acara->ekskul_id)->get();

        return view('pembina.presensi.edit_rekap', compact('acara', 'siswaEkskuls'));
    }

   public function update(Request $request, $acara_id)
{
    $request->validate([
        'presensi' => 'required|array',
        'presensi.*.siswa_id' => 'required|integer',
        'presensi.*.keterangan' => 'required|string',
    ]);

    $acara = Acara::findOrFail($acara_id); 

    foreach ($request->presensi as $data) {
        Presensi::updateOrCreate(
            [
                'acara_id' => $acara_id,
                'siswa_id' => $data['siswa_id'],
            ],
            [
                'keterangan' => $data['keterangan'],
                'ekskul_id' => $acara->ekskul_id, 
            ]
        );
    }

    Alert::success('success', "Rekap presensi berhasil diperbarui")->autoClose(1000);
    return redirect()->route('acara.index');
}

    public function exportPdf($acara_id)
    {
        $acara = Acara::findOrFail($acara_id);
        $presensis = Presensi::where('acara_id', $acara_id)->get();

        $pdf = Pdf::loadView('pembina.presensi.pdf', compact('acara', 'presensis'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Rekap-Presensi-' . $acara->nama . '.pdf');
    }

}