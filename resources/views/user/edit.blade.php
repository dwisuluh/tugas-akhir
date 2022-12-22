@extends('layouts.app')
@section('content')
  <!-- Star Page Header -->
  <div class="pagetitle">
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Header -->

  <section class="section">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Data user</h5>

            <!-- General Form Elements -->
            <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('user.update',Crypt::encryptString($user->id)) }}">
              @method('PUT')
              @csrf
              <div class="row mb-3">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                    value="{{ old('username', $user->username) }}" required>
                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $user->name) }}" required>
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" required>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      {{ $message }}
                    </span>
                  @enderror
                </div>
              </div>
              <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                <div class="col-sm-8">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="gridRadios1" value="1"
                      {{ $user->role == 1 ? 'checked' : '' }} required>
                    <label class="form-check-label" for="gridRadios1">
                      Admin
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="gridRadios2" value="0"
                      {{ $user->role == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="gridRadios2">
                      Mahasiswa
                    </label>
                  </div>
              </fieldset>
              <div class="row mb-3">
                {{-- <label class="col-sm-2 col-form-label"></label> --}}
                <div class="col-md-6 text-start">
                  <a type="cancel" href="{{ route('user.index') }}" class="btn btn-danger text-start"> Cancel </a>
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
