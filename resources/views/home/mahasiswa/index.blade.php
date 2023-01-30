@extends('layouts.app')
@section('content')
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  @if (session()->has('success'))
    <div class="d-flex justify-content-center py-4 mt-3 mb-3">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check2-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  <section class="section dashboard">
    <livewire:mahasiswa-dashboard />
  </section>
@endsection
