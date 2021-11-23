<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="backend/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="backend/assets/img/favicon.png">
    <title>
        UMKM A | {{ $title }}
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="backend/assets/css/nucleo.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="backend/assets/css/backend.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">

    @include('backend.partials.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg"">
        @include('backend.partials.navbar')
        @yield('content')
    </main>




    <script src=" backend/assets/js/backend-app.js">
        </script>
</body>
