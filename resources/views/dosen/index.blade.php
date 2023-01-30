@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>Dosen</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Data Dosen</li>
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
        @if (session()->has('danger'))
          <div class="d-flex justify-content-center py-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-person-x-fill me-1"></i>
              {{ session('danger') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        @endif
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Dosen</h5>
            <p>
              <span class="text-start">
                <a href="{{ route('dosen-import') }}" class="btn btn-sm btn-success"><i class="bi bi-cloud-arrow-up"></i> Import</a>
              </span>
              <span class="text-end sm-auto">
                <a href="{{ route('data-dosen.create') }}" class="btn btn-primary btn-sm sm-auto text-end">
                  <i class="bi bi-person-plus"></i> Tambah Data </a>
            </p>
            </span>
            <!-- Bordered Table -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($dosen as $list)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $list->nama }}</td>
                    <td>
                      <a type="button" class="btn btn-primary btn-sm"
                        href="{{ route('data-dosen.edit', $list->id) }}" data-toggle="tooltip"
                        data-placement="top" title="Edit"><i class="bi bi-pencil"></i></a>
                      <form method="POST" action="{{ route('data-dosen.destroy', $list->id) }}"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah {{ $list->nama }} benar akan dihapus?')"><i class="bi bi-trash" data-toggle="tooltip"
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
