<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
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

            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Design and Developed by
                    <a href="" target="_blank" class="pe-1 text-primary text-decoration-underline">
                        AdminMart.com
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
    @include('layouts.admin._scripts')
</body>

</html>
