@extends('layouts.app')
@section('content')
  <div class="pagetitle">
    <h1>Karya Ilmiah</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">{{ $title }}</li>
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
        @elseif (session()->has('failed'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamtion-octagon-fill me-1"></i>
            {{ session('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <h5 class="card-title">Data {{ $title }}</h5>
              </div>
              @can('mhs')
                <div class="col-6 sm-auto mt-3">
                    @if(!$karyas || $karyas->first()->status == 4)
                  <p class="text-end"><a href="{{ route($link . '.create') }}"
                      class="btn btn-primary btn-sm text-end d-inline">
                      <i class="bi bi-file-plus"></i> Upload Karya Ilmiah </a></p>
                </div>
                @else
                  <p class="text-end"><a href="#"
                      class="btn btn-danger btn-sm text-end d-inline">
                      <i class="bi bi-x-circle"></i> Masih Ada Proses Pengajuan </a></p>
                </div>
                @endif
              @endcan
            </div>
            <!-- Bordered Table -->
            <table class="table datatable table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">
                    @can('mhs')
                      Judul Karya Tulis
                    @endcan
                    @can('admin')
                      NIM
                    @endcan
                  </th>
                  <th scope="col">Tanggal Surat</th>
                  <th scope="col">Tanggal Pengajuan</th>
                  <th scope="col">Status</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($karyas as $mail)
                  <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>
                      @can('admin')
                        {{ $mail->nim }}
                      @endcan
                      @can('mhs')
                        {!! $mail->judul !!}
                      @endcan
                    </td>
                    <td>{{ $mail->tgl_surat }}</td>
                    <td>{{ $mail->created_at }}</td>
                    <td>
                      @if ($mail->status == 1)
                        <span class="badge rounded-pill bg-primary">Open</span>
                      @elseif ($mail->status == 2)
                        <span class="badge rounded-pill bg-warning">On Progress</span>
                      @elseif ($mail->status == 3)
                        <span class="badge rounded-pill bg-success">Done</span>
                      @elseif ($mail->status == 4)
                        <span class="badge rounded-pill bg-danger">Rejected</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route($link . '.show', $mail->id) }}" type="button" class="btn btn-info btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Detail"><i class="bi bi-eye"></i></a>
                      @can('admin')
                        <a href="{{ route($link . '.edit', $mail->id) }}" type="button"
                          class="btn btn-warning btn-sm {{ $mail->status == 4 ? 'disabled' : '' }}" data-toggle="tooltip"
                          data-placement="top" title="Proses" disabled><i class="bi bi-pencil-square"></i></a>
                        @if ($mail->status == 2 || $mail->status == 3)
                          <a href="{{ route('files.show', $mail->id) }}" target="_blank" type="button"
                            class="btn btn-primary btn-sm"><i class="bi bi-printer"></i> </a>
                        @endif
                      @endcan
                      @if ($mail->status == 3)
                        <a href="{{ route($print, $mail->id) }}" target="_blank" type="button"
                          class="btn btn-success btn-sm"><i class="bi bi-cloud-download"></i></a>
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
            <!-- End Data Surat -->
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
