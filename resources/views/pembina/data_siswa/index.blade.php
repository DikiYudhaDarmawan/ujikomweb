@extends('layouts.pembina')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6>Data Siswa - {{ $ekskul->name }}</h6>
                            </div>
                            {{--
                            <form action="{{ route('datasiswa.index') }}" method="GET" class="row g-2 mt-3">
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari Nama Siswa..." value="{{ request('search') }}">
                                </div>

                                <div class="col-md-3">
                                    <select name="kelas" class="form-control">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelass as $kls)
                                            <option value="{{ $kls->id }}"
                                                {{ request('kelas') == $kls->id ? 'selected' : '' }}>
                                                {{ $kls->tingkat }} {{ $kls->jurusan?->nama ?? '-' }}
                                                {{ $kls->gelombang?->gelombang ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <select name="jurusan" class="form-control">
                                        <option value="">-- Pilih Jurusan --</option>
                                        @foreach ($jurusans as $jrs)
                                            <option value="{{ $jrs->id }}"
                                                {{ request('jurusan') == $jrs->id ? 'selected' : '' }}>
                                                {{ $jrs->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">Filter</button>
                                    <a href="{{ route('datasiswa.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>

                        </div> --}}

                        <table class="table align-items-center mb-0" id="myTable">
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
                                            {{ $data->siswa->jurusan->nama }} {{ $data->siswa->gelombang_belajar_id }}
                                        </td>
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
@push('javascript')
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush
