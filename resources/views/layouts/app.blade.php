<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta http-equiv="refresh" content="10" >Í --}}

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
  <link href="{{ asset('/') }}plugins/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/dist/css/select2.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/css/style.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/css/trix.css" rel="stylesheet">

  <script src="{{ asset('/') }}plugins/js/trix.umd.min.js"></script>
  @livewireStyles

  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display: none
    }
  </style>

  @yield('head')


</head>

<body class="d-flex flex-column min-vh-100">

  @guest
    <main>
      <div class="container">
        @include('partials.navout')
      </div>
      <div class="row">
        @yield('content')
      </div>
    </=>
  @endguest
  @auth
    <div id="app">
      @include('partials.navbar')
      @include('partials.aside')

      <main id="main" class="main">
        @yield('content')
      </main>


    </div>
    <footer id="footer" class="footer mt-auto bg-light">
      <div class="copyright">
        &copy; Copyright <strong><span>Poltekkes BSI</span></strong>. All Rights Reserved
      </div>
    </footer><!-- End Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>
  @endauth
  <!-- Vendor JS Files -->
  <script type="text/javascript"
    src="{{ URL::asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}"></script>
  <script src="{{ asset('/') }}plugins/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/chart.js/chart.min.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('/') }}plugins/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('/') }}plugins/dist/js/select2.min.js"></script>
  <script src="{{ asset('/') }}plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ asset('/') }}plugins/datepicker/locales/bootstrap-datepicker.id.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script> --}}

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

  <!-- Template Main JS File -->
  <script src="{{ asset('/') }}plugins/js/main.js"></script>
  @livewireScripts
  <script>
    $(document).ready(function() {
      $('#pembimbing').select2({
        placeholder: "Pilih Dosen.....",
        minimumInputLength: 3,
        required: true,
        allowClear: true,
        autoclose: true,
        width: 'resolve',
        // width: '300px',
        // dropdownCssClass: "bigdrop"
      });
      $('#my-select2').select2({
        placeholder: "Pilih Dosen.....",
        minimumInputLength: 3,
        required: true,
        allowClear: true,
        width: 'resolve',
        // maximumSelectionLength: 2,
        autoclose: true,
      });
    });
    $('.input-daterange').datepicker({
      format: "dd/mm/yyyy",
      clearBtn: true,
      language: "id",
      //   autoclose: true,
      todayHighlight: true,
      toggleActive: true
    });
    $('.datepicker').datepicker({
      changeMonth: true,
      changeYear: true,
      language: "id",
      format: "dd/mm/yyyy",
      autoclose: true,
      allowClear: true,
      immediateUpdates: true,
      todayHighlight: true,
    });
    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    });
  </script>
  @yield('script')
</body>

</html>
