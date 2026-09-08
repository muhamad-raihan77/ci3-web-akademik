<html>
  <head>
    <title><?php echo $title; ?></title>
    <style>
        .line-title {
            border: 1;
            border-style: inset;
            border-top: 1px solid #0000;
        }
    </style>
 </head>
 <body>
<div class="container-fluid">
<img src="<?php echo base_url(); ?>assets/img/horizon.jpg" 
width="50" height="50">
<hr class="line-title">
 <h2>
<p class="mb-10">Biodata Mahasiswa</p>
</h2>
<div class="card mb-3">
  <div class="card-body">
<table>
 <tr>
  <td>NIM</td>
  <td>:</td>
  <td><?php echo $mahasiswa->npm; ?></td>
 </tr>
 <tr>
  <td>Nama</td>
  <td>:</td>
  <td><?php echo $mahasiswa->nama; ?></td>
</tr>
<tr>
<td>Foto</td>
<td>:</td>
<td>
<img src="<?= base_url('assets/foto/').$mahasiswa->foto; ?>" width="50" class="img-thumbnail">
</td>
</tr>
</table>
</div>
</div>
</div>
</body>
</html>
