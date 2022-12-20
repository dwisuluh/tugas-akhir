@extends('layouts.app')
@section('content')
<!-- Page Titile -->
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
      <div class="row">
        @can('admin')
        <!-- Card Studi Pendahuluan -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">Studi Pendahuluan</a></li>
                <li><a class="dropdown-item" href="#">Penelitian</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Pengajuan Surat Ijin <span>| Today</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-newspaper"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $surats->count() }}</h6>
                  {{-- <span class="text-success small pt-1 fw-bold">00%</span> <span
                    class="text-muted small pt-2 ps-1">increase</span> --}}
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Studi Pendahuluan -->

        <!-- Card Karya Ilmiah -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

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
              <h5 class="card-title">Surat Keterangan <span>| Today</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-newspaper"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $karyas->count() }}</h6>
                  {{-- <span class="text-success small pt-1 fw-bold">{{ $karya }}</span> <span
                    class="text-muted small pt-2 ps-1">increase</span> --}}
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Karya Ilmiah -->

        <!-- Card Jumlah Mahasiswa -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">

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
              <h5 class="card-title">Mahasiswa <span>| aktif</span></h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $countMhs }}</h6>
                  {{-- <span class="text-danger small pt-1 fw-bold">12%</span>
                  <span class="text-muted small pt-2 ps-1">decrease</span> --}}
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Jumlah Mahasiswa -->
        @endcan

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

              <table class="table datatable table-striped">
                @can('admin')
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">NIM</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Waktu Pengajuan</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($surats->where('id_surat', 1) as $list)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $list->nim }}</td>
                        <td>{!! $list->mahasiswa->name !!}</td>
                        <td>{{ $list->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('surat-observasi.edit',$list->id) }}" class="btn">
                          @if ($list->id_surat == 1)
                            <span class="badge rounded-pill bg-primary">Open</span>
                          @elseif ($list->id_surat == 2)
                            <span class="badge rounded-pill bg-warning">On Progress</span>
                          @elseif ($list->id_surat == 3)
                            <span class="badge rounded-pill bg-success">Done</span>
                            @elseif ($list->id_surat == 4)
                              <span class="badge rounded-pill bg-danger">Rejected</span>
                          @endif
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                @endcan
                @can('mhs')
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Tanggal Surat</th>
                    <th scope="col">Waktu Pengajuan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($surats->where('id_surat', 1) as $list)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{!! $list->tujuan !!}</td>
                      <td>{!! $list->tgl_surat !!}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td><a href="{{ route('surat-observasi.show',$list->id) }}" class="btn">
                        @if ($list->id_surat == 1)
                          <span class="badge rounded-pill bg-primary">Open</span>
                        @elseif ($list->id_surat == 2)
                          <span class="badge rounded-pill bg-warning">On Progress</span>
                        @elseif ($list->id_surat == 3)
                          <span class="badge rounded-pill bg-success">Done</span>
                          @elseif ($list->id_surat == 4)
                            <span class="badge rounded-pill bg-danger">Rejected</span>
                        @endif
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>

                @endcan
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
                    <th scope="col">NIM</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Pengajuan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($surats->where('id_surat', 2) as $list)
                    <tr>
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{{ $list->nim }}</td>
                      <td>{!! $list->mahasiswa->name !!}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td><a href="{{ route('surat-penelitian.edit',$list->id) }}">
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
                    <th scope="col">NIM</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Pengajuan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($karyas as $list)
                    <tr>
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{{ $list->nim }}</td>
                      <td>{!! $list->mahasiswa->name !!}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td><a href="{{ route('surat-penelitian.edit',$list->id) }}">
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
  </section>
@endsection
