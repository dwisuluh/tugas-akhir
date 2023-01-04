@extends('layouts.app')
@section('content')
  {{-- @include('partials.navout') --}}
  <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
          <div class="d-flex justify-content-center py-4">
            <img src="{{ asset('/') }}plugins/img/logo-bsi.png" alt="Image" height="100">
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pelacakan Surat</h5>

            <!-- Floating Labels Form -->
            <form class="row g-3" action="{{ url('search') }}">
              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" class="form-control" id="floatingName" placeholder="Your Name" name="search"
                    value="{{ request('search') }}">
                  <label for="floatingName">Masukan Keyword</label>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- End floating Labels Form -->
          </div>
        </div>
      </div>
      @if ($surat != null)
        <div class="row justify-content-center">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hasil Pencarian</h5>

              @if ($surat->count() > 0)
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">NIM</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Tujuan</th>
                      <th scope="col">Tanggal Surat</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($surat as $data)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->mahasiswa->name }}</td>
                        <td>{!! $data->tujuan !!}</td>
                        <td>{{ $data->tgl_surat }}</td>
                        <td><a data-attr="{{ route('detail-surat-ijin',$data->id) }}" id="isiBody" class="btn btn-info btn-sm" type="button" data-toggle="tooltip"
                            data-placement="top" data-bs-toggle="modal" data-bs-target="#disablebackdrop"
                            title="Detail"><i class="bi bi-eye"></i></a></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <i class="bi bi-exclamation-octagon me-1"></i>
                  Tidak ada data surat ditemukan.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
            </div>
          </div>
        </div>
      @endif
    </div>
  </section>
@endsection
<div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Detail Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="isiBody">
        <div>
          {{-- Hasil show detail --}}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@section('script')
  <script>
    $(document).on('click','#isiBody', function(event){
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function(){
                $('#loader').show();
            },
            success: function(result){
                $('#isiBody').html(result).show();
            },
            complete: function(){
                $('#loader').hide();
            }
        })
    });
  </script>
  @endsection
