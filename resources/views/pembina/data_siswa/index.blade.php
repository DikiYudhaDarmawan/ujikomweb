@extends('layouts.pembina')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Data Siswa - {{ $ekskul->name }}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        No.</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Nama</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        Kelas</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Telepon</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($data_siswa as $data)
                                    <tr>
                                        <td class="px-4 py-3">{{ $i++ }}</td>
                                        <td class="px-4 py-3">{{ $data->siswa->user->name }}</td>
                                        <td class="px-4 py-3">{{ $data->siswa->kelas->tingkat }}
                                            {{ $data->siswa->jurusan->nama }} {{ $data->siswa->gelombang_belajar_id }}</td>
                                        <td class="px-4 py-3 text-center">{{ $data->siswa->nomor_telp }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('evaluasi.show', ['evaluasi' => $data->id]) }}"
                                                class="btn btn-sm bg-gradient-primary">
                                                <i class="fas fa-eye me-1"></i> Lihat Nilai
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($data_siswa->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center py-3">
                                            <span class="text-muted">Belum ada siswa yang mendaftar</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
