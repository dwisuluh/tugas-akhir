@extends('layouts.app')
@section('content')
<div class="pagetitle">
    <h1>Surat Ijin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Surat Ijin</li>
        <li class="breadcrumb-item active">Studi Pendahuluan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <h5 class="card-title">Data Pengajuan Surat Studi Pendahuluan</h5>
              </div>
            </div>
            <!-- Bordered Table -->
            <table class="table datatable table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">NIM</th>
                  <th scope="col">Tujuan Surat</th>
                  <th scope="col">Tanggal Surat</th>
                  <th scope="col">Tanggal Pengajuan</th>
                  <th scope="col">Status</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $mail)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $mail->nim }}</td>
                    <td>{!! $mail->mahasiswa->name !!}</td>
                    <td>{{ $mail->tgl_surat }}</td>
                    <td>{{ $mail->created_at->diffForHumans() }}</td>
                    <td>
                      @if ($mail->status == 1)
                        <span class="badge rounded-pill bg-primary">Open</span>
                      @elseif ($mail->status == 2)
                        <span class="badge rounded-pill bg-warning">On Progress</span>
                      @elseif ($mail->status == 3)
                        <span class="badge rounded-pill bg-success">Done/span>
                        @elseif ($mai->status == 4)
                          <span class="badge rounded-pill bg-danger">Rejected</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('pendahuluan.show', $mail->id) }}" type="button" class="btn btn-info btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Detail"><i class="bi bi-info-circle"></i></a>
                      <a href="{{ route('pendahuluan.edit', $mail->id) }}" type="button" class="btn btn-primary btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Proses"><i class="bi bi-pencil-square"></i></a>
                      @if ($mail->id_surat == 3)
                        <a href="pendahuluan/print/{{ $mail->id }}" target="_blank" type="button"
                          class="btn btn-success btn-sm"><i class="bi bi-printer"></i></a>
                      @endif
                      {{-- <a type="button" class="btn btn-primary btn-sm"
                        href="{{ route('mahasiswa.edit', Crypt::encryptString($mahasiswa->id)) }}" data-toggle="tooltip"
                        data-placement="top" title="Edit"><i class="bi bi-pencil"></i></a> --}}
                      {{-- <form method="POST" action="{{ route('mahasiswa.destroy', Crypt::encryptString($mahasiswa->id)) }}"
                        class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash" data-toggle="tooltip"
                            data-placement="top" title="Delete"></i></button>
                      </form> --}}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Bordered Table -->
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
