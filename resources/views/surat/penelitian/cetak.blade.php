@extends('layouts.masterSurat')
@section('content')
  <div class="row space-text-1">
    <table>
      <tr>
        <td style="width: 2cm">Nomor</td>
        <td>: {{ $surat->no_surat }}/S.Permoh.RMIK/Dir-POLBSI/{{ date('Y', strtotime($surat->tgl_surat)) }}</td>
      </tr>
      <tr>
        <td>Hal</td>
        <td>: Surat Ijin Penelitian</td>
      </tr>
    </table>
  </div>
  <div class="row space-text-1">
    <div class="row mt-4">
      <div class="col-sm-3">
        Kepada Yth.
      </div>
      <div class="col-sm-5">
        {!! $surat->tujuan !!}
      </div>
      <div class="col-sm-5">
        {!! $surat->alamat !!}
      </div>
    </div>
  </div>
  <div class="row">
    <div class="row mt-4">
      <div class="col-lg-12">
        Dengan Hormat
        <p class="indent text-justify">Sehubungan dengan akan diselenggarakannya kegiatan Karya Tulis Ilmiah (KTI) sebagai
          salah satu syarat untuk menyelesaikan studi di Politeknik Kesehatan Bhakti Setya Indonesia Yogyakarta, maka kami mengajukan
          permohonan ijin untuk studi penelitian bagi mahasiswa kami yaitu:</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <table>
        <tr>
          <td style="width: 3cm;">Nama</td>
          <td style="width: 0.5cm;">:</td>
          <td style="width: 60%;">{{ $surat->mahasiswa->name }}</td>
        </tr>
        <tr>
          <td>NIM</td>
          <td style="width: 5%;">:</td>
          <td style="width: 60%;">{{ $surat->mahasiswa->nim }}</td>
        </tr>
        <tr>
          <td style="vertical-align: top;">Program Studi</td>
          <td style="width: 5%; vertical-align: top;">:</td>
          <td style="width: 60%;">
            @if ($surat->mahasiswa->program_studi == 1)
              {{ __('Rekam Medis dan Informasi Kesehatan') }}
            @elseif ($surat->mahasiswa->program_studi == 2)
              {{ __('Teknologi Transfusi Darah') }}
            @elseif ($surat->mahasiswa->program_studi == 3)
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
          <td style="width: 65%;">{!! $surat->judul !!}</td>
        </tr>
        <tr>
          <td>Lokasi</td>
          <td style="width: 5%;">:</td>
          <td style="width: 60%;">{!! $surat->lokasi !!}</td>
        </tr>
        <tr>
          <td>Waktu</td>
          <td style="width: 5%;">:</td>
          <td style="width: 60%;">{{ $surat->tgl_mulai_ind }} Sampai {{ $surat->tgl_selesai_ind }}</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="row mt-2">
      <div class="col-lg-12">
        <p>Demikian permohonan kami, atas perhatian dan kerjasamanya kami sampaikan terima kasih.</p>
      </div>
    </div>
  </div>
@endsection
@section('tanggal')
  {{ $surat->tgl_ind }}
@endsection
@section('pejabat')
  <div class="mt-5">
    <p>
      <br>
      Dra. Yuli Puspita Rini, M.Si.
    </p>
  </div>
@endsection
@section('footer')
<img src="data:image/png;base64, {!! $qrCode !!}">
@endsection
