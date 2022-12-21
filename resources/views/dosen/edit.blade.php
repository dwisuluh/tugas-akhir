@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Data Dosen</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mahasiswa.index') }}">Dosen</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <section class="section">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Data Dosen</h5>
            <!-- Form Tamabah Data Dosen -->
            <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('data-dosen.update',$dosen->id) }}">
                @method('PUT')
              @csrf
              <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                    value="{{ old('nama',$dosen->nama) }}" required>
                  @error('nama')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6 text-start">
                  <a href="{{ url()->previous() }}" type="cancel" class="btn btn-danger text-start"> Cancel </a>
                </div>
                <div class="col-md-6 text-end">
                  <button type="submit" class="btn btn-primary"> Submit </button>
                </div>
              </div>
            </form><!-- End Form Tambah Data Dosen -->
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
