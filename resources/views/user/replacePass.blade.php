@extends('layouts.app')
@section('content')
  <div class="pagetitle">
    <h1>Ganti Password</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item active">Ganti Password</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row justify-content-center">
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Konfirmasi Password</h5>

            @if (session()->has('passError'))
              <div class="d-flex justify-content-center py-4 mt-3 mb-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="bi bi-exclamation-octagon me-1"></i>
                  {{ session('passError') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            @endif
            <!-- General Form Elements -->
            <form class="row g-3 needs-validation" action="{{ route('user.update', Crypt::encryptString($user->id)) }}"
              method="POST" novalidate>
              @method('put')
              @csrf
              <div class="col-12">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">Password Lama</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control @error('oldPassword') is-invalid @enderror"
                      name="oldPassword" required>
                    @error('oldPassword')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">Password Baru</label>
                  <div class="col-sm-8">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                      name="password" required autocomplete="current-password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-3 col-form-label">Ulangi Password</label>
                  <div class="col-sm-8">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                      name="password_confirmation" required autocomplete="current-password">
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6 text-start">
                  <button type="cancel" class="btn btn-danger text-start"> Cancel </button>
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
