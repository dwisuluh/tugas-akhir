@extends('layouts.app')
@section('content')
  <div class="pagetitle">
    <h1>Surat Ijin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Surat Ijin</li>
        <li class="breadcrumb-item">Penelitian</li>
        <li class="breadcrumb-item active">Proses</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  @switch($surat->mahasiswa->program_studi)
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
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                @if ($surat->status == 2)
                  Upload Naskah Surat
                @else
                  Pengajuan Ijin Penelitian
                @endif
              </h5>

              <!-- General Form Elements -->
              <form class="needs-validation" novalidate action="{{ route('surat.update',$surat->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <input type="hidden" value="{{ Auth::user()->mahasiswa->id }}" name=""> --}}
                <div class="row mb-3">
                  <label for="nim" class="col-sm-2 col-form-label">NIM </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nim" value="{{ $surat->mahasiswa->nim }}" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $surat->mahasiswa->name }}" disabled>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{ $prodi }}" disabled>
                  </div>
                </div>
                @if ($surat->status == 1)
                  <div class="row mb-3">
                    <label for="tujuan" class="col-sm-2 col-form-label">Instansi Tujuan</label>
                    <div class="col-sm-10">
                      <input id="tujuan" type="hidden" name="tujuan" value="{{ old('tujuan', $surat->tujuan) }}">
                      <trix-editor input="tujuan"
                        class="@error('tujuan')
                        is-invalid
                    @enderror">
                      </trix-editor>
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
                      <input id="alamat" type="hidden" name="alamat" value="{{ old('alamat', $surat->alamat) }}">
                      <trix-editor input="alamat"
                        class="@error('alamat')
                        is-invalid
                    @enderror">
                      </trix-editor>
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
                      <input id="judul" type="hidden" name="judul" value="{{ old('judul', $surat->judul) }}">
                      <trix-editor input="judul"
                        class="@error('judul')
                        is-invalid
                    @enderror">
                      </trix-editor>
                      @error('judul')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="noSurat" class="col-sm-2 col-form-label">Nomor Surat</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control @error('noSurat') is-invalid @enderror"
                        value="{{ old('noSurat', $surat->no_surat) }}" name="noSurat" required>
                    </div>
                    @error('noSurat')
                      <span class="invalid-feedback" role="alert">
                        {{ $message }}
                      </span>
                    @enderror
                  </div>
                  <div class="row mb-3">
                    <label for="tglSurat" class="col-sm-2 col-form-label">Tanggal Surat</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control @error('tglSurat') is-invalid @enderror"
                        value="{{ old('tglSurat', $surat->tgl_surat) }}" name="tglSurat" required>
                    </div>
                  </div>
                @endif
                @if ($surat->status == 2)
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
                @endif
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-6">
                    <select class="form-select" aria-label="Default select example" name="status" required>
                      <option value="2">Proses</option>
                      <option value="3" {{ $surat->status == 2 ? 'selected' : '' }}>Selesai</option>
                      <option value="4">Tolak</option>
                    </select>
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
