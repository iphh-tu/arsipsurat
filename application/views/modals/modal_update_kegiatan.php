<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Kegiatan</h3>

  <form id="form-update-kegiatan" method="POST">
    <input type="hidden" name="id_kegiatan" value="<?php echo $dataKegiatan->id_kegiatan; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <select class="form-control" placeholder="== Pilih Program ==" name="id_program" aria-describedby="sizing-addon2">
        <option value="">== Pilih Program ==</option>
        <?php
          foreach ($selectProgram as $program) {
        ?>
        <option value="<?php echo $program->id_program; ?>"><?php echo "[".$program->kode_program."] ".$program->nama_program; ?></option>
        <?php
          }
        ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Kode Kegiatan" name="kode_kegiatan" aria-describedby="sizing-addon2" value="<?php echo $dataKegiatan->kode_kegiatan; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Kegiatan" name="nama_kegiatan" aria-describedby="sizing-addon2" value="<?php echo $dataKegiatan->nama_kegiatan; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Pagu" name="pagu" aria-describedby="sizing-addon2" value="<?php echo $dataKegiatan->pagu; ?>">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>