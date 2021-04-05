<?php
  $no = 1;
  foreach ($dataProgram as $program) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $program->kode_program; ?></td>
      <td><?php echo $program->nama_program; ?></td>
      <td><?php echo number_format($program->pagu,0,'','.'); ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataProgram" data-id="<?php echo $program->id_program; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger konfirmasiHapus-program" data-id="<?php echo $program->id_program; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>