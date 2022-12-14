@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Karya Ilmiah</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{ $title }}</a></li>
        <li class="breadcrumb-item active">Upload Surat</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body pt-3">
            <h5 class="card-title">Data karyaIlmiah Ijin {{ $title }}</h5>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label ">Nama Lengkap</div>
              <div class="col-lg-10 col-md-8">{{ $karyaIlmiah->mahasiswa->name }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">NIM</div>
              <div class="col-lg-10 col-md-8">{{ $karyaIlmiah->nim }}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">Judul</div>
              <div class="col-lg-9 col-md-10">{!! $karyaIlmiah->judul !!}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">Tanggal Ujian</div>
              <div class="col-lg-9 col-md-8">{!! $karyaIlmiah->tgl_ujian !!}</div>
            </div>
            <div class="row mb-2">
              <div class="col-lg-2 col-md-2 label">Pembimbing 1</div>
              <div class="col-lg-9 col-md-8">{!! $karyaIlmiah->pembimbing_1 !!}</div>
            </div>
            @if ($karyaIlmiah->pembimbing_2)
              <div class="row mb-4">
                <div class="col-lg-2 col-md-2 label">Pembimbing 2</div>
                <div class="col-lg-9 col-md-8">{{ $karyaIlmiah->pembimbing_2 }}</div>
              </div>
            @endif
            @if ($karyaIlmiah->status == 2)
              <form method="POST" action="{{ route($link . '.update', $karyaIlmiah->id) }}" class="d-inline"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row mb-4">
                  <div class="col-lg-2 col-md-2 label">Upload Surat</div>
                  <div class="col-lg-9 col-md-8">
                    <input class="form-control @error('file') is-invalid
                    @enderror" type="file"
                      id="formFile" name="file" required>
                    @error('file')
                      <span class="invalid-feedback" role="alert">
                        {{ $message }}
                      </span>
                    @enderror
                    <input type="hidden" value="3" name="status">

                  </div>
                </div>
                <div class="row">
                  <div class="text-start col-6">
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-danger"><i
                        class="bi bi-arrow-left-circle"></i> Back</a>
                  </div>
                  <div class="col-sm-6 text-end">
                    <button type="submit" class="btn btn-primary">Proses <i
                        class="bi bi-arrow-right-circle"></i></button>
                  </div>
                </div>
              </form>
            @endif
            <div class="row mt-3">
              <div class="col-6 text-end">
                @can('admin')
                  @if ($karyaIlmiah->status == 1)
                    <form method="POST" action="{{ route($link . '.destroy', $karyaIlmiah->id) }}" class="d-inline">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger"><i class="bi bi-x-circle" data-toggle="tooltip"
                          data-placement="top" title="Reject"></i> Reject</button>
                    </form>
                    <form method="POST" action="{{ route($link . '.update', $karyaIlmiah->id) }}" class="d-inline">
                      @method('PUT')
                      @csrf
                      <input type="hidden" value="2" name='status'>
                      <button type="submit" class="btn btn-primary">Proses <i
                          class="bi bi-arrow-right-circle"></i></button>
                    </form>
                    <a href="{{ route('files.show', $karyaIlmiah->id) }}" target="_blank" type="button"
                      class="btn btn-success"><i class="bi bi-printer"></i> Print</a>
                  @endif
                @endcan
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
