<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/dist/img/user-avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <base href="<?php echo base_url() ?>">
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="administrator/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="administrator/siswa"><i class="fa fa-graduation-cap"></i> <span>Siswa</span></a></li>
        <li><a href="administrator/wali"><i class="fa fa-users"></i> <span>Wali</span></a></li>
        <li><a href="administrator/guru"><i class="fa fa-user"></i> <span>Guru</span></a></li>
        <li><a href="#"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-university"></i>
            <span>Akademik</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Kelas</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Jurusan</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Bagian</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Silabus</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Tugas</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Subjek</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Jadwal</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-address-book-o"></i>
            <span>Kehadiran</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Guru</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Siswa Mapel</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Siswa Hari</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Pengguna</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>