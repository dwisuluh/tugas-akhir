@extends('layouts.app')
@section('content')
  <div class="pagetitle">
    <h1>Data Mahasiswa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Mahasiswa</li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Upload</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
              Upload File Data Mahasiswa
            </h5>
            <p>
              Aturan susunan kolom file excel:<br>
              <code>NIM | Nama | Jenis Kelamin [Laki-laki:1|Perempuan:2] | Program Studi [Rekam Medis:1 | Teknologi Transfusi Darah:2 | Farmasi:3] | NIK | Tempat Lahir | Tgl Lahir[2022-12-01]
              </code><br>
              Pastikan pada kolom tanggal format text bukan format Date pada excel
            </p>
            <!-- General Form Elements -->
            <form class="needs-validation" novalidate action="{{ route('data-mahasiswa') }}" method="POST"
              enctype="multipart/form-data">
              {{-- @method('PUT') --}}
              @csrf
              {{-- <input type="hidden" value="{{ Auth::user()->mahasiswa->id }}" name=""> --}}
              <div class="row mb-3">
                <label for="formFile" class="col-sm-2 col-form-label">File Upload</label>
                <div class="col-sm-10">
                  <input class="form-control @error('file') is-invalid
                      @enderror" type="file"
                    id="formFile" name="file" required>
                  @error('file')
                    <span class="invalid-feedback" role="alert">
                      {{ $message }}
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6 text-start">
                  <a type="button" href="{{ url()->previous() }}" class="btn btn-danger text-start"> Cancel
                  </a>
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
