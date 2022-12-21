@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">User</li>
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
            <div class="row">
              <div class="col-sm-6">
                <h5 class="card-title">Data User</h5>
              </div>
              <div class="col-sm-6 sm-auto mt-3">
                <p class="text-end"><a href="{{ route('user.create') }}" class="btn btn-primary btn-sm sm-auto">
                    <i class="bi bi-person-plus"></i> Tambah Data </a></p>
              </div>
            </div>
            <!-- Bordered Table -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">username</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role === 1 ? 'Admin' : 'Mahasiswa' }}</td>
                    <td>
                      <a type="button" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top"
                        title="Detail" href="{{ route('user.show', Crypt::encrypt($user->id)) }}"><i
                          class="bi bi-eye"></i></a>
                      <a type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                        title="Edit" href="{{ route('user.edit', Crypt::encrypt($user->id)) }}"><i
                          class="bi bi-pencil"></i></a>
                      <form method="POST" action="{{ route('user.destroy', $user->id) }}" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                          title="Delete" onclick="return "><i class="bi bi-trash"></i></button>
                      </form>
                      {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop">
                        Launch Modal
                      </button> --}}
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
  {{-- <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda Yakin akan menghapus data tersebut?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
