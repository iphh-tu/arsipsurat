<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Upload Surat</h3>
  <h5 style="display:block; text-align:center;"><?php echo $datasurat->no_agenda; ?></h5>

  <form id="form-upload-surat" method="POST">
    <input type="hidden" name="no_agenda" value="<?php echo $datasurat->no_agenda; ?>">
    <div class="form-group">
              <label for="inputFile" class="col-sm-2 control-label">File</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="File" name="file">
              </div>
            </div>
            <br>
            <br>
            <br>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Upload Surat</button>
      </div>
    </div>
  </form>
</div>