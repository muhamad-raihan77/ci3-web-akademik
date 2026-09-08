<?php
header('Content-type: application/vnd-ms-excel');
header("Content-Disposition: attachment; filename=Laporan_Mahasiswa.xls");
header('Pragma: no-cache');
header('Expires: 0');
?>
<table border='1' width='100%'>
 <thead>
 <tr>
    <th>No</th>
    <th>NPM</th>
    <th>Nama</th>
    <th>Photo</th>
 </tr>
 </thead>
 <tbody>
 <?php 
$i=1; 
if (is_object($mahasiswa)) {
    $mahasiswa = [$mahasiswa];
}
foreach($mahasiswa as $data) { ?>
<tr>
  <td><?php echo $i ?></td>
  <td><?php echo $data->npm; ?></td>
  <td><?php echo $data->nama; ?></td>
  <td><?php echo $data->foto; ?></td>
</tr>
<?php $i++; } ?>
</tbody>
</table>
