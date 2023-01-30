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
                  <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                </div>
                @if (session()->has('loginError'))
                  <div class="d-flex justify-content-center py-4 mt-3 mb-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      {{ session('loginError') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  </div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="/login">
                  @csrf

                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        id="yourUsername" value="{{ old('username') }}" required autocomplete="username" autofocus>
                      @error('username')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                      id="yourPassword" required>
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe"
                        {{ old('rememberMe') ? 'checked' : '' }}>
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>
                </form>
                <div class="col-12 mt-2">
                  <a href="{{ url('search') }}" class="btn btn-info w-100">Lacak Surat</a>
                </div>
                <div class="col-12">
                  <p class="small mb-0">Akun belum aktif?
                    <a href="/register">aktifkan akun</a>
                  </p>
                  <p class="small mb-0">Lupa password?
                    <a href="reset">
                      lupa password
                    </a>
                  </p>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>

    </section>

  </div>
@endsection
