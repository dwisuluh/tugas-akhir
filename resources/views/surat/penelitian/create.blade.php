@extends('layouts.app')
@section('content')
  <div class="pagetitle">
    <h1>Surat Ijin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Surat Ijin</li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}"> Penelitian </a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  @switch(Auth::user()->mahasiswa->program_studi)
    @case(1)
      @php
        $prodi = 'Rekam Medis dan Teknologi Kesehatan';
      @endphp
    @break

    @case(2)
      @php
        $prodi = 'Teknologi Transfusi Darah';
      @endphp
    @break

    @case(3)
      @php
        $prodi = 'Farmasi';
      @endphp

      @default
    @endswitch

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pengajuan Ijin Penelitian</h5>

              <!-- General Form Elements -->
              <form class="needs-validation" novalidate action="{{ route('penelitian.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">NIM</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ Auth::user()->mahasiswa->nim }}" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $prodi }}" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="tujuan" class="col-sm-2 col-form-label">Tujuan Surat</label>
                  <div class="col-sm-10">
                    <input id="tujuan" type="hidden" name="tujuan" value="{{ old('tujuan') }}">
                    <trix-editor input="tujuan"
                      class="@error('tujuan')
                      is-invalid
                  @enderror"></trix-editor>
                    @error('tujuan')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat Instansi</label>
                  <div class="col-sm-10">
                    <input id="alamat" type="hidden" name="alamat" value="{{ old('alamat') }}">
                    <trix-editor input="alamat"
                      class="@error('alamat')
                      is-invalid
                  @enderror"></trix-editor>
                    @error('alamat')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Judul" class="col-sm-2 col-form-label">Judul Karya Tulis Ilmiah</label>
                  <div class="col-sm-10">
                    <input id="judul" type="hidden" name="judul" value="{{ old('judul') }}">
                    <trix-editor input="judul"
                      class="@error('judul')
                      is-invalid
                  @enderror"></trix-editor>
                    @error('judul')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Penelitian</label>
                  <div class="col-sm-10">
                    <input id="lokasi" type="hidden" name="lokasi" value="{{ old('lokasi') }}">
                    <trix-editor input="lokasi"
                      class="@error('lokasi')
                      is-invalid
                  @enderror"></trix-editor>
                    @error('lokasi')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Pelaksanaan</label>
                  <div class="col-sm-4">
                    <input type="date" class="form-control" @error('tgl_awal')
                        is-invalid
                    @enderror name="tgl_awal" required>
                  </div>
                  <label for="inputDate" class="col-sm-1 col-form-label"> Sampai </label>
                  <div class="col-sm-4">
                    <input type="date" class="form-control @error('tgl_akhir')
                        is-invalid
                    @enderror" name="tgl_akhir" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6 text-start">
                    <a href="{{ url()->previous() }}" type="submit" class="btn btn-danger text-start"> Cancel </a>
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
