<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">LIST MENU</li>
      <!-- Optionally, you can add icons to the links -->

      <!-- <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      
      <li <?php if ($page == 'pegawai') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Pegawai'); ?>">
          <i class="fa fa-user"></i>
          <span>Data Pegawai</span>
        </a>
      </li>

      <li <?php if ($page == 'posisi') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Posisi'); ?>">
          <i class="fa fa-briefcase"></i>
          <span>Data Posisi</span>
        </a>
      </li>
      
      <li <?php if ($page == 'kota') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('Kota'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Data Kota</span>
        </a>
      </li> -->
      <li class="treeview <?php if ($page == 'surat') {echo 'active';} ?>">
          <a href="<?php echo base_url('Surat'); ?>">
            <i class="fa fa-laptop"></i>
            <span>Arsip Surat</span>
          </a>
          
        </li>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if ($page == 'program') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Program'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Program</span>
              </a>
            </li>
            <li <?php if ($page == 'kegiatan') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Kegiatan'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Kegiatan</span>
              </a>
            </li>
            <li <?php if ($page == 'output') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Output'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Output</span>
              </a>
            </li>
            <li <?php if ($page == 'suboutput') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Suboutput'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Sub Output</span>
              </a>
            </li>
            <li <?php if ($page == 'komponen') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Komponen'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Komponen</span>
              </a>
            </li>
            <li <?php if ($page == 'subkomponen') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Subkomponen'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Sub Komponen</span>
              </a>
            </li>
            <li <?php if ($page == 'akun') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Akun'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Akun</span>
              </a>
            </li>
            <li <?php if ($page == 'detail') {echo 'class="active"';} ?>>
              <a href="<?php echo base_url('Detail'); ?>">
                <i class="fa fa-location-arrow"></i>
                <span>Detail</span>
              </a>
            </li>
            
          </ul>
        </li>
      
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>