@extends('layouts.siswa')
@section('content')
    <section class="closed-contests">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading text-center">
                        <h6>Daftar Ekskul</h6>
                        <h4><em>Kembangkan minat dan bakatmu</em> dengan mengikuti <em>ekskul yang kamu senangi</em></h4>
                    </div>
                </div>
                @foreach ($ekskul as $data)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-lg border-0">
                            <img src="{{ asset('siswa/assets/images/closed-01.jpg') }}" class="card-img-top"
                                alt="Gambar Ekskul">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $data->name }}</h5>
                                <p class="text-muted">Lorem ipsum dolor sit amet.</p>

                                @if (in_array($data->id, $ekskulDiikuti))
                                    <button class="btn btn-secondary" disabled>Anda sudah mendaftar</button>
                                @else
                                    <button class="btn btn-primary daftar-ekskul"
                                        data-ekskul-id="{{ $data->id }}">Daftar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="col-lg-12">
                    <div class="border-button text-center">
                        <a href="">lihat lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.daftar-ekskul', function() {
            var ekskulId = $(this).data('ekskul-id');

            $.ajax({
                url: "{{ route('daftarEkskul') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ekskul_id: ekskulId
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message);
                }
            });
        });
    </script>
@endsection
