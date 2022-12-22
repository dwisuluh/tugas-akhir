@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">User</a></li>
        <li class="breadcrumb-item active">Detail</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body profile-card pt-3">
            <h5 class="card-title">Profile Details</h5>
            <div class="row">
              <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
              <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4 label">Jenis Akun</div>
              <div class="col-lg-9 col-md-8">{{ $user->role == 1 ? 'Admin' : 'Mahasiswa' }}</div>
            </div>
            <div class="row">
              <div class="col-lg-3 col-md-4 label">Email</div>
              <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
            </div>
            <div class="ms-auto text-end">
              <a href="{{ url()->previous() }}" type="button" class="btn btn-danger text-end"><i
                  class="bi bi-arrow-left-circle"></i> Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
