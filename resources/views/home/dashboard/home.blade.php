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

  <section class="section dashboard">
    <div class="row">


      <div class="row">

        <!-- Sales Card -->
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
                  <h6>{{ $surat->count() }}</h6>
                  {{-- <span class="text-success small pt-1 fw-bold">00%</span> <span
                    class="text-muted small pt-2 ps-1">increase</span> --}}

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
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
                  <h6>{{ $karya }}</h6>
                  {{-- <span class="text-success small pt-1 fw-bold">{{ $karya }}</span> <span
                    class="text-muted small pt-2 ps-1">increase</span> --}}
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
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
                  <h6>{{ $count }}</h6>
                  {{-- <span class="text-danger small pt-1 fw-bold">12%</span>
                  <span class="text-muted small pt-2 ps-1">decrease</span> --}}
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

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
                  @foreach ($surat->where('id_surat', 1) as $list)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $list->nim }}</td>
                      <td>{!! $list->mahasiswa->name !!}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td><a href="{{ route('pendahuluan.edit',$list->id) }}" class="btn">
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
                    <th scope="col">Tujuan</th>
                    <th scope="col">Pengajuan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($surat->where('id_surat', 2) as $list)
                    <tr>
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{{ $list->nim }}</td>
                      <td>{!! $list->tujuan !!}</td>
                      <td>{{ $list->created_at->diffForHumans() }}</td>
                      <td>
                        @if ($list->id_surat == 1)
                          <span class="badge rounded-pill bg-primary">Open</span>
                        @elseif ($list->id_surat == 2)
                          <span class="badge rounded-pill bg-warning">On Progress</span>
                        @elseif ($list->id_surat == 3)
                          <span class="badge rounded-pill bg-success">Done/span>
                          @elseif ($list->id_surat == 4)
                            <span class="badge rounded-pill bg-danger">Rejected</span>
                        @endif
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
                    <th scope="col">Customer</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><a href="#">#2457</a></th>
                    <td>Brandon Jacob</td>
                    <td><a href="#" class="text-primary">At praesentium minu</a></td>
                    <td>$64</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">#2147</a></th>
                    <td>Bridie Kessler</td>
                    <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                    <td>$47</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">#2049</a></th>
                    <td>Ashleigh Langosh</td>
                    <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                    <td>$147</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">#2644</a></th>
                    <td>Angus Grady</td>
                    <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                    <td>$67</td>
                    <td><span class="badge bg-danger">Rejected</span></td>
                  </tr>
                  <tr>
                    <th scope="row"><a href="#">#2644</a></th>
                    <td>Raheem Lehner</td>
                    <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                    <td>$165</td>
                    <td><span class="badge bg-success">Approved</span></td>
                  </tr>
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
