<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <title>SnapX Photography by TemplateMo</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('siswa/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('siswa/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('siswa/assets/css/templatemo-snapx-photography.css') }}">
    <link rel="stylesheet" href="{{ asset('siswa/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('siswa/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!--

TemplateMo 576 SnapX Photography

https://templatemo.com/tm-576-snapx-photography

-->
</head>

<body>


    <!-- ***** Header Area Start ***** -->
    @include('layouts.siswa.nav')
    <!-- ***** Header Area End ***** -->


    <!-- ***** Main Banner Area Start ***** -->
    @include('layouts.siswa.mainBanner')
    <!-- ***** Main Banner Area End ***** -->

    @yield('content')

    @include('layouts.siswa.footer')

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('siswa/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('siswa/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('siswa/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('siswa/assets/js/owl-carousel.js') }}"></script>

    <script src="{{ asset('siswa/assets/js/tabs.js') }}"></script>
    <script src="{{ asset('siswa/assets/js/popup.js') }}"></script>
    <script src="{{ asset('siswa/assets/js/custom.js') }}"></script>

</body>

</html>
