<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="{{ url('/') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{ Request::is('pendahuluan*') ? '' : (Request::is('penelitian*') ? '':'collapsed') }}" data-bs-target="#components-nav"
          data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Surat Ijin</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse {{ Request::is('pendahuluan*') ? 'show' : (Request::is('penelitian*') ? 'show' :'') }}"
          data-bs-parent="#sidebar-nav">
          <li>
            <a href="/pendahuluan" class="{{ Request::is('pendahuluan*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Studi Pendahuluan</span>
            </a>
          </li>
          <li>
            <a href="{{ route('surat.index',['id' => 2]) }}" class="{{ Request::is('penelitian*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Penelitian</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Karya Tulis Ilmiah</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Upload KTI</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Surat Keterangan</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      @can('admin')
        <li class="nav-heading">Master</li>

        <li class="nav-item">
          <a class="nav-link {{ Request::is('mahasiswa*') ? '' : 'collapsed' }}" href="{{ route('mahasiswa.index') }}">
            <i class="bi bi-person"></i>
            <span>Data Mahasiswa</span>
          </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
          <a class="nav-link {{ Request::is('user*') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
            <i class="bi bi-people-fill"></i>
            <span>User</span>
          </a>
        </li><!-- End F.A.Q Page Nav -->
      @endcan
    </ul>
  </aside><!-- End Sidebar-->
