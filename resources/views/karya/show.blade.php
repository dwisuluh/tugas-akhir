@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Karya Ilmiah</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ $title }}</a></li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
            <h2>{{ $karyaIlmiah->mahasiswa->name }}</h2>
            <h3>{{ $karyaIlmiah->mahasiswa->nim }}</h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="card-body pt-3">

            <h5 class="card-title">Data karyaIlmiah Ijin {{ $title }}</h5>

            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label ">Nama Lengkap</div>
              <div class="col-lg-10 col-md-8">: {{ $karyaIlmiah->mahasiswa->name }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">NIM</div>
              <div class="col-lg-10 col-md-8">: {{ $karyaIlmiah->nim }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">Judul</div>
              <div class="col-lg-9 col-md-10">{!! $karyaIlmiah->judul !!}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">Tanggal Ujian</div>
              <div class="col-lg-9 col-md-8">: {!! $karyaIlmiah->tgl_indo !!}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">Pembimbing 1</div>
              <div class="col-lg-9 col-md-8">: {!! $karyaIlmiah->pembimbing_1 !!}</div>
            </div>
            <div class="row mb-4">
              <div class="col-lg-2 col-md-2 label">Pembimbing 2</div>
              <div class="col-lg-9 col-md-8"> :{{ $karyaIlmiah->pembimbing_2 }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">File</div>
              <div class="col-lg-10 col-md-10">
                <iframe src="{{ url($file . '/' . $karyaIlmiah->filekarya->where('jenis_file', 1)->first()->file) }}"
                  align="top" height="720" width="100%" frameborder="0" scrolling="auto"></iframe>
              </div>
            </div>
            @if ($karyaIlmiah->status == 3)
            @endif
            <div class="row mt-3">
              <div class="text-start col-6">
                <a href="{{ url()->previous() }}" type="button" class="btn btn-danger"><i
                    class="bi bi-arrow-left-circle"></i> Back</a>
              </div>
              @if ($karyaIlmiah->status == 2)
                @can('admin')
                  <div class="col-6 text-end">
                    <a href="{{ route('files.show', $karyaIlmiah->id) }}" target="_blank" type="button"
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
@endsection
