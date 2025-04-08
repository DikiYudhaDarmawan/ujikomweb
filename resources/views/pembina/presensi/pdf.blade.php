<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Presensi {{ $acara->nama }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <h3 class="center">Rekap Presensi Acara</h3>
    <p><strong>Nama Acara:</strong> {{ $acara->nama }}</p>
    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($acara->tanggal)->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($presensis as $key => $item)
                <tr>
                    <td class="center">{{ $key + 1 }}</td>
                    <td>{{ $item->siswa->user->name }}</td>
                    <td class="center">{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <div style="text-align: right;">
        <p>Dicetak tanggal: {{ now()->format('d M Y') }}</p>
    </div>
</body>
</html>
