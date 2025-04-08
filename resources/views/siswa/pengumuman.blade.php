@extends('layouts.siswa2')


@section('content')
<div class="container py-5">
  <!-- Header dengan background gradasi -->
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body text-center text-dark">
      <h2 class="card-title mb-0">Pengumuman - {{ $ekskul->name }}</h2>
    </div>
  </div>

  @if($pengumuman->isEmpty())
    <div class="alert alert-info text-center">
      Tidak ada pengumuman untuk ekskul ini.
    </div>
  @else
    <div class="row">
      @foreach($pengumuman as $item)
        <div class="col-md-6 mb-4">
          <div class="card h-100 shadow-sm border-0">
            @if ($item->foto)
              <img src="{{ asset('assets/pengumuman/' . $item->foto) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
            @else
             <img src="{{asset('assets/foto/noimage.jpeg')}}" class="card-img-top" style="height: 250px; object-fit: cover;">
            @endif
            <div class="card-body">
              <h5 class="card-title" style="color: #333;">{{ $item->judul }}</h5>
              <p class="card-text" style="color: #555;">{{ Str::limit($item->description, 150) }}</p>
            </div>
            <div class="card-footer bg-light">
              <small class="text-muted">
                Diumumkan pada: {{ $item->created_at->format('d M Y') }}
              </small>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif

  <div class="text-center mt-4">
    <a href="{{ route('siswa.ekskulku') }}" class="btn btn-outline-primary">
      <i class="bi bi-arrow-left"></i> Kembali ke Ekskul Ku
    </a>
  </div>
</div>
@endsection
