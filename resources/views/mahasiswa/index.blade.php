@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Mahasiswa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Data Mahasiswa</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        @if (session()->has('success'))
          <div class="d-flex justify-content-center py-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check-circle me-1"></i>
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        @endif
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Mahasiswa</h5>
            <p>
              <span class="text-start">
                <a href="{{ route('import-mahasiswa') }}" class="btn btn-sm btn-success"><i class="bi bi-cloud-arrow-up"></i> Import</a>
              </span>
              <span class="text-end sm-auto">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary btn-sm sm-auto text-end">
                  <i class="bi bi-person-plus"></i> Tambah Data </a>
            </p>
            </span>
            <!-- Bordered Table -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">NIM</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Program Studi</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $mahasiswa->nim }}</td>
                    <td>{{ $mahasiswa->name }}</td>
                    <td>
                      {{ $mahasiswa->program_studi == 1 ? 'Rekam Medis dan Informasi Kesehatan' : ($mahasiswa->program_studi == 2 ? 'Teknologi Bank Darah' : 'Farmasi') }}
                    </td>
                    <td>
                      <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" type="button" class="btn btn-info btn-sm"
                        data-toggle="tooltip" data-placement="top" title="Detail"><i class="bi bi-eye"></i></a>
                      <a type="button" class="btn btn-primary btn-sm"
                        href="{{ route('mahasiswa.edit', Crypt::encryptString($mahasiswa->id)) }}" data-toggle="tooltip"
                        data-placement="top" title="Edit"><i class="bi bi-pencil"></i></a>
                      <form method="POST" action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}"
                        class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash" data-toggle="tooltip"
                            data-placement="top" title="Delete"></i></button>
                      </form>
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
