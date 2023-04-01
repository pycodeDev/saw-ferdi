<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php //echo session()->get('nama'); ?>
          <i class="far fa-user"></i>
          <?php echo session('nama'); ?>
          <!-- <span class="badge badge-success navbar-badge">10</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="/logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i>
            <span class="text-muted text-sm">Logout</span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->