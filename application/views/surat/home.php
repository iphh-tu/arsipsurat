<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <!-- <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-program"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div> -->
    <div class="col-md-3">
        <a href="<?php echo base_url('Surat/export'); ?>" class="form-control btn btn-success"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-warning" data-toggle="modal" data-target="#import-surat"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th class="col-md-1">#</th>
          <th class="col-md-2">Tanggal Agenda</th>
          <th class="col-md-2">Nomor Agenda</th>
          <th>Asal Surat</th>
          <th>Tujuan</th>
          <th class="col-md-2">Nomor Surat</th>
          <th class="col-md-2">Tanggal Surat</th>
          <th class="col-md-2">Perihal</th>

          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-surat">
      
      </tbody>
    </table>
  </div>
</div>

<!-- <?php echo $modal_tambah_program; ?> -->

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataProgram', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<?php
  $data['judul'] = 'Surat';
  $data['url'] = 'Surat/import';
  echo show_my_modal('modals/modal_import', 'import-surat', $data);
?>