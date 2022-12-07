@extends('layouts.app')
@section('content')
  <div class="pagetitle">
    <h1>Surat Ijin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Surat Ijin</li>
        <li class="breadcrumb-item active">Penelitian</li>
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
            $prodi = 'Teknologi Bank Darah';
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
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pengajuan Ijin Penelitian</h5>

            <!-- General Form Elements -->
            <form>
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
                <label for="inputPassword" class="col-sm-2 col-form-label">Instansi Tujuan</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="height: 100px"></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Judul Karya Tulis Ilmiah</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="height: 100px"></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Alamat Instansi</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="height: 100px"></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Pelaksanaan</label>
                <div class="col-sm-4">
                  <input type="date" class="form-control">
                </div>
                <label for="inputDate" class="col-sm-1 col-form-label"> Sampai </label>
                <div class="col-sm-4">
                    <input type="date" class="form-control">
                  </div>
              </div>
              <div class="row mb-3">
                {{-- <label class="col-sm-2 col-form-label"></label> --}}
                <div class="col-md-6 text-start">
                  <button type="submit" class="btn btn-danger text-start"> Cancel </button>
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
