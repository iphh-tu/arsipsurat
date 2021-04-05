<?php
  $no = 1;
  foreach ($datasurat as $surat) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $surat->tgl_agenda; ?></td>
      <td><?php echo $surat->no_agenda; ?></td>
      <td><?php echo $surat->asal_surat; ?></td>
      <!-- <td><?php echo $surat->tujuan; ?></td>
      <td><?php echo $surat->no_surat; ?></td>
      <td><?php echo $surat->tgl_surat; ?></td> -->
      <td><?php echo $surat->perihal; ?></td>
      <td class="text-center col-md-1">
          <button class="btn btn-success upload-dataSurat" data-id="<?php echo $surat->no_agenda; ?>"><i class="glyphicon glyphicon-eye-open"></i></button>
          <?php if($surat->file == ''){ echo '<button class="btn btn-info upload-dataSurat" data-id="'.$surat->no_agenda.'"><i class="glyphicon glyphicon-upload"></i></button>'; } ?>
         <!--  <button class="btn btn-warning update-dataSurat" data-id="<?php echo $surat->no_agenda; ?>"><i class="glyphicon glyphicon-edit"></i></button> -->
          <button class="btn btn-danger konfirmasiHapus-surat" data-id="<?php echo $surat->no_agenda; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i></button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>