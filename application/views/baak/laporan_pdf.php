<head>
  <title><?php echo $title; ?></title>
</head>
<body>
  <table width="100%" style="border-bottom: 2px solid black; padding-bottom: 10px;">
   <tr>
     <td width="15%" align="center">
<?php
  $path = FCPATH . 'assets/img/horizon.jpg';
  $type = pathinfo($path, PATHINFO_EXTENSION);
  $data = file_get_contents($path);
?>
  <img src="data:image/<?= $type ?>;base64,<?= base64_encode($data); ?>" width="100">
     </td>
     <td width="85%" align="left">
       <span style="font-size:25px; font-weight:bold;">
         UNIVERSITAS HORIZON INDONESIA
       </span><br>
       <span style="font-size:12px;">
         Jl. Raya Pangkal Perjuangan Km.1 ByPass Karawang, Jawa Barat<br>
         Telp: (0267) 3331999 | Email: info@horizon.ac.id
       </span>
     </td>
  </tr>
</table>
<label style="font-size: 20px;"><b>Laporan Data Mahasiswa</b></label><br>
<i>Tahun Akademik 2025/2026</i><br><br>
<table border="1" class="table table-hover" id="dataTable" width="100%" cellspacing="0">
  <thead>
<tr>
 <th style="width: 30px;">No</th>
 <th>NPM</th>
 <th>Nama</th>
</tr>
  </thead>
  <tbody>
<?php
$no = 1;
foreach ($mahasiswa as $mhs) { ?>
<tr align="center">
  <td style="width: 30px;"><?php echo $no++; ?></td>
  <td><?php echo $mhs->npm; ?></td>
  <td><?php echo $mhs->nama; ?></td>
</tr>
<?php } ?>
  </tbody>
</table>
<table width="100%" style="padding-top: 30px;">
 <tr>
    <td>Mengetahui,</td>
    <td style="padding-left:150px;">
 <?php
  if (!function_exists('tanggal_indo')) {
      function tanggal_indo($tanggal){
          $bulan = [
            1 => 'Januari','Februari','Maret','April','Mei','Juni',
            'Juli','Agustus','September','Oktober','November','Desember'
          ];
          $pecah = explode('-', $tanggal);
          return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
      }
  }
?>
<label> Karawang, <?= tanggal_indo(date('Y-m-d')); ?></label>
     </td>
  </tr>
  <tr>
<td>Kepala BAAK</td>
<td style="padding-left:150px;">Staff Kemahasiswaan</td>
  </tr>
  <tr>
<td style="padding-top:50px;">Nama Pegawai, S.Kom.</td>
<td style="padding-top:50px;padding-left:150px;">Nama Pegawai, S.Kom.</td>
  </tr>
 </table>
</body>
