<?php
  $no = 1;
  foreach ($dataOutput as $output) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $output->kode_program; ?></td>
      <td><?php echo $output->nama_program; ?></td>
      <td><?php echo $output->kode_output; ?></td>
      <td><?php echo $output->nama_output; ?></td>
      <td><?php echo $output->pagu; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataOutput" data-id="<?php echo $output->id_output; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger konfirmasiHapus-Output" data-id="<?php echo $output->id_output; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>