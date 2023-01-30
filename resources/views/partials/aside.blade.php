<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link {{ Request::is('/') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('surat*') ? '' : 'collapsed' }}" data-bs-target="#components-nav"
        data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Surat Ijin</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse {{ Request::is('surat*') ? 'show' : '' }}"
        data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ url('surat-observasi') }}" class="{{ Request::is('surat-observasi*') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Studi Pendahuluan</span>
          </a>
        </li>
        <li>
          <a href="{{ url('surat-penelitian') }}"
            class="{{ Request::is('surat-penelitian*') ? 'active' : '' }}">
            <i class="bi bi-circle"></i><span>Penelitian</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ Request::is('karya-ilmia*') ? '' : 'collapsed' }}" href="{{ url('karya-ilmiah') }}">
        <i class="bi bi-grid"></i>
        <span>Karya Ilmiah</span>
      </a>
    </li>
    @can('admin')
      <li class="nav-heading">Master</li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('mahasiswa*') ? '' : 'collapsed' }}" href="{{ route('mahasiswa.index') }}">
          <i class="bi bi-person"></i>
          <span>Data Mahasiswa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('data-dosen*') ? '' : 'collapsed' }}" href="{{ url('data-dosen') }}">
          <i class="bi bi-person"></i>
          <span>Data Dosen</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('user*') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
          <i class="bi bi-people-fill"></i>
          <span>User</span>
        </a>
      </li>
    @endcan
  </ul>
</aside><!-- End Sidebar-->
