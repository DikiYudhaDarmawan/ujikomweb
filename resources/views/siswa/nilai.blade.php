@extends('layouts.siswa2')


@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-center">
            Nilai ekskul
                - {{ $ekskul->name }}
        </h2>
        @if ($evaluasi->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada nilai evaluasi yang tersedia.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Grade</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evaluasi as $data)
                            <tr>
                                <td>{{ $data->grade }}</td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="text-center mt-4">
            <a href="{{ route('siswa.ekskulku') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left"></i> Kembali ke Ekskul Ku
            </a>
        </div>
    </div>
@endsection
