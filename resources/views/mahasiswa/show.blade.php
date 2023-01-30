@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Mahasiswa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Mahasiswa</a></li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
            <h2>{{ $mahasiswa->name }}</h2>
            <h3>{{ $mahasiswa->nim }}</h3>
            {{-- <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> --}}
          </div>
          <div class="card-body pt-3">

            <h5 class="card-title">Profile Details</h5>

            <div class="row">
              <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
              <div class="col-lg-9 col-md-8">{{ $mahasiswa->name }}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">NIM</div>
              <div class="col-lg-9 col-md-8">{{ $mahasiswa->nim }}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
              <div class="col-lg-9 col-md-8">{{ $mahasiswa->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4 label">NIK</div>
              <div class="col-lg-9 col-md-8">{{ $mahasiswa->nik }}</div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
              <div class="col-lg-9 col-md-8">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tgl_lahir }}</div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4 label">Program Studi</div>
              <div class="col-lg-9 col-md-8">
                @switch($mahasiswa->program_studi)
                  @case(1)
                    {{ 'Rekam Medis dan Informasi Kesehatan' }}
                  @break

                  @case(2)
                    {{ 'Teknologi Bank Darah' }}
                  @break

                  @case(3)
                    {{ 'Farmasi' }}
                  @break

                  @default
                @endswitch

              </div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Status</div>
              <div class="col-lg-9 col-md-8">{!! $mahasiswa->status == true
                  ? 'Aktif'
                  : 'Belum Aktif <a class="btn btn-primary btn-sm"><i class="bi bi-check-circle"></i></a>' !!}</div>
            </div>

            <div class="row">
              <div class="col-lg-3 col-md-4 label">Email</div>
              <div class="col-lg-9 col-md-8">{{ $mahasiswa->email }}</div>
            </div>
            <div class="ms-auto text-end">
              <a href="{{ url()->previous() }}" type="button" class="btn btn-danger text-end"><i
                  class="bi bi-arrow-left-circle"></i> Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
