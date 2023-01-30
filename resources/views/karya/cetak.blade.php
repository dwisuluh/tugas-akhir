@extends('layouts.masterSurat')
@section('content')
  <div class="row space-text-1">
    <div class="row mt-4">
      <div class="col-sm-12" style="text-align: center">
        <h4><u>SURAT KETERANGAN</u></h4>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="row mt-4">
      <div class="col-lg-12">
        <p class="text-justify">Saya yang bertanda tangan dibawah ini, menerangkan bahwa mahasiswa berikut ini:</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <table>
        <tr>
          <td style="width: 3cm;">Nama</td>
          <td style="width: 0.5cm;">:</td>
          <td style="width: 60%;">{{ $karyaIlmiah->mahasiswa->name }}</td>
        </tr>
        <tr>
          <td>NIM</td>
          <td style="width: 5%;">:</td>
          <td style="width: 60%;">{{ $karyaIlmiah->mahasiswa->nim }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top;">Program Studi</td>
          <td style="width: 5%; vertical-align: top;">:</td>
          <td style="width: 60%;">
            @if ($karyaIlmiah->mahasiswa->program_studi == 1)
              {{ __('Rekam Medis dan Informasi Kesehatan') }}
            @elseif ($karyaIlmiah->mahasiswa->program_studi == 2)
              {{ __('Teknologi Transfusi Darah') }}
            @elseif ($karyaIlmiah->mahasiswa->program_studi == 3)
              {{ __('Farmasi') }}
            @endif
          </td>
        </tr>
        <tr>
          <td>Jenjang</td>
          <td style="width: 5%;">:</td>
          <td style="width: 60%;">Diploma-3 (D3)</td>
        </tr>
        <tr>
          <td style="width: 30%;">Judul</td>
          <td style="width: 5%;">:</td>
          <td style="width: 65%;">{!! $karyaIlmiah->judul !!}</td>
        </tr>
        <tr>
          <td>Pembimbing 1</td>
          <td style="width: 5%;">:</td>
          <td style="width: 60%;">{!! $karyaIlmiah->pembimbing_1 !!}</td>
        </tr>
        <tr>
          <td>Pembimbing 2</td>
          <td style="width: 5%;">:</td>
          <td style="width: 60%;">{{ $karyaIlmiah->pembimbing_2 }}</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="row mt-2">
      <div class="col-lg-12">
        <p>Telah mengunggah Dokumen Karya Tulis Ilmiah dan dinyatakan diterima.
          Demikian surat keterangan bukti unggah Dokument Karya Tulis Ilmiah ini diberikan kepada yang bersangkutan untuk
          dipergunakan sebagai syarat kelengkapan wisuda.</p>
      </div>

    </div>
  </div>
@endsection
@section('tanggal')
  {{ $karyaIlmiah->tgl_ind }}
@endsection

@section('ttd')
  <img src="data:image/png;base64, {!! $qrCode !!}">
@endsection
@section('pejabat')
    <p>
      Dra. Yuli Puspita Rini, M.Si.
    </p>
@endsection
