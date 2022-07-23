<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">Rent A car</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          

          <li class="nav-header">Meni</li>

          <li class="nav-item  <?php if($activePage == 'Vozila' || $activePage == 'Drzave' || $activePage == 'Proizvodjaci' || $activePage == 'Modeli' || $activePage == 'Klijenti'  ) echo "menu-is-opening menu-open"; ?>">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-table"></i>
              <p>
                Sifarnici
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="vozila.php" class="nav-link <?php if($activePage == 'Vozila') echo "active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vozila</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="klijenti.php" class="nav-link <?php if($activePage == 'Klijenti') echo "active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Klijenti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="proizvodjaci.php" class="nav-link <?php if($activePage == 'Proizvodjaci') echo "active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Proizvodjaci</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="modeli.php" class="nav-link <?php if($activePage == 'Modeli') echo "active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modeli</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="drzave.php" class="nav-link <?php if($activePage == 'Drzave') echo "active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Drzave</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if($activePage == 'dashboard' || $activePage == 'Rezervacije' ) echo "active"; ?>">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Rezervacije
              </p>
            </a>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>