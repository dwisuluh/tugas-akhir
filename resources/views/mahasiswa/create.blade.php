@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Mahasiswa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}">Mahasiswa</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <section class="section">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tambah Data Mahasiswa</h5>

            <!-- General Form Elements -->
            <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('mahasiswa.store') }}">
              @csrf
              <div class="row mb-3">
                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                    value="{{ old('nim') }}" required>
                  @error('nim')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1" value="1"
                      required>
                    <label class="form-check-label" for="gridRadios1">
                      Laki-laki
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2" value="2">
                    <label class="form-check-label" for="gridRadios2">
                      Perempuan
                    </label>
                  </div>
              </fieldset>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-6">
                  <select class="form-select" aria-label="Default select example" name="prodi" required>
                    <option></option>
                    <option value="1">Rekam Medis dan Informasi Kesehatan</option>
                    <option value="2">Teknologi Bank Darah</option>
                    <option value="3">Farmasi</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                {{-- <label class="col-sm-2 col-form-label"></label> --}}
                <div class="col-md-6 text-start">
                  <a href="{{ url()->previous() }}" type="cancel" class="btn btn-danger text-start"> Cancel </a>
                </div>
                <div class="col-md-6 text-end">
                  <button type="submit" class="btn btn-primary"> Submit </button>
                </div>
              </div>

            </form><!-- End General Form Elements -->

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
