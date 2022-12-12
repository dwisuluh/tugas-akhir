@extends('layouts.loginapp')

@section('content')
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex justify-content-center py-4">
              <img src="{{ asset('/') }}plugins/img/logo-bsi.png" alt="Image" height="100">
            </div>
            <div class="d-flex justify-content-center py-4">
              <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                <span class="d-none d-lg-block">E-Layanan BSI</span>
              </a>
            </div><!-- End Logo -->
            @if (session()->has('loginError'))
              <div class="d-flex justify-content-center py-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="bi bi-exclamation-triangle me-1"></i>
                  {{ session('loginError') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            @endif
            @if (session()->has('success'))
              <div class="d-flex justify-content-center py-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <i class="bi bi-check-circle me-1"></i>
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>
            @endif
            <div class="card mb-3">

              <div class="card-body">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                </div>

                <form class="row g-3 needs-validation" novalidate method="POST" action="register-reset">
                  @csrf
                  <div class="col-12">
                    <div class="input-group has-validation">
                      <div class="form-floating mb-3">
                        <input type="text" name="nim"
                          class="form-control @error('nim') is-invalid
                                  @enderror"
                          id="floatingNIM" placeholder="masukan NIM anda" value="{{ old('nim') }}" required>
                        <label for="floatingNIM">NIM</label>
                        @error('nim')
                          <span class="invalid-feedback" role="alert">
                            <strong>Status akun belum aktif atau tidak terdaftar, silahkan aktikan melalui menu registrasi</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Reset</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <a href="{{ route('login') }}" class="btn btn-danger w-100" type="submit">Back</a>
                    </div>
                  </div>
                </form>

              </div>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
@endsection
