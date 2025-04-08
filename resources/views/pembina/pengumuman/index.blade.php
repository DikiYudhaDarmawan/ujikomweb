@extends('layouts.pembina')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Data Pengumuman</h6>
                        <a href="{{ route('pengumuman.create') }}" class="btn btn-sm bg-gradient-primary">
                            <i class="fas fa-plus me-2"></i> Tambah Data pengumuman
                        </a>
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
                                        Judul</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        descriprion</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3">
                                        foto</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4 py-3 text-center">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($pengumuman as $data)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $i++ }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $data->judul }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm ">{{ $data->description }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($data->foto)
                                                <img src="{{ asset('image/fotopengumuman/' . $data->foto) }}" width="50"
                                                    height="50"style="border-radius: 50%">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        <td class="align-middle text-center">
                                            <div class="d-flex ms-auto justify-content-center basg-2">
                                                <a href="{{ route('pengumuman.edit', $data->id) }}"
                                                    class="btn btn-sm bg-gradient-info px-3 mb-0">
                                                    <i class="fas fa-pencil-alt me-2"></i>Edit
                                                </a>
                                                <form action="{{ route('pengumuman.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm bg-gradient-danger px-3 mb-0">
                                                        <i class="fas fa-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
