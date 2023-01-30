@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Surat Ijin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Surat Ijin</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ $title }}</a></li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <div class="container">
    <section class="section profile">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <h2>{{ $surat->mahasiswa->name }}</h2>
              <h3>{{ $surat->mahasiswa->nim }}</h3>
              <div class="social-links mt-2">
                {{-- <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a> --}}
              </div>
            </div>
            <div class="card-body pt-3">

              <h5 class="card-title">Data Surat Ijin {{ $title }}</h5>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                <div class="col-lg-9 col-md-8">{{ $surat->mahasiswa->name }}</div>
              </div>

              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">NIM</div>
                <div class="col-lg-9 col-md-8">{{ $surat->nim }}</div>
              </div>
              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Tujuan</div>
                <div class="col-lg-9 col-md-8">{!! $surat->tujuan !!}</div>
              </div>
              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Alamat</div>
                <div class="col-lg-9 col-md-8">{!! $surat->alamat !!}</div>
              </div>
              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Judul</div>
                <div class="col-lg-9 col-md-8">{!! $surat->judul !!}</div>
              </div>
              <div class="row mb-2">
                <div class="col-lg-3 col-md-4 label">Tanggal Surat</div>
                <div class="col-lg-9 col-md-8">{{ $surat->tgl_indo }}</div>
              </div>
              @if ($surat->status == 3)
                <div class="row mb-2">
                  <div class="col-lg-3 col-md-4 label">File</div>
                  <div class="col-lg-9 col-md-8">
                    <iframe src="{{ url($fileSurat . '/' . $surat->files->file) }}" align="top" height="720"
                      width="100%" frameborder="0" scrolling="auto"></iframe>
                  </div>
                </div>
              @endif
              <div class="row mt-3">
                <div class="text-start col-6">
                  <a href="{{ url()->previous() }}" type="button" class="btn btn-danger"><i
                      class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
                @if ($surat->status == 2)
                  @can('admin')
                    <div class="col-6 text-end">
                      <a href="{{ route('files.show', $surat->id) }}" target="_blank" type="button"
                        class="btn btn-success"><i class="bi bi-printer"></i> Print</a>
                    </div>
                  @endcan
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
