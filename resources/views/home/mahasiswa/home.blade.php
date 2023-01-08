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
    <div class="row">
      <div class="row">
        <!-- Tabel Pengajuan Surat Ijin Studi Pendahuluan -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Studi Pendahuluan <span>| Surat Ijin</span></h5>

              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Tanggal Surat</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($surats->where('id_surat', 1) as $list)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{!! $list->tujuan !!}</td>
                      <td><a href="#" class="text-primary"></a>{{ $list->tgl_surat }}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td><a href="{{ route('surat-observasi.show', $list->id) }}" class="btn">
                          @if ($list->status == 1)
                            <span class="badge rounded-pill bg-primary">Open</span>
                          @elseif ($list->status == 2)
                            <span class="badge rounded-pill bg-warning">On Progress</span>
                          @elseif ($list->status == 3)
                            <span class="badge rounded-pill bg-success">Done</span>
                          @elseif ($list->status == 4)
                            <span class="badge rounded-pill bg-danger">Rejected</span>
                          @endif
                        </a>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Pengajuan Studi Pendahuluan -->

        <!-- Tabel Pengajuan Surat Ijin Penelitian -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Penelitian <span>| Surat Ijin</span></h5>

              <table class="table table-striped datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Tanggal Surat</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($surats->where('id_surat', 2) as $list)
                    <tr>
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{!! $list->tujuan !!}</td>
                      <td><a href="#" class="text-primary"></a>{{ $list->tgl_surat }}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td><a href="{{ route('surat-penelitian.show', $list->id) }}" class="btn">
                          @if ($list->status == 1)
                            <span class="badge rounded-pill bg-primary">Open</span>
                          @elseif ($list->status == 2)
                            <span class="badge rounded-pill bg-warning">On Progress</span>
                          @elseif ($list->status == 3)
                            <span class="badge rounded-pill bg-success">Done</span>
                          @elseif ($list->status == 4)
                            <span class="badge rounded-pill bg-danger">Rejected</span>
                          @endif
                        </a>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>

            </div>

          </div>
        </div>
        <!-- End Pengajuan Surat Ijin Penelitian -->

        <!-- Pengajuan Surat Keterangan Pengumpulan Karya Tulis Ilmiah -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Surat Keterangan <span>| Karya Tulis Ilmiah</span></h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul Karya Tulis</th>
                    <th scope="col">Pembimbing</th>
                    <th scope="col">Waktu Pengajuan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($karyas as $list)
                    <tr>
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{!! $list->judul !!}</td>
                      <td>{{ $list->pembimbing_1 }}<br>{{ $list->pembimbing_2 }}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td><a href="{{ route('karya-ilmiah.show', $list->id) }}">
                          @if ($list->status == 1)
                            <span class="badge rounded-pill bg-primary">Open</span>
                          @elseif ($list->status == 2)
                            <span class="badge rounded-pill bg-warning">On Progress</span>
                          @elseif ($list->status == 3)
                            <span class="badge rounded-pill bg-success">Done</span>
                          @elseif ($list->status == 4)
                            <span class="badge rounded-pill bg-danger">Rejected</span>
                          @endif
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>

          </div>
        </div>
        <!-- End Pengajuan Surat Keterangan KTI -->

      </div>

    </div>
  </section>
@endsection
