<div class="row mb-2">
  <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
  <div class="col-lg-9 col-md-8">{{ $data->mahasiswa->name }}</div>
</div>
<div class="row mb-2">
  <div class="col-lg-3 col-md-4 label">NIM</div>
  <div class="col-lg-9 col-md-8">{{ $data->nim }}</div>
</div>
<div class="row mb-2">
    <div class="col-lg-3 col-md-4 label">Jenis Surat</div>
    <div class="col-lg-9 col-md-8">{{ ($data->id_surat == 2 ) ? 'Ijin Penelitian' : 'Studi Pendahuluan'  }}</div>
</div>
<div class="row mb-2">
  <div class="col-lg-3 col-md-4 label">Tanggal Surat</div>
  <div class="col-lg-9 col-md-8">{{ $data->tgl_surat }}</div>
</div>
<div class="row mb-2">
  <div class="col-lg-3 col-md-4 label">Tujuan</div>
  <div class="col-lg-9 col-md-8">{!! $data->tujuan !!}</div>
</div>
<div class="row mb-2">
  <div class="col-lg-3 col-md-4 label">Alamat</div>
  <div class="col-lg-9 col-md-8">{!! $data->alamat !!}</div>
</div>
<div class="row mb-2">
  <div class="col-lg-3 col-md-4 label">Judul</div>
  <div class="col-lg-9 col-md-8">{!! $data->judul !!}</div>
</div>
@if($data->id_surat == 2)
<div class="row mb-2">
    <div class="col-lg-3 col-md-4 label">Waktu Pelaksanaan</div>
    <div class="col-lg-9 col-md-8"><strong>{{ $data->tgl_mulai }}</strong> sampai <strong>{{ $data->tgl_selesai }}</strong></div>
  </div>
@endif
