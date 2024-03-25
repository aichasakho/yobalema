<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', "Yobalema") }} | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">


    @include('layouts.client._linkcss')


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


</head>

<body>




    <!-- App Header -->
    @include('layouts.client._navbar')

    <!-- Start Content -->
    @yield('content')
    <!-- End Content -->

    <!-- App Footer -->
    @include('layouts.client._footer')



@include('layouts.client._scripts')

{{--    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcnTraR8rzs-NOYZ7jzGVBASwbd0dtsrE&callback=initMap"></script>--}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
