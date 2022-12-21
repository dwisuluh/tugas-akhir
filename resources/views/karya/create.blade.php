@extends('layouts.app')
@section('head')
@endsection
@section('content')
  <div class="pagetitle">
    <h1>Karya Ilmiah</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}"> {{ $title }} </a></li>
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
              <h5 class="card-title">Upload {{ $title }}</h5>

              <!-- General Form Elements -->
              <form class="needs-validation" novalidate action="{{ route($link . '.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ Auth::user()->mahasiswa->id }}" name="id_mhs">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">NIM</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ Auth::user()->mahasiswa->nim }}" name="nim"
                      readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name" readonly>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $prodi }}" readonly>
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
                  <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Ujian</label>
                  <div class="col-sm-4">
                    <div class='input-group date'>
                      <input type="text"
                        class="form-control datepicker @error('tgl_ujian')
                          is-invalid
                      @enderror" value="{{ old('tgl_ujian') }}"
                        placeholder="Tanggal Ujian" aria-label="tanggal ujian" aria-describedby="basic-addon2" name="tgl_ujian"
                        required>
                      <span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar-date"></i></span>
                      @error('tgl_ujian')
                        <span class='invalid-feedback' role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Pembimbing1" class="col-sm-2 col-form-label">Pembimbing 1</label>
                  <div class="col-sm-6">
                    <select
                      class="form-select @error('pembimbing1')
                        is-invalid
                    @enderror"
                      id="my-select2" aria-label="Default select example" name="pembimbing1"
                      style="width: 50%; font-size:15px" required>
                      <option></option>
                      @foreach ($dosens as $dosen)
                        <option>{{ $dosen->nama }}</option>
                      @endforeach
                    </select>
                    @error('pembimbing1')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Pembimbing2" class="col-sm-2 col-form-label">Pembimbing 2</label>
                  <div class="col-sm-6">
                    <select class="form-select @error('pembimbing2')
                        is-invalid @enderror"
                      aria-label="Default select example" id="pembimbing" style="width: 50%; font-size:20px"
                      name="pembimbing2">
                      <option></option>
                      @foreach ($dosens as $dosen)
                        <option>{{ $dosen->nama }}</option>
                      @endforeach
                    </select>
                    @error('pembimbing[]')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="formFile" class="col-sm-2 col-form-label">Upload Naskah KTI</label>
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
