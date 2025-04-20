@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Manajemen Siswa Ekskul</h4>
            </div>
            <div class="card-body">

                {{-- Filter Ekskul --}}
                <form method="GET" action="{{ route('siswaekskul.index') }}" class="row g-3 mb-4">
                    <div class="col-auto">
                        <select name="ekskul_id" onchange="this.form.submit()" class="form-select shadow-sm">
                            <option value="">-- Pilih Ekskul --</option>
                            @foreach ($ekskuls as $ekskul)
                                <option value="{{ $ekskul->id }}" {{ $selectedEkskul == $ekskul->id ? 'selected' : '' }}>
                                    {{ $ekskul->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <div class="row">
                    {{-- Tabel Semua Siswa --}}
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Semua Siswa</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="tabelSiswa" class="table table-bordered table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Kelas</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswas as $siswa)
                                                <tr>
                                                    <td>{{ $siswa->user->name }}</td>
                                                    <td>{{ $siswa->kelas->tingkat }} {{ $siswa->jurusan->nama }} {{ $siswa->gelombangbelajar->gelombang }}</td>
                                                    <td class="text-center">
                                                        @if ($selectedEkskul)
                                                            @php
                                                                $isJoined = $dataSiswaEkskul->where('siswa_id', $siswa->id)->count() > 0;
                                                            @endphp

                                                            @if ($isJoined)
                                                                <span class="badge bg-success">Terdaftar</span>
                                                            @else
                                                                <form action="{{ route('siswaekskul.store', [$selectedEkskul, $siswa->id]) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-success">
                                                                        <i class="bi bi-plus-circle"></i> Tambah
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <small class="text-muted">Pilih ekskul dulu</small>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel Siswa Ekskul --}}
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Data Siswa Ekskul</h5>
                            </div>
                            <div class="card-body">
                                @if ($selectedEkskul)
                                    <div class="table-responsive">
                                        <table id="tabelSiswaEkskul" class="table table-bordered table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kelas</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($dataSiswaEkskul as $item)
                                                    <tr>
                                                        <td>{{ $item->siswa->user->name }}</td>
                                                        <td>{{ $item->siswa->kelas->tingkat }} {{ $item->siswa->jurusan->nama }} {{ $item->siswa->gelombangbelajar->gelombang }}</td>
                                                        <td class="text-center">
                                                            <form action="{{ route('siswaekskul.destroy', [$selectedEkskul, $item->siswa_id]) }}" method="POST" onsubmit="return confirm('Yakin mau mengeluarkan siswa ini dari ekskul?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger">
                                                                    <i class="bi bi-x-circle"></i> Keluarkan
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center text-muted">Belum ada siswa di ekskul ini.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center text-muted">
                                        <p>Silakan pilih ekskul terlebih dahulu untuk melihat data siswa.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new DataTable('#tabelSiswa', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });

            new DataTable('#tabelSiswaEkskul', {
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        });
    </script>
@endpush
