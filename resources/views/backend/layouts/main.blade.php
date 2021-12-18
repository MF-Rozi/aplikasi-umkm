<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="backend/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="backend/assets/img/favicon.png">
    <title>
        UMKM A | {{ $title }}
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('backend/assets/css/backend.css')}}" rel="stylesheet" />
    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/datatables.min.css" />
    <script type=" text/javascript" src="{{ asset('backend/assets/js/backend.js') }}"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">

    @include('backend.layouts.partials.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        @include('backend.layouts.partials.navbar')
        @yield('content')
    </main>








    <script src=" {{asset('backend/assets/js/core/popper.min.js')}}">
    </script>
    <script src="{{asset('backend/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins/chartjs.min.js')}}"></script>
    <script type=" text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js">
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>

    <script src="{{asset('backend/assets/js/soft-ui-dashboard.min.js?v=1.0.3')}}"></script>

    @include('sweetalert::alert')

    @yield('script-body')

</body>

@yield('script-after')
