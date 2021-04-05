<?php
  $no = 1;
  foreach ($dataKegiatan as $kegiatan) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kegiatan->kode_program; ?></td>
      <td><?php echo $kegiatan->nama_program; ?></td>
      <td><?php echo $kegiatan->kode_kegiatan; ?></td>
      <td><?php echo $kegiatan->nama_kegiatan; ?></td>
      <td><?php echo $kegiatan->pagu; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKegiatan" data-id="<?php echo $kegiatan->id_kegiatan; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger konfirmasiHapus-Kegiatan" data-id="<?php echo $kegiatan->id_kegiatan; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>