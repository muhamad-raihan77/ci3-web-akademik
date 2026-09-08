<?php
header('Content-type: application/vnd-ms-excel');
header("Content-Disposition: attachment; filename=Laporan_Buku.xls");
header('Pragma: no-cache');
header('Expires: 0');
?>
<table border='1' width='100%'>
 <thead>
 <tr>
    <th>No</th>
    <th>Kode Buku</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Penerbit</th>
 </tr>
 </thead>
 <tbody>
 <?php 
$i=1; 
foreach($buku as $data) { ?>
<tr>
  <td><?php echo $i ?></td>
  <td><?php echo $data->kode_buku; ?></td>
  <td><?php echo $data->judul; ?></td>
  <td><?php echo $data->penulis; ?></td>
  <td><?php echo $data->penerbit; ?></td>
</tr>
<?php $i++; } ?>
</tbody>
</table>
