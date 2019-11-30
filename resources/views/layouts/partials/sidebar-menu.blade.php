<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ url('home') }}" class="nav-link {{{ (Request::is('home') ? 'active' : '') }}}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('surat-tugas') }}" class="nav-link {{{ (Request::is('surat-tugas') ? 'active' : '') }}}">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
          Surat Tugas
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('laporan-surat-tugas') }}" class="nav-link {{{ (Request::is('laporan-surat-tugas') ? 'active' : '') }}}">
        <i class="nav-icon fas fa-book"></i>
        <p>
          Laporan Surat Tugas
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('keuangan') }}" class="nav-link">
        <i class="nav-icon fas fa-money-check-alt"></i>
        <p>
          Keuangan
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('user') }}" class="nav-link {{{ (Request::is('user') ? 'active' : '') }}}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Pengguna
        </p>
      </a>
    </li>
    <li class="nav-item has-treeview {{{ (Request::is('jenis-surat-tugas') ? 'menu-open' : '') }}}">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-database"></i>
        <p>
          Master Data
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ url('jenis-surat-tugas') }}" class="nav-link {{{ (Request::is('jenis-surat-tugas') ? 'active' : '') }}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Jenis Surat Tugas</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('tujuan-surat-tugas') }}" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Tujuan Surat Tugas</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>