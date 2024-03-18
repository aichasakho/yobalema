<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', "Yobalema") }} | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    @include('layouts.client._linkcss')

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

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcnTraR8rzs-NOYZ7jzGVBASwbd0dtsrE&callback=initMap"></script>

</body>

</html>
