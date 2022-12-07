<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'E-Layanan') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
  <!-- Favicons -->
  <link href="{{ asset('/') }}plugins/img/logo-bsi.png" rel="icon">
  <link href="{{ asset('/') }}plugins/img/logo-bsi.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/') }}plugins/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  {{-- <link href="{{ asset('/') }}plugins/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File --> --}}
  <link href="{{ asset('/') }}plugins/css/style.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">

    @yield('content')

  <!-- Vendor JS Files -->
  {{-- <script src="{{ asset('/') }}plugins/vendor/apexcharts/apexcharts.min.js"></script> --}}
  <script src="{{ asset('/') }}plugins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  {{-- <script src="{{ asset('/') }}plugins/vendor/chart.js/chart.min.js"></script> --}}
  <script src="{{ asset('/') }}plugins/vendor/echarts/echarts.min.js"></script>
  {{-- <script src="{{ asset('/') }}plugins/vendor/quill/quill.min.js"></script> --}}
  {{-- <script src="{{ asset('/') }}plugins/vendor/simple-datatables/simple-datatables.js"></script> --}}
  <script src="{{ asset('/') }}plugins/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('/') }}plugins/js/main.js"></script>
</body>

</html>
