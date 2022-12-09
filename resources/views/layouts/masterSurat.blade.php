<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">

<head>
  <title>Surat Cetak </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <style>
    * {
      margin: 2px;
      padding: 0;
    }

    p.one {
      line-height: 1.2;
    }

    p.indent {
      text-indent: 50px;
    }
    .space-text-1{
        line-height: 1;
    }
    .space-text-15{
        line-height: 1.5;
    }
    .space-text-2{
        line-height: 2;
    }

    #halaman {
      width: auto;
      /* height: auto; */
      position: absolute;
      /* border: 1px solid; */
      padding-top: 1px;
      padding-left: 1cm;
      padding-right: 1.0cm;
      padding-bottom: 80px;
      font-size: 12pt;
      font-family: 'Times New Roman', Times, serif;
    }

    #page {
      margin-left: 1.0cm;
      margin-right: 1.0cm;
    }

    .text-justify {
      text-align: justify;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    footer {
      margin-top: auto;
    }
    .text-ttd{
        margin-left: 12cm;
    }

    .footer {
      position: fixed;
      /* left: 0; */
      bottom: 0;
      width: 100%;
      /* background-color: red;
      color: white;
      text-align: center; */
    }
  </style>
</head>

<body>
  <div id="halaman">
    <div class="row"">
      <img src="{{ public_path('/plugins/img/kop-surat.png') }}" width="100%" alt="">
    </div>
    <div id="page">
        @yield('content')
        <div class="row">
            <div class="row mt-2">
              <div class="text-ttd">
                <p>Yogyakarta, @yield('tanggal')
                  <br>
                  Direktur,
                </p>
                <br>
                <br>
                <br>
                <p>Dra. Yuli Puspito Rini, M.Si.</p>
              </div>
            </div>
          </div>
    </div>
    <footer>
      <div class="row footer">
        <p class="one"> Program Studi: <br>
          D3 Farmasi (Akreditasi B)<br>
          D3 Rekam Medis dan Informasi Kesehatan (Akreditasi B)<br>
          D3 Teknologi Transfusi Darah (Akreditasi B)
          </p>
      </div>

    </footer>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>
