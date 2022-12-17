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
                      @enderror"
                        placeholder="Tanggal" aria-label="tanggal ujian" aria-describedby="basic-addon2" name="tgl_ujian"
                        required>
                      <span class="input-group-text" id="basic-addon2"><i class="bi bi-calendar-date"></i></span>
                      @error('tgl_ujia')
                        <span class='invalid-feedback' role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Pembimbing" class="col-sm-2 col-form-label">Pembimbing</label>
                  <div class="col-sm-6">
                    <select
                      class="form-select select2 @error('pembimbing')
                        is-invalid
                    @enderror"
                      id="js-example-basic-single" multiple aria-label="Default select example" name="pembimbing[]"
                      required>
                      <option>Ibnu Mardiyoko, S.KM., MM</option>
                      <option>Hendra Rohman, S.KM. M.P.H</option>
                      <option>Syarah Mazaya F., S.KM., M.P.H</option>
                      <option>Vidya Widowati, S.KM., M.A.R.S</option>
                      <option>Yuli Fitriyah, S.KM., M.P.H</option>
                      <option>Agung Dwi Saputro, S.KM., M.A.R.S</option>
                      <option>Andhy Sulistyo, M.Kom</option>
                      <option>dr. Anna Dewi Lukitasari, M.P.H</option>
                      <option>Indra Narendra, M.H.Kes</option>
                      <option>M. Imron Mawardi, M.Kes (Epid)</option>
                      <option>Sugeng, S.KM., MM</option>
                      <option>Ana Mardiyaningsih, M.Sc., Apt</option>
                      <option>Eddy Kristiyono, S.KM</option>
                      <option>Fadia Sulaiman, S.Thi., M.Si</option>
                      <option>Nur Ismiyati, M.Sc., Apt</option>
                      <option>Oni Noviandi K., S.Pd., M.Pd</option>
                      <option>Pramono, S.Kom</option>
                      <option>Widhi Sulistyo, S.Kom. M.Cs</option>
                      <option>Windadari Murni Hartini, M.P.H</option>
                    </select>
                    @error('pembimbing')
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
                @if ($title === 'Penelitian')
                  <div class="row mb-3">
                    <label for="Lokasi" class="col-sm-2 col-form-label">Lokasi Penelitian</label>
                    <div class="col-sm-10">
                      <input id="lokasi" type="hidden" name="lokasi" value="{{ old('lokasi') }}">
                      <trix-editor input="lokasi"
                        class="@error('lokasi')
                      is-invalid
                  @enderror">
                      </trix-editor>
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
                      <input type="date" class="form-control"
                        @error('tgl_awal')
                        is-invalid
                    @enderror name="tgl_awal"
                        value="{{ old('tgl_awal') }}" required>
                    </div>
                    <label for="inputDate" class="col-sm-1 col-form-label"> Sampai </label>
                    <div class="col-sm-4">
                      <input type="date"
                        class="form-control @error('tgl_akhir')
                        is-invalid
                    @enderror"
                        name="tgl_akhir" value="{{ old('tgl_akhir') }}" required>
                    </div>
                  </div>
                @endif
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
