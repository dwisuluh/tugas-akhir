@extends('layouts.loginapp')
@section('content')
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <img src="{{ asset('/') }}plugins/img/logo-bsi.png" alt="" width="100">
            <div class="d-flex justify-content-center py-4">
              <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                <span class="d-none d-lg-block">e-layanan</span>
              </a>
            </div><!-- End Logo -->
            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Registrasi</h5>
                  <p class="text-center small">Enter your personal details to create account</p>
                </div>
                <form class="row g-3 needs-validation" action="/register" method="POST" novalidate>
                  @csrf
                  <div class="col-12">
                    <label for="yourNIM" class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
                      value="{{ old('nim') }}" id="yourNIM" required autocomplete="name" autofocus>
                    @error('nim')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="yourEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                      value="{{ old('email') }}" id="yourEmail" required>
                    @error('email')
                      <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </div>
                    @enderror
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms"
                        required>
                      <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and
                          conditions</a></label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                  </div>
                  <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="/login">Log
                        in</a>
                    </p>
                  </div>
                </form>

              </div>
            </div>
            <div class="credits">
              Designed by Akademik Poltekkes BSI
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
