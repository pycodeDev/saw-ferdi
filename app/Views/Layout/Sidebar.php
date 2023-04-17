<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">SPK Jurusan SMA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo session('nama'); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
              <a href="/dashboard" class="nav-link" style="color:#fff">
                  <i class="nav-icon fa fa-tachometer-alt"></i>
                  <p>
                  Dashboard
                  </p>
              </a>
          </li>
          <li class="nav-header">FEATURE</li>
          <li class="nav-item">
              <a href="/kriteria" class="nav-link" style="color:#fff">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                  Kriteria
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="/sub/kriteria" class="nav-link" style="color:#fff">
                  <i class="nav-icon fa fa-bars"></i>
                  <p>
                  Sub Kriteria
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="/alternatif" class="nav-link" style="color:#fff">
                  <i class="nav-icon fa fa-server"></i>
                  <p>
                  Alternatif
                  </p>
              </a>
          </li>
          <li class="nav-header">SPK</li>
          <li class="nav-item">
              <a href="/rank" class="nav-link" style="color:#fff">
                  <i class="nav-icon fa fa-search"></i>
                  <p>
                  Eksekusi
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="/laporan" class="nav-link" style="color:#fff">
                  <i class="nav-icon fa fa-file"></i>
                  <p>
                  Laporan
                  </p>
              </a>
          </li>
          <!-- <li class="nav-header">Setting</li>
          <li class="nav-item">
              <a href="/dashboard" class="nav-link" style="color:#fff">
                  <i class="nav-icon fa fa-cog"></i>
                  <p>
                  Pengaturan
                  </p>
              </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>