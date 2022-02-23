<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi kasir laravel">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/assets/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/argon.css?v=1.2.0') }}" type="text/css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- toastr --}}
    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/toastr.css') }}"> --}}

    {{-- Snackbar --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/snackbar.min.css') }}">
    <script src="{{ asset('/assets/js/snackbar.min.js') }}"></script>
    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>

    {{-- select 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    @inertia
    <!-- Argon Scripts -->
    <!-- Core -->
    
    <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->
    <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('/assets/js/argon.js?v=1.2.0') }}"></script>

    <!-- toastr -->
    {{-- <script src="{{ asset('/assets/js/toastr.min.js') }}"></script> --}}

    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/assets') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        @if (Session::has('success'))
            Snackbar.show({
            text: "{{ session('success') }}",
            backgroundColor: '#28a745',
            actionTextColor: '#212529',
            })
        @elseif (Session::has('error'))
            Snackbar.show({
            text: "{{ session('error') }}",
            backgroundColor: '#dc3545',
            actionTextColor: '#212529',
        })
        @elseif (Session::has('info'))
            Snackbar.show({
            text: "{{ session('info') }}",
            backgroundColor: '#17a2b8',
            actionTextColor: '#212529',
            })
        @endif
    </script>

    @yield('c_js')
</body>

</html>
