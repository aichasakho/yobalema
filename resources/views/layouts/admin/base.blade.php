<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yobalema</title>
    @include('layouts.admin._css')
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
     data-sidebar-position="fixed" data-header-position="fixed">

    @include('layouts.admin._sidebar')

    <!--  Main wrapper -->
    <div class="body-wrapper">

        @include('layouts.admin._header')

        <div class="container-fluid">
            <!--  Row 1 -->

            @yield('content')


        </div>
    </div>
</div>
    @include('layouts.admin._scripts')
</body>

</html>
