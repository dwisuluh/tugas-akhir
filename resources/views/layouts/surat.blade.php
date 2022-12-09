<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>Surat</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'E-Layanan') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
  <!-- Favicons -->
  <link href="{{ public_path('/plugins/img/logo-bsi.png') }}" rel="icon">
  <link href="{{ public_path('/plugins/img/logo-bsi.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  {{-- <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- Vendor CSS Files -->
  {{-- <link href="{{ public_path('/plugins/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
  {{-- <link href="{{ asset('/') }}plugins/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('/') }}plugins/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"> --}}

  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> --}}
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" /> --}}
  {{-- <style>
    #judul {
      text-align: center;
    }

    #halaman {
      width: auto;
      height: auto;
      position: absolute;
      /* border: 1px solid; */
      padding-top: 1px;
      padding-left: 30px;
      padding-right: 30px;
      padding-bottom: 80px;
      font-size: 12pt;
    }

    * {
      margin: 1;
      padding: 0;
    }

    .judul {
      width: 100%;
      font-size: 14px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
      margin-top: 20px;
    }

    .kop-surat {
      width: 100%;
      font-size: 14px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
      margin-top: 10px;
    }

    .content {
      margin-left: 20px;
      margin-top: 20px;
      margin-bottom: 20px;
      margin-right: 20px;
    }

    .table-padding {
      border-collapse: collapse;
      border: 2px solid black;
      padding: 5px;
      font-size: 18px;
      text-align: left;
      width: 100%;
    }

    th.lima {
      width: 5%;
      text-align: left;
      border-collapse: collapse;
      border: 2px solid black;
      padding: 5px;
    }

    th.dua {
      width: 25%;
      text-align: left;
      border-collapse: collapse;
      border: 2px solid black;
      padding: 5px;
    }

    th.tiga {
      width: 40%;
      text-align: left;
      border-collapse: collapse;
      border: 2px solid black;
      padding: 5px;
    }

    /* td {
      border-collapse: collapse;
      border: 2px solid black;
    } */
  </style> --}}
  <style type="text/css">
    * {
      margin: 1;
      padding: 0;
      /* margin-right: 5; */
    }

    .kop-surat {
      width: 100%;
      font-size: 14px;
      margin-left: 0.5cm auto;
      margin-right: 0.5cm auto;
      text-align: center;
      margin-top: 10px;
    }

    page {
      background: white;
      display: block margin: 0 auto;
      margin-bottom: 0.5cm;
    }

    page[size="A4"] {
      width: 20cm;
      height: 29.7cm;
    }

    #halaman {
      width: auto;
      height: auto;
      position: absolute;
      /* border: 1px solid; */
      padding-top: 1px;
      padding-left: 1cm;
      padding-right: 1.0cm;
      padding-bottom: 80px;
      font-size: 12pt;
      font-family: 'Times New Roman', Times, serif;
    }

    #font {
      font-size: 12pt;
      font-family: 'Times New Roman', Times, serif;
      margin-left: 1.5cm;
      margin-right: 1.5cm;
      /* text-align: justify; */
    }

    .text-style {
      text-align: justify;
    }

    .spasi {
      margin-top:
    }

    .awal {
      text-indent: 50px;
    }

    .ttd {
      margin-left: 10cm;
      text-align: left;
      float: left;
    }

    table td,
    table td * {
      vertical-align: top;
    }

    /* .footer {
      clear: both;
      position: absolute;
      height: 200px;
      margin-top: 100px;
      position: relative;
      bottom: 10px;
      width: 50%;
    } */
  </style>
</head>

<body>
  <page size="A4">
    <div class="row kop-surat mt-2">
      <div class="col-sm-12 ml-2">
        <img src="{{ public_path('/plugins/img/kop-surat.png') }}" width="100%" alt="">
      </div>
    </div>
    <div class="row">
      <div class="container" id="font" style="width: 16cm">
        {{-- <div id="halaman"> --}}
        @yield('content')
      </div>
    </div>
    <div class="row" id="font">
      <div class="row mt-5">
        <div class="col-sm-12">
          <p>
            < Program Studi: <br>
              D3 Farmasi (Akreditasi B)<br>
              D3 Rekam Medis dan Informasi Kesehatan (Akreditasi B)<br>
              D3 Teknologi Transfusi Darah (Akreditasi B)
          </p>
        </div>
      </div>
    </div>
  </page>
  {{-- <script src="{{ asset('/') }}plugins/vendor/apexcharts/apexcharts.min.js"></script> --}}
  {{-- <script src="{{ public_path('/plugins/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <!-- Template Main JS File -->
  {{-- <script src="{{ asset('/') }}plugins/js/main.js"></script> --}}
</body>

</html>
