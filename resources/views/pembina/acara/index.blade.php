@extends('layouts.pembina')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Data Acara</h6>
                    <a href="{{ route('acara.create') }}" class="btn btn-sm bg-gradient-primary">
                        <i class="fas fa-plus me-2"></i> Tambah Data Acara
                    </a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">No.</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">Nama Acara</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($acaras as $data)
                                <tr>
                                    <td class="px-4 py-3">{{ $i++ }}</td>
                                    <td class="px-4 py-3">{{ $data->nama }}</td>
                                    <td class="px-4 py-3">
                                        {{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            @if($data->presensis->isNotEmpty())
                                                <a href="{{ route('presensi.rekap', $data->id) }}" class="btn btn-sm bg-gradient-warning px-3 mb-0">
                                                    <i class="fas fa-list me-2"></i> Rekap
                                                </a>
                                            @else
                                                <a href="{{ route('presensi.create', $data->id) }}" class="btn btn-sm bg-gradient-success px-3 mb-0">
                                                    <i class="fas fa-user-check me-2"></i> Presensi
                                                </a>
                                            @endif
                                            <a href="{{ route('acara.edit', $data->id) }}" class="btn btn-sm bg-gradient-info px-3 mb-0">
                                                <i class="fas fa-pencil-alt me-2"></i> Edit
                                            </a>
                                            <form action="{{ route('acara.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus acara ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm bg-gradient-danger px-3 mb-0">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($acaras->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center py-4">Belum ada data acara.</td>
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
