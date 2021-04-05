<?php
  $no = 1;
  foreach ($datasurat as $surat) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $surat->tgl_agenda; ?></td>
      <td><?php echo $surat->no_agenda; ?></td>
      <td><?php echo $surat->asal_surat; ?></td>
      <td><?php echo $surat->tujuan; ?></td>
      <td><?php echo $surat->no_surat; ?></td>
      <td><?php echo $surat->tgl_surat; ?></td>
      <td><?php echo $surat->perihal; ?></td>
      <td class="text-center" style="min-width:100px;">
          <?php if($surat->perihal == ''){ echo '<button class="btn btn-info" data-id="'.$surat->no_agenda.'"><i class="glyphicon glyphicon-repeat"></i> Upload</button>'; } ?>
          
          <button class="btn btn-warning update-dataSurat" data-id="<?php echo $surat->no_agenda; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger konfirmasiHapus-surat" data-id="<?php echo $surat->no_agenda; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>